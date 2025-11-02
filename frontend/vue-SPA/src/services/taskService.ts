import api from "@/plugins/axios"; // importamso axios que contiene el token

interface TaskPayload {
   title: string;
   category: string;
   state: string;
   priority: string;
   due_date: string;
   metadata: string[]; // Ej: ["Color: Rojo", "Tamaño: Grande"]
   description: string; 
};

export default {
    // crear tarea
    async createTask(payload: TaskPayload) {
        try {
            const response = await api.post("/tasks", payload);
            return response.data;
        } catch (error: any) {
            console.log("Error al crear la tarea", error.response?.data || error.message);
            throw error;
        }
    }
}