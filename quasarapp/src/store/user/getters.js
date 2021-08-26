function userLoggedIn(state) {
  return state.loggedIn;
}

function getToken(state) {
  return state.token;
}

function WALLETS(state) {
  return state.wallets;
}

function WALLETS_LIST(state) {
  return state.wallets.map((index) => ({
    label: index.name,
    value: index.id,
  }
  ));
}

function WALLETS_TYPE_CREDIT(state) {
  return state.wallets.filter((w) => w.wallet_type_id === 2);
}
function WALLETS_TYPE_DEBIT(state) {
  return state.wallets.filter((w) => w.wallet_type_id === 1);
}

function CATEGORIES(state) {
  return state.categories;
}

function CATEGORIES_LIST(state) {
  return state.categories.map((index) => ({
    label: index.name,
    value: index.id,
  }
  ));
}

function CATEGORY_PROFIT(state) {
  return state.categories.filter(
    (category) => category.category_type_id === 1,
  );
}

function CATEGORY_LOSE(state) {
  return state.categories.filter(
    (category) => category.category_type_id === 2,
  );
}

export {
  userLoggedIn,
  getToken,
  WALLETS,
  WALLETS_LIST,
  WALLETS_TYPE_CREDIT,
  WALLETS_TYPE_DEBIT,
  CATEGORIES,
  CATEGORIES_LIST,
  CATEGORY_PROFIT,
  CATEGORY_LOSE,
};
