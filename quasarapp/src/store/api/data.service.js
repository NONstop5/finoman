import axios from 'axios';
import { showErrorNotification } from 'src/functions/function-show-notifications';

export const parseItem = (response, code) => {
  if (response.status !== code) {
    throw Error(response.message);
  }
  let item = response.data;
  if (typeof item !== 'object') {
    item = undefined;
  }
  return item;
};
const getWallets = async () => {
  try {
    return await axios.get('/api/accounts');
    //  filter might be needed here
  } catch (error) {
    showErrorNotification(error);
    return [];
  }
};
const getWallet = async (typeId) => {
  try {
    const response = await axios.get(`/api/accounts/${typeId}`);
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};
const updateWallet = async (wallet) => {
  try {
    const response = await axios.put(`/api/accounts/${wallet.id}`, wallet);
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};
const addWallet = async (wallet) => {
  try {
    const response = await axios.post('api/accounts', wallet);
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};
const deleteWallet = async (wallet) => {
  try {
    const response = await axios.delete(`api/accounts/${wallet.id}`);
    parseItem(response, 200);
    return wallet.id;
  } catch (error) {
    showErrorNotification(error);
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
