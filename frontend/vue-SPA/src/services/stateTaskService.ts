import api from "@/plugins/axios";



export default {
    async getAll() {
        try {
            const response = await api.get("/states");
            return response.data;            
        } catch (error: any) {
            console.log("Error al obteber las categorias", error.response?.data || error.message);
            throw error;
        }
    }
}