<template>

  <div class="w-full min-h-screen">
    <Header />
    <div class="min-h-screen w-full flex flex-col px-10 mt-10">

      <div>
        <p class="font-medium text-xl">РЕЙТИНГ ОБРАЗОВАТЕЛЬНЫХ ПРОГРАММ ВУЗОВ</p>
      </div>


      <!-- FILTER -->
      <div class="flex flex-row w-full justify-between  mt-10">

<!--        <div class="flex flex-col w-1/5 text-sm ">-->
<!--          <p class="font-medium text-sm">Год</p>-->
<!--            <select name="" id="" class=" form-select focus:border-blue-600 focus:border-2  rounded-lg block w-full mt-1 border border-gray-300 outline-1 outline-blue-600 py-2 px-3 font-medium">-->
<!--              <option selected>2022</option>-->
<!--            </select>-->
<!--        </div>-->

        <div class="flex flex-col w-1/5 text-sm ">
          <p class="font-medium text-sm ">Название ВУЗа</p>
          <div class="w-full">
            <input @change="search" v-model="model.name" type="text" name="name" placeholder="Найти..." class="border outline-1  outline-blue-600 w-full mt-1 rounded-lg py-1.5 px-3 border-gray-400 font-medium text-sm">
          </div>
        </div>
        <div class="flex flex-col w-1/5 text-sm ">
          <p class="font-medium text-sm">Специальность</p>
            <select @change="search" v-model="model.speciality" name="select" id="" class="form-select focus:border-blue-600 focus:border-2 rounded-lg block w-full mt-1 border border-gray-300 outline-1 outline-blue-600 py-2 px-3 font-medium">
              <option :value="speciality.id" v-for="speciality in specialities.data" >{{ speciality.name }}</option>
            </select>
        </div>
        <div class="flex flex-col w-1/5 text-sm ">
          <p class="font-medium  text-sm">Регион</p>
            <select @change="search" v-model="model.region" name="" id="" class="form-select content-end focus:border-blue-600 focus:border-2  rounded-lg block w-full mt-1 border border-gray-300 outline-1 outline-blue-600 py-2 px-3 font-medium">
              <option :value="region.name"  v-for="region in regions.data" selected>{{ region.name }}</option>
            </select>
        </div>
      </div>


      <!-- LIST -->
      <div class="grid gap-10 w-full grid-cols-2 mt-10">

        <div v-if="universities.data.length !== 0" v-for="(university, ind) in universities.data" class="flex flex-col w-full text-sm">

          <div class="w-full relative h-32 bg-blue-800 flex flex-row p-5 rounded-t-xl">

            <div class=" ">
              <p class="font-extralight text-white ">{{university.speciality}} - {{ university.code }}</p>
              <p class="font-bold text-white text-lg">{{ university.name }}</p>
              <p class="font-light text-white mt-3 tex">{{ university.region }}</p>
            </div>
            <div class="bg-amber-400  absolute -right-4 -top-4   rounded-3xl p-3">
              <p class="font-bold text-xl"> {{ind+1}}/{{universities.data.length}}</p>
            </div>

          </div>

          <div class="  w-full bg-gray-200 flex flex-col p-5 rounded-b-xl ">
            <div class=" flex flex-row justify-between mb-3">
              <p class=" ">Средняя заработная плата (в тенге)	</p>
              <p class=" font-bold">420 000.67</p>
            </div>
            <div class=" flex flex-row justify-between mb-3">
              <p class=" ">Уровень трудоустройства (в %)	</p>
              <p class=" font-bold">87.5%</p>
            </div>
            <div class=" flex flex-row justify-between ">
              <p class=" ">Очки</p>
              <p class=" font-bold">{{ university.points }}</p>
            </div>
          </div>
        </div>
        <div v-else-if="model.speciality === 0">
          <p>Пожалуйста выберите специальность.</p>
        </div>
        <div v-else-if="model.region === '' && model.name === ''">
          <p>По данному запросу ничего не найдено.</p>
        </div>
        <div v-else>
          <p>По данному запросу ничего не найдено.</p>
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
  region: "",
  speciality: 0,
}

function search() {
  store.dispatch("getRating", { data: model })
}

const specialities = computed(() => store.state.specialities)
const universities = computed(() => store.state.universities)
const regions = computed(() => store.state.regions)

store.dispatch("getRating", { data: model })
store.dispatch("getRegions", { page: 0, name: ""})
store.dispatch("getSpecialities", { page: 0, specialityData: {name: "", programs: [], first_subject: "", second_subject: ""} })

</script>

<style scoped>

</style>