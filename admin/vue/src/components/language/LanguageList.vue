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
      <tr @click="sendEmit(language)" :class="ind % 2 === 1 ? 'bg-secondary' : ''" v-for="(language, ind) in languages.data" class="bg-primary text-white hover:bg-yellow-700 hover:cursor-pointer " >
        <td class="text-sm font-bold border-yellow-600 px-10 py-4 whitespace-nowrap overflow-y-auto">
          {{ language.name }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>

const props = defineProps(['languages'])
const types = props.languages
const emit = defineEmits(['language'])
function sendEmit(language) {
  emit('language', language)
}

</script>
