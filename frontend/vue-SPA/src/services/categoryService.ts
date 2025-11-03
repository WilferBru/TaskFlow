import api from "@/plugins/axios";

interface categoryData {
    category: string;
}

export default {
    async getAll() {
        try {
            const response = await api.get("/categories");
            return response.data;   
        } catch (error: any) {
            console.log("Error al obteber las categorias", error.response?.data || error.message);
            throw error;
        }        
    },

    async create(data: categoryData) {
        try {
            const response = await api.post("/categories", data);
            return response.data;
        } catch (error: any) {
            console.log("Error al crear la categoria", error.response?.data || error.message);
            throw error;
        }   
    }
}

