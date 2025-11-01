<template>
  <div class="bg-gray-200 rounded-2xl p-8 shadow-2xl">
    <h1 class="text-black font-bold text-2xl text-center">Crea una tarea ✍️</h1>
    <p class="font-sans text-black mt-4 text-center">
        Crea las tareas que necesites y ordenalas por categorias o estados de avance, 
        puedes crear hast 10 atributos por tarea.
    </p>
    <div class="mt-9">
        <label class="block text-black text-sm font-medium mb-2">
            Titulo
        </label>
        <input
        type="email"
        name="email"
        value=""
        class="w-full max-w-xl px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div>
        <label class="block text-black text-sm font-medium mb-2">
            Categoria
        </label>
        <select
        name="country"
        value=""
        class="w-full px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        >
            <option>United States</option>
            <option>Canada</option>
            <option>Mexico</option>
            <option>United Kingdom</option>
            <option>Colombia</option>
            <option>Spain</option>
            <option>Argentina</option>
        </select>
        </div>
        <div>
        <label class="block text-black text-sm font-medium mb-2">
            Estado
        </label>
        <select
        name="country"
        value=""
        class="w-full px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        >
            <option>United States</option>
            <option>Canada</option>
            <option>Mexico</option>
            <option>United Kingdom</option>
            <option>Colombia</option>
            <option>Spain</option>
            <option>Argentina</option>
        </select>
        </div>
        
        <div>
        <label class="block text-black text-sm font-medium mb-2">
            Prioridad
        </label>
        <input
            type="text"
            name="lastName"
            value=""

            class="w-full px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        />
        </div>
        
        <div>
        <label class="block text-black text-sm font-medium mb-2">
            Fecha de vencimiento
        </label>
        <input
            type="date"
            name="lastName"
            value=""

            class="w-full px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        />
        </div>
    </div>  

    <div class="mt-6">
        <label class="block text-black text-sm font-medium mb-2">
            Atributos
        </label>
        <input
        type="email"
        name="email"
        value=""
        class="w-full max-w-xl px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        />
    </div>

    <div class="mt-6">
        <label class="block text-black text-sm font-medium mb-2">
            Descripción
        </label>
        <textarea 
            class="
            w-4xl py-7 px-7 h-39 bg-slate-300 text-black border-slate-600 
            rounded-lg placeholder-gray-600 focus:outline-none 
            focus:ring-2 focus:ring-sky-400 
            focus:border-transparent transition
            "
            placeholder="Describe tu tarea..."
        ></textarea>
    </div>

    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-sky-400">
        <!-- <button
        class="px-6 py-2.5 text-black hover:text-slate-300 transition font-medium"
        >
         Cancel
        </button> -->
        <button
        class="dark:bg-black px-4 py-2 rounded-3xl text-gray-50 hover:bg-gray-600 hover:text-shadow-gray-600"
        >
            Crear
        </button>
    </div>
</div>
</template>