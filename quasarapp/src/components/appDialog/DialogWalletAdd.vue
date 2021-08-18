<template>
  <div>
    <q-dialog
      ref="dialogRef"
      @hide="onDialogHide"
    >
      <q-card class="q-dialog-plugin">
        <q-card-section class="text-h6 text-secondary">
          Add new Wallet
        </q-card-section>

        <q-separator />

        <q-card-section>
          <q-select
            v-model="form.wallet_type_id"
            class="q-mb-md"
            :options="wallet_type_id"
            label="Type of new wallet"
            emit-value
            map-options
            :rules="[val => !!val || 'Field is required']"
          />
          <q-input
            v-model="form.name"
            class="q-mb-md"
            label="Name of new wallet"
            type="text"
            float-label="Name of new wallet"
            :rules="[val => !!val || 'Field is required']"
          />
          <q-select
            v-model="form.icon"
            class="q-mb-md"
            label="Choose an icon"
            :options="icon"
            emit-value
            map-options
            float-label="Icon for new wallet"
            required
          />
          <q-input
            v-model="form.balance"
            class="q-mb-md"
            label="Enter balance for new wallet"
            type="number"
            float-label="Balance of new wallet"
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
import { ref } from 'vue';
import { mapActions } from 'vuex';

export default {
  name: 'DialogWalletAdd',
  props: {},
  emits: [
    'ok', 'hide', 'data', 'show',
  ],
  setup() {
    return {
      v$: useVuelidate(),
      wallet_type_id: [
        {
          label: 'Debit',
          value: '1',
        },
        {
          label: 'Credit',
          value: '2',
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
        wallet_type_id: ref(null),
        name: null,
        icon: ref(null),
        balance: null,
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
      },
    };
  },
  methods: {
    ...mapActions('user', ['addWalletAction']),
    displaydata() {
      this.$q.notify(JSON.stringify(this.form));
      this.addWalletAction(JSON.stringify(this.form));
    },
    show() {
      this.$refs.dialogRef.show();
    },
    hide() {
      this.$refs.dialogRef.hide();
    },
    onDialogHide() {
      this.$emit('hide');
    },
    onOKClick() {
      this.v$.$validate();
      if (!this.v$.$error) {
        this.displaydata(); // TODO: DELETE AFTER CONFIRMED VERSION FOR DEMO ONLY
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
