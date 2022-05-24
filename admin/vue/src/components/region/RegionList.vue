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
    <tr :class="ind % 2 === 1 ? 'bg-secondary' : ''" v-for="(region, ind) in regions.data.data" class="bg-primary text-white " >
      <td class="text-sm  w-full  border-yellow-600 px-10 py-4 whitespace-nowrap">
        <input type="text" name="name" @change="saveRegion(region)" required v-model="region.name" class="bg-input focus:outline-none focus:ring focus:ring-indigo-600 w-1/5  shadow text-sm rounded-xl  border-none text-white"
               placeholder="Поиск">
      </td>
      <td class="text-sm border-yellow-600 px-10 py-4 whitespace-nowrap">
        <div class="flex w-full justify-end">
          <button type="button" @click="deleteRegion(region)"  class="bg-red-700  rounded-xl p-3.5 text-xs text-white font-bold hover:bg-red-800 hover:cursor-pointer focus:outline focus:outline-red-500">Удалить</button>
        </div>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script setup>
import store from "../../store";

const props = defineProps(['regions'])
const regions = props.regions

const emit = defineEmits(['region', 'currentPage'])

function sendEmit(region) {
  emit('region', region)
}

function saveRegion(region) {
  let action = "добавлен";
  if (region.id) {
    action = "изменен";
  }
  store.dispatch("saveRegion", { ...region }).then(({ data }) => {
    store.commit("notify", {
      type: "success",
      message: "Регион успешно " + action,
    });
  });
  close()
}

function deleteRegion(region) {
  if (
      confirm(
          `Вы действительно хотите удалить объект?`
      )
  ) {
    store.dispatch("deleteRegion", region.id).then(() => {
      emit('currentPage', 1)
      store.dispatch("getRegions", { page: 1})
    });
  }
}

</script>
