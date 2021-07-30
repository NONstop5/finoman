// import axios from 'axios';
import { api } from 'boot/axios';
import { Loading, LocalStorage } from 'quasar';
import { showErrorNotification, showSuccessNotification } from 'src/functions/function-show-notifications';

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

export {
  login, logout, getState, register,
};
