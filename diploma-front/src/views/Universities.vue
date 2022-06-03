<template>
  <div class="w-full min-h-screen ">
    <Header />
    <div class="p-10 min-h-screen flex relative flex-row w-full">
      <!-- FILTER -->
      <div class="flex flex-col w-4/12 ">
        <div class="flex flex-col">
          <div class="inline-flex justify-between pr-10">
            <p class="font-medium">Поиск по названию</p>
          </div>
          <div class="w-full mt-3">
            <input @change="search" v-model="model.name" type="text" name="name" placeholder="Найти..." class="border outline-1 outline-blue-600 w-4/5 mx-auto rounded-lg py-2 px-3 border-gray-400 font-medium text-sm">
          </div>

<!--          <div class="inline-flex justify-between pt-5">-->
<!--            <p class="font-medium">Академическая степень</p>-->
<!--          </div>-->
<!--          <div class="w-full mt-1 text-sm">-->
<!--            <div class="pt-1">-->
<!--              <label class="inline-flex items-center">-->
<!--                <input type="radio" class="form-radio" name="radio" value="1" checked>-->
<!--                <span class="ml-2">Бакалавриат</span>-->
<!--              </label>-->
<!--            </div>-->
<!--            <div class="pt-1">-->
<!--              <label class="inline-flex items-center">-->
<!--                <input type="radio" class="form-radio" name="radio" value="2">-->
<!--                <span class="ml-2">Магистратура</span>-->
<!--              </label>-->
<!--            </div>-->
<!--            <div class="pt-1">-->
<!--              <label class="inline-flex items-center">-->
<!--                <input type="radio" class="form-radio" name="radio" value="3">-->
<!--                <span class="ml-2">Докторантура</span>-->
<!--              </label>-->
<!--            </div>-->
<!--          </div>-->
          <div class="inline-flex justify-between pt-5">
            <p class="font-medium">Язык обучения</p>
          </div>
          <div class="mt-1 text-sm" v-for="language in languages.data">
            <div class="py-1">
              <label class="inline-flex items-center">
                <input v-on:change="search" type="checkbox" class="form-checkbox" :value="language.name" v-model="model.languages">
                <span class="ml-2">{{ language.name }}</span>
              </label>
            </div>
          </div>

          <div class="inline-flex justify-between pt-5">
            <p class="font-medium">Тип</p>
          </div>
          <div class="mt-1 text-sm" v-for="type in types.data">
            <div class="py-1">
              <label class="inline-flex items-center">
                <input v-on:change="search" type="checkbox" class="form-checkbox" :value="type.name" v-model="model.types">
                <span class="ml-2">{{ type.name }}</span>
              </label>
            </div>
          </div>

          <div class="inline-flex justify-between pt-5">
            <p class="font-medium">Группы образовательных программ</p>
          </div>
          <div class="mt-1 text-sm" v-for="program in programs.data">
            <div class="py-1">
              <label class="inline-flex items-center">
                <input v-on:change="search" type="checkbox" class="form-checkbox" :value="program.name" v-model="model.programs">
                <span class="ml-2">{{ program.name }}</span>
              </label>
            </div>
          </div>

          <div class="inline-flex justify-between pt-5">
            <p class="font-medium">Регионы</p>
          </div>
          <div class="mt-1 text-sm" v-for="region in regions.data">
            <div class="py-1">
              <label class="inline-flex items-center">
                <input v-on:change="search" type="checkbox" class="form-checkbox" :value="region.name" v-model="model.regions">
                <span class="ml-2">{{ region.name }}</span>
              </label>
            </div>
          </div>
        </div>

      </div>

      <!-- ITEMS -->
      <div class="flex flex-col w-8/12 mt-8">
        <!-- UNIVERSITY CARD -->
        <div v-if="universities.data.data.length > 0" v-for="university in universities.data.data" class="border border-gray-200 mb-3 rounded-lg flex flex-col px-8">
          <div class="w-full pt-3">
            <p class="font-semibold text-xl">{{ university.name }}</p>
          </div>
          <div class="w-full flex flex-row py-3">
            <div class="w-24 my-auto">
              <img :src="university.logo" alt="uni logo" class="">
            </div>
            <div class="flex flex-row">
              <div class="flex flex-col">
                <div class="inline-flex p-5">
                  <img src="../assets/language.svg" alt="language" class="w-4">
                  <p class="text-sm pl-2">Язык обучения: {{ university.language.name }}</p>
                </div>
                <div class="inline-flex pl-5">
                  <img src="../assets/uni-location.svg" alt="language" class="w-4">
                  <p class="text-sm pl-2">{{university.region.name}}</p>
                </div>
              </div>
              <div class="flex flex-col">
                <div class="inline-flex p-5">
                  <img src="../assets/type.svg" alt="language" class="w-4">
                  <p class="text-sm pl-2">{{ university.type.name }}</p>
                </div>
              </div>
            </div>
          </div>


          <div class="flex w-full flex-row py-5 justify-between">
            <div class="w-8/12">
              <p class="text-sm"> {{ university.description }} </p>
            </div>
            <div>
              <a v-bind:href="'/university/' + university.id" ><button class="focus:outline-blue-900 bg-blue-500 hover:bg-blue-600 py-2.5 px-11 rounded-lg text-sm text-white">Подробнее</button></a>
            </div>
          </div>
        </div>
        <div v-else class="my-10 mx-auto">
          <p>По данному запросу ничего не найдено.</p>
        </div>
        <div v-if="universities.data.current_page < universities.data.last_page" class="mx-auto my-10">
          <button @click="addUniversities" class="py-3 px-11 border rounded-lg border-gray-500 text-sm font-semibold">
            Показать больше
          </button>
        </div>

      </div>

    </div>
    <Footer  />

  </div>

</template>

<script setup>
import Header from '../components/Header.vue';
import Footer from "../components/Footer.vue";
import store from "../store";
import {computed} from "vue";

const model = {
  name: "",
  regions: [],
  programs: [],
  category: "",
  types: [],
  languages: [],
}

function search(e) {
  e.preventDefault();

  store.dispatch("getUniversities", { page: 1, universityData: model })
}

function addUniversities()  {
  store.dispatch("getUniversities", { add: true, page: (universities.value.data.current_page + 1), universityData: model })
}

const universities = computed(() => store.state.universities);
const programs = computed(() => store.state.programs);
const regions = computed(() => store.state.regions);
const languages = computed(() => store.state.languages);
const types = computed(() => store.state.types);


store.dispatch("getRegions", { page: 0, name: ""})
store.dispatch("getPrograms", { page: 0, })
store.dispatch("getLanguages", )
store.dispatch("getTypes", )

store.dispatch("getUniversities", { page: 1, universityData: model })
</script>

<style scoped>

</style>