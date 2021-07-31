import { LocalStorage } from 'quasar';

export default () => ({
  loggedIn: LocalStorage.getItem('user.loggedIn'),
  permissions: [],
  details: {},
  wallets: [],
  category_profit: {},
  category_lose: {},
  token: '',
  transactions: [],
});
