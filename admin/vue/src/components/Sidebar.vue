<template>
  <div class="relative flex flex-col items-center min-h-screen w-20 bg-secondary">

      <img src="../assets/logo.svg" alt="logo" class="w-6/12 my-12 animate-spin animate-spin-slow">

      <div class="w-full flex flex-col my-8">
        <div class="hover:bg-indigo-600 flex flex-col items-center hover:cursor-pointer w-full">
          <img src="../assets/admin.svg" alt="admin" class="my-3.5 w-5/12">
        </div>
        <div class="hover:bg-indigo-600 flex flex-col items-center hover:cursor-pointer w-full">
            <img src="../assets/uni.svg" alt="uni" class="my-3.5 w-5/12">
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: "Sidebar"
};
</script>