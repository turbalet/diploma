<template>
  <nav class="w-full max-h-16 flex flex-row justify-between">
      <div class="flex flex-row justify-between w-full px-28">
        <!--Logo -->
        <div class=" text-2xl font-bold black flex space-x-0  m-2 p-2 ">
          <a href="" class="block">LOGO</a>
        </div>
        <!--Navigation buttons -->
        <div class="flex flex-row items-end right-0 ">

          <!--
          <div class="flex space-x-0 space-x-2 m-2 p-2">
            <NavButton v-bind:navs="navs"/>
          </div>
          <div class="flex space-x-0 space-x-2 m-2 p-2">
            <NavButton/>
          </div>
          <div class="flex space-x-0 space-x-2 m-2 p-2">
            <NavButton/>
          </div>
          <div class="flex space-x-0 space-x-2 m-2 p-2">
            <NavButton/>
          </div>
          <div class="flex space-x-0 space-x-2 m-2 p-2">
            <NavButton/>
          </div>-->

          <div class="flex space-x-0 m-2 p-2">
            <a  class=" text-white  text-zinc-800 hover:bg-blue-400 text-white px-3 py-2 rounded-md text-sm font-medium text-transform: uppercase
">о нас</a>
          </div>
          <div class="flex space-x-0 space-x-2 m-2 p-2 ">
            <a  class=" text-white text-zinc-800 hover: hover:bg-blue-400 text-white px-3 py-2 rounded-md text-sm font-medium text-transform: uppercase">Рейтинг</a>
          </div>
          <div class="flex space-x-0 space-x-2 m-2 p-2">
          <a  class=" text-white text-zinc-800 hover: hover:bg-blue-400 text-white px-3 py-2 rounded-md text-sm font-medium text-transform: uppercase">вузы</a>
        </div>
          <div class="flex space-x-0 space-x-2 m-2 p-2">
          <a  class=" text-white text-zinc-800 hover: hover:bg-blue-400 text-white px-3 py-2 rounded-md text-sm font-medium text-transform: uppercase">специальности</a>
        </div>
          <div class="flex space-x-0 space-x-2 m-2 p-2">
            <a  class=" text-white text-zinc-800 hover: hover:bg-blue-400 text-white px-3 py-2 rounded-md text-sm font-medium text-transform: uppercase">новости</a>
          </div>

          <div class="flex flex-row justify-between ">
            <div  class="flex space-x-0 space-x-2 m-2 p-2">
              <input type="search" class="form-control
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
        " placeholder="Искать...">
            </div>
            <div class="flex space-x-0 space-x-2 m-2 p-2">
              <a  class=" hover: hover:text-white px-3 py-2 rounded-md text-sm font-medium underline text-transform: uppercase">RUS</a>
            </div>

          </div>
        </div>
      </div>
  </nav>
</template>

<script>
import NavButton from "./NavButton.vue";
export default {
  data(){
    return{
      navs:[
        {title:'О НАС'},
        {title:'РЕЙТИНГ'},
        {title:'ВУЗЫ'},
        {title:'СПЕЦИАЛЬНОСТЬ'},
        {title:'НОВОСТИ'},
      ]

    }
  },
  name: "Navigation",
}
</script>

<style scoped>

</style>