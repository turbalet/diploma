import { createRouter, createWebHistory } from "vue-router";
import Universities from "../views/Universities.vue";
import Home from "../views/Home.vue";
import Specialities from "../views/Specialities.vue";
import University from "../views/University.vue";
import Speciality from "../views/Speciality.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/universities",
        name: 'Universities',
        component: Universities
    },
    {
        path: "/specialities",
        name: 'Specialities',
        component: Specialities
    },
    {
        path: "/university/:id",
        name: 'University',
        component: University
    },
    {
        path: "/speciality/:id",
        name: 'Speciality',
        component: Speciality
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
