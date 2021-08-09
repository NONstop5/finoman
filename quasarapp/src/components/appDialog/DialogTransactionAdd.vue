<template>
  <div>
    <q-dialog
      ref="transactionAddRef"
      @hide="onDialogHide"
    >
      <q-card class="q-dialog-plugin q-pa-md">
        <div>Add new transaction</div>
        <q-select
          v-model="form.category_type_id"
          class="q-mb-md"
          :options="category_type_id"
          label="Test"
          emit-value
          map-options
          :rules="[val => !!val || 'Field is required']"
        />
        <q-input
          v-model="form.name"
          class="q-mb-md"
          label="test"
          type="text"
          float-label="Name of new category"
          :rules="[val => !!val || 'Field is required']"
        />
        <q-input
          v-model="form.budget"
          class="q-mb-md"
          label="test"
          type="number"
          float-label="Budget of new category"
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

export default {
  name: 'DialogCategoryAdd',
  props: {
  },
  emits: [
    'ok', 'hide', 'data', 'show',
  ],
  setup() {
    return {
      v$: useVuelidate(),
      category_type_id: [{ label: 'Income', value: '1' }, { label: 'Expenses', value: '2' }],
    };
  },
  data() {
    return {
      form: {
        category_type_id: ref(null),
        name: null,
        budget: null,
      },
    };
  },
  validations() {
    return {
      form: {
        category_type_id: { required },
        name: { required },
        budget: { required },
      },
    };
  },
  methods: {
    ...mapActions('user', ['addCategoryAction']),
    displaydata() {
      this.$q.notify(JSON.stringify(this.form));
      this.addTransactionAction(JSON.stringify(this.form));
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
