<template>
  <dialog id="createUser" class="modal">
    <div class="modal-box bg-gray-50 w-11/12 max-w-3xl">
      <h3 class="text-lg font-bold text-gray-600 mb-4">
        {{ props.id_user ? 'Editar Usuario' : 'Crear Usuario' }}
      </h3>
      <p
        v-if="props.id_user"
        class="text-gray-800 font-medium"
      >
        Solo puedes actualizar el 
        nombre( no hacer sin concentimiento del suario) y el 
        rol (ten en cuenta que le daras beneficios de adminitrador 
        a el usuario si lo cambias a admin).
      </p>
      <form method="dialog" class="space-y-4">
        <!-- Inputs en una fila -->
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-6">
            <label class="label">
              <span class="label-text text-gray-600 font-medium">Nombre</span>
            </label>
            <input
              v-model="userName"
              type="text"
              placeholder="Ingresa el nombre"
              class="input input-bordered w-full bg-gray-50 
                    text-gray-700 border border-gray-800
                    focus:outline-none focus:ring-2 focus:ring-blue-400 
                    focus:border-blue-400
                    "
              :class="emptyName ? 'border-red-500 ring-2 ring-red-400' : ''"
            />
            <p 
                v-if="emptyName" class="text-red-400 mt-2 text-sm"
            >
                El campo es obligatorio
            </p>
          </div>

          <div class="col-span-6">
            <label class="label">
              <span class="label-text text-gray-600 font-medium">Correo</span>
            </label>
            <input
              v-model="userEmail"
              type="email"
              placeholder="Ingresa el correo"
              class="input input-bordered w-full bg-gray-50 
                    text-gray-700 border border-gray-800
                    focus:outline-none focus:ring-2 focus:ring-blue-400 
                    focus:border-blue-400
                    "
              :class="emptyEmail ? 'border-red-500 ring-2 ring-red-400' : ''"
              :disabled="!!props.id_user"
              />
            <p 
                v-if="emptyEmail" class="text-red-400 mt-2 text-sm"
            >
                El campo es obligatorio
            </p>
            <p 
                v-if="validaEmail" class="text-red-400 mt-2 text-sm"
            >
                El correo electrónico no tiene un formato válido (nombre@dominio.com)
            </p>
          </div>
          
          <div class="col-span-6">
            <label class="label">
              <span class="label-text text-gray-600 font-medium">Contraseña</span>
            </label>
            <input
              v-model="userPass"
              type="password"
              placeholder="Ingresa una contraseña"
              class="input input-bordered w-full bg-gray-50 
                    text-gray-700 border border-gray-800
                    focus:outline-none focus:ring-2 focus:ring-blue-400 
                    focus:border-blue-400
                    "
              :class="emptyPass ? 'border-red-500 ring-2 ring-red-400' : ''"
              :disabled="!!props.id_user"
            />
            <p 
                v-if="emptyPass" class="text-red-400 mt-2 text-sm"
            >
                El campo es obligatorio
            </p>
          </div>
          
          <div class="col-span-6">
            <label class="label">
              <span class="label-text text-gray-600 font-medium">Confirmar Contraseña</span>
            </label>
            <input
              v-model="userPassCon"
              type="password"
              min="8"
              placeholder="Confirma tu contraseña"
              class="input input-bordered w-full bg-gray-50 
                    text-gray-700 border border-gray-800
                    focus:outline-none focus:ring-2 focus:ring-blue-400 
                    focus:border-blue-400
                    "
              :class="emptyPassCon ? 'border-red-500 ring-2 ring-red-400' : ''"
              :disabled="!!props.id_user"
            />
            <p 
                v-if="emptyPassCon" class="text-red-400 mt-2 text-sm"
            >
                El campo es obligatorio
            </p>
          </div>
        </div>
        <p
          v-if="comparePass"
          class="text-red-400 text-sm"
        >
          Tu contraseña no coincide
        </p>
        <p
          v-if="lengthPass"
          class="text-red-400 text-sm"
        >
          tu contraseña debe tener al menos 8 caracteres
        </p>

        <!-- Dropdown de rol -->
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-6">
            <label class="label">
              <span class="label-text text-gray-600 font-medium">Rol</span>
            </label>
            <select 
                v-model="userRole"
                class="select select-bordered w-full bg-gray-50 
                     text-gray-700 border border-gray-800
                     focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                     "
                :class="emptyRole ? 'border-red-500 ring-2 ring-red-400' : ''"
            >
              <option 
                disabled
                value=""
              >
                Selecciona un rol
              </option>
              <option
                value="user"
              >
                Usuario
              </option>
              <option
                value="admin"
              >
                Administrador
              </option>
            </select>
            <p 
                v-if="emptyRole" class="text-red-400 mt-2 text-sm"
            >
                El campo es obligatorio
            </p>
          </div>
        </div>
        
        <!-- Botones -->
        <div class="modal-action">
          <button
            type="button"
            class="btn bg-red-400 text-gray-100 border-0 rounded-3xl hover:bg-red-500"
            @click="closeModal"
            >
            Cancelar
          </button>
          <button
            type="button"
            class="btn bg-blue-400 text-gray-100 border-0 rounded-3xl hover:bg-blue-500"
            @click="emitUser"            
            >
            {{ props.id_user ? 'Actualizar' : 'Guardar' }}
          </button>
        </div>
      </form>
    </div>
  </dialog>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';

const userName = ref("");
const userEmail = ref("");
const userRole = ref("");
const userPass = ref("");
const userPassCon = ref("");

const emptyName = ref(false);
const emptyEmail = ref(false);
const emptyRole = ref(false);
const emptyPass = ref(false);
const emptyPassCon = ref(false);
const comparePass = ref(false);
const lengthPass = ref(false); 
const validaEmail = ref(false);

interface userData {
     id_user?: number;
     name: string;
     email?: string;
     role: string;
     password?: string;
     password_confirmation?: string;
}

const props = defineProps<{
    id_user?: number;
    name?: string;
    email?: string;
    role?: string;
    password?: string;
    password_confirmation?: string;
}>();

// cada vez que cmabien los props al abrir el modal o seleccionar n usuario
watch(
    () => props,
    (newProps) => {
        userName.value = newProps.name || '';
        userEmail.value = newProps.email || '';
        userRole.value = newProps.role || '';
        userPass.value = newProps.password || '';
        userPassCon.value = newProps.password_confirmation || '';
    },
    { immediate: true, deep: true }
);

// eliminar border y el mesnaje de cmapo vacio al escribir
watch([userName, userEmail, userRole, userPass, userPassCon], () => {
  if (userName.value.trim()) emptyName.value = false;
  if (userEmail.value.trim()) emptyEmail.value = false;
  if (userRole.value.trim()) emptyRole.value = false;
  if (userPass.value.trim()) emptyPass.value = false;
  if (userPassCon.value.trim()) emptyPassCon.value = false;
});

const emit = defineEmits<{
    (e: 'userForm', value: userData): void
}>();

const emitUser = () => {
    if (props.id_user) {
        // si hay id editamos y validmaos solo 2 campos
        emptyName.value = !userName.value.trim();
        emptyRole.value = !userRole.value.trim();
        if (emptyName.value || emptyRole.value) return;

        emit("userForm", {
          id_user: props.id_user,
          name: userName.value,
          role: userRole.value,
        });
    } else {
      // resetear errores
      emptyName.value     = !userName.value.trim();
      emptyEmail.value    = !userEmail.value.trim();
      emptyRole.value     = !userRole.value.trim();
      emptyPass.value     = !userPass.value.trim();
      emptyPassCon.value  = !userPassCon.value.trim();

      if (emptyName.value || emptyEmail.value || emptyRole.value || emptyPass.value || emptyPassCon.value) return;
      // verificar que sea un correo valido
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(userEmail.value)) {
        validaEmail.value = true;
        return;
      }
      // verificar que la contraseña sean iguales
      if (userPass.value !== userPassCon.value) {
        comparePass.value = true;
        return;
      }
      // validar que sea mayor a 8 caracteres las password
      if (userPass.value.length < 8) {
        lengthPass.value = true;
        return;
      }
      
      emit('userForm', { 
        name: userName.value,
        email: userEmail.value,
        role: userRole.value,
        password: userPass.value,
        password_confirmation: userPassCon.value,
      });
    }
    closeModal();
}

const closeModal = () => {
    const modal = document.getElementById('createUser') as HTMLDialogElement;
    modal?.close();
    // SI ESTAMOS CREANDO ELIMINAMOS EL CONTENIDO DE LOS INPUT
    if (!props.id_user) {
        userName.value = '';
        userEmail.value = '';
        userRole.value = '';
        userPass.value = '';
        userPassCon.value = '';
    }
    emptyName.value     = false;
    emptyEmail.value    = false;
    emptyRole.value     = false;
    emptyPass.value     = false;
    emptyPassCon.value  = false;
    comparePass.value   = false;
}

</script>
