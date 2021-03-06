<template>
  <div>
    <q-dialog
      ref="dialogRefEdit"
      @hide="onDialogHide"
    >
      <q-card class="q-dialog-plugin">
        <q-card-section class="text-h6 text-secondary">
          Update selected Wallet
        </q-card-section>

        <q-separator />

        <q-card-section>
          <q-select
            v-model="form.wallet_type_id"
            class="q-mb-md"
            :options="wallet_type_id"
            label="Type of wallet"
            emit-value
            map-options
            :rules="[val => !!val || 'Field is required']"
          />
          <q-input
            v-model="form.name"
            class="q-mb-md"
            label="Name of wallet"
            type="text"
            :rules="[val => !!val || 'Field is required']"
          />
          <q-select
            v-model="form.icon"
            class="q-mb-md"
            label="Choose an icon"
            :options="icon"
            emit-value
            map-options
            required
          />
          <q-select
            v-model="form.currency"
            class="q-mb-md"
            label="Currency"
            :options="currency_id"
            emit-value
            map-options
            required
          />
          <q-input
            v-model="form.balance"
            class="q-mb-md"
            label="Enter new balance"
            type="number"
            required
          />
        </q-card-section>

        <q-separator />

        <q-card-section>
          <q-card-actions
            align="center"
          >
            <q-btn
              color="grey"
              label="Cancel"
              @click="onCancelClick"
            />
            <q-btn
              color="secondary"
              label="Ok"
              @click="onOKClick"
            />
          </q-card-actions>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import { formatedTimestamp } from 'src/functions/formatedTimestamp';
import { showErrorNotification } from 'src/functions/function-show-notifications';
import { mapActions } from 'vuex';

export default {
  name: 'DialogWalletAdd',
  props: {
    wallet: {
      type: Object,
      default() {
        return { msg: 'hello' };
      },
    },
  },
  emits: [
    'ok', 'hide', 'data', 'show',
  ],
  setup() {
    return {
      v$: useVuelidate(),
      currency_id: [{ label: '₽ - Рубль', value: '1' }],
      wallet_type_id: [
        {
          label: 'Debit',
          value: 1,
        },
        {
          label: 'Credit',
          value: 2,
        },
      ],
      icon: [
        {
          label: 'Cash',
          value: 'account_balance_wallet',
        },
        {
          label: 'Card',
          value: 'credit_card',
        },
        {
          label: 'Bank Account',
          value: 'account_balance',
        }, {
          label: 'Savings',
          value: 'savings',
        },
      ],
    };
  },
  data() {
    return {
      showDialog: false,
      form: {
        id: this.wallet.id,
        wallet_type_id: null,
        currency_id: this.wallet.currency_id,
        name: this.wallet.name,
        icon: this.wallet.icon,
        balance: this.wallet.balance,
        balance_date: formatedTimestamp(),
      },
    };
  },
  validations() {
    return {
      form: {
        wallet_type_id: { required },
        name: { required },
        icon: { required },
        balance: { required },
        currency_id: { required },
      },
    };
  },
  methods: {
    ...mapActions('user', ['updateWalletAction']),
    show() {
      this.$refs.dialogRefEdit.show();
    },
    hide() {
      this.$refs.dialogRefEdit.hide();
    },
    onDialogHide() {
      this.$emit('hide');
    },
    onOKClick() {
      this.v$.$validate();
      if (!this.v$.$error) {
        this.updateWalletAction(this.form);
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
