import { LocalStorage } from 'quasar';

export default () => ({
  loggedIn: LocalStorage.getItem('user.loggedIn'),
  permissions: [],
  details: LocalStorage.getItem('user.details'),
  wallets: [],
  wallets_credit: [],
  wallets_debit: [],
  categories: [],
  category_profit: {},
  category_lose: {},
  token: LocalStorage.getItem('user.token'),
  transactions: {},
});
