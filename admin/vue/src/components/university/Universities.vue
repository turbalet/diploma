<template>
  <div class="flex flex-row mx-10 mt-10">
    <div class="mr-10">
      <input type="search" @keyup="changeInput" v-model="university.name"  class="bg-secondary shadow rounded-xl border border-none text-white" placeholder="Поиск">
      <!--          <div class="absolute pin-r pin-t mt-3 mr-4 text-purple-lighter">-->
      <!--            <img src="../assets/search.svg" alt="search.svg">-->
      <!--          </div>-->
    </div>
    <div class="mr-10">
      <select  v-model="university.region" @change="changeInput" class="select text-sm select-ghost text-white rounded-xl bg-secondary border-none">
        <option value="" selected>Регион</option>
        <option v-for="region in regions.data.data" :value="region.name">{{ region.name }}</option>
      </select>
    </div>
    <div class="mr-10">
      <select v-model="university.category" @change="changeInput"  class="select text-sm  select-ghost  text-white rounded-xl bg-secondary border-none">
        <option value=""  selected>Категория</option>
        <option v-for="category in categories.data" :value="category.name">{{ category.name }}</option>
      </select>
    </div>
    <div class="mr-10">
      <select v-model="university.type" @change="changeInput"  class="select text-sm  select-ghost  text-white rounded-xl bg-secondary border-none">
        <option value=""  selected>Тип</option>
        <option v-for="type in types.data" :value="type.name">{{ type.name }}</option>
      </select>
    </div>
    <div class="mr-10">
      <select v-model="university.language" @change="changeInput"  class="select text-sm  select-ghost  text-white rounded-xl bg-secondary border-none">
        <option value=""  selected>Язык обучения</option>
        <option v-for="lang in languages.data" :value="lang.name">{{ lang.name }}</option>
      </select>
    </div>
  </div>
  <div class="mt-10 flex flex-row justify-between">
    <div class="ml-10 font-bold  text-yellow-500 ">
      <p>Всего: {{!universities.loading ? universities.data.data.length : 0}}

      </p>
    </div>
    <paginate
        v-model="currentPage"
        :page-count="!universities.loading ? universities.data.last_page : 1"
        :container-class="'bg-secondary rounded-xl text-gray-400 flex flex-row h-9'"
        :page-class="'bg-secondary w-9 h-9  flex items-center justify-center hover:bg-yellow-600  hover:cursor-pointer hover:text-black relative inline-flex items-center px-4 py-2 border-none text-sm font-medium'"
        :active-class="'text-black bg-yellow-600 '"
        :disabled-class="'hover:bg-secondary hover:text-gray-400'"

        :hide-pred-next="true"
        :prev-class="'flex justify-center hover:bg-sky-700 hover:text-white hover:cursor-pointer text-white w-9 h-9 bg-sky-600 h-full rounded-l-xl items-center'"
        :next-text="'>'"
        :prev-text="'<'"
        :next-class="'flex justify-center hover:cursor-pointer  text-white w-9 h-9 bg-sky-600 h-full rounded-r-xl items-center hover:bg-sky-700'"
        :click-handler="search">
    </paginate>
<!--    <div>-->
<!--      <div>-->
<!--        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">-->
<!--          <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border-r-4 border-primary bg-sky-600 text-sm font-medium text-white hover:bg-sky-700">-->
<!--            <span class="sr-only">Previous</span>-->
<!--            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />-->
<!--          </a>-->
<!--          &lt;!&ndash; Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" &ndash;&gt;-->
<!--          <a href="#"  class="z-10 bg-secondary border-indigo-500 text-white relative inline-flex items-center px-4 py-2 border-none text-sm font-medium"> 1 </a>-->
<!--          <a href="#" class="bg-secondary  text-gray-500 hover:bg-yellow-600 hover:text-black relative inline-flex items-center px-4 py-2 border-none text-sm font-medium"> 2 </a>-->
<!--          <a href="#" class="bg-secondary  text-gray-500 hover:bg-yellow-600 hover:text-black hidden md:inline-flex relative items-center px-4 py-2 border-none text-sm font-medium"> 3 </a>-->
<!--          <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border-l-4 border-primary bg-sky-600 text-sm font-medium text-white hover:bg-sky-700">-->
<!--            <span class="sr-only">Next</span>-->
<!--            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />-->
<!--          </a>-->
<!--        </nav>-->
<!--      </div>-->
<!--    </div>-->
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
import Paginate from 'vuejs-paginate-next';
import {computed, ref} from "vue";
import store from "../../store";

const university = {
  name: "",
  region: "",
  category: "",
  type: "",
  language: "",
}

function changeInput() {
  currentPage.value = 1
  store.dispatch("getUniversities", { page: 1, universityData: university })
}

function search(page) {
  if (!page) {
    page = 1
  }
  store.dispatch("getUniversities", { page: page, universityData: university })
}

let currentPage = ref(1);
const universities = computed(() => store.state.universities);
const categories = computed(() => store.state.categories);
const regions = computed(() => store.state.regions);
const types = computed(() => store.state.types);
const languages = computed(() => store.state.languages);

store.dispatch("getUniversities", { page: 1, universityData: university })
store.dispatch("getCategories")
store.dispatch("getRegions")
store.dispatch("getTypes")
store.dispatch("getLanguages")
</script>

<style scoped>

</style>
