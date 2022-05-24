<template>
  <Navigation/>
  <SpecPage />
  <Footer/>
</template>

<script>
import Navigation from "./components/Navigation.vue";
import SpecPage from "./components/SpecPage.vue";
import Footer from "./components/Footer.vue";

export default {
  name: "SpecialitiesPage",
  components: {SpecPage,Navigation,Footer}
}
</script>

<style scoped>

</style>