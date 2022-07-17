<template>
  <div class="">
    <table class="table-fixed w-full">
      <thead class="bg-primary text-white font-medium border-b border-yellow-600">
      <tr>
        <th scope="col" class="text-sm w-2/12 px-10 pt-12 pb-5 text-left">
          Название
        </th>
        <th scope="col" class="text-sm w-2/12 px-10 pt-12 pb-5 text-left">
          Код
        </th>
        <th scope="col" class="text-sm w-2/12 px-10 pt-12 pb-5 text-left">
          Предмет 1
        </th>
        <th scope="col" class="text-sm w-2/12 px-10 pt-12 pb-5 text-left">
          Предмет 2
        </th>
      </tr>
      </thead>
      <tbody >
      <tr @click="sendEmit(program)" :class="ind % 2 === 1 ? 'bg-secondary' : ''" v-for="(program, ind) in programs.data" class="bg-primary text-white hover:bg-yellow-700 hover:cursor-pointer " >
        <td class="text-sm font-bold border-yellow-600 px-10 py-4 whitespace-nowrap overflow-y-auto">
          {{ program.name }}
        </td>
        <td class="text-sm font-bold border-yellow-600 px-10 py-4 whitespace-nowrap overflow-y-auto">
          {{ program.code }}
        </td>
        <td class="text-sm font-bold border-yellow-600 px-10 py-4 whitespace-nowrap overflow-y-auto">
          {{ program.first_subject.name }}
        </td>
        <td class="text-sm font-bold border-yellow-600 px-10 py-4 whitespace-nowrap overflow-y-auto">
          {{ program.second_subject.name }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>

const props = defineProps(['programs'])
const types = props.programs
const emit = defineEmits(['program'])
function sendEmit(program) {
  emit('program', program)
}

</script>
