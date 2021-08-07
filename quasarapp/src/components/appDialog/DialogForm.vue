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
      <div class="row q-mb-md">
        <q-input
          v-model="form.username"
          type="text"
          float-label="Your username"
        />
      </div>
      <div class="row q-mb-md">
        <q-input
          v-model="form.email"
          type="email"
          float-label="Your email"
        />
      </div>
      <div class="row q-mb-md">
        <q-input
          v-model="form.password"
          type="password"
          float-label="Your password"
        />
      </div>
      <div class="row">
        <q-input
          v-model="form.confirmpassword"
          type="password"
          float-label="Confirm your password"
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
import { useDialogPluginComponent } from 'quasar';

export default {
  name: 'DialogForm',
  props: {
    // ...your custom props
  },
  emits: [
    // REQUIRED; need to specify some events that your
    // component will emit through useDialogPluginComponent()
    ...useDialogPluginComponent.emits,
  ],

  setup() {
    // REQUIRED; must be called inside of setup()
    const {
      dialogRef, onDialogHide, onDialogOK, onDialogCancel,
    } = useDialogPluginComponent();
    // dialogRef      - Vue ref to be applied to QDialog
    // onDialogHide   - Function to be used as handler for @hide on QDialog
    // onDialogOK     - Function to call to settle dialog with "ok" outcome
    //                    example: onDialogOK() - no payload
    //                    example: onDialogOK({ /*.../* }) - with payload
    // onDialogCancel - Function to call to settle dialog with "cancel" outcome

    return {
      // This is REQUIRED;
      // Need to inject these (from useDialogPluginComponent() call)
      // into the vue scope for the vue html template
      dialogRef,
      onDialogHide,

      // other methods that we used in our vue html template;
      // these are part of our example (so not required)
      onOKClick() {
        // on OK, it is REQUIRED to
        // call onDialogOK (with optional payload)
        onDialogOK({ dialogRef });
        this.displaydata();
        console.log(this.data);
        console.log(this.data.form);
        console.log(this.displaydata);
        // or with payload: onDialogOK({ ... })
        // ...and it will also hide the dialog automatically
      },
      // we can passthrough onDialogCancel directly
      onCancelClick: onDialogCancel,
    };
  },
  data() {
    return {
      showDialog: false,
      form: {
        username: null,
        email: null,
        password: null,
        confirmpassword: null,
      },
    };
  },
  methods: {
    displaydata() {
      this.$q.notify(JSON.stringify(this.form));
    },
  },

};
</script>
