import api from "@/plugins/axios";

interface categoryData {
    id_category?: number;
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
    },
    
    async update(data: categoryData) {
        try {
            const response = await api.put(`/categories/${data.id_category}`, data);
            return response.data;
        } catch (error: any) {
            console.log("Error al actualizar la categoria", error.response?.data || error.message);
            throw error;
        }   
    },
    
    async delete(id_category: string) {
        try {
            const response = await api.delete(`/categories/${id_category}`);
            return response.data;
        } catch (error: any) {
            console.log("Error al crear la categoria", error.response?.data || error.message);
            throw error;
        }   
    }
}

