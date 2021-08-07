import { reactive } from 'vue';
import { uid } from 'quasar';

const state = reactive({
  budgets: [

  ],
  showAddBudgetDialog: false,
});

const actions = {
  addBudget(addBudgetForm) {
    const newBudget = { ...addBudgetForm };
    newBudget.id = uid();
    state.budgets.push(newBudget);
    state.showAddBudgetDialog = false;
  },
};

export default {
  state,
  actions,
};
