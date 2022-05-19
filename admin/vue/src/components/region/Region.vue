<template>
  <div class="flex flex-col">
    <div class="flex flex-row justify-between mt-10 mr-5 ml-2 h-36">
      <div>
        <img src="../../assets/close.svg" class="hover:cursor-pointer" alt="close.svg">
      </div>
      <div class="flex flex-col">
        <div class="overflow-hidden relative w-32 h-64 mt-4 mb-4">
          <button class="bg-indigo-700 relative rounded-xl hover:bg-indigo-800 text-white font-bold inline-flex items-center">
            <svg fill="#FFF" class="w-12 h-12 py-3 pl-2" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0h24v24H0z" fill="none"/>
              <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
            </svg>
            <span class="text-white text-xs">Загрузить фото</span>
          </button>
          <input class="cursor-pointer absolute block opacity-0 pin-r pin-t" type="file" name="vacancyImageFiles"
                 @change="file">
        </div>
        <button class="bg-green-700 hover:bg-green-800 font-bold py-3 px-3 text-sm text-gray-200 rounded-2xl mr-3">
          Добавить
        </button>
      </div>
      <div>
        <img src="../../assets/university.png" class="w-44 h-36" alt="">
      </div>
    </div>
    <div class="flex flex-col w-full mt-10">
      <div class="flex flex-col w-4/5 ml-5 text-white">
        <label for="name" class="font-medium">Название</label>
        <div class="flex flex-row mt-2">
          <input type="text" name="name" class="bg-input w-4/5 shadow rounded-xl border border-none text-white"
                 placeholder="Поиск">
          <button class="bg-green-700 hover:bg-green-800 ml-5 rounded px-2 py-2 font-bold">Изменить</button>
        </div>
      </div>
      <div class="flex flex-col w-4/5 ml-5 mt-5 text-white">
        <label for="name" class="font-medium">Описание</label>
        <div class="flex flex-row mt-2">
          <textarea name="desc" class="bg-input w-4/5 max-h-80 h-32 shadow rounded-xl border border-none text-white"
          ></textarea>
          <button class="bg-green-700 hover:bg-green-800 ml-5 rounded max-h-10 px-2 py-2 font-bold">Изменить</button>
        </div>
      </div>
      <div class="flex flex-col w-4/5 ml-5 mt-5 text-white">
        <label for="name" class="font-medium">Вебсайт</label>
        <div class="flex flex-row mt-2">
          <input type="text" name="name" class="bg-input w-4/5 shadow rounded-xl border border-none text-white"
                 placeholder="Поиск">
          <button class="bg-green-700 hover:bg-green-800 ml-5 rounded px-2 py-2 font-bold">Изменить</button>
        </div>
      </div>
      <div class="flex flex-col w-4/5 ml-5 mt-5 text-white">
        <label for="name" class="font-medium">Инстаграм</label>
        <div class="flex flex-row mt-2">
          <input type="text" name="name" class="bg-input w-4/5 shadow rounded-xl border border-none text-white"
                 placeholder="Поиск">
          <button class="bg-green-700 hover:bg-green-800 ml-5 rounded px-2 py-2 font-bold">Изменить</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>


</script>

<style scoped>

</style>
