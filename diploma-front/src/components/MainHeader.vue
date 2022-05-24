<template>
  <div className="w-full bg-cover bg-center"
       style="height:100vh; background-image: url('https://r4.mt.ru/r27/photo1BE9/20861290917-0/jpg/bp.jpeg')">
    <MainNaviagation/>
    <div className="flex items-center h-full w-full bg-gray-900 bg-opacity-50">
      <div className="text-left flex-column ml-36">
        <h1 className="text-white text-2xl font-semibold  md:text-5xl">Поступи вместе с нами </h1>
        <h3 class="text-white text-lg font-semibold  md:text-lg">Ваше образование наша миссия</h3>
        <button
          className="mt-4 px-4 py-2 bg-blue-400 text-white text-sm  font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
          Пройти проф тест
        </button>
      </div>

    </div>
  </div>

  <div class="w-full h-screen flex flex-row">
    <div class="w-1/2 h-full items-center flex justify-end  ">
      <div class="w-3/4  pr-10 ">
        <img class="rounded-2xl " src="https://yt3.ggpht.com/a/AGF-l796X9vjsEEPCaJ4oLdkqslMH_jhfxpUe_Inpw=s900-c-k-c0xffffffff-no-rj-mo" alt="">
      </div>

    </div>
    <div class="w-1/2 h-full items-center flex ">
      <div class="w-10/12  pl-20 ">
        <h1 class="font-bold text-zinc-800 text-4xl">История компании</h1>
        <hr class="w-24 h-1 border-4 border-blue-500 mb-10 mt-3">
        <p class="text-lg text-zinc-800">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad at atque dolores doloribus, error ipsa iure
          maiores nulla numquam obcaecati officia perferendis perspiciatis possimus quas quo rerum sint voluptas. Lorem ipsum dolor sit amet,
          consectetur adipisicing elit. Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias beatae cumque cupiditate eligendi et explicabo facere id, itaque maiores quam quia quibusdam quis sunt temporibus ullam unde velit voluptas voluptatibus.
          Beatae cumque dolores eos fuga laboriosam obcaecati provident quis quos. consectetur adipisicing elit. Accusantium corporis excepturi facere iste minus necessitatibus reprehenderit sapiente sequi voluptatibus voluptatum. Adipisci aliquam aspernatur at commodi
          cum ea excepturi, expedita, ipsum magni maiores maxime modi nemo non perferendis quibusdam temporibus veniam. Ab ad beatae eaque et excepturi facilis, impedit in magni modi neque nisi obcaecati omnis perferendis possimus,
          praesentium provident similique? Adipisci alias assumenda consequuntur cum hic ipsa iste odit quisquam similique suscipit! </p>
      </div>
    </div>
  </div>
    <div class="w-full h-screen items-center flex bg-cover bg-center"
         style="height:100vh; background-image: url('https://www.oppl.org/wp-content/uploads/2020/04/Main-Library-3.jpg')">
      <div className="flex items-center h-full w-full bg-gray-900 bg-opacity-50">

        <div class="w-1/4 h-full flex items-end">
          <div class="w-1/4 h-full absolute hover:backdrop-blur-3xl hover:bg-white  hover:opacity-10 pl-16  flex items-end">
          </div>
          <div class="mb-10 pl-12">
            <h2 class=" mb-4 text-blue-400 text-3xl font-bold">01</h2>
            <h3 class="  mb-4 text-white text-3xl font-bold">Критерии рейтинга</h3>
            <p class=" mb-4 text-white ">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Atque commodi distinctio dolorem doloribus, error ipsum molestiae nulla possimus quasi soluta?</p>
          </div>
        </div>

        <div class="w-1/4 h-full   flex items-end">
          <div class="w-1/4 h-full absolute hover:backdrop-blur-3xl hover:bg-white  hover:opacity-10 pl-16  flex items-end">
          </div>

          <div class="mb-10 pl-12">
            <h2 class=" mb-4 text-blue-400 text-3xl font-bold ">02</h2>
            <h3 class="  mb-4 text-white text-3xl font-bold block">Методика</h3>
            <p class=" mb-4 text-white ">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Atque commodi distinctio dolorem doloribus, error ipsum molestiae nulla possimus quasi soluta?</p>
          </div>
        </div>
        <div class="w-1/4 h-full    flex items-end">
          <div class="w-1/4 h-full absolute hover:backdrop-blur-3xl hover:bg-white  hover:opacity-10 pl-16  flex items-end">
          </div>
          <div class="mb-10 pl-12">
            <h2 class=" mb-4 text-blue-400 text-3xl font-bold">03</h2>
            <h3 class="  mb-4 text-white text-3xl font-bold">Процесс оценки</h3>
            <p class=" mb-4 text-white ">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Atque commodi distinctio dolorem doloribus, error ipsum molestiae nulla possimus quasi soluta?</p>
          </div>
        </div>
        <div class="w-1/4 h-full flex items-end">
          <div class="w-1/4 h-full absolute hover:backdrop-blur-3xl hover:bg-white  hover:opacity-10 pl-16  flex items-end">
          </div>
          <div class="mb-10 pl-12">
            <h2 class=" mb-4 text-blue-400 text-3xl font-bold">04</h2>
            <h3 class="  mb-4 text-white text-3xl font-bold">Надежность</h3>
            <p class=" mb-4 text-white ">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Atque commodi distinctio dolorem doloribus, error ipsum molestiae nulla possimus quasi soluta?</p>
          </div>
        </div>
      </div>

    </div>


</template>

<script>
import Navigation from "./Navigation.vue";
import MainNaviagation from "./MainNaviagation.vue";
export default {
  name: "MainHeader",
  components:{MainNaviagation, Navigation},
  image:"./assets/bgimg.png"
}
</script>

<style scoped>

</style>