import axios from 'axios';
import { showErrorNotification } from 'src/functions/function-show-notifications';

const parseItem = (response, code) => {
  if (response.status !== code) {
    throw Error(response.message);
  }
  let item = response.data;
  if (typeof item !== 'object') {
    item = undefined;
  }
  return item;
};

const parseList = (response) => {
  if (response.status !== 200) {
    throw Error(response.message);
  }
  if (!response.data) {
    return [];
  }
  let list = response.data;
  if (typeof list !== 'object') {
    list = [];
  }
  return list;
};

const getWallets = async () => {
  try {
    const response = await axios.get('/api/wallets');
    return parseList(response);
    // const wallets = data.map(w => )
    //  filter might be needed here
  } catch (error) {
    showErrorNotification(error);
    return [];
  }
};

const getWallet = async (typeId) => {
  try {
    const response = await axios.get(`/api/wallets/${typeId}`);
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};

const updateWallet = async (wallet) => {
  try {
    const response = await axios.put(`/api/wallets/${wallet.id}`, wallet);
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};

const addWallet = async (wallet) => {
  try {
    const response = await axios.post('api/wallets', wallet);
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};

const deleteWallet = async (wallet) => {
  try {
    const response = await axios.delete(`api/wallets/${wallet.id}`);
    parseItem(response, 200);
    return wallet.id;
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};

async function getTran() {
  try {
    const response = await axios.get('api/transactions/1'); // test change last part of url later
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return {};
  }
}

export const dataService = {
  getWallets,
  getWallet,
  updateWallet,
  addWallet,
  deleteWallet,
  getTran,
  parseItem,
  parseList,
};
