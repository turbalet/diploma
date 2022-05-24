<template>
  <div class="flex flex-wrap max-w-full px-10 justify-center">
    <div class="w-10/12 flex flex-wrap justify-around ">
      <UniCard/>
      <UniCard/>
      <UniCard/><UniCard/><UniCard/><UniCard/><UniCard/><UniCard/><UniCard/>
      <UniCard/>
    </div>

  </div>

</template>

<script>
import UniCard from "./UniCard.vue";
export default {
  name: "UGallery",
  components: {UniCard}
}
</script>

<style scoped>

</style>