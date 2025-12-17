import { defineStore } from "pinia";
import taskService from "@/services/taskService";

interface TaskFilters {
    category_id?: number | null;
    state_id?: number | null;
    priority?: string | null;
    keyword?: string | null;
};

export interface Task {
  id_task: number;
  title: string;
  user_id: number;
  due_date: string | null;
  priority: string;
  category: string;
  state: string;
  state_level: number;
  description: string | null;
  metadata: [];
}


export const useTaskStore = defineStore('task', {
    state: () => ({
        tasks: [] as Task[],
        loading: false,
    }),

    actions: {
        async loadTask(filters?: TaskFilters) {
            this.loading = true;

            try {
                const hasFilters = 
                    filters &&
                    (filters.category_id ||
                        filters.state_id ||
                        filters.priority ||
                        filters.keyword);
                
                const data = hasFilters
                    ? await taskService.filter(filters)
                    : await taskService.getAll();

                this.tasks = data;

            } catch (error) {
                console.error("Error cargando tareas: ", error);
                throw error;
            } finally {
                this.loading = false;
            }
        }
    }
});