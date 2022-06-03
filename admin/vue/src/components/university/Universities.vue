<template>
  <div class="flex flex-row justify-between">
  <div class="">
    <div class="flex flex-row mx-10 mt-10">
      <div class="mr-10 ">
        <input type="search" @change="changeInput" v-model="university.name"  class="bg-secondary focus:ring focus:ring-indigo-600  box-border focus:border focus:border-indigo-500 shadow rounded-xl border border-none text-white" placeholder="Поиск">
      </div>
      <div class="mr-10">
        <select v-model="university.region" @change="changeInput" class="select focus:ring focus:ring-indigo-600  text-sm select-ghost text-white rounded-xl bg-secondary border-none">
          <option value="" selected>Регион</option>
          <option v-for="region in regions.data" :value="region.name">{{ region.name }}</option>
        </select>
      </div>
      <div class="mr-10">
        <select v-model="university.category" @change="changeInput"  class="select text-sm  focus:ring focus:ring-indigo-600  select-ghost  text-white rounded-xl bg-secondary border-none">
          <option value=""  selected>Категория</option>
          <option v-for="category in categories.data" :value="category.name">{{ category.name }}</option>
        </select>
      </div>
      <div class="mr-10">
        <select v-model="university.type" @change="changeInput"  class="select text-sm focus:ring focus:ring-indigo-600   select-ghost  text-white rounded-xl bg-secondary border-none">
          <option value=""  selected>Тип</option>
          <option v-for="type in types.data" :value="type.name">{{ type.name }}</option>
        </select>
      </div>
      <div class="mr-10">
        <select v-model="university.language" @change="changeInput"  class="select text-sm  focus:ring focus:ring-indigo-600  select-ghost  text-white rounded-xl bg-secondary border-none">
          <option value=""  selected>Язык обучения</option>
          <option v-for="lang in languages.data" :value="lang.name">{{ lang.name }}</option>
        </select>
      </div>

    </div>
    <div v-if="!universities.loading" class="mt-10 flex flex-row justify-between">
      <div class="ml-10 font-bold  text-yellow-500 ">
        <p>Всего: {{!universities.loading ? universities.data.total : 0}}

        </p>
      </div>
      <paginate
          v-model="currentPage"
          :page-count="!universities.loading ? universities.data.last_page : 1"
          :container-class="'bg-secondary rounded-xl text-gray-400 flex flex-row h-9'"
          :page-class="'bg-secondary w-9 h-9 font-bold flex items-center justify-center hover:bg-yellow-600  hover:cursor-pointer hover:text-black relative inline-flex items-center px-4 py-2 border-none text-sm font-medium'"
          :active-class="'text-black bg-yellow-600 '"
          :disabled-class="'hover:bg-secondary hover:text-gray-400'"

          :hide-pred-next="true"
          :prev-class="'flex justify-center hover:bg-indigo-700 hover:text-white hover:cursor-pointer text-white w-9 h-9 bg-indigo-600 h-full rounded-l-xl items-center'"
          :next-text="'>'"
          :prev-text="'<'"
          :next-class="'flex justify-center hover:cursor-pointer  text-white w-9 h-9 bg-indigo-600 h-full rounded-r-xl items-center hover:bg-indigo-700'"
          :click-handler="search">
      </paginate>
      <div>
        <button type="button" @click="showAddForm" class="bg-indigo-600 animate-bounce hover:bg-indigo-700 font-bold py-3 px-3 text-sm text-gray-200 rounded-2xl mr-3">+ Добавить</button>
      </div>
    </div>
    <div v-if="!universities.loading" class="flex flex-col">
      <div class="overflow-x-auto ">
        <div class=" inline-block min-w-full">
          <div class="overflow-hidden">
            <UniversityList @university="getUniversity" :universities="universities" />
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div v-if="universities.loading" class=" text-center flex my-auto w-full h-full">
    <div  class="flex items-center mx-auto justify-center">
      <img src="../../assets/loading.svg"  alt="loading" class="animate-spin animate-spin-mid w-10">
    </div>
  </div>
  <div v-if="show" class="absolute min-h-screen h-full inset-y-0 overflow-auto right-0 w-5/12 bg-secondary">
    <form @submit.prevent="saveUniversity">
      <div class="flex flex-col">
        <div class="flex flex-row justify-around mt-10 mr-5 ml-2 h-36">
          <div @click="close">
            <img src="../../assets/close.svg" class="hover:cursor-pointer" alt="close.svg">
          </div>
          <div class="flex flex-col">
            <div class="overflow-hidden  relative w-32 h-64 mt-4 mb-4">
              <input type="file"
                     @change="onImageChoose">
            </div>
          </div>
          <div class=" w-44 h-36">
            <img class="w-full h-full border-4 border-indigo-700 rounded-xl" v-if="model.image_url"
                 :src="model.image_url"
                 :alt="model.title" >
            <div class="w-full h-full border-4 border-indigo-700 rounded-xl"  v-else>
              <img v-if="model.image" class="w-full rounded-xl h-full rounded-xl " :src="model.image" :alt="model.title" />
            </div>
          </div>
        </div>
        <div class="flex flex-col justify-around w-full mt-10">
          <div class="flex text-sm flex-col w-11/12 ml-5 content-end text-white ">
            <label for="name" class="font-medium text-right">Название</label>
            <div class="flex flex-row mt-2 w-full justify-end  ">
              <div class="w-4/5">
                <input type="text" name="name" required v-model="model.name" class="bg-input focus:outline-none focus:ring focus:ring-indigo-600 w-full shadow text-sm rounded-xl  border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col ml-5 mt-5 w-11/12 text-white">
            <label for="name" class="font-medium text-right">Описание</label>
            <div class="flex flex-row mt-2 justify-end">
              <div class="w-4/5">
              <textarea name="description" v-model="model.description" class="bg-input w-full focus:ring focus:ring-indigo-600  text-sm max-h-80 h-32 shadow rounded-xl border border-none text-white"
              ></textarea>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Вебсайт</label>
            <div class="flex flex-row mt-2 w-full justify-end">
              <div class="w-4/5">
                <input type="text" name="website" v-model="model.website" class="bg-input text-sm focus:ring focus:ring-indigo-600  w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Инстаграм</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <input type="text" v-model="model.instagram" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Номер телефона</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <input type="text" v-model="model.phone_number" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Регион</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select v-model="model.region.id"  class="select w-full bg-input text-sm select-ghost  focus:ring focus:ring-indigo-600 text-white rounded-xl bg-secondary border-none">
                  <option name="regionId" :selected="region.name === model.region.name" v-for="region in regions.data" :value="region.id">{{ region.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Категория</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select v-model="model.category.id" class="select w-full text-sm select-ghost text-white focus:ring focus:ring-indigo-600  rounded-xl bg-input border-none">
                  <option name="categoryId" :selected="category.name === model.category.name" v-for="category in categories.data" :value="category.id">{{ category.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Тип</label>
            <div class="flex flex-row mt-2 w-full justify-end">
              <div class="w-4/5 ">
                <select v-model="model.type.id"  class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
                  <option name="typeId" :selected="type.name === model.type.name" v-for="type in types.data" :value="type.id">{{ type.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Язык обучения</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select  v-model="model.language.id" class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
                  <option name="languageId" :selected="language.name === model.language.name" v-for="language in languages.data" :value="language.id">{{ language.name }}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-end flex-row ">
          <div class="flex">
            <button type="submit" class="bg-indigo-700 mr-4 mb-5 rounded-xl p-3.5 mt-5 text-sm text-white font-bold hover:bg-indigo-800 hover:cursor-pointer focus:outline focus:outline-indigo-500">Сохранить</button>
          </div>
          <div class="flex" v-if="model.id">
            <button type="button" @click="deleteUniversity"  class="bg-red-700 mr-4 mb-5 rounded-xl p-3.5 mt-5 text-sm text-white font-bold hover:bg-red-800 hover:cursor-pointer focus:outline focus:outline-red-500">Удалить</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>

import UniversityList from './UniversityList.vue';
import Paginate from 'vuejs-paginate-next';
import {computed, ref} from "vue";
import store from "../../store";
import '@hyjiacan/vue-slideout/lib/slideout.css'

const university = {
  name: "",
  region: "",
  category: "",
  type: "",
  language: "",
}

function showAddForm() {
  model.value = {
    name: "",
    description: "",
    website: "",
    phone_number: "",
    instagram: "",
    image: "",
    image_url: null,
    updated_image: null,
    region: {},
    category: {},
    type: {},
    language: {}
  }
  show.value = true

}

function close() {
  show.value = false
  currentPage.value = 1
 // store.dispatch("getUniversities", { page: 1, universityData: university })
}

function getUniversity(university) {
  model.value = university
  show.value = true
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

const image = null;
let currentPage = ref(1);
let show = ref(false);

const model = ref({
  name: "",
  description: "",
  website: "",
  phone_number: "",
  instagram: "",
  image: "",
  image_url: null,
  updated_image: null,
  region: {},
  category: {},
  type: {},
  language: {}
});

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

function saveUniversity() {
  let action = "добавлено";
  if (model.value.id) {
    action = "изменено";
  }
  store.dispatch("saveUniversity", { ...model.value }).then(({ data }) => {
    store.commit("notify", {
      message: "Успешно " + action,
      type: 'success'
    });
    if (!model.value.id) {
      close()
      store.dispatch("getUniversities", { page: 1, universityData: university })
    }
  });
}

function deleteUniversity() {
  if (
      confirm(
          `Вы действительно хотите удалить объект?`
      )
  ) {
    store.dispatch("deleteUniversity", model.value.id).then(() => {
      store.commit("notify", {
        type: 'success',
        message: "Успешно удалено"
      });
      store.dispatch("getUniversities", { page: 1, universityData: university })
      close()
    });
  }
}

const universities = computed(() => store.state.universities);
const categories = computed(() => store.state.categories);
const regions = computed(() => store.state.regions);
const types = computed(() => store.state.types);
const languages = computed(() => store.state.languages);

store.dispatch("getUniversities", { page: 1, universityData: university })
store.dispatch("getCategories", {})
store.dispatch("getRegions", { page: 0, name: university.region })
store.dispatch("getTypes")
store.dispatch("getLanguages")
</script>

<style scoped>

</style>
