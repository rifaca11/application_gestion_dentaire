import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'


const routes = [
  {
    path: '/',
    name: 'HomeView',
    component: HomeView
  },
  {
    path: '/AboutView',
    name: 'AboutView',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
      path: "/RendezV",
      name: "RendezV",
      /* beforeEnter: (to, from, next) => {
                  if (sessionStorage.getItem("userId") === null) {
                      next({
                          path: "/SignAccount",
                      });
                  } else {
                      next();
                  }
              }, */
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () =>
          import ( /* webpackChunkName: "Booking" */ "../views/RendezV.vue"),
  },
  {
      path: "/SignAccount",
      name: "SignAccount",
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () =>
          import ( /* webpackChunkName: "SignAccount" */ "../views/SignAccount.vue"),
  },
];


const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router;
