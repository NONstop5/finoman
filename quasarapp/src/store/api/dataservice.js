import { api } from 'src/boot/axios';
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

const parseItemConfig = (response, code) => {
  if (response.status !== code) {
    throw Error(response.message);
  }
  let item = JSON.parse(response.config.data);
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
    const response = await api.get('/api/wallets');
    return parseList(response);
    // const wallets = data.map(w => )
    // filter might be needed here
  } catch (error) {
    showErrorNotification(error);
    return [];
  }
};

const getWallet = async (typeId) => {
  try {
    const response = await api.get(`/api/wallets/${typeId}`);
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};

const updateWallet = async (wallet) => {
  try {
    const response = await api.put(`/api/wallets/${wallet.id}`, wallet);
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};

const addWallet = async (wallet) => {
  try {
    const response = await api.post('api/wallets', wallet);
    return parseItemConfig(response, 201);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};

const deleteWallet = async (wallet) => {
  try {
    const response = await api.delete(`api/wallets/${wallet}`);
    parseItem(response, 204);
    return wallet;
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};
async function getCategories() {
  try {
    const response = await api.get('api/categories');
    return parseList(response);
  } catch (error) {
    showErrorNotification(error);
    return [];
  }
}
const addCategory = async (category) => {
  try {
    const response = await api.post('api/categories', category);
    return parseItem(response, 201);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};
const updateCategory = async (category) => {
  debugger;
  try {
    const response = await api.put(`/api/categories/${category.id}`, category);
    return parseItemConfig(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};
const deletedCategory = async (id) => {
  try {
    const response = await api.delete(`api/categories/${id}`);
    if (response.status === 204) {
      return id;
    } return null;
  } catch (error) {
    showErrorNotification(error);
    return null;
  }
};
async function getTran() {
  try {
    const response = await api.get('api/transactions?amount=5&data_order=desc'); // test change last part of url later
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return [];
  }
}
async function get5LastTran() {
  try {
    const response = await api.get('api/transactions?amount=5&data_order=desc'); // test change last part of url later
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return [];
  }
}
async function getSortTran(date) {
  try {
    const response = await api.get(`api/transactions?${date}`); // test change last part of url later
    return parseItem(response, 200);
  } catch (error) {
    showErrorNotification(error);
    return [];
  }
}

const addTran = async (tran) => {
  try {
    const response = await api.post('api/transactions', tran);
    return parseItem(response, 201);
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
  getCategories,
  addCategory,
  updateCategory,
  deletedCategory,
  getTran,
  get5LastTran,
  getSortTran,
  parseItem,
  parseList,
  addTran,
};
