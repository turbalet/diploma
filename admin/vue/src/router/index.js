import { createRouter, createWebHistory } from "vue-router";
import Surveys from "../views/Surveys.vue";
import SurveyView from "../views/SurveyView.vue";
import Login from "../views/Login.vue";
import NotFound from "../views/NotFound.vue";
import SurveyPublicView from "../views/SurveyPublicView.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store";
import Universities from "../components/university/Universities.vue";
import University from "../components/university/University.vue";
import Regions from "../components/region/Regions.vue";
import Categories from "../components/category/Categories.vue";
import Types from "../components/type/Types.vue";
import Languages from "../components/language/Languages.vue";
import Programs from "../components/program/Programs.vue";


const routes = [
  {
    path: "/",
    redirect: "/dashboard/universities",
    name: "Dashboard",
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [
      { path: "/dashboard/universities", name: "Universities", component: Universities},
      { path: "/dashboard/university/:id", name: "University", component: University},
      { path: "/dashboard/regions", name: "Regions", component: Regions},
      { path: "/dashboard/categories", name: "Categories", component: Categories},
      { path: "/dashboard/types", name: "Types", component: Types},
      { path: "/dashboard/languages", name: "Languages", component: Languages},
      { path: "/dashboard/programs", name:"Programs", component: Programs },
      { path: "/dashboard", name: "Dashboard1", redirect: "/dashboard/universities" },
      { path: "/surveys", name: "Surveys", component: Surveys },
      { path: "/surveys/create", name: "SurveyCreate", component: SurveyView },
      { path: "/surveys/:id", name: "SurveyView", component: SurveyView },
    ],
  },
  {
    path: "/view/survey/:slug",
    name: 'SurveyPublicView',
    component: SurveyPublicView
  },
  {
    path: "/:pathMatch(.*)*",
    name: "NotFound",
    component: NotFound
  },
  {
    path: "/auth",
    redirect: "/login",
    name: "Auth",
    component: AuthLayout,
    meta: {isGuest: true},
    children: [
      {
        path: "/login",
        name: "Login",
        component: Login,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.meta.isGuest) {
    next({ name: "Dashboard" });
  } else {
    next();
  }
});

export default router;
