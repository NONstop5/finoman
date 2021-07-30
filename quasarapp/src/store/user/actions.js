import axios from 'axios';
import { Loading, LocalStorage } from 'quasar';
import {
  showErrorNotification,
  showSuccessNotification,
} from 'src/functions/function-show-notifications';
import { dataService } from '../api/data.service';
import { GET_WALLETS, ADD_WALLET, DELETE_WALLET, UPDATE_WALLET } from './mutations';

function login({ commit }, payload) {
  Loading.show();

  axios
    .get('/sanctum/csrf-cookie')
    .then(() => {
      axios
        .post('/api/login', {
          email: payload.email,
          password: payload.password,
        }, { headers: { 'Content-Type': 'application/json' } })
        .then(() => {
          commit('setLoggedIn', true);

          axios
            .get('/api/user')
            .then((response) => {
              commit('setDetails', response.data);

              showSuccessNotification("You've been authenticated!");
              this.$router.push('/index');
            })
            .catch(() => {
              showErrorNotification("You're not authenticated!");

              commit('setLoggedIn', false);
            });
        })
        .catch(() => {
          showErrorNotification("Authentication couldn't take place!");
          this.$router.push('/login');
        });
    })
    .catch(() => {
      showErrorNotification("Authentication couldn't take place!");
    });
}

function logout({ commit }) {
  const reset = () => {
    commit('setLoggedIn', false);
    this.$router.replace('/login');
  };

  Loading.show();

  axios
    .post('/api/logout')
    .then(() => {
      localStorage.removeItem('user.details');
      showSuccessNotification("You've been logged out!");
      reset();
    })
    .catch(() => {
      showErrorNotification('Session expired!');
      reset();
    });
}

function getState({ commit }) {
  const loggedIn = LocalStorage.getItem('user.loggedIn') || false;
  const details = LocalStorage.getItem('user.details') || {};

  commit('setLoggedIn', loggedIn);
  commit('setDetails', details);
}
function register({ commit }, payload) {
  Loading.show();
  axios
    .get('/sanctum/csrf-cookie')
    .then(() => {
      axios
        .post('/api/register', {
          name: payload.name,
          email: payload.email,
          password: payload.password,
          password_confirmation: payload.password_confirmation,
        }, { headers: { 'Content-Type': 'application/json' } })
        .then(() => {
          showSuccessNotification("You've been registered!");
          this.$router.push('/login');
        })
        .catch(() => {
          showErrorNotification("Registration could't take place.");
          commit();
        });
    })
    .catch(() => {
      showErrorNotification("Registration couldn't take place!");
    });
}
// function GET_WALLET({ commit }) {
//   axios
//     .get('/api/accounts', {
//       user_id: state.details.user_id,
//     })
// }
async function addWalletAction({ commit }, wallet) {
  const addedWallet = await dataService.addWallet(wallet);
  commit(ADD_WALLET, addedWallet);
}
async function getWalletsAction({ commit }) {
  const wallets = await dataService.getWallets();
  commit(GET_WALLETS, wallets);
}
async function deleteWalletAction({ commit }, wallet) {
  const deletedWalletId = await dataService.deleteWallet(wallet);
  commit(DELETE_WALLET, deletedWalletId);
}
async function updateWalletAction({ commit }, wallet) {
  const updatedWallet = await dataService.updateWallet(wallet);
  commit(UPDATE_WALLET, updatedWallet);
}
export {
  login, logout, getState, register, addWalletAction, getWalletsAction, deleteWalletAction, updateWalletAction,
};
