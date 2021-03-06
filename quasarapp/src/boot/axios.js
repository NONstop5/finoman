import { boot } from 'quasar/wrappers';
import axios from 'axios';
import { LocalStorage } from 'quasar';
import { showErrorNotification } from 'src/functions/function-show-notifications';

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)

axios.defaults.headers.common.authorization = `Bearer ${LocalStorage.getItem('user.token')}`;
axios.defaults.baseURL = process.env.API_BASE_URL;

const api = axios.create({ baseURL: process.env.API_BASE_URL });
api.interceptors.request.use((config) => {
  const token = LocalStorage.getItem('user.token');
  if (token) {
    config.headers.credentials = 'include';
    config.headers.authorization = `Bearer ${token}`;
    config.headers['Access-Control-Allow-Origin'] = '*';
    config.headers['Content-Type'] = 'application/json';
  }

  return config;
}, (error) => {
  showErrorNotification('interceptor request has error');
  return Promise.reject(error);
});

export default boot(({ app }) => {
  // for use inside Vue files (Options API) through this.$axios and this.$api
  app.config.globalProperties.$axios = axios;
  // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
  //       so you won't necessarily have to import axios in each vue file

  app.config.globalProperties.$api = api;
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API
});

export { axios, api };
