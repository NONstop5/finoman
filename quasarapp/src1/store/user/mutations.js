import { LocalStorage } from 'quasar';

function setLoggedIn(state, value) {
  LocalStorage.set('user.loggedIn', value);

  state.loggedIn = value;
}

function setDetails(state, payload) {
  state.details = payload;

  LocalStorage.set('user.details', payload);
}

function setToken(state, value) {
  state.token = value;

  LocalStorage.set('user.token', value);
}
function ADD_WALLET(state, wallet) {
  state.wallets.push(wallet);
}
function GET_WALLETS(state, wallets) {
  state.wallets = wallets;
}
function UPDATE_WALLET(state, wallet) {
  const index = state.wallets.findIndex((h) => h.id === wallet.id);
  state.wallets.splice(index, 1, wallet);
  state.wallets = [...state.wallets];
}
function DELETE_WALLET(state, wallet) {
  state.wallets = [...state.wallets.filter((p) => p.id !== wallet.id)];
}
function GET_CATEGORIES(state, categories) {
  state.categories = categories;
}
function ADD_CATEGORY(state, category) {
  state.categories.push(category);
}
function UPDATE_CATEGORY(state, category) {
  const index = state.categories.findIndex((h) => h.id === category.id);
  state.categories.splice(index, 1, category);
  state.categories = [...state.categories];
}
function DELETE_CATEGORY(state, category) {
  state.categories = [...state.categories.filter((p) => p.id !== category.id)];
}
function GET_TRANSACTIONS(state, payload) {
  state.transactions = payload;
}
function ADD_TRANSACTION(state, transaction) {
  state.transactions.push(transaction);
}
function UPDATE_TRANSACTION(state, transaction) {
  const index = state.transactions.findIndex((h) => h.id === transaction.id);
  state.transactions.splice(index, 1, transaction);
  state.transactions = [...state.transactions];
}
function DELETE_TRANSACTION(state, transaction) {
  state.transactions = [...state.transactions.filter((p) => p.id !== transaction.id)];
}
export {
  setLoggedIn,
  setDetails,
  setToken,
  ADD_WALLET,
  GET_WALLETS,
  UPDATE_WALLET,
  DELETE_WALLET,
  GET_CATEGORIES,
  ADD_CATEGORY,
  UPDATE_CATEGORY,
  DELETE_CATEGORY,
  GET_TRANSACTIONS,
  ADD_TRANSACTION,
  UPDATE_TRANSACTION,
  DELETE_TRANSACTION,
};
