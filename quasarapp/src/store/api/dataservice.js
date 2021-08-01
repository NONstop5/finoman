import * as axios from 'axios';
import { showErrorNotification } from 'src/functions/function-show-notifications';

export const parseItem = (response, code) => {
  if (response.status !== code) throw Error(response.message);
  let item = response.data;
  if (typeof item !== 'object') {
    item = undefined;
  }
  return item;
};
const parseList = (response) => {
  if (response.status !== 200) throw Error(response.message);
  if (!response.data) return [];
  let list = response.data;
  if (typeof list !== 'object') {
    list = [];
  }
  return list;
};

async function getWallets() {
  try {
    const response = await axios.get('/api/accounts');
    const data = parseList(response);
    // const wallets = data.map(w => )
    //  filter might be needed here
    return data;
  } catch (error) {
    showErrorNotification(error);
    return [];
  }
}
async function getWallet(id) {
  try {
    const response = await axios.get(`/api/accounts/${id}`);
    const wallet = parseItem(response, 200);
    return wallet;
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
}
async function updateWallet(wallet) {
  try {
    const response = await axios.put(`/api/accounts/${wallet.id}`, wallet);
    const updatedWallet = parseItem(response, 200);
    return updatedWallet;
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
}
async function addWallet(wallet) {
  try {
    const response = await axios.post('api/accounts', wallet);
    const addedWallet = parseItem(response, 200);
    return addedWallet;
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
}
async function deleteWallet(wallet) {
  try {
    const response = await axios.delete(`api/accounts/${wallet.id}`);
    parseItem(response, 200);
    return wallet.id;
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
}
async function getTran() {
  try {
    const response = await axios.get('api/transactions/1'); // test change last part of url later
    const transactions = parseItem(response, 200);
    return transactions;
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
};
