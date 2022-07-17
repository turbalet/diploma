<template>
  <div class="w-full">

    <div class="flex flex-row">
      <div class="flex flex-row mt-10 mr-5 ml-10 h-36">
        <div class="w-44 h-36">
          <label for="name" class="font-medium text-white w-full">Баннер</label>
          <img class="w-full h-full border-4 border-indigo-700 rounded-xl" v-if="model.image_url"
               :src="model.image_url"
               :alt="model.title" >
          <div class="w-full h-full border-4 border-indigo-700 rounded-xl"  v-else>
            <img v-if="university.banner" class="w-full rounded-xl h-full rounded-xl " :src="university.banner" :alt="model.title" />
          </div>
        </div>
        <div class="flex flex-col m-5">
          <div class="overflow-hidden  w-32 h-64 mt-4 mb-4">
            <input type="file"
                   @change="onImageChoose">
          </div>
        </div>
      </div>
      <div class="flex flex-row mt-10 mr-5 ml-20 h-36">
        <div class=" w-44 h-36">
          <label for="name" class="font-medium text-right text-white w-full">Логотип</label>
          <img class="w-full h-full border-4 border-indigo-700 rounded-xl" v-if="model.logo_url"
               :src="model.logo_url"
               :alt="model.title" >
          <div class="w-full h-full border-4 border-indigo-700 rounded-xl"  v-else>
            <img v-if="university.logo" class="w-full rounded-xl h-full rounded-xl " :src="university.logo" :alt="university.title" />
          </div>
        </div>
        <div class="flex flex-col m-5">
          <div class="overflow-hidden w-32 h-64 mt-4 mb-4">
            <input type="file"
                   @change="onLogoChoose">
          </div>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-4 gap-4 w-full px-10 mt-10">


      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium ">Название</label>
        <div class="flex flex-row mt-2  w-full">
          <div class="w-full">
            <input type="text" v-model="university.name" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                   placeholder="Поиск">
          </div>
        </div>
      </div>
      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium ">Инстаграм</label>
        <div class="flex flex-row mt-2  w-full">
          <div class="w-full">
            <input type="text" v-model="university.instagram" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                   placeholder="Поиск">
          </div>
        </div>
      </div>
      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium ">Вебсайт</label>
        <div class="flex flex-row mt-2  w-full">
          <div class="w-full">
            <input type="text" v-model="university.website" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                   placeholder="Поиск">
          </div>
        </div>
      </div>
      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium ">Номер телефона</label>
        <div class="flex flex-row mt-2  w-full">
          <div class="w-full">
            <input type="text" v-model="university.phone_number" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                   placeholder="Поиск">
          </div>
        </div>
      </div>
      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium ">Год основания</label>
        <div class="flex flex-row mt-2  w-full">
          <div class="w-full">
            <input type="text" v-model="university.opened" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                   placeholder="Поиск">
          </div>
        </div>
      </div>
      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium">Тип</label>
        <div class="flex flex-row mt-2 w-full">
          <div class="w-full ">
            <select v-model="university.type.id"  class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
              <option name="typeId" :selected="type.name === university.type.name" v-for="type in types.data" :value="type.id">{{ type.name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium">Категория</label>
        <div class="flex flex-row mt-2 w-full">
          <div class="w-full ">
            <select v-model="university.category.id"  class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
              <option name="typeId" :selected="category.name === university.category.name" v-for="category in categories.data" :value="category.id">{{ category.name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium">Регион</label>
        <div class="flex flex-row mt-2 w-full">
          <div class="w-full ">
            <select v-model="university.region.id"  class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
              <option name="typeId" :selected="region.name === university.region.name" v-for="region in regions.data" :value="region.id">{{ region.name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium">Язык обучения</label>
        <div class="flex flex-row mt-2 w-full">
          <div class="w-full ">
            <select v-model="university.language.id"  class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
              <option name="typeId" :selected="language.name === university.language.name" v-for="language in languages.data" :value="language.id">{{ language.name }}</option>
            </select>
          </div>
        </div>
      </div>

      <div class="flex text-sm flex-col text-white">
        <label for="name" class="font-medium">Описание</label>
        <div class="flex flex-row mt-2 justify-end">
          <div class="w-full">
              <textarea name="description" v-model="university.description" class="bg-input w-full focus:ring focus:ring-indigo-600  text-sm max-h-80 h-32 shadow rounded-xl border border-none text-white"
              ></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="m-10 text-white">
      <p class="font-semibold text-lg">Образовательные программы</p>
      <div class="flex flex-col">
        <div class="flex flex-col">
          <div class="flex w-full border-2 border-indigo-700 flex-row justify-between">
            <div>
              <p>Информационные технологии</p>
            </div>
            <div>
              <p>+</p>
            </div>
          </div>
          <div class="px-10">
            <p>Программная инженерия</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import {computed, ref} from "vue";
import store from "../../store";
import router from "../../router";
import {useRoute} from "vue-router";

const route = useRoute();

let model = ref({
  name: "",
  description: "",
  website: "",
  phone_number: "",
  opened: 0,
  instagram: "",
  banner: "",
  logo: "",
  image_url: null,
  logo_url: null,
  updated_image: null,
  updated_logo: null,
  region: {},
  category: {},
  type: {},
  language: {},
  programs: [],
})


function onImageChoose(ev) {
  const file = ev.target.files[0];

  const reader = new FileReader();
  reader.onload = () => {
    // The field to send on backend and apply validations
    model.value.updated_image = reader.result;

    // The field to display here
    model.value.image_url = reader.result;
    ev.target.value = "";
  };
  reader.readAsDataURL(file);
}

function onLogoChoose(ev) {
  const file = ev.target.files[0];

  const reader = new FileReader();
  reader.onload = () => {
    // The field to send on backend and apply validations
    model.value.updated_logo = reader.result;

    // The field to display here
    model.value.logo_url = reader.result;
    ev.target.value = "";
  };
  reader.readAsDataURL(file);
}


const university = computed(()=>store.state.university);
const categories = computed(() => store.state.categories);
const regions = computed(() => store.state.regions);
const types = computed(() => store.state.types);
const languages = computed(() => store.state.languages);

store.dispatch("getCategories", {})
store.dispatch("getRegions", { page: 0, })
store.dispatch("getTypes")
store.dispatch("getLanguages")
store.dispatch("getUniversity", {id: route.params.id})


</script>

<style scoped>

</style>