<template>
  <div class="flex flex-row mx-10 mt-10">
    <div class="mr-10">
      <input type="search" @change="changeInput" v-model="region.name" class="bg-secondary shadow rounded-xl border border-none text-white" placeholder="Поиск">
      <!--          <div class="absolute pin-r pin-t mt-3 mr-4 text-purple-lighter">-->
      <!--            <img src="../assets/search.svg" alt="search.svg">-->
      <!--          </div>-->
    </div>
  </div>
  <div class="mt-10 flex flex-row justify-between">
    <div class="ml-10 font-bold  text-yellow-500 ">
      <p>Всего: {{!regions.loading ? regions.data.total : 0}}</p>
    </div>
    <paginate
        v-model="currentPage"
        :page-count="!regions.loading ? regions.data.last_page : 1"
        :container-class="'bg-secondary rounded-xl text-gray-400 flex flex-row h-9'"
        :page-class="'bg-secondary w-9 h-9  flex items-center justify-center hover:bg-yellow-600  hover:cursor-pointer hover:text-black relative inline-flex items-center px-4 py-2 border-none text-sm font-medium'"
        :active-class="'text-black bg-yellow-600 '"
        :disabled-class="'hover:bg-secondary hover:text-gray-400'"

        :hide-pred-next="true"
        :prev-class="'flex justify-center bg-indigo-600 hover:text-white hover:cursor-pointer text-white w-9 h-9 bg-indigo-700 h-full rounded-l-xl items-center'"
        :next-text="'>'"
        :prev-text="'<'"
        :next-class="'flex justify-center hover:cursor-pointer  text-white w-9 h-9 bg-indigo-600 h-full rounded-r-xl items-center hover:bg-indigo-700'"
        :click-handler="search">
    </paginate>
    <div class="">
      <button class="bg-indigo-600 hover:bg-indigo-700 font-bold py-3 px-3 text-sm text-gray-200 rounded-2xl mr-3">+ Добавить</button>
    </div>
  </div>
  <div v-if="!regions.loading" class="flex flex-col">
    <div class="overflow-x-auto ">
      <div class=" inline-block min-w-full">
        <div class="overflow-hidden">
          <RegionList :regions="regions"/>
        </div>
      </div>
    </div>
  </div>
  <div v-if="regions.loading" class=" text-center flex my-auto w-full h-full">
    <div  class="flex items-center mx-auto justify-center">
      <img src="../../assets/loading.svg"  alt="loading" class="animate-spin animate-spin-mid w-10">
    </div>
  </div>
</template>
<script setup>
import RegionList from './RegionList.vue';
import Paginate from 'vuejs-paginate-next';
import store from "../../store";
import {computed, ref} from "vue";

const region = {
  name: ""
}

function changeInput() {
  currentPage.value = 1
  store.dispatch("getRegions", { page: 1, name: region.name })
}

function search(page) {
  if (!page) {
    page = 1
  }
  store.dispatch("getRegions", { page: page, name: region.name })
}

let currentPage = ref(1);
const regions = computed(() => store.state.regions);

store.dispatch("getRegions", { page: 1, name: region.name})

console.log(regions.data)
</script>

<style scoped>

</style>
