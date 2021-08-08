<template>
  <!-- notice dialogRef here -->
  <q-dialog
    ref="dialogRef"
    @hide="onDialogHide"
  >
    <q-card class="q-dialog-plugin">
      <!--
        ...content
        ... use q-card-section for it?
      -->
      <q-select
        v-model="form.options"
        :options="options"
        label="Standard"
        emit-value
        map-options
      />
      <div class="row q-mb-md">
        <q-input
          v-model="form.name"
          type="text"
          float-label="Name of new wallet"
        />
      </div>
      <div class="row q-mb-md">
        <q-input
          v-model="form.icon"
          float-label="Icon for new wallet"
        />
      </div>
      <div class="row q-mb-md">
        <q-input
          v-model="form.ballance"
          type="number"
          float-label="Balance of new wallet"
        />
      </div>
      <!-- buttons example -->
      <q-card-actions align="right">
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
</template>

<script>
import { mapActions } from 'vuex';
import { ref } from 'vue';

export default {
  name: 'DialogForm',
  props: {
    // ...your custom props
  },
  emits: [
    // REQUIRED
    'ok', 'hide', 'data',
  ],
  setup() {
    return {
      options: [{ label: 'Debit', value: '1' }, { label: 'Credit', value: '2' }],
    };
  },
  data() {
    return {
      showDialog: false,
      form: {
        options: ref(null),
        name: null,
        icon: null,
        ballance: null,
        ballance_date: Date.now(),
      },
    };
  },

  methods: {
    ...mapActions('user', ['addWalletAction']),
    displaydata() {
      this.$q.notify(JSON.stringify(this.form));
      console.log(this.form);
      this.addWalletAction(JSON.stringify(this.form));
    },
    // following method is REQUIRED
    // (don't change its name --> "show")
    show() {
      this.$refs.dialogRef.show();
    },

    // following method is REQUIRED
    // (don't change its name --> "hide")
    hide() {
      this.$refs.dialogRef.hide();
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
      this.displaydata(); // DELETE AFTER CONFIREMED VERSION FOR DEMO ONLY
      this.$emit('ok');
      // or with payload: this.$emit('ok', { ... })

      // then hiding dialog
      this.hide();
    },

    onCancelClick() {
      // we just need to hide the dialog
      this.hide();
    },
  },
};
</script>
