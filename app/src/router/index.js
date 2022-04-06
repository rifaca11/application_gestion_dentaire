import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AboutViewComp from "../views/AboutView.vue";
import RendezVous from "../views/RendezVous.vue";
import ListRDV from "../views/ListRDV.vue";
import SignAccount from "../views/SignAccount.vue";

const routes = [{
        path: "/",
        name: "HomeView",
        component: HomeView
    },
    {
        path: "/AboutView",
        name: "AboutView",
        component: AboutViewComp

    },
    {
        path: "/RendezVous",
        name: "RendezVous",
        component: RendezVous

    },
    {
        path: "/ListRDV",
        name: "ListRDV",
        component: ListRDV

    },
    {
        path: "/SignAccount",
        name: "SignAccount",
        component: SignAccount
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router