import { describe, it, expect, vi } from 'vitest'
import { mount } from '@vue/test-utils'
import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '@/views/Auth/LoginView.vue'

// 👉 mock del login
const loginMock = vi.fn()

// 👉 mock del authStore (SIEMPRE ARRIBA)
vi.mock('@/stores/authStore', () => ({
  useAuthStore: () => ({
    login: loginMock,
    token: 'fake-token',
    error: null,
  }),
}))

// 👉 mock del toast
vi.mock('vue-toastification', () => ({
  useToast: () => ({
    success: vi.fn(),
    error: vi.fn(),
  }),
}))

describe('LoginView', () => {
  it('permite hacer login', async () => {
    const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
        name: 'home',
        path: '/',
        component: { template: '<div>Home</div>' },
        },
        {
        name: 'register',
        path: '/register',
        component: { template: '<div>Register</div>' },
        },
    ],
    })


    const wrapper = mount(LoginView, {
      global: {
        plugins: [router],
      },
    })

    await wrapper.find('input[type="email"]').setValue('test@test.com')
    await wrapper.find('input[type="password"]').setValue('123456')
    await wrapper.find('form').trigger('submit')

    expect(loginMock).toHaveBeenCalledWith('test@test.com', '123456')
  })
})
