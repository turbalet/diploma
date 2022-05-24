<template>
  <Navigation/>
  <UniPage />
  <Footer/>
</template>

<script>
import Navigation from "./components/Navigation.vue";
import UniPage from "./components/UniPage.vue";
import Footer from "./components/Footer.vue";

export default {
  name: "UniversitiesPage",
  components:{Navigation,UniPage,Footer}
}
</script>

<style scoped>
</style>