import api from "@/plugins/axios";

// interface payload {
//     category: string;
// }

export default {
    async getAll() {
        try {
            const response = await api.get("/categories");
            return response.data;   
        } catch (error: any) {
            console.log("Error al obteber las categorias", error.response?.data || error.message);
            throw error;
        }        
    }
}

