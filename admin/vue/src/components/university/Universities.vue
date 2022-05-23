<template>
  <div class="flex flex-row justify-between">
  <div class="">
    <div class="flex flex-row mx-10 mt-10">
      <div class="mr-10 ">
        <input type="search" @change="changeInput" v-model="university.name"  class="bg-secondary focus:ring focus:ring-indigo-600  box-border focus:border focus:border-indigo-500 shadow rounded-xl border border-none text-white" placeholder="Поиск">
        <!--          <div class="absolute pin-r pin-t mt-3 mr-4 text-purple-lighter">-->
        <!--            <img src="../assets/search.svg" alt="search.svg">-->
        <!--          </div>-->

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
  <div v-if="showAdd" class="absolute min-h-screen h-full inset-y-0 overflow-auto right-0 w-5/12 bg-secondary">
    <form   @submit.prevent="addUniversity">
      <div class="flex flex-col">
        <div class="flex flex-row justify-around mt-10 mr-5 ml-2 h-36">
          <div @click="close">
            <img src="../../assets/close.svg" class="hover:cursor-pointer" alt="close.svg">
          </div>
          <div class="flex flex-col">
            <div class="overflow-hidden  relative w-32 h-64 mt-4 mb-4">
              <input type="file" name="image"
                     @change="fileChange">
            </div>
          </div>
          <div>
            <img class="w-44 h-36" :src="url" alt="">
          </div>
        </div>
        <div class="flex flex-col justify-around w-full mt-10">
          <div class="flex text-sm flex-col w-11/12 ml-5 content-end text-white ">
            <label for="name" class="font-medium text-right">Название</label>
            <div class="flex flex-row mt-2 w-full justify-end  ">
              <div class="w-4/5">
                <input type="text" name="name" required v-model="universityAddData.name" class="bg-input focus:outline-none focus:ring focus:ring-indigo-600 w-full shadow text-sm rounded-xl  border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col ml-5 mt-5 w-11/12 text-white">
            <label for="name" class="font-medium text-right">Описание</label>
            <div class="flex flex-row mt-2 justify-end">
              <div class="w-4/5">
              <textarea name="description" v-model="universityAddData.description" class="bg-input w-full focus:ring focus:ring-indigo-600  text-sm max-h-80 h-32 shadow rounded-xl border border-none text-white"
              ></textarea>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Вебсайт</label>
            <div class="flex flex-row mt-2 w-full justify-end">
              <div class="w-4/5">
                <input type="text" name="website" v-model="universityAddData.website" class="bg-input text-sm focus:ring focus:ring-indigo-600  w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Инстаграм</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <input type="text" v-model="universityAddData.instagram" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Номер телефона</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <input type="text" v-model="universityAddData.phoneNumber" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Регион</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select v-model="universityAddData.regionId"  class="select w-full bg-input text-sm select-ghost  focus:ring focus:ring-indigo-600 text-white rounded-xl bg-secondary border-none">
                  <option name="regionId"  v-for="region in regions.data" :value="region.id">{{ region.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Категория</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select v-model="universityAddData.categoryId" class="select w-full text-sm select-ghost text-white focus:ring focus:ring-indigo-600  rounded-xl bg-input border-none">
                  <option name="categoryId"  v-for="category in categories.data" :value="category.id">{{ category.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Тип</label>
            <div class="flex flex-row mt-2 w-full justify-end">
              <div class="w-4/5 ">
                <select v-model="universityAddData.typeId"  class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
                  <option name="typeId" v-for="type in types.data" :value="type.id">{{ type.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Язык обучения</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select  v-model="universityAddData.languageId" class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
                  <option name="languageId"  v-for="language in languages.data" :value="language.id">{{ language.name }}</option>
                </select>
              </div>
            </div>
          </div>


        </div>
        <div class="w-full justify-end  flex">
          <button type="submit"  class="bg-indigo-600 mr-4 mb-5 rounded-xl p-3.5 mt-5 text-sm text-white font-bold hover:bg-indigo-700 hover:cursor-pointer focus:outline focus:outline-indigo-500">Добавить</button>
        </div>
      </div>
    </form>
  </div>
  <div v-if="show" class="absolute min-h-screen h-full inset-y-0 overflow-auto right-0 w-5/12 bg-secondary">
    <div class="flex flex-col">
      <div class="flex flex-row justify-around mt-10 mr-5 ml-2 h-36">
        <div @click="close">
          <img src="../../assets/close.svg" class="hover:cursor-pointer" alt="close.svg">
        </div>
        <div class="flex flex-col">
          <div class="overflow-hidden  relative w-32 h-64 mt-4 mb-4">
            <input type="file"
                   @change="fileChange">
          </div>
        </div>
        <div>
          <img class="w-44 h-36" :src="url" alt="">
        </div>
      </div>
        <div class="flex flex-col justify-around w-full mt-10">
          <div class="flex text-sm flex-col w-11/12 ml-5 content-end text-white ">
            <label for="name" class="font-medium text-right">Название</label>
            <div class="flex flex-row mt-2 w-full justify-end  ">
              <div class="w-4/5">
                <input type="text" name="name" required v-model="universityFormData.name" class="bg-input focus:outline-none focus:ring focus:ring-indigo-600 w-full shadow text-sm rounded-xl  border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col ml-5 mt-5 w-11/12 text-white">
            <label for="name" class="font-medium text-right">Описание</label>
            <div class="flex flex-row mt-2 justify-end">
              <div class="w-4/5">
              <textarea name="description" v-model="universityFormData.description" class="bg-input w-full focus:ring focus:ring-indigo-600  text-sm max-h-80 h-32 shadow rounded-xl border border-none text-white"
              ></textarea>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Вебсайт</label>
            <div class="flex flex-row mt-2 w-full justify-end">
              <div class="w-4/5">
                <input type="text" name="website" v-model="universityFormData.website" class="bg-input text-sm focus:ring focus:ring-indigo-600  w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Инстаграм</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <input type="text" v-model="universityFormData.instagram" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Номер телефона</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <input type="text" v-model="universityFormData.phone_number" name="instagram" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                       placeholder="Поиск">
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Регион</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select v-model="universityFormData.region.id"  class="select w-full bg-input text-sm select-ghost  focus:ring focus:ring-indigo-600 text-white rounded-xl bg-secondary border-none">
                  <option name="regionId" :selected="region.name === universityFormData.region.name" v-for="region in regions.data" :value="region.id">{{ region.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Категория</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select v-model="universityFormData.category.id" class="select w-full text-sm select-ghost text-white focus:ring focus:ring-indigo-600  rounded-xl bg-input border-none">
                  <option name="categoryId" :selected="category.name === universityFormData.category.name" v-for="category in categories.data" :value="category.id">{{ category.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Тип</label>
            <div class="flex flex-row mt-2 w-full justify-end">
              <div class="w-4/5 ">
                <select v-model="universityFormData.type.id"  class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
                  <option name="typeId" :selected="type.name === universityFormData.type.name" v-for="type in types.data" :value="type.id">{{ type.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Язык обучения</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <select  v-model="universityFormData.language.id" class="select w-full text-sm select-ghost focus:ring focus:ring-indigo-600  text-white rounded-xl bg-input border-none">
                  <option name="languageId" :selected="language.name === universityFormData.language.name" v-for="language in languages.data" :value="language.id">{{ language.name }}</option>
                </select>
              </div>
            </div>
          </div>


        </div>
        <div class="w-full justify-end  flex">
        <button type="button" @click="updateUniversity"  class="bg-indigo-700 mr-4 mb-5 rounded-xl p-3.5 mt-5 text-sm text-white font-bold hover:bg-indigo-800 hover:cursor-pointer focus:outline focus:outline-indigo-500">Изменить</button>
        </div>
    </div>
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

const universityAddData = {
  name: "",
  description: "",
  website: "",
  instagram: "",
  phoneNumber: "",
  regionId: 0,
  categoryId: 0,
  typeId: 0,
  languageId: 0,
}


function showAddForm() {
  showAdd.value = true

}

function close() {
  show.value = false
  url.value = false
  universityFormData.value = {}
  store.dispatch("getUniversities", { page: 1, universityData: university })
}

function getUniversity(university) {
  universityFormData.value = university
  show.value = true
  url.value = universityFormData.value.image
}

function addUniversity(e) {
  console.log(e.target.elements.name.value);
  console.log(e.target);
}

function changeInput() {
  currentPage.value = 1
  store.dispatch("getUniversities", { page: 1, universityData: university })
}

function fileChange(e) {
  const file = e.target.files[0];
  url.value = URL.createObjectURL(file);
  const form_data = new FormData();
  form_data.append("file", file, file.name);
  store.dispatch("uploadUniversityImage", {formData: form_data, id: universityFormData.value.id});

}

function updateUniversity() {
  store.dispatch("updateUniversity", { form: universityFormData.value })
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
let showAdd = ref(false);
let url = ref(null);
const universityFormData = ref(null);
const universities = computed(() => store.state.universities);
const categories = computed(() => store.state.categories);
const regions = computed(() => store.state.regions);
const types = computed(() => store.state.types);
const languages = computed(() => store.state.languages);

store.dispatch("getUniversities", { page: 1, universityData: university })
store.dispatch("getCategories")
store.dispatch("getRegions", { page: 0, name: university.region })
store.dispatch("getTypes")
store.dispatch("getLanguages")
</script>

<style scoped>

</style>
