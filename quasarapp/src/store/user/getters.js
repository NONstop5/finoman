function userLoggedIn(state) {
  return state.loggedIn;
}

function getToken(state) {
  return state.token;
}

function WALLETS(state) {
  return state.wallets;
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
  CATEGORY_PROFIT,
  CATEGORY_LOSE,
};
