<template>
  <div>
    <q-dialog
      ref="dialogRef"
      @hide="onDialogHide"
    >
      <q-card class="q-dialog-plugin q-pa-md">
        <div>Adding new Wallet</div>
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
          v-model="form.ballance"
          class="q-mb-md"
          label="Enter balance for new wallet"
          type="number"
          float-label="Balance of new wallet"
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
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import { ref } from 'vue';
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import { showErrorNotification } from '../../functions/function-show-notifications';
import { formatedTimestamp } from '../../functions/formatedTimestamp';

export default {
  name: 'DialogWalletAdd',
  props: {
  },
  emits: [
    'ok', 'hide', 'data', 'show',
  ],
  setup() {
    return {
      v$: useVuelidate(),
      wallet_type_id: [{ label: 'Debit', value: '1' }, { label: 'Credit', value: '2' }],
      icon: [{ label: 'Cash', value: 'fas fa-money-bill-wave' }, { label: 'Card', value: 'far fa-credit-card' }, { label: 'Bank Account', value: 'fas fa-university' }, { label: 'Savings', value: 'fas fa-piggy-bank' }],
    };
  },
  data() {
    return {
      showDialog: false,
      form: {
        wallet_type_id: ref(null),
        name: null,
        icon: ref(null),
        ballance: null,
        ballance_date: formatedTimestamp(),
      },
    };
  },
  validations() {
    return {
      form: {
        wallet_type_id: { required },
        name: { required },
        icon: { required },
        ballance: { required },
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
