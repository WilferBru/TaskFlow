import api from "@/plugins/axios";

interface stateTaskData {
    id_state?: number;
    state: string;
}

export default {
    async getAll() {
        try {
            const response = await api.get("/states");
            return response.data;            
        } catch (error: any) {
            console.log("Error al obteber los estados", error.response?.data || error.message);
            throw error;
        }
    },

    async create(data: stateTaskData) {
        try {
            const response = await api.post("/states", data);
            return response.data;
        } catch (error: any) {
            console.log("Error al crear el estado", error.response?.data || error.message);
            throw error;
        }
    },

    async update(data: stateTaskData) {
        try {
            const response = await api.put(`/states/${data.id_state}`, data);
            return response.data;
        } catch (error: any) {
            console.log("Error al actualizar el estado", error.response?.data || error.message);
            throw error;
        }
    },

    async delete(id_state: number) {
        try {
            const response = await api.delete(`/states/${id_state}`);
            return response.data;
        } catch (error: any) {
            console.log("Error al eliminar el estado", error.response?.data || error.message);
            throw error;
        }
    }
}