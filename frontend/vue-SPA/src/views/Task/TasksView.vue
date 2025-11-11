<template>
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="group bg-info-content rounded-2xl p-4 transition-all duration-300 lg:p-8">
          <div class="mb-3 text-right">
            <button 
                class="bg-amber-400 text-gray-50 px-3 rounded-2xl transition-all duration-300 hover:scale-110 hover:bg-amber-300 hover:text-gray-400"
                title="estado"
            >                
               Pendiente
            </button>
          </div>
          <div class="flex items-center gap-x-2">
            <div>
              <h3 class="text-2xl font-bold text-gray-50">Titulo de la tarea</h3>
              <span class="text-xs text-gray-300"><b>Fecha limite:</b> 5 de noviembre</span>
            </div>
          </div>
          <div class="my-4"> 
            <div class="text-sm font-medium">
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis, 
                ipsum soluta obcaecati ab distinctio ex ipsam aut dolore consequatur 
                maxime eveniet fuga expedita provident tenetur laudantium amet sunt 
                cupiditate excepturi.
              </p>
            </div>
          </div>
          <div class="flex items-center justify-between mt-6">
            <span class="text-sm font-medium bg-red-400 text-gray-50 px-3 rounded-2xl" title="prioridad">Alta</span>
            <a class="bg-info px-3 font-medium transition-all duration-300 rounded-2xl" title="categoria">Trabajo</a>
          </div>
        </div>
    </div>
</div>
</template>
