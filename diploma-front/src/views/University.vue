<template>
  <div class="w-full">
    <div class="h-screen w-full bg-cover bg-center flex flex-col" v-bind:style='{ backgroundImage: `linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url(${university.data.banner})` }' >
      <HeaderHome />
      <div class="align-middle mx-auto text-white my-auto">
        <p class="font-bold text-4xl">{{ university.data.name }}</p>
        <p class="text-center font-semibold pt-3">{{ university.data.region.name }}</p>
      </div>
      <div class="mx-auto pb-5 animate-bounce hover:cursor-pointer">
        <a href="#info"><img src="../assets/arrow-down.svg" alt="arrow-down" ></a>
      </div>
    </div>

    <div id="history" class="min-h-screen">

      <div class="mx-auto w-11/12 m-8">
        <p class="font-bold text-xl">Об {{ university.data.name }}y</p>
      </div>

      <div class=" w-11/12 mx-auto flex flex-row justify-between">
<!--right-->
        <div class="w-5/12  p-5  shadow-lg rounded-2xl border-black">
          <img class="w-64   mx-auto" src="../assets/news.svg" alt="">
          <br>
          <p>{{university.data.description}}</p>
          <br>
          <div v-if="university.data.advantages">
            <p class="font-bold">Преимущества ВУЗа</p>
            <br>
            <p>{{ university.data.advantages }}</p>
          </div>
        </div>
<!--left top-->
        <div class="w-6/12 flex flex-col justify-between">

        <div class="w-full p-5 shadow-lg rounded-2xl border-black flex flex-col">
          <p class="font-bold ">Информация</p>

          <div class="flex flex-row m-2">
            <img class="h-6 mr-3" src="../assets/uni-phone-card.svg" alt="">
            <p>{{ university.data.phone_number }}</p>
          </div>

          <div class="flex flex-row m-2">
            <img class="h-6 mr-3" src="../assets/uni-location-card.svg" alt="">
            <p>{{ university.data.region.name }}
            </p>
          </div>

          <div class="flex flex-row m-2">
            <img class="h-6 mr-3" src="../assets/email.svg" alt="">
            <p>{{ university.data.email }}</p>
          </div>

          <div class="flex flex-row m-2">
            <img class="h-6 mr-3" src="../assets/uni-site-card.svg" alt="">
            <p>{{ university.data.website}}</p>
          </div>

          <div class="flex flex-row m-2">
            <img class="h-6 mr-3" src="../assets/uni-insta-card.svg" alt="">
            <p>@{{university.data.instagram}}</p>
          </div>

          <div class="flex flex-row m-2">
            <img class="h-6 mr-3" src="../assets/uni-phone-card.svg" alt="">
            <p>     от 500.000 тг</p>
          </div>
        </div>

          <div class="w-full p-5 shadow-lg rounded-2xl border-black flex flex-col">

            <div class="flex flex-row m-2">
              <p class="font-bold w-1/3">Год основания :</p>
              <p>{{ university.data.opened }} год</p>
            </div>

            <div class="flex flex-row m-2">
              <p class="font-bold w-1/3">Код ВУЗа :</p>
              <p>{{ university.data.code }}</p>
            </div>

            <div class="flex flex-row m-2">
              <p class="font-bold w-1/3">Тип ВУЗа :</p>
              <p>{{ university.data.type.name }} </p>
            </div>

          </div>

        </div>


      </div>
      <div class="w-11/12 mx-auto m-6">
        <p class="font-bold text-lg">Дополнительная информация</p>
        <hr>
      </div>


      <div v-if="university.data.dorm" class="w-11/12 mx-auto p-5 text-sm shadow-lg rounded-2xl">
        <p class="font-bold text-xl">Наличие Общежития</p>
        <p>{{university.data.dorm}}</p>
      </div>

      <div v-if="university.data.military" class="w-11/12 mx-auto p-5 text-sm shadow-lg rounded-2xl">
        <p class="font-bold text-xl">Наличие Военной кафедры</p>
        <p>{{university.data.military}}</p>
      </div>

      <div class="w-11/12 mx-auto m-6">
        <p class="font-bold text-lg">Срок поступления</p>
        <hr>
      </div>

      <div class="w-11/12 mx-auto p-5 text-sm shadow-lg rounded-2xl">
        <p class="font-bold text-xl">Перечень документов для поступления</p>
        <p class="font-bold">Для поступающих на бакалавриат:</p>
        <span>
          1)	Заявление на бланке установленного образца (выдает приемная комиссия)
          2)	Оригинал документ об образовании (аттестат/диплом) с приложением + 2 копии,
          3)	Сертификат ЕНТ текущего года (для проверки в базе необходимо иметь ИКТ и ИИН). Примечание: для участия в конкурсе на получение образовательного гранта дата сертификата 16 мая – 5 июля
          4)	6 фотографий 3х4,
          5)	Мед. Справка 075,
          6)	Снимок флюорографии (оригинал),
          7)	Копия регистрации приписного свидетельства (юношам),
          8)	Удостоверение личности (3 копии),
          9)	Копия справки об инвалидности (при наличии).
        </span>

        <p class="font-bold">Для поступающих в магистратуру:</p>
        <div class="whitespace-pre-wrap">
          1) заявление на имя ректора по форме;
          2) документ о высшем образовании (подлинник);
          3) документ, удостоверяющий личность (требуется для идентификации личности);
          4) шесть фотографий размером 3x4 сантиметра;
          5) медицинскую справку по форме 075/у в электронном формате, утвержденную приказом № ҚР ДСМ-175/2020;
          6) сертификат, подтверждающий владение иностранным языком (при его наличии);
          7) документ, подтверждающий трудовую деятельность (для лиц, имеющих трудовой стаж);
          8) список научных и научно-методических работ (в случае их наличия).

        </div>
        <span class="whitespace-pre-line">
          1) заявление на имя ректора по форме;
          2) документ о высшем образовании (подлинник);
          3) документ, удостоверяющий личность (требуется для идентификации личности);
          4) шесть фотографий размером 3x4 сантиметра;
          5) медицинскую справку по форме 075/у в электронном формате, утвержденную приказом № ҚР ДСМ-175/2020;
          6) сертификат, подтверждающий владение иностранным языком (при его наличии);
          7) документ, подтверждающий трудовую деятельность (для лиц, имеющих трудовой стаж);
          8) список научных и научно-методических работ (в случае их наличия).
        </span>

        <p class="font-bold">Для поступающих в докторантуру:</p>
        <span>
          1) заявление в произвольной форме;
          2) документ об образовании (подлинник, при подаче документов в приемную комиссию);
          3) документ удостоверяющий личность (требуется для идентификации личности);
          4) официальный сертификат о сдаче экзамена по государственному языку (КАЗТЕСТ), выданный НЦТ;
          5) сертификат, подтверждающий владение иностранным языком;
          6) медицинскую справку по форме 075/у в электронном формате, утвержденную приказом № ҚР ДСМ-175/2020);
          7) шесть фотографий размером 3x4 сантиметра;
          8) личный листок по учету кадров или иной документ, подтверждающий трудовую деятельность, заверенный кадровой службой по месту работы;
          9) список научных публикаций за последние 3 календарных года, обоснование исследования.

        </span>
      </div>
      <div class="w-11/12 mx-auto m-6">
        <p class="font-bold text-lg">Условия поступления</p>
        <hr>
      </div>

    </div>







    <div class="flex flex-col mt-10">
      <div class="flex flex-row justify-between px-5">
        <div><p class="font-medium text-xl">Образовательные программы ({{ university.data.specialities.length }})</p></div>
        <div><img class="w-8 my-auto" src="../assets/arrow-down-black.svg" alt="arrow"></div>
      </div>
      <br>
      <hr>
      <br>


<!--      SPECIALITIES-->
      <div class="grid grid-cols-2 gap-4 px-5">
        <div v-for="speciality in university.data.specialities" class="border border-gray-300 mb-3 rounded-lg flex flex-col px-8">
          <div class="w-full pt-5">
            <p class="font-semibold text-xl">{{ speciality.code }} <span class="pl-3">{{ speciality.name }}</span></p>
          </div>
          <div class="w-full flex flex-col py-5">
            <div class="inline-flex ">
              <img src="../assets/type.svg" alt="language" class="w-4">
              <p class="text-sm pl-4 ">{{ speciality.program.degree.name }}</p>
            </div>
            <div class="inline-flex pt-2">
              <img src="../assets/ep.svg" alt="language" class="w-4">
              <p class="text-sm pl-4 ">{{ speciality.program.name }}</p>
            </div>
          </div>


          <div class="flex w-full flex-row pb-5 justify-between">
            <div class="w-8/12">
              <p class="text-sm">{{ speciality.description }}</p>
            </div>
            <div>
              <a v-bind:href="'/speciality/' + speciality.id"><button class="focus:outline-blue-900 bg-blue-500 hover:bg-blue-600 py-2.5 px-11 rounded-lg text-sm text-white">Подробнее</button></a>
            </div>
          </div>
        </div>
      </div>

    </div>
    <br>
    <Footer />

  </div>
</template>

<script setup>
import HeaderHome from '../components/HeaderHome.vue';
import Footer from "../components/Footer.vue";
import router from "../router";
import {useRoute} from "vue-router";
import {computed} from "vue";
import store from "../store";

const id = useRoute().params.id

const university = computed(() => store.state.university);

store.dispatch("getUniversity", { id: id})

</script>

<style scoped>

</style>