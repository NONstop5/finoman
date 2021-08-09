const routes = [
  {
    path: '/',
    component: () => import('layouts/FormLayout'),
    children: [
      { path: '/', component: () => import('pages/Main.vue') },
      { path: '/hello', component: () => import('pages/hello.vue') },
      { path: '/index', component: () => import('pages/Index.vue') },
      { path: '/login', component: () => import('pages/Login.vue') },
      { path: '/register', component: () => import('pages/Register.vue') },
      { path: '/wallets', component: () => import('pages/Wallets') },
      { path: '/categories', component: () => import('pages/Categories.vue') },
      { path: '/history', component: () => import('pages/History.vue') },
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
