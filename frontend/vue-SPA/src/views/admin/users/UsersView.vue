<template>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h1 class="text-gray-700 font-bold text-4xl">Usuarios</h1>
                <p class="text-gray-700 mt-3 font-medium">Panel administrativo de usuarios</p>
            </div>
            <div class="my-2 mt-7 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <select
                            class="appearance h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option>10</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative">
                        <select
                            v-model="searchRole"
                            class="appearance h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                            <option value="">Todos</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input 
                        v-model="searchTerm"
                        placeholder="Buscar"
                        class="appearance-none 
                               rounded-r rounded-l 
                               sm:rounded-l-none border 
                               border-gray-400 border-b block pl-8 pr-6 py-2
                               w-full bg-white text-base placeholder-gray-400 text-gray-700 
                               focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 
                               focus:outline-none" 
                    />
                </div>
                <div class="ml-auto">
                    <button 
                        @click="openCreateModal"
                        class="btn btn-soft btn-primary 
                             bg-blue-500 text-gray-50 
                             hover:bg-blue-700 hover:text-gray-200 
                             border-0 rounded-2xl"
                    >
                        Agregar Usuario
                    </button>
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Id
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Rol
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Creado
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="us in filteredUsers"
                                :key="us.id_user"
                            >
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ us.id_user }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ us.name }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p 
                                        class="text-gray-900 whitespace-no-wrap font-medium"
                                    >
                                        {{ us.email }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p 
                                        class="text-gray-900 whitespace-no-wrap font-medium"
                                    >
                                        {{ us.role }}
                                    </p>
                                </td>                                
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ new Date(us.created_at).toLocaleDateString()}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <button 
                                        class="btn bg-gray-200 text-black" 
                                        :popovertarget="`popover-${us.id_user}`" 
                                        :style="`anchor-name:--anchor-${us.id_user}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                        </svg>
                                    </button>
                                    <ul 
                                        class="dropdown menu w-15 rounded-box bg-gray-200 text-black shadow-sm"
                                        popover 
                                        :id="`popover-${us.id_user}`" 
                                        :style="`position-anchor:--anchor-${us.id_user}`">
                                        <li>
                                            <button
                                                @click="openEditModal(us)"
                                                class="flex items-center text-blue-500 justify-center w-10 h-10 rounded-full hover:bg-blue-700 hover:text-gray-100 transition"
                                            >
                                                <EditIcon />
                                            </button>
                                        </li>
                                        <li>
                                            <button 
                                                class="flex items-center text-red-500 justify-center w-10 h-10 rounded-full hover:bg-red-500 hover:text-gray-100 transition" 
                                                @click="modalDeleteUser(`${us.id_user}`)"
                                            >
                                                <DeleteIcon />
                                            </button>
                                        </li>
                                        <DeleteUserModal 
                                            :modal-id="`${us.id_user}`"
                                            @user-delete="deleteUser"
                                        />
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Aqui va el carucel  -->
                     <PrevNext class="mt-7" />
                </div>
            </div>
        </div>
        <!-- Modal apra crear y editar los user -->
         <CreateUserModal 
            @user-form="saveUser"
            :id_user="selectedUser?.id_user"
            :name="selectedUser?.name"
            :role="selectedUser?.role"
            :email="selectedUser?.email"
         />
    </div>
</template>

<script setup lang="ts">
import PrevNext from '@/components/users/PrevNext.vue';
import userService from '@/services/userService';
import { onMounted, ref, computed } from 'vue';
import { useToast } from "vue-toastification";
import CreateUserModal from '@/components/users/CreateUserModal.vue';
import EditIcon from '@/components/common/icons/EditIcon.vue';
import DeleteIcon from '@/components/common/icons/DeleteIcon.vue';
import DeleteUserModal from '@/components/users/DeleteUserModal.vue';


const toast = useToast();

const searchTerm = ref(""); // variable para filtrar en la tabla
const searchRole = ref(""); // variable para filtrar por rol en la tabla

interface userData {
     id_user?: number;
     name: string;
     email?: string;
     role: string;
     password?: string;
     password_confirmation?: string;
}

// variable reactiva apra guardar los datos del user
const selectedUser = ref<{
    id_user?: number;
    name?: string;
    role?: string;
    email?: string;
    password?: string;
    password_confirmation?: string;
}>({});

const users = ref<{
    id_user: number,
    name: string,
    role: string,
    email: string,
    created_at: Date,
    password: string;
    password_confirmation: string;
}[]>([]);

onMounted(async () => {
    try {
        const response = await userService.getAll();
        users.value = response.data; // obtenemos el arraya data
    } catch (error) {
       console.error("Error cargando usuarios:", error); 
    }
});
// filtadro de la tabla
const filteredUsers = computed(() => {
  const term = searchTerm.value.toLowerCase();
  const role = searchRole.value.toLowerCase();

  return users.value.filter(u => {
    const matchesTerm =
      !term ||
      u.name.toLowerCase().includes(term) ||
      u.email.toLowerCase().includes(term) ||
      String(u.id_user).includes(term);

    const matchesRole =
      !role || u.role.toLowerCase() === role;

    return matchesTerm && matchesRole;
  });
});


const openCreateModal = () => {
    selectedUser.value = {}; // si no hay datos vamos a crear
    const modal = document.getElementById('createUser') as HTMLDialogElement;
    modal.showModal();
};

const openEditModal = (us: any) => {
    selectedUser.value = {...us};
    const modal = document.getElementById('createUser') as HTMLDialogElement;
    modal.showModal();
}

const saveUser = async (data: userData) => {
    try {
        if (data.id_user) {
            const response = await userService.update(data);
            toast.success("Usuario actualizado correctamente");
            // actualizar solo la categoria editada
            const index = users.value.findIndex(
                (u) => u.id_user === data.id_user
            );
            if (index !== -1) users.value[index] = response.data;
            return response;
        } else {
            const response = await userService.create(data);
            toast.success("Usuario creado correctamente");
            // Actualizar lista
            users.value.push(response.data);
            return response;
        }
    } catch (error) {
        console.error("❌ Error creando el usuario:", error);
    }
}

const modalDeleteUser = (id_user: string) => {
    const modal = document.getElementById(id_user) as HTMLDialogElement | null;
    if (modal) {
        modal.showModal();
    } else {
         console.warn(`⚠️ No se encontró el modal con id ${id_user}`);
    }
}

const deleteUser = async (id_user: string) => {
    try {
        const response = await userService.delete(Number(id_user));
        toast.success("Usuario eliminada correctamente");
        // eliminar de la lista local
        users.value = users.value.filter(
            (u) => u.id_user !== Number(id_user)
        );
        return response;
    } catch (error) {
        console.error("❌ Error eliminando el usuario:", error);
    }
}

</script>