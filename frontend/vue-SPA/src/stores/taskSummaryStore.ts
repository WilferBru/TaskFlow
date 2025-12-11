import { defineStore } from "pinia";
import taskService from "@/services/taskService";

export const useTaskSummaryStore = defineStore('taskSummary', {
    state: () => ({
        total: 0,
        alta: 0,
        media: 0,
        baja: 0,
    }),

    actions: {
        async loadSummary() {
            try {
                const res = await taskService.summary();

                // Recuerda: res.data contiene success, message, data
                const data = res.data;

                this.total = data.total;
                this.alta = data.alta;
                this.media = data.media;
                this.baja = data.baja;
            } catch (error) {
                console.error("Error cargando resumen:", error);
            }
        }
    }
});