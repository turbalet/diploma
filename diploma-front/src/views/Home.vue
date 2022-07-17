<template>
  <div class="w-full">
    <div class="h-screen w-full bg-cover bg-center flex flex-col" style="background-image: url(src/assets/home-bg.svg)">
      <Header/>
      <div class="align-middle px-10 text-white my-auto">
        <p class="font-bold text-5xl">Поступи вместе с нами</p>
        <p class="text-xl my-7">Ваше образование - наша миссия</p>
        <button class="rounded-xl bg-blue-500 py-3 px-9 "><a href="#history">Продолжить</a></button>
      </div>
    </div>
    <!-- HISTORY -->
    <div class="h-screen w-full flex" id="history">
      <div class="mx-auto my-auto flex flex-row w-4/5">
        <div class="my-auto">
          <img src="../assets/history.svg" class="md:block md:w-5/5 hidden" alt="history img">
        </div>
        <div class="flex flex-col w-4/5 pl-10">
          <div class="pt-8">
            <p class="font-medium text-2xl">История компании</p>
            <div class="w-12 h-1 bg-blue-500"></div>
          </div>
          <div class="pt-5">
            <p>Национальная палата предпринимателей РК «Атамекен» — это некоммерческая организация. Создана для усиления переговорной силы бизнеса с Правительством РК и государственными органами.

              Палата предпринимателей представляет интересы малого, среднего и крупного бизнеса, охватывая своей деятельностью все сферы предпринимательства, включая внутреннюю и внешнюю торговлю. Главная задача «Атамекена» – защита прав и интересов бизнеса и обеспечение широкого охвата и вовлеченности всех предпринимателей в процесс формирования законодательных и иных нормативных правил работы бизнеса.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- CRITERIA -->
    <div class="h-screen w-full flex flex-row" style="background-image: url(src/assets/criteria-bg.svg);
  background-attachment: fixed;
  background-position: center;">
      <div class="h-full w-2/6 py-10 flex flex-col text-white px-10 justify-end hover:backdrop-blur hover:cursor-pointer group">
        <p class="text-blue-500 font-bold text-2xl">01</p>
        <p class="font-bold text-2xl py-5">Критерии рейтинга</p>
        <p class="text-l py-5 hidden group-hover:block">Это текст о компании. Он необходим для
          дальнейшего продвижения Вашего сайта Это текст о компании. Он необходим для
          дальнейшего продвижения Вашего сайта</p>
        <img src="../assets/criteria-arrow.svg" alt="arrow" class="w-8">
      </div>
      <div class="h-full w-2/6 py-10 flex flex-col text-white px-10 justify-end hover:backdrop-blur hover:cursor-pointer group">
        <p class="text-blue-500 font-bold text-2xl">02</p>
        <p class="font-bold text-2xl py-5">Методика</p>
        <p class="text-l py-5 hidden group-hover:block">Это текст о компании. Он необходим для
          дальнейшего продвижения Вашего сайта Это текст о компании. Он необходим для
          дальнейшего продвижения Вашего сайта</p>
        <img src="../assets/criteria-arrow.svg" alt="arrow" class="w-8">
      </div>
      <div class="h-full w-2/6 py-10 flex flex-col text-white px-10 justify-end hover:backdrop-blur hover:cursor-pointer group  ">
        <p class="text-blue-500 font-bold text-2xl">03</p>
        <p class="font-bold text-2xl py-5">Процесс оценки</p>
        <p class="text-l py-5 hidden group-hover:block">Это текст о компании. Он необходим для
          дальнейшего продвижения Вашего сайта Это текст о компании. Он необходим для
          дальнейшего продвижения Вашего сайта</p>
        <img src="../assets/criteria-arrow.svg" alt="arrow" class="w-8">
      </div>
    </div>
    <!-- NEWS -->
<!--    <div class="h-screen w-full flex flex-col p-10">-->
<!--      <div class="">-->
<!--        <p class="font-medium text-2xl">Новости</p>-->
<!--        <div class="w-7 h-1 bg-blue-500"></div>-->
<!--      </div>-->
<!--      <div class="grid grid-cols-2 w-full gap-y-20 pt-10">-->
<!--        <div class="flex flex-row">-->
<!--          <img src="../assets/news.svg" class="w-2/6" alt="news">-->
<!--          <div class="px-5 flex flex-col justify-between">-->
<!--            <div>-->
<!--              <p class="font-medium text-xl">Вышли результаты грантов 2022</p>-->
<!--              <p class="pt-5">Результаты грантов</p>-->
<!--            </div>-->
<!--            <p class="pt-5">26.03.22</p>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="flex flex-row">-->
<!--          <img src="../assets/news.svg" class="w-2/6" alt="news">-->
<!--          <div class="px-5 flex flex-col justify-between">-->
<!--            <div>-->
<!--              <p class="font-medium text-xl">Вышли результаты грантов 2022</p>-->
<!--              <p class="pt-5">Результаты грантов</p>-->
<!--            </div>-->
<!--            <p class="pt-5">26.03.22</p>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="flex flex-row">-->
<!--          <img src="../assets/news.svg" class="w-2/6" alt="news">-->
<!--          <div class="px-5 flex flex-col justify-between">-->
<!--            <div>-->
<!--              <p class="font-medium text-xl">Вышли результаты грантов 2022</p>-->
<!--              <p class="pt-5">Результаты грантов</p>-->
<!--            </div>-->
<!--            <p class="pt-5">26.03.22</p>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="flex flex-row">-->
<!--          <img src="../assets/news.svg" class="w-2/6" alt="news">-->
<!--          <div class="px-5 flex flex-col justify-between">-->
<!--            <div>-->
<!--              <p class="font-medium text-xl">Вышли результаты грантов 2022</p>-->
<!--              <p class="pt-5">Результаты грантов</p>-->
<!--            </div>-->
<!--            <p class="pt-5">26.03.22</p>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="w-full flex pt-10">-->
<!--        <button class="bg-blue-500 py-2 px-8 text-white rounded-xl mx-auto">Больше новостей</button>-->
<!--      </div>-->
<!--    </div>-->

    <!-- TEAM -->
    <div class=" w-full flex flex-col mt-10  pl-10">
      <div class="">
        <p class="font-medium text-2xl">Наша команда</p>
        <div class="w-7 h-1 bg-blue-500"></div>
      </div>
      <div class="flex h-full flex-row pt-10 mx-auto">
        <div class="w-1/3 flex flex-col">
          <img src="../assets/employee.svg" class="w-3/5" alt="employee">
          <div>
            <p class="font-semibold text-xl">Ахметов Ахмет Ахметович</p>
            <p class="py-3">Project Manager</p>
          </div>
        </div>
        <div class="w-1/3 flex flex-col">
          <img src="../assets/employee.svg" class="w-3/5" alt="employee">
          <div>
            <p class="font-semibold text-xl">Ахметов Ахмет Ахметович</p>
            <p class="py-3">Project Manager</p>
          </div>
        </div>
        <div class="w-1/3 flex flex-col">
          <img src="../assets/employee.svg" class="w-3/5" alt="employee">
          <div>
            <p class="font-semibold text-xl">Ахметов Ахмет Ахметович</p>
            <p class="py-3">Project Manager</p>
          </div>
        </div>

      </div>

    </div>

    <!-- CONTACTS -->
    <div class="py-5 w-full flex flex-col px-10">
      <div class="">
        <p class="font-medium text-2xl">Контакты</p>
        <div class="w-7 h-1 bg-blue-500"></div>
      </div>
      <div class="flex flex-row pt-10">
        <div class="flex flex-col w-1/3">
          <p class="font-semibold">Адрес:</p>
          <div class="inline-flex pt-3">
            <img src="../assets/address.svg" alt="address">
            <p class="px-2">РК, г. Нур-Султан 010000,
              ул. Здесь будет улица 24, </p>
          </div>
        </div>
        <div class="flex flex-col w-1/3 border-r border-l  px-5">
          <p class="font-semibold">Телефон:</p>
          <div class="inline-flex pt-3">
            <img src="../assets/phone.svg" alt="address">
            <p class="px-2">+ 7 (777) 777-77-77</p>
          </div>
        </div>
        <div class="flex flex-col w-1/3 px-5">
          <p class="font-semibold">Email:</p>
          <div class="inline-flex pt-3">
            <img src="../assets/email.svg" alt="address">
            <p class="px-2">info@example-mail.kz</p>
          </div>
        </div>
      </div>
    </div>

    <Footer class="mt-10"/>
  </div>
</template>

<script setup>
import Header from '../components/HeaderHome.vue'
import Footer from "../components/Footer.vue"

</script>

<style scoped>

</style>