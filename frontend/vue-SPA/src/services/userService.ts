import api from "@/plugins/axios";

interface UserData {
    id_user?: number;
    name: string;
    role: string;
    email?: string;
    password?: string;
    password_confirmation?: string;
}

export default {
    async getAll() {
        try {
            const response = await api.get("/users");
            return response.data;
        } catch (error: any) {
            console.log("Error al obtener los usuarios", error.response?.data || error.message);
            throw error;
        }
    },

    async create(data: UserData) {
        try {
            const response = await api.post("/users", data);
            return response.data;
        } catch (error: any) {
            console.log("Eror al crear el usario", error.response?.data);
            throw error;
        }
    },
    
    async update(idUser: number, data: { name: string }) {
        try {
            const response = await api.put(`/users/${idUser}`, data);
            return response.data;
        } catch (error: any) {
            console.log("Eror al actualizar el usario", error.response?.data);
            throw error;
        }
    },
    
    async updateRol(idUser: number, data: { role: string }) {
        try {
            const response = await api.patch(`/users/${idUser}/role`, data);
            return response.data;
        } catch (error: any) {
            console.log("Eror al actualizar el usario", error.response?.data);
            throw error;
        }
    },
    
    async delete(id_user: number) {
        try {
            const response = await api.delete(`/users/${id_user}`);
            return response.data;
        } catch (error: any) {
            console.log("Eror al eliminar el usario", error.response?.data);
            throw error;
        }
    },
}