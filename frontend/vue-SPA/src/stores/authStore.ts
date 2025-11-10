import { defineStore } from "pinia";
import authService from "@/services/authService";

interface User {
  id_user: number;
  name: string;
  email: string;
  role: string;
  created_at?: string;
}

interface AuthState {
  user: User | null;
  token: string | null;
  loading: boolean;
  error: string | null;
}

export const useAuthStore = defineStore("auth", {
    state: (): AuthState => ({
        user: JSON.parse(localStorage.getItem("user") || "null"),
        token: localStorage.getItem("token"),
        loading: false,
        error: null,
    }),

    actions: {
        async login(email: string, password:string) {
            this.loading = true;
            this.error = null;
            try {
                const response = await authService.login({ email, password });
                this.token = response.token;
                this.user = response.data;
                if (this.token) {
                    localStorage.setItem("token", this.token);
                }
                if (this.user) {
                    localStorage.setItem("user", JSON.stringify(this.user));
                }
                return response;
            } catch (error: any) {
                this.error = error.response?.data?.message || "Error al inciiar sesion en authStore";
                throw error;
            }finally {
                this.loading = false;
            }
        },

        async register(name: string, email: string, password: string, password_confirmation: string) {
            this.loading = true;
            this.error = null;

            try {
                const response = await authService.register({ name, email, password, password_confirmation });
                this.token = response.token;
                this.user = response.data;
                if (this.token) {
                    localStorage.setItem("token", this.token);
                }
                if (this.user) {
                    localStorage.setItem("user", JSON.stringify(this.user));
                }
                return response;
            } catch (error: any) {
                this.error = error.response?.data?.message || "Error al registrar en authstore";
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async fetchUser() {
            if (!this.token) return;
            try {
                const response = await authService.getUser();
                this.user = response;
                if (this.user) {
                    localStorage.setItem("user", JSON.stringify(this.user));
                }
                return response;
            } catch (error) {
                console.error("Error al obtener usuario:", error);
            }
        },

        async logout() {
            this.loading = true;
            try {
                const response = await authService.logout();

                // Si la Api responde con exito 
                if (response.code === 200) {
                    this.user = null;
                    this.token = null;
                    localStorage.removeItem("token");
                    localStorage.removeItem("user");
                }else {
                    console.error("⚠️ El backend respondió pero no confirmó el cierre:", response);
                }

                return response; 

            } catch (error: any) {
                this.error = error.response?.data?.message || "Error cerrando sesion en authstore";
                console.error("❌ Error en logout:", error);
                throw error;
            } finally {
                this.loading = false;
            }
        },
    }
});