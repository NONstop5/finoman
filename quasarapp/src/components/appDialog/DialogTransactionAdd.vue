<template>
  <div>
    <q-dialog
      ref="transactionAddRef"
      @hide="onDialogHide"
    >
      <q-card class="q-dialog-plugin q-pa-md">
        <div>Add new transaction</div>
        <q-btn-toggle
            v-model="category_type_id"
            color="secondary"
            toggle-color="info"
            :options="[
              {label: 'Income', value: 1},
              {label: 'Transfer', value: 3},
              {label: 'Outcome', value: 2}
            ]"
          />
        <div v-if="category_type_id === 1 || category_type_id === 2">
          <q-select
            v-model="form.category_id"
            class="q-mb-md"
            :options="categoriesList"
            label="Choose category"
            emit-value
            map-options
            :rules="[val => !!val || 'Field is required']"
          />
          <q-select
            v-model="form.wallet_from_id"
            class="q-mb-md"
            :options="walletsList"
            label="Choose wallet"
            emit-value
            map-options
            :rules="[val => !!val || 'Field is required']"
          />
          <q-input
            v-model="form.transacted_at"
            class="text-secondary q-my-lg"
            outlined
            mask="##-##-####"
            :rules="[ val => val && val.length > 9 || 'Incorrect date']"
          >
            <q-icon
              name="event"
              size="md"
              class="cursor-pointer q-pt-md"
            >
              <q-popup-proxy
                ref="qDateProxy"
                transition-show="scale"
                transition-hide="scale"
              >
                <q-date
                  v-model="form.transacted_at"
                  v-close-popup
                  color="secondary"
                  class="text-secondary"
                  mask="DD-MM-YYYY"
                />
              </q-popup-proxy>
            </q-icon>
          </q-input>
          <q-input
            v-model="form.amount"
            class="q-mb-md"
            label="Amount"
            type="number"
            float-label="Amount"
            required
          />
          <q-card-actions
            class="q-mb-md"
            align="center"
          >
            <q-btn
              color="secondary"
              label="OK"
              @click="onOKClick"
            />
            <q-btn
              color="secondary"
              label="Cancel"
              @click="onCancelClick"
            />
          </q-card-actions>
        </div>
        <div v-if="category_type_id === 3">
          <q-select
            v-model="form.wallet_from_id"
            class="q-mb-md"
            :options="walletsList"
            label="Wallet from"
            emit-value
            map-options
            :rules="[val => !!val || 'Field is required']"
          />
          <q-select
            v-model="form.wallet_to_id"
            class="q-mb-md"
            :options="walletsList"
            label="Wallet to"
            emit-value
            map-options
            :rules="[val => !!val || 'Field is required']"
          />
          <q-input
            v-model="proxyDate"
            class="text-secondary q-my-lg"
            outlined
            mask="####-##-##"
            :rules="[ val => val && val.length > 9 || 'Incorrect date']"
          >
            <q-icon
              name="event"
              size="md"
              class="cursor-pointer q-pt-md"
            >
              <q-popup-proxy
                ref="updateProxy"
                @before-show="updateProxy"
                transition-show="scale"
                transition-hide="scale"
              >
                <q-date
                  v-model="proxyDate"
                  color="secondary"
                  class="text-secondary"
                  model-value=""
                  @click="save"
                  mask="YYYY-MM-DD"
                >
                  <div
                    class="row items-center justify-end q-gutter-sm"
                  >
                    <q-btn
                      v-close-popup
                      label="Cancel"
                      color="secondary"
                      flat
                    />
                    <q-btn
                      v-close-popup
                      label="OK"
                      color="secondary"
                      flat
                      @click="getDate(date)"
                    />
                  </div>
                </q-date>
              </q-popup-proxy>
            </q-icon>
          </q-input>
          <q-input
            v-model="form.amount"
            class="q-mb-md"
            label="Amount"
            type="number"
            float-label="Amount"
            required
          />
          <q-card-actions
            class="q-mb-md"
            align="center"
          >
            <q-btn
              color="secondary"
              label="OK"
              @click="onOKClick"
            />
            <q-btn
              color="secondary"
              label="Cancel"
              @click="onCancelClick"
            />
          </q-card-actions>
        </div>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import { date as qdate } from 'quasar';
import { ref } from 'vue';
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import { showErrorNotification } from '../../functions/function-show-notifications';

export default {
  name: 'DialogTransactionAdd',
  props: {
  },
  emits: [
    'ok', 'hide', 'data', 'show',
  ],
  setup() {
    const date = ref(Date.now());
    const proxyDate = ref(null);
    return {
      date,
      proxyDate,
      updateProxy() {
        proxyDate.value = date.value;
      },
      save() {
        date.value = proxyDate.value;
      },
      v$: useVuelidate(),
      category_type_id: ref(1),
    };
  },
  data() {
    return {
      categoriesList: [],
      dt: null,
      form: {
        category_id: ref(null),
        wallet_from_id: ref(null),
        wallet_to_id: ref(null),
        transacted_at: null,
        amount: null,
      },
    };
  },
  validations() {
    return {
      form: {
        wallet_from_id: { required },
        amount: { required },
      },
    };
  },
  computed: {
    ...mapState('user', ['wallets', 'categories', 'transactions']),
  },
  async created() {
    await this.loadInfo();
    this.getCategoriesList();
    this.getWalletList();
  },
  methods: {
    ...mapActions('user', ['getWalletsAction', 'getCategoriesAction', 'getTransactionsAction', 'addTransactionAction']),
    async loadInfo() {
      await this.getWalletsAction();
      await this.getCategoriesAction();
      await this.getTransactionsAction();
    },
    displaydata() {
      // console.log(this.form);
      this.createTransObj();
      this.addTransactionAction({
        wallet_from_id: 1,
        wallet_to_id: 4,
        category_id: 1,
        amount: '2.66',
        transacted_at: '1987-09-24 14:08:54',
      });
    },
    getCategoriesList() {
      this.categoriesList = this.categories.map((index) => ({
        label: index.name,
        value: index.id,
      }
      ));
    },
    getWalletList() {
      this.walletsList = this.wallets.map((index) => ({
        label: index.name,
        value: index.id,
      }
      ));
    },
    getDate(timeStamp) {
      debugger;
      this.dt = qdate.formatDate(timeStamp, 'YYYY-MM-DD HH:mm:ss');
    },
    createTransObj() {
      const transObj = {
        category_id: this.form.category_id,
        wallet_from_id: this.form.wallet_from_id,
        wallet_to_id: this.form.wallet_to_id,
        transacted_at: this.dt,
        amount: this.form.amount,
      };
      console.log(transObj);
    },
    show() {
      this.$refs.transactionAddRef.show();
    },
    hide() {
      this.$refs.transactionAddRef.hide();
    },
    onDialogHide() {
      this.$emit('hide');
    },
    onOKClick() {
      this.v$.$validate();
      if (!this.v$.$error) {
        debugger;
        this.displaydata(); // DELETE AFTER CONFIREMED VERSION FOR DEMO ONLY
        this.$emit('ok');
        this.hide();
      } else {
        showErrorNotification('Complete all fields');
      }
    },
    onCancelClick() {
      this.hide();
    },
  },
};
</script>
