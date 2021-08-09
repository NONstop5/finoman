<template>
  <!-- notice dialogRef here -->
  <div>
    <q-dialog
      ref="categoryAddRef"
      @hide="onDialogHide"
    >
      <div
        class="q-gutter-y-md column"
        style="max-width: 400px"
      >
        <q-card class="q-dialog-plugin">
          <!--
        ...content
        ... use q-card-section for it?
      -->
          <q-card-section class="justify-center items-center content-center">
            <div>Adding new Category</div>
            <q-select
              v-model="form.options"
              class="row q-mb-md"
              :options="options"
              label="Type of new wallet"
              emit-value
              map-options
              :rules="[val => !!val || 'Field is required']"
            />
            <q-input
              v-model="form.name"
              class="row q-mb-md"
              label="Name of new wallet"
              type="text"
              float-label="Name of new wallet"
              :rules="[val => !!val || 'Field is required']"
            />
            <q-select
              v-model="form.icons"
              class="row q-mb-md"
              label="Choose an icon"
              :options="icons"
              emit-value
              map-options
              float-label="Icon for new wallet"
              required
            />
            <q-input
              v-model="form.ballance"
              class="row q-mb-md"
              label="Enter balance for new wallet"
              type="number"
              float-label="Balance of new wallet"
              required
            />
          <!-- buttons example -->
          </q-card-section>
          <q-card-actions
            class="row q-mb-md"
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
      </div>
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
    // ...your custom props
  },
  emits: [
    // REQUIRED
    'ok', 'hide', 'data', 'show',
  ],
  setup() {
    return {
      v$: useVuelidate(),
      options: [{ label: 'Debit', value: '1' }, { label: 'Credit', value: '2' }],
      icons: [{ label: 'Cash', value: 'fas fa-money-bill-wave' }, { label: 'Card', value: 'far fa-credit-card' }, { label: 'Bank Account', value: 'fas fa-university' }, { label: 'Savings', value: 'fas fa-piggy-bank' }],
    };
  },
  data() {
    return {
      showDialog: false,
      form: {
        options: ref(null),
        name: null,
        icons: ref(null),
        ballance: null,
        ballance_date: Date.now(),
      },
    };
  },
  validations() {
    return {
      form: {
        options: { required },
        name: { required },
        icons: { required },
        ballance: { required },
      },
    };
  },

  methods: {
    ...mapActions('user', ['addCategoryAction']),
    displaydata() {
      this.$q.notify(JSON.stringify(this.form));
      this.addCategoryAction(JSON.stringify(this.form));
    },
    // following method is REQUIRED
    // (don't change its name --> "show")
    show() {
      this.$refs.categoryAddRef.show();
    },

    // following method is REQUIRED
    // (don't change its name --> "hide")
    hide() {
      this.$refs.categoryAddRef.hide();
    },

    onDialogHide() {
      // required to be emitted
      // when QDialog emits "hide" event
      this.$emit('hide');
    },

    onOKClick() {
      // on OK, it is REQUIRED to
      // emit "ok" event (with optional payload)
      // before hiding the QDialog
      this.v$.$validate();
      if (!this.v$.$error) {
        this.displaydata(); // DELETE AFTER CONFIREMED VERSION FOR DEMO ONLY
        this.$emit('ok');
        this.hide();
      } else {
        showErrorNotification('Complete all fields');
      }

      // or with payload: this.$emit('ok', { ... })

      // then hiding dialog
    },

    onCancelClick() {
      // we just need to hide the dialog
      this.hide();
    },
  },
};
</script>
