<template>
  <div class="w-full min-h-screen">
    <Header />
    <div class="p-10 min-h-screen flex relative flex-row w-full">
      <!-- FILTER -->
      <div class="flex flex-col w-4/12">
        <div class="flex flex-col">
          <div class="inline-flex justify-between pr-10">
            <p class="font-medium">Поиск по названию</p>
          </div>
          <div class="w-full mt-3">
            <input @change="search" v-model="model.name" type="text" name="name" placeholder="Найти..." class="border outline-1 outline-blue-600 w-4/5 mx-auto rounded-lg py-2 px-3 border-gray-400 font-medium text-sm">
          </div>


          <div class="inline-flex justify-between pt-5">
            <p class="font-medium">Профильные предметы</p>
          </div>
          <div class="w-full mt-1 text-sm flex flex-row">
            <select v-model="model.first_subject" @change="search" class="form-select focus:border-blue-600 focus:border-2 w-5/12 rounded-lg block w-full mt-1 border border-gray-300 outline-1 outline-blue-600 py-2 px-3 font-medium">
              <option value="" selected>Предмет 1</option>
              <option v-for="subject in subjects.data" :value="subject.name"> {{ subject.name }} </option>
            </select>
            <p class="my-auto px-2 text-gray-500" >+</p>
            <select v-model="model.second_subject" @change="search" class="form-select focus:border-blue-600 focus:border-2 w-5/12 rounded-lg block w-full mt-1 border border-gray-300 outline-1 outline-blue-600 py-2 px-3 font-medium">
              <option value="" selected>Предмет 2</option>
              <option v-for="subject in subjects.data" :value="subject.name"> {{ subject.name }} </option>
            </select>
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
            <p class="font-medium">Группы образовательных программ</p>
          </div>
          <div class="mt-1 text-sm" v-for="program in programs.data" >
            <div class="py-1">
              <label class="inline-flex items-center">
                <input v-on:change="search" :value="program.name" v-model="model.programs" type="checkbox" class="form-checkbox" checked>
                <span class="ml-2">{{ program.name }}</span>
              </label>
            </div>
          </div>
        </div>
      </div>

      <!-- ITEMS -->
      <div class="flex flex-col w-8/12 mt-8">
        <!-- SPECIALITY CARD -->
        <div v-for="speciality in specialities.data.data" class="border border-gray-300 mb-3 rounded-lg flex flex-col px-8">
          <div class="w-full pt-5">
            <p class="font-semibold text-xl"><span class="text-blue-600">{{ speciality.code }}</span> <span class="pl-3">{{ speciality.name }}</span></p>
          </div>
          <div class="w-full flex flex-col py-5">
              <div class="inline-flex ">
                <img src="../assets/type.svg" alt="language" class="w-4">
                <p class="text-sm pl-4 ">{{ speciality.program.degree.name }}</p>
              </div>
            <div class="inline-flex pt-2">
              <img src="../assets/ep.svg" alt="language" class="w-4">
              <p class="text-sm pl-4 ">{{ speciality.program.name }}</p>
            </div>
          </div>


          <div class="flex w-full flex-row pb-5 justify-between">
            <div class="w-8/12">
              <p class="text-sm">{{ speciality.description }}</p>
            </div>
            <div>
              <a v-bind:href="'/speciality/' + speciality.id"><button class="focus:outline-blue-900 bg-blue-500 hover:bg-blue-600 py-2.5 px-11 rounded-lg text-sm text-white">Подробнее</button></a>
            </div>
          </div>
        </div>

        <div v-if="specialities.data.current_page < specialities.data.last_page" class="mx-auto my-10">
          <button @click="addSpecialities" class="py-3 px-11 border rounded-lg border-gray-500 text-sm font-semibold">
            Показать больше
          </button>
        </div>

      </div>

    </div>
    <Footer />
  </div>

</template>

<script setup>
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import store from "../store";
import {computed} from "vue";

const model = {
  name: "",
  first_subject: "",
  second_subject: "",
  programs: []
}

function search() {
  store.dispatch("getSpecialities", { page: 1, specialityData: model })
}

function addSpecialities() {
  store.dispatch("getSpecialities", { add: true, page: (specialities.value.data.current_page + 1), specialityData: model })
}

const specialities = computed(() => store.state.specialities);
const subjects = computed(() => store.state.subjects);
const programs = computed(() => store.state.programs);


store.dispatch("getSpecialities", { page: 1, specialityData: model })
store.dispatch("getSubjects", )
store.dispatch("getPrograms", { page: 0, })

</script>

<style scoped>

</style>