import api from "@/plugins/axios"; // importamso axios que contiene el token

interface TaskPayload {
   title: string;
   category_id: string;
   state_id: string;
   priority: string;
   due_date: string;
   metadata: string[]; // Ej: ["Color: Rojo", "Tamaño: Grande"]
   description: string; 
};

interface UpdateState {
    id_task: number;
    state_id: number;
}

export default {
    async getAll() {
        try {
            const response = await api.get('/tasks');
            return response.data;
        } catch (error: any) {
            console.log("Error al obtener las tareas", error.response?.data || error.message);
            throw error;
        }
    },

    async create(data: TaskPayload) {
        try {
            const response = await api.post("/tasks", data);
            return response.data;
        } catch (error: any) {
            console.log("Error al crear la tarea", error.response?.data || error.message);
            throw error;
        }
    },

    async updateState(data: UpdateState) {
        try {
            const response = await api.put(`/tasks/updateState/${data.id_task}`, {
                state_id: data.state_id
            });
            return response.data;
        } catch (error: any) {
            console.log("Error al actualizar el estado de la tarea", error.response?.data || error.message);
            throw error;
        }
    }
}