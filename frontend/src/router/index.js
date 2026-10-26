import { createRouter, createWebHistory } from "vue-router";

// Define routes
const routes = [
  {
    path: "/",
    name: "siswa.index",
    component: () =>
      import(
        /* webpackChunkName: "siswa.index" */
        "@/views/siswa/Index.vue"
      ),
  },
  {
    path: "/create",
    name: "siswa.create",
    component: () =>
      import(
        /* webpackChunkName: "siswa.create" */
        "@/views/siswa/Create.vue"
      ),
  },
  {
    path: "/edit/:id",
    name: "siswa.edit",
    component: () =>
      import(
        /* webpackChunkName: "siswa.edit" */
        "@/views/siswa/Edit.vue"
      ),
  },
];

// Create router
const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
