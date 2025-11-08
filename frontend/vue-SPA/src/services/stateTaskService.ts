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
            console.log("Error al obteber las categorias", error.response?.data || error.message);
            throw error;
        }
    },

    async create(data: stateTaskData) {
        try {
            const response = await api.post("/states", data);
            return response.data;
        } catch (error: any) {
            console.log("Error al crear la categorias", error.response?.data || error.message);
            throw error;
        }
    }
}