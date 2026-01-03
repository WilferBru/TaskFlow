import { describe, it, expect, beforeEach } from 'vitest'
import { createRouter, createWebHistory } from 'vue-router'

// Rutas mínimas para testear el guard
const routes = [
  {
    path: '/',
    name: 'home',
    component: { template: '<div>Home</div>' },
    meta: { requiresAuth: true },
  },
  {
    path: '/login',
    name: 'login',
    component: { template: '<div>Login</div>' },
    meta: { requiresGuest: true },
  },
]

describe('Auth Guard', () => {
  let router: ReturnType<typeof createRouter>

  beforeEach(() => {
    localStorage.clear()

    router = createRouter({
      history: createWebHistory(),
      routes,
    })

    // 👇 mismo guard que tienes en tu router real
    router.beforeEach((to, from, next) => {
      const isAuthenticated = !!localStorage.getItem('token')

      if (to.meta.requiresAuth && !isAuthenticated) {
        next({ name: 'login' })
      } else if (to.meta.requiresGuest && isAuthenticated) {
        next({ name: 'home' })
      } else {
        next()
      }
    })
  })

  it('redirige a login si no está autenticado y la ruta requiere auth', async () => {
    await router.push('/')
    expect(router.currentRoute.value.name).toBe('login')
  })

  it('redirige a home si está autenticado y va a login', async () => {
    localStorage.setItem('token', 'fake-token')

    await router.push('/login')
    expect(router.currentRoute.value.name).toBe('home')
  })
})
