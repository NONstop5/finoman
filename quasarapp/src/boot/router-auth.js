import { LocalStorage } from 'quasar';

export default ({ router }) => {
  router.beforeEach((to, from, next) => {
    const loggedIn = LocalStorage.getItem('user.loggedIn');
    const guestRoutes = ['/login', '/registration'];

    if (!loggedIn && !guestRoutes.includes(to.path)) {
      next('/login');
    } else {
      next();
    }
  });
};
