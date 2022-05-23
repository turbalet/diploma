<template>
  <table class="min-w-full">
    <thead class="bg-primary text-white font-medium border-b border-yellow-600">
    <tr>
      <th scope="col" class="text-sm px-10 py-12 text-left">
        Название
      </th>
    </tr>
    </thead>
    <tbody class="">
    <tr :class="ind % 2 === 1 ? 'bg-secondary' : ''" v-for="(region, ind) in regions.data.data" class="bg-primary text-white hover:bg-yellow-700 hover:cursor-pointer" >
      <td class="text-sm border-yellow-600 px-10 py-4 whitespace-nowrap">
        {{ region.name }}
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script setup>
const props = defineProps(['regions'])

const regions = props.regions

</script>
