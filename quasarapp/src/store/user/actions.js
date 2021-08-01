import { api } from 'boot/axios';
import {
  Loading,
  LocalStorage,
} from 'quasar';
import {
  showErrorNotification,
  showSuccessNotification,
} from 'src/functions/function-show-notifications';
import { dataService } from '../api/dataservice';

function login({ commit }, payload) {
  Loading.show();

  api
    .post('/api/login',
      {
        email: payload.email,
        password: payload.password,
      },
      { headers: { 'Content-Type': 'application/json' } })
    .then((response) => {
      commit('setLoggedIn', true);
      commit('setDetails', response.data.user);
      commit('setToken', response.data.token);

      showSuccessNotification('You\'ve been authenticated!');
      this.$router.push('/index');
    })
    .catch(() => {
      showErrorNotification('You\'re not authenticated!');

      commit('setLoggedIn', false);
    })
    .catch(() => {
      showErrorNotification('Authentication couldn\'t take place!');
      this.$router.push('/login');
    });
}

function logout({ commit, state }) {
  Loading.show();

  api
    .post('/api/logout', {}, {
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${state.token}`,
      },
    })
    .then(() => {
      showSuccessNotification('You\'ve been logged out!');
    })
    .catch(() => {
      showErrorNotification('Session expired!');
    })
    .finally(() => {
      commit('setLoggedIn', false);
      commit('setDetails', {});
      commit('setToken', '');

      this.$router.replace('/login');
    });
}

function getState({ commit }) {
  const loggedIn = LocalStorage.getItem('user.loggedIn') || false;
  const details = LocalStorage.getItem('user.details') || {};
  const token = LocalStorage.getItem('user.token') || {};

  commit('setLoggedIn', loggedIn);
  commit('setDetails', details);
  commit('setToken', token);
}

function register({ commit }, payload) {
  Loading.show();

  api
    .post('/api/register', {
      name: payload.name,
      email: payload.email,
      password: payload.password,
      password_confirmation: payload.password_confirmation,
    }, { headers: { 'Content-Type': 'application/json' } })
    .then(() => {
      showSuccessNotification('You\'ve been registered!');
      this.$router.push('/login');
    })
    .catch(() => {
      showErrorNotification('Registration could\'t take place.');
      commit();
    });
}

async function addWalletAction({ commit }, wallet) {
  const addedWallet = await dataService.addWallet(wallet);
  commit('ADD_WALLET', addedWallet);
}

async function getWalletsAction({ commit }) {
  const wallets = await dataService.getWallets();
  commit('GET_WALLETS', wallets);
}

async function deleteWalletAction({ commit }, wallet) {
  const deletedWalletId = await dataService.deleteWallet(wallet);
  commit('DELETE_WALLET', deletedWalletId);
}

async function updateWalletAction({ commit }, wallet) {
  const updatedWallet = await dataService.updateWallet(wallet);
  commit('UPDATE_WALLET', updatedWallet);
}

async function getTransactionsAction({ commit }) {
  const transactions = await dataService.getTran();
  commit('GET_TRANSACTIONS', transactions);
}

export {
  login,
  logout,
  getState,
  register,
  getTransactionsAction,
  addWalletAction,
  getWalletsAction,
  deleteWalletAction,
  updateWalletAction,
};
