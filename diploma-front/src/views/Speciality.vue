<template>
  <div class="w-full">
    <Header />
    <div class="mt-10 flex pl-5 flex-row">
      <div class="flex flex-col w-7/12 p-5">
        <p class="font-medium text-2xl"><span class="text-blue-500">{{ speciality.data.code }}</span> {{ speciality.data.name }} </p>
        <p class="pt-10">{{ speciality.data.description }}</p>
      </div>
      <div class="flex flex-col w-5/12 mt-10 pl-5">
        <div class="inline-flex pl-5 pt-10">
          <img src="../assets/type.svg"  alt="type">
          <p class="pl-3">{{ speciality.data.program.degree.name }}</p>
        </div>
        <div class="inline-flex pl-5 py-5">
          <img src="../assets/ep.svg" alt="type">
          <p class="pl-3">{{ speciality.data.program.name }}</p>
        </div>
        <div class="inline-flex pl-5">
          <img src="../assets/ep.svg" alt="type">
          <p class="pl-3">{{ speciality.data.first_subject.name }} + {{ speciality.data.second_subject.name }}</p>
        </div>
      </div>
    </div>

    <div class="flex flex-row justify-between px-10 pt-10">
      <div><p class="font-medium text-lg">Кем можно работать?</p></div>
      <div><img class="w-5 my-auto" src="../assets/arrow-down-black.svg" alt="arrow"></div>
    </div>
    <br>
    <hr>

    <p class="px-10 pt-3">{{ speciality.data.professions }}</p>

    <div class="flex flex-row justify-between px-10 pt-10">
      <div><p class="font-medium text-lg">Дополнительная информация</p></div>
      <div><img class="w-5 my-auto" src="../assets/arrow-down-black.svg" alt="arrow"></div>
    </div>
    <br>
    <hr>

    <p class="px-10 pt-3">Проходной балл: {{ speciality.data.program.points }} балл
    </p>
    <p class="px-10 pt-3">
      Процент трудоустройства: {{ speciality.data.job_rate }}%
    </p>
    <p class="px-10 pt-3">
      Медианная заработная плата выпускников: {{ speciality.data.avg_salary }} тенге
    </p>

    <div class="flex flex-row justify-between px-10 pt-10">
      <div><p class="font-semibold text-xl">Университеты</p></div>
      <div><img class="w-5 my-auto" src="../assets/arrow-down-black.svg" alt="arrow"></div>
    </div>
    <br>
    <hr>

    <div class="grid grid-cols-2 gap-4 px-5 py-5">
      <div v-for="university in speciality.data.universities" class="border border-gray-200 mb-3 rounded-lg flex flex-col px-8">
        <div class="w-full pt-3">
          <p class="font-semibold text-xl">{{ university.name }}</p>
        </div>
        <div class="w-full flex flex-row py-3">
          <div class="w-24">
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
                <p class="text-sm pl-2">{{ university.region.name }}</p>
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
            <p class="text-sm">{{ university.description }}</p>
          </div>
          <div>
            <a v-bind:href="'/university/' + university.id"><button  class="bg-blue-500 py-2.5 px-11 rounded-lg text-sm text-white">Подробнее</button></a>
          </div>
        </div>
      </div>


    </div>

    <br>
    <Footer />

  </div>
</template>

<script setup>
import Header from '../components/Header.vue';
import Footer from "../components/Footer.vue";
import router from "../router";
import {useRoute} from "vue-router";
import {computed} from "vue";
import store from "../store";

const id = useRoute().params.id

const speciality = computed(() => store.state.speciality);

store.dispatch("getSpeciality", { id: id})

</script>

<style scoped>

</style>