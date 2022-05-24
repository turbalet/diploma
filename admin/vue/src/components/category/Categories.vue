<template>
  <div class="flex flex-row justify-between">
    <div class="">
      <div class="flex flex-row mx-10 mt-10">
        <div class="mr-10 ">
          <input type="search" @change="changeInput" v-model="category.name"  class="bg-secondary focus:ring focus:ring-indigo-600  box-border focus:border focus:border-indigo-500 shadow rounded-xl border border-none text-white" placeholder="Поиск">
        </div>
      </div>
      <div v-if="!categories.loading" class="mt-10 flex flex-row justify-between">
        <div class="ml-10 font-bold  text-yellow-500 ">
          <p>Всего: {{!categories.loading ? categories.data.length : 0}}

          </p>
        </div>
        <div>
          <button type="button" @click="showAddForm" class="bg-indigo-600 animate-bounce hover:bg-indigo-700 font-bold py-3 px-3 text-sm text-gray-200 rounded-2xl mr-3">+ Добавить</button>
        </div>
      </div>
      <div v-if="!categories.loading" class="flex flex-col">
        <div class="overflow-x-auto ">
          <div class=" inline-block min-w-full">
            <div class="overflow-hidden">
              <CategoryList @category="getCategory" :categories="categories" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-if="categories.loading" class=" text-center flex my-auto w-full h-full">
    <div  class="flex items-center mx-auto justify-center">
      <img src="../../assets/loading.svg"  alt="loading" class="animate-spin animate-spin-mid w-10">
    </div>
  </div>
  <div v-if="show" class="absolute min-h-screen h-full inset-y-0 overflow-auto right-0 w-5/12 bg-secondary">
    <form @submit.prevent="saveCategory">
      <div class="flex flex-col">
        <div @click="close" class="mt-10 ml-5">
          <img src="../../assets/close.svg" class="hover:cursor-pointer" alt="close.svg">
        </div>
        <div class="flex flex-col justify-around w-full mt-10">
          <div class="flex text-sm flex-col w-11/12 ml-5 mt-5 text-white">
            <label for="name" class="font-medium text-right">Название категории</label>
            <div class="flex flex-row mt-2 justify-end w-full">
              <div class="w-4/5">
                <input type="text" v-model="model.name" name="name" class="bg-input focus:ring focus:ring-indigo-600  text-sm w-full shadow rounded-xl border border-none text-white"
                       placeholder="Категория">
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-end flex-row ">
          <div class="flex">
            <button type="submit" class="bg-indigo-700 mr-4 mb-5 rounded-xl p-3.5 mt-5 text-sm text-white font-bold hover:bg-indigo-800 hover:cursor-pointer focus:outline focus:outline-indigo-500">Сохранить</button>
          </div>
          <div class="flex" v-if="model.id">
            <button type="button" @click="deleteCategory"  class="bg-red-700 mr-4 mb-5 rounded-xl p-3.5 mt-5 text-sm text-white font-bold hover:bg-red-800 hover:cursor-pointer focus:outline focus:outline-red-500">Удалить</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>

import CategoryList from './CategoryList.vue';
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

function getCategory(category) {
  model.value = category
  show.value = true
}

function changeInput() {
  store.dispatch("getCategories", category)
}

let show = ref(false);

const model = ref({
  name: "",
});
const category = {
  name: ""
}

function saveCategory() {
  let action = "добавлено";
  if (model.value.id) {
    action = "изменено";
  }
  store.dispatch("saveCategory", { ...model.value }).then(() => {
    store.commit("notify", {
      message: "Успешно " + action,
      type: 'success'
    });
    if (!model.value.id) {
      close()
      store.dispatch("getCategories", category)
    }
  });
}

function deleteCategory() {
  if (
      confirm(
          `Вы действительно хотите удалить объект?`
      )
  ) {
    store.dispatch("deleteCategory", model.value.id).then(() => {
      store.commit("notify", {
        type: 'success',
        message: "Успешно удалено"
      });
      store.dispatch("getCategories", category )
      close()
    });
  }
}

const categories = computed(() => store.state.categories);

store.dispatch("getCategories", category)
</script>

<style scoped>

</style>
