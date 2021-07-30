import { LocalStorage } from 'quasar';

function setLoggedIn(state, value) {
  state.loggedIn = value;

  LocalStorage.set('user.loggedIn', value);
}

function setDetails(state, payload) {
  state.details = payload;

  LocalStorage.set('user.details', payload);
}
function ADD_WALLET(state, wallet) {
  state.wallets.push(wallet);
}
function GET_WALLETS(state, wallets) {
  state.wallets = wallets;
}
function UPDATE_WALLET(state, wallet) {
  const index = state.wallets.findIndex(h => h.id === wallet.id);
  state.wallets.splice(index, 1, wallet);
  state.wallets = [...state.wallets];
}
function DELETE_WALLET(state, wallet) {
  state.wallets = [...state.wallets.filter(p => p.id !== wallet.id)];
}
// export default {
//   SET_WALLET: (state, payload) => {
//     state.wallets = payload;
//   },
//   ADD_WALLET: (state, payload) => {
//     state.wallets.push(payload);
//   }
// }
export {
  setLoggedIn,
  setDetails,
  ADD_WALLET,
  GET_WALLETS,
  UPDATE_WALLET,
  DELETE_WALLET,
};
