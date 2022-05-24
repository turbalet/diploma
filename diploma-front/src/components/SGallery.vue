<template>
  <div class="flex flex-row justify-between">
    <div class="w-96 bg-green-500 h-full items-center static">
      <div class="justify-center">
        <h4>Профильные предметы</h4>

      </div>

    </div>
    <div class="flex flex-col">
      <SpecCard/>
      <SpecCard/>
      <SpecCard/>
      <SpecCard/>
      <SpecCard/>
    </div>
  </div>



</template>

<script>
import SpecCard from "./SpecCard.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/solid'

export default {
  name: "Gallery",
  components: { SpecCard },

}
</script>

<style scoped>
</style>