<template>
  <div class="w-full">
    <div class="h-screen w-full bg-cover bg-center flex flex-col" v-bind:style='{ backgroundImage: `linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url(${university.data.banner})` }' >
      <HeaderHome />
      <div class="align-middle mx-auto text-white my-auto">
        <p class="font-bold text-4xl">{{ university.data.name }}</p>
        <p class="text-center font-semibold pt-3">{{ university.data.region.name }}</p>
      </div>
      <div class="mx-auto pb-5 animate-bounce hover:cursor-pointer">
        <a href="#info"><img src="../assets/arrow-down.svg" alt="arrow-down" ></a>
      </div>
    </div>
    <div id="info" class="w-full flex flex-col pt-10">
      <div class="flex flex-row w-full justify-around">
        <div class="py-2 w-1/8 px-8 flex flex-row shadow">
          <img src="../assets/uni-location-card.svg" class="w-8" alt="uni">
          <p class="my-auto pl-4">{{ university.data.region.name }}</p>
        </div>
        <div class="py-2 w-1/8 px-8 flex flex-row shadow">
          <img src="../assets/uni-insta-card.svg" class="w-8" alt="uni">
          <p class="my-auto pl-4">{{ university.data.instagram }}</p>
        </div>
        <div class="py-2 w-1/8 px-8 flex flex-row shadow">
          <img src="../assets/uni-phone-card.svg" class="w-8" alt="uni">
          <p class="my-auto pl-4">{{ university.data.phone_number }}</p>
        </div>
        <div class="py-2 w-1/8 px-8 flex flex-row shadow">
          <img src="../assets/uni-site-card.svg" class="w-8" alt="uni">
          <p class="my-auto pl-4">{{ university.data.website }}</p>
        </div>
        <div class="py-2 w-1/8 px-8 flex flex-row shadow">
          <img src="../assets/uni-tenge-card.svg" class="w-8" alt="uni">
          <p class="my-auto pl-4">{{ university.data.min_pay }}</p>
        </div>
      </div>
      <div>

      </div>
    </div>
    <br>
    <div class="mt-10 flex" id="history">
      <div class="mx-auto my-auto flex flex-row w-4/5">
        <div class="my-auto">
          <img src="../assets/uni-about.svg" class="md:block md:w-5/5 hidden" alt="history img">
        </div>
        <div class="flex flex-col w-4/5 pl-10">
          <div class="pt-8">
            <p class="font-medium text-2xl">Об {{ university.data.name }}</p>
            <div class="w-12 h-1 bg-blue-500"></div>
          </div>
          <div class="pt-5">
            <p>{{ university.data.description }}</p>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="flex flex-col mt-10">
      <div class="flex flex-row justify-between px-5">
        <div><p class="font-medium text-xl">Образовательные программы ({{ university.data.specialities.length }})</p></div>
        <div><img class="w-8 my-auto" src="../assets/arrow-down-black.svg" alt="arrow"></div>
      </div>
      <br>
      <hr>
      <br>

      <div class="grid grid-cols-2 gap-4 px-5">
        <div v-for="speciality in university.data.specialities" class="border border-gray-300 mb-3 rounded-lg flex flex-col px-8">
          <div class="w-full pt-5">
            <p class="font-semibold text-xl">{{ speciality.code }} <span class="pl-3">{{ speciality.name }}</span></p>
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
      </div>

    </div>
    <br>
    <Footer />

  </div>
</template>

<script setup>
import HeaderHome from '../components/HeaderHome.vue';
import Footer from "../components/Footer.vue";
import router from "../router";
import {useRoute} from "vue-router";
import {computed} from "vue";
import store from "../store";

const id = useRoute().params.id

const university = computed(() => store.state.university);

store.dispatch("getUniversity", { id: id})

</script>

<style scoped>

</style>