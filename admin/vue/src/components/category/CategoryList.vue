<template>
  <div class="">
    <table class="table-fixed w-full">
      <thead class="bg-primary text-white font-medium border-b border-yellow-600">
      <tr>
        <th scope="col" class="text-sm w-2/12 px-10 pt-12 pb-5 text-left">
          Название
        </th>
      </tr>
      </thead>
      <tbody >
      <tr @click="sendEmit(category)" :class="ind % 2 === 1 ? 'bg-secondary' : ''" v-for="(category, ind) in categories.data" class="bg-primary text-white hover:bg-yellow-700 hover:cursor-pointer " >
        <td class="text-sm font-bold border-yellow-600 px-10 py-4 whitespace-nowrap overflow-y-auto">
          {{ category.name }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>

const props = defineProps(['categories'])
const categories = props.categories
const emit = defineEmits(['category'])
function sendEmit(category) {
  emit('category', category)
}

</script>
