<template align="center">
  <div class="text-center container q-mx-auto q-mt-xl">
    <span v-if="registered">Successfully registered</span><br />
    <input class="full-width no-outline rounded-borders q-mb-lg q-py-sm q-px-md text-body1" type="text" v-model="form.name" placeholder="Name" /><br />
    <input class="full-width no-outline rounded-borders q-mb-lg q-py-sm q-px-md text-body1" type="text" v-model="form.email" placeholder="Email" /><br />
    <input class="full-width no-outline rounded-borders q-mb-lg q-py-sm q-px-md text-body1"
      type="password"
      v-model="form.password"
      placeholder="Password"
    /><br />
    <input class="full-width no-outline rounded-borders q-mb-lg q-py-sm q-px-md text-body1"
      type="password"
      v-model="form.password_confirmation"
      placeholder="Password Confirmation"
    /><br />
     <q-btn class="btn cursor-pointer" @click="sendForm" :disabled="pending">Registration</q-btn>
  </div>
</template>
 <style lang="scss" scoped>
  .container {
    max-width: 335px;
  }
  .btn {
    min-width: 150px;
    background-color: transparent;
    border: 1px solid $secondary;
    color: $secondary;
}
.btn:hover {
    background: $positive;
    transition: 0.4;
    border-color: transparent;
}
input {
    color: $primary;
    border: 1px solid $secondary;
    background-color: transparent;
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
