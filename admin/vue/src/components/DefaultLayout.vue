<template>
  <div class="bg-primary h-full flex flex-row">
    <Sidebar />
    <div class="flex flex-col w-full">
      <div class="flex flex-row justify-between w-full mt-10">
        <div class="mx-10 mt-3">
          <select @change="changeRoute($event)" v-model="$route.name" class="select select-ghost text-sm font-bold text-white bg-secondary border-none rounded-xl">
            <option :value="item.to.name"  v-for="item in navigation">
                {{ item.name }}
            </option>
          </select>
        </div>
        <div class="mx-3">
          <button class="bg-yellow-600 text-gray-900 hover:bg-yellow-700 font-bold py-3 px-7 rounded-2xl" @click="logout"> Выход </button>
        </div>
      </div>
      <router-view></router-view>
    </div>
    <Notification />
  </div>
</template>

<script>
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import { BellIcon, MenuIcon, XIcon } from "@heroicons/vue/outline";
import { useStore } from "vuex";
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
import { computed } from "vue";
import { useRouter } from "vue-router";
import Notification from "./Notification.vue";
import Sidebar from './Sidebar.vue';
import UniversityList from './university/UniversityList.vue';

const navigation = [
  { name: "Университеты", to: {name: "Universities"}},
  { name: "Регионы", to: {name: "Regions"}},
  { name: "Категории", to: {name: "Categories"}},
  { name: "Типы", to: {name: "Types"}},
  { name: "Языки", to: {name: "Languages"}},
  { name: "Программы", to: {name: "Programs"}}
];

export default {
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    BellIcon,
    MenuIcon,
    XIcon,
    Notification,
    Sidebar,
    ChevronLeftIcon,
    ChevronRightIcon,
    UniversityList
  },



  setup() {
    const store = useStore();
    const router = useRouter();

    function logout() {
      store.dispatch("logout").then(() => {
        router.push({
          name: "Login",
        });
      });
    }

    function changeRoute(a) {
      router.push({name: a.target.value});
    }

    return {
      user: computed(() => store.state.user.data),
      navigation,
      logout,
      changeRoute,
    };
  },
};
</script>
