<template>
  <div class="flex flex-row mx-10 mt-10">
    <div class="mr-10">
      <input type="search" class="bg-secondary shadow rounded-xl border border-none text-white" placeholder="Поиск">
      <!--          <div class="absolute pin-r pin-t mt-3 mr-4 text-purple-lighter">-->
      <!--            <img src="../assets/search.svg" alt="search.svg">-->
      <!--          </div>-->
    </div>
    <div class="mr-10">
      <select class="select select-ghost text-white rounded-xl bg-secondary border-none">
        <option disabled selected>Регион</option>
        <option>Алматы</option>
      </select>
    </div>
    <div class="mr-10">
      <select class="select select-ghost  text-white rounded-xl bg-secondary border-none">
        <option disabled selected>Категория</option>
        <option>Частный</option>
      </select>
    </div>
    <div class="mr-10">
      <select class="select select-ghost  text-white rounded-xl bg-secondary border-none">
        <option disabled selected>Тип</option>
        <option>Университет</option>
      </select>
    </div>
    <div class="mr-10">
      <select class="select select-ghost  text-white rounded-xl bg-secondary border-none">
        <option disabled selected>Язык обучения</option>
        <option>Английский</option>
      </select>
    </div>
  </div>
  <div class="mt-10 flex flex-row justify-between">
    <div class="ml-10 font-bold  text-yellow-500 ">
      <p>Всего: {{ !universities.loading ? universities.data.data.length : 0}}</p>
    </div>
    <div>
      <div>
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
          <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border-r-4 border-primary bg-sky-600 text-sm font-medium text-white hover:bg-sky-700">
            <span class="sr-only">Previous</span>
            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
          </a>
          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
          <a href="#"  class="z-10 bg-secondary border-indigo-500 text-white relative inline-flex items-center px-4 py-2 border-none text-sm font-medium"> 1 </a>
          <a href="#" class="bg-secondary  text-gray-500 hover:bg-yellow-600 hover:text-black relative inline-flex items-center px-4 py-2 border-none text-sm font-medium"> 2 </a>
          <a href="#" class="bg-secondary  text-gray-500 hover:bg-yellow-600 hover:text-black hidden md:inline-flex relative items-center px-4 py-2 border-none text-sm font-medium"> 3 </a>
          <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border-l-4 border-primary bg-sky-600 text-sm font-medium text-white hover:bg-sky-700">
            <span class="sr-only">Next</span>
            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
          </a>
        </nav>
      </div>
    </div>
    <div class="">
      <button class="bg-sky-600 hover:bg-sky-700 font-bold py-3 px-3 text-sm text-gray-200 rounded-2xl mr-3">+ Добавить</button>
    </div>
  </div>
  <div v-if="!universities.loading" class="flex flex-col">
    <div class="overflow-x-auto ">
      <div class=" inline-block min-w-full">
        <div class="overflow-hidden">
          <UniversityList :universities="universities" />
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <div v-if="universities.loading" class="flex text-white justify-center">Загрузка...</div>
  </div>
</template>
<script setup>
import UniversityList from './UniversityList.vue';
import {ChevronLeftIcon, ChevronRightIcon} from "@heroicons/vue/solid";
import { computed } from "vue";
import store from "../../store";

const universities = computed(() => store.state.universities);
store.dispatch("getUniversities")

</script>

<style scoped>

</style>
