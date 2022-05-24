<template>
  <div class="bg-white">
    <div class="pt-6">
      <!-- Image gallery -->
      <div class="mt-6  mx-auto sm:px-6 lg:max-w-7xl flex flex-row">
        <div class=" w-1/2  rounded-l-lg overflow-hidden ">
          <img src="../assets/aitu.jpeg" alt="" class="w-full h-full object-center object-cover">
        </div>

        <div class="w-1/2  rounded-r-lg  p-3 ">
          <h3 class="font-bold text-xl text-center w-full">Университет имени Зухрап Жогалбаевной</h3>
          <p class="text-lg p-2">      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquam ducimus eligendi esse, eveniet
            hic illo iusto labore laudantium molestias
            omnis optio pariatur perferendis praesentium sapiente soluta tenetur voluptas voluptatum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, excepturi. </p>


        </div>

      </div>


      <!-- Product info -->
      <div class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
          <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Astana IT University</h1>
        </div>

        <!-- Options -->
        <div class="mt-4 lg:mt-0 lg:row-span-3">
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">Основная информация</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
            </div>
            <div class="border-t border-gray-200">
              <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Полное название</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">ТОО "Astana IT University"</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Категория</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Университет</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Тип</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Государственный</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Профиль</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Информационные технологии</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Студенческий дом</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Есть</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Адрес</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">г.Нур-Султан Мангилик Ел С1</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Вебсайт</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Информационные технологии</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Телефон</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">+7 (7172) 64‒57‒10</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Инстаграм</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><a href="">@astana.it.univesity</a></dd>
                </div>



              </dl>
            </div>
          </div>

        </div>

        <div class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
          <!-- Description and details -->
          <div>
            <h3 class="sr-only">Description</h3>

            <div class="space-y-6">
              <p class="text-base text-gray-900">The Basic Tee 6-Pack allows you to fully express your vibrant personality with three grayscale options. Feeling adventurous? Put on a heather gray tee. Want to be a trendsetter? Try our exclusive colorway: &quot;Black&quot;. Need to add an extra pop of color to your outfit? Our white tee has you covered.</p>
            </div>
          </div>

          <!-- dropdown-->
            <div class="dropdown w-full  inline-block relative :hover block mt-3">
              <button class="bg-gray-200 w-full text-gray-700 font-semibold py-2 px-4 rounded inline-flex " v-on:click="$event">
                <span class=" mr-1"> Доступные образовательные прораммы</span>
              </button>
              <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 w-full">
                <li class=""><a class="border-l-2 border-l-gray-700 hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap" href="#">Прграмная инженирия</a></li>
                <li class=""><a class="border-l-2 border-l-gray-700 hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap" href="#">Компьютерные науки</a></li>
                <li class=""><a class="border-l-2 border-l-gray-700 hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap" href="#">IT Менеджментr</a></li>
                <li class=""><a class="border-l-2 border-l-gray-700 hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap" href="#">Медиа технологии</a></li>
                <li class=""><a class="border-l-2 border-l-gray-700 hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap" href="#">Цифровой журнализм</a></li>
                <li class=""><a class="border-l-2 border-l-gray-700 hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap" href="#">Телокоммуникационные системы</a></li>
              </ul>
            </div>



        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "UniPage"
}
</script>

<style scoped>
.dropdown:hover .dropdown-menu {
  display: block;
}.dropdown:after .dropdown-menu {
   display: block;
 }


</style>