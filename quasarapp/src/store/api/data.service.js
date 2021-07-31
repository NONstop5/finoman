import * as axios from 'axios';

export const parseItem = (response, code) => {
  if (response.status !== code) throw Error(response.message);
  let item = response.data;
  if (typeof item !== 'object') {
    item = undefined;
  }
  return item;
};
const getWallets = async function () {
  try {
    const response = await axios.get('/api/accounts');
    return response;
    //  filter might be needed here
  } catch (error) {
    console.error(error);
    return [];
  }
};
const getWallet = async function (typeId) {
  try {
    const response = await axios.get(`/api/accounts/${typeId}`);
    const wallet = parseItem(response, 200);
    return wallet;
  } catch (error) {
    console.error(error);
    return null;
  }
};
const updateWallet = async function (wallet) {
  try {
    const response = await axios.put(`/api/accounts/${wallet.id}`, wallet);
    const updatedWallet = parseItem(response, 200);
    return updatedWallet;
  } catch (error) {
    console.error(error);
    return null;
  }
};
const addWallet = async function (wallet) {
  try {
    const response = await axios.post('api/accounts', wallet);
    const addedWallet = parseItem(response, 200);
    return addedWallet;
  } catch (error) {
    console.error(error);
    return null;
  }
};
const deleteWallet = async function (wallet) {
  try {
    const response = await axios.delete(`api/accounts/${wallet.id}`);
    parseItem(response, 200);
    return wallet.id;
  } catch (error) {
    console.error(error);
    return null;
  }
};
export const dataService = {
  getWallets,
  getWallet,
  updateWallet,
  addWallet,
  deleteWallet,
};
