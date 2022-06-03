<template>
  <div class="flex flex-row justify-between">
    <div class="">

      <div v-if="!languages.loading" class="mt-10 flex flex-row justify-between">
        <div class="ml-10 font-bold  text-yellow-500 ">
          <p>Всего: {{!languages.loading ? languages.data.length : 0}}

          </p>
        </div>
        <div>
          <button type="button" @click="showAddForm" class="bg-indigo-600 animate-bounce hover:bg-indigo-700 font-bold py-3 px-3 text-sm text-gray-200 rounded-2xl mr-3">+ Добавить</button>
        </div>
      </div>
      <div v-if="!languages.loading" class="flex flex-col">
        <div class="overflow-x-auto ">
          <div class=" inline-block min-w-full">
            <div class="overflow-hidden">
              <LanguageList @language="getLanguage" :languages="languages" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-if="languages.loading" class=" text-center flex my-auto w-full h-full">
    <div  class="flex items-center mx-auto justify-center">
      <img src="../../assets/loading.svg"  alt="loading" class="animate-spin animate-spin-mid w-10">
    </div>
  </div>
  <div v-if="show" class="absolute min-h-screen h-full inset-y-0 overflow-auto right-0 w-5/12 bg-secondary">
    <form @submit.prevent="saveLanguage">
      <div class="flex flex-col">
        <div @click="close" class="mt-10 ml-5">
          <img src="../../assets/close.svg" class="hover:cursor-pointer" alt="close.svg">
        </div>
        <div class="flex flex-col justify-around w-full mt-10">
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Название типа</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <input type="text" v-model="model.name" name="name" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                       placeholder="Тип">
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-end flex-row ">
          <div class="flex">
            <button type="submit" class="bg-indigo-700 mr-4 mb-5 rounded-xl p-3.5 mt-5 text-sm text-white font-bold hover:bg-indigo-800 hover:cursor-pointer focus:outline focus:outline-indigo-500">Сохранить</button>
          </div>
          <div class="flex" v-if="model.id">
            <button type="button" @click="deleteLanguage"  class="bg-red-700 mr-4 mb-5 rounded-xl p-3.5 mt-5 text-sm text-white font-bold hover:bg-red-800 hover:cursor-pointer focus:outline focus:outline-red-500">Удалить</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>

import LanguageList from './LanguageList.vue';
import {computed, ref} from "vue";
import store from "../../store";
import '@hyjiacan/vue-slideout/lib/slideout.css'

function showAddForm() {
  model.value = {
    name: "",
  }
  show.value = true
}

function close() {
  show.value = false
  // store.dispatch("getUniversities", { page: 1, universityData: university })
}

function getLanguage(type) {
  model.value = type
  show.value = true
}

let show = ref(false);

const model = ref({
  name: "",
});

function saveLanguage() {
  let action = "добавлено";
  if (model.value.id) {
    action = "изменено";
  }
  store.dispatch("saveLanguage", { ...model.value }).then(() => {
    store.commit("notify", {
      message: "Успешно " + action,
      type: 'success'
    });
    if (!model.value.id) {
      close()
      store.dispatch("getLanguages")
    }
  });
}

function deleteLanguage() {
  if (
      confirm(
          `Вы действительно хотите удалить объект?`
      )
  ) {
    store.dispatch("deleteLanguage", model.value.id).then((res) => {
      store.dispatch("getLanguages")
      close()
    }).catch(() => {
      store.commit("notify", {
        type: 'error',
        message: "Ошибка"
      });
    });

  }
}

const languages = computed(() => store.state.languages);

store.dispatch("getLanguages")
</script>

<style scoped>

</style>
