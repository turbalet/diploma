<template>
  <div
    v-if="notification.show"
    class="fixed w-[300px] left-4 bottom-4 py-2 px-4 rounded-xl text-white animate-fade-in-down"
    :class="[notification.type === 'success' ? 'bg-emerald-500' : 'bg-red-500']"
  >
    {{ notification.message }}
  </div>
</template>

<script setup>
import { computed } from "vue";
import store from "../store";

const notification = computed(() => store.state.notification);
</script>

<style></style>
