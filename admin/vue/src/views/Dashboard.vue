<template>
  <div>
    <h1>hello</h1>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useStore } from "vuex";

const store = useStore();

const data = computed(() => store.state.dashboard.data);

// store.dispatch("getDashboardData");
</script>

<style scoped></style>
