<template>
  <table class="min-w-full">
    <thead class="bg-primary text-white font-medium border-b border-yellow-600">
    <tr>
      <th scope="col" class="text-sm px-6 py-12 text-left">
        Название
      </th>
      <th scope="col" class="text-sm px-6 py-4 text-left">
        Описание
      </th>
      <th scope="col" class="text-sm px-6 py-4 text-left">
        Вебсайт
      </th>
      <th scope="col" class="text-sm px-6 py-4 text-left">
        Регион
      </th>
      <th scope="col" class="text-sm px-6 py-4 text-left">
        Категория
      </th>
      <th scope="col" class="text-sm px-6 py-4 text-left">
        Кол-во баллов
      </th>
    </tr>
    </thead>
    <tbody class="">
    <tr :class="ind % 2 === 1 ? 'bg-secondary' : ''" v-for="(university, ind) in universities.data.data" class="bg-primary text-white hover:bg-yellow-700 hover:cursor-pointer " >
      <td class="text-sm border-yellow-600 px-6 whitespace-nowrap">
        {{ university.name }}
      </td>
      <td class="text-sm border-yellow-600 px-6 py-4 whitespace-nowrap">
        {{ university.description }}
      </td>
      <td class="text-sm border-yellow-600 px-6 py-4 whitespace-nowrap">
        {{ university.website }}
      </td>
      <td class="text-sm border-yellow-600 px-6 py-4 whitespace-nowrap">
        {{ university.region.name }}
      </td>
      <td class="text-sm border-yellow-600 px-6 py-4 whitespace-nowrap">
        {{ university.category.name }}
      </td>
      <td class="text-sm px-6 py-4 whitespace-nowrap">
        90+
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script setup>

const props = defineProps(['universities'])

const universities = props.universities

console.log(universities)

</script>
