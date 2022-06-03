<template>
  <div class="">
    <table class="table-fixed w-full">
      <thead class="bg-primary text-white font-medium border-b border-yellow-600">
      <tr>
        <th scope="col" class="text-sm w-2/12 px-6 py-12 text-left">
          Название
        </th>
        <th scope="col" class="text-sm w-2/12 px-6 py-4 text-left ">
          Описание
        </th>
        <th scope="col" class="text-sm w-1/12 px-6 py-4 text-left">
          Вебсайт
        </th>
        <th scope="col" class="text-sm w-1/12 px-6 py-4 text-left">
          Регион
        </th>
        <th scope="col" class="text-sm w-1/12 px-6 py-4 text-left">
          Категория
        </th>
        <th scope="col" class="text-sm w-1/12 px-6 py-4 text-left">
          Тип
        </th>
        <th scope="col" class="text-sm w-1/12 px-6 py-4 text-left">
          Язык
        </th>
      </tr>
      </thead>
      <tbody >
      <tr @click="toUniversity(university)" :class="ind % 2 === 1 ? 'bg-secondary' : ''" v-for="(university, ind) in universities.data.data" class="bg-primary text-white hover:bg-yellow-700 hover:cursor-pointer " >
        <td class="text-sm font-bold border-yellow-600 px-6 whitespace-nowrap overflow-y-auto">
          {{ university.name }}
        </td>
        <td class="text-sm border-yellow-600  px-6 w-2/12 py-4 whitespace-nowrap overflow-y-auto ">
          {{ university.description }}
        </td>
        <td class="text-sm border-yellow-600  px-6 py-4 whitespace-nowrap">
          {{ university.website }}
        </td>
        <td class="text-sm border-yellow-600  px-6 py-4 whitespace-nowrap">
          {{ university.region.name }}
        </td>
        <td class="text-sm border-yellow-600 px-6 py-4 whitespace-nowrap">
          {{ university.category.name }}
        </td>
        <td class="text-sm pr-6 py-4 whitespace-nowrap text-left">
          {{ university.type.name }}
        </td>
        <td class="text-sm pr-6 py-4 whitespace-nowrap text-left">
          {{ university.language.name }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import router from "../../router";
const props = defineProps(['universities'])
const universities = props.universities

function toUniversity(university) {
  router.push({name: 'University', params: {id: university.id}})
}

const emit = defineEmits(['university'])
function sendEmit(university) {
  emit('university', university)
}

</script>
