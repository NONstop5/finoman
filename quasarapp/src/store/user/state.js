import { LocalStorage } from 'quasar';

export default () => ({
  loggedIn: LocalStorage.getItem('user.loggedIn'),
  permissions: [],
  details: LocalStorage.getItem('user.details'),
  wallets: [],
  categories: [],
  category_profit: {},
  category_lose: {},
  token: LocalStorage.getItem('user.token'),
  transactions: [],
});
