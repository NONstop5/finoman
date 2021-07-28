const routes = [
  {
    path: '/',
    component: () => import('layouts/FormLayout'),
    children: [
      { path: '/', component: () => import('pages/Main.vue') },
      { path: '/index', component: () => import('pages/Index.vue') },
      { path: '/login', component: () => import('pages/Login.vue') },
      { path: '/registration', component: () => import('pages/Registration.vue') },
      { path: '/transaction', component: () => import('pages/Transaction') },
      { path: '/history', component: () => import('pages/Histrory.vue') },
      { path: '/category', component: () => import('pages/Category.vue') },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue'),
  },
];

export default routes;
