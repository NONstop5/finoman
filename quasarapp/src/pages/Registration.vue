<template align="center">
  <div>
    <span v-if="registered">Successfully registered</span><br />
    <input type="text" v-model="form.name" placeholder="Name" /><br />
    <input type="text" v-model="form.email" placeholder="Email" /><br />
    <input
      type="password"
      v-model="form.password"
      placeholder="Password"
    /><br />
    <input
      type="password"
      v-model="form.password_confirmation"
      placeholder="Password Confirmation"
    /><br />
    <button @click="sendForm" :disabled="pending">Registration</button>
  </div>
</template>

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
          .catch(() => {})
          .then(() => {
            this.pending = false;
          });
      }
    },
  },
};
</script>
