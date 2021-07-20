<template align="center">
  <div class="text-center column content-center q-mt-xl">
    <div style="min-width: 300px">
    <span v-if="registered">Successfully registered</span><br />
    <q-input
      outlined
      dark
      class="q-mb-lg text-body1"
      type="text"
      v-model="form.name"
      placeholder="Name" />
    <q-input
      outlined
      dark
      class="q-mb-lg text-body1"
      type="text"
      v-model="form.email"
      placeholder="Email"/>
    <q-input
      outlined
      dark
      class="q-mb-lg text-body1"
      type="password"
      v-model="form.password"
      placeholder="Password"/>
    <q-input
      outlined
      dark
      class="q-mb-lg text-body1"
      type="password"
      v-model="form.password_confirmation"
      placeholder="Password Confirmation"/>
     <q-btn
      class="btn text-secondary"
      outline
      size="md"
      @click="sendForm"
      :disabled="pending">Sign up</q-btn>
  </div>
  </div>
</template>
<style lang="scss" scoped>
  .btn:hover {
      background: $positive !important;
      transition: 0.4;
  }
 </style>
<script>
import axios from 'axios';
import { API_REGISTRATION_URL } from '../data/auth';

export default {
  name: 'Registration',
  data() {
    return {
      pending: false,
      registered: false,
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
    };
  },
  methods: {
    sendForm() {
      if (this.pending === false) {
        this.pending = true;
        axios
          .post(API_REGISTRATION_URL, this.form)
          .then(() => {
            this.registered = true;
          })
          .then(() => {
            this.pending = false;
          });
      }
    },
  },
};
</script>
