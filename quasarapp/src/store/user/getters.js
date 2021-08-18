function userLoggedIn(state) {
  return state.loggedIn;
}

function getToken(state) {
  return state.token;
}

function WALLETS(state) {
  return state.wallets;
}

function WALLETS_TYPE_DEBIT(state) {
  return state.wallets.filter(
    (wallet) => wallet.wallet_type_id === 1,
  );
}

function CATEGORY_PROFIT(state) {
  return state.category_profit;
}

function CATEGORY_LOSE(state) {
  return state.category_lose;
}

export {
  userLoggedIn,
  getToken,
  WALLETS,
  WALLETS_TYPE_DEBIT,
  CATEGORY_PROFIT,
  CATEGORY_LOSE,
};
