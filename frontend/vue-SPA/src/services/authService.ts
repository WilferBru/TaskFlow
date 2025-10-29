import api from "@/plugins/axios";

interface LoginData {
    email:string;
    password: string;
}

interface RegisterData {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
}

export default {
    // iniciar sesion
    async login(data: LoginData) {
        const response = await api.post("/login", data);
        return response.data;
    },

    // Registrar usuario
    async register(data: RegisterData){
        const response = await api.post("/register", data);
        return response.data;
    },

    // Cerrar sesion
    async logout() {
        try {
            const response = await api.post("/logout");
            return {
                code: response.status,       // Ejemplo: 200
                data: response.data,
                message: "Logout exitoso",
            };
        } catch (error: any) {
            return {
                code: error.response?.status || 500,
                data: error.response?.data || null,
                message: error.response?.data?.message || "Error al cerrar sesión",
            };
        }
        ;
    },

    // Obtner el usuario autenticado
    async getUser() {
        const response = await api.get("/profile");
        return response.data;
    },
}