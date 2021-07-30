function userLoggedIn(state) {
  return state.loggedIn;
}

function getToken(state) {
  return state.token;
}

export { userLoggedIn, getToken };
