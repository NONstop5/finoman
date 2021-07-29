<template align="center">
  <div class="text-center column content-center q-mt-xl">
    <div style="min-width: 300px">
      <q-form>
        <q-input
          v-model="formData.name"
          outlined
          dark
          class="q-mb-lg text-body1"
          type="text"
          placeholder="Name"
        />
        <div
          v-for="error of v$.formData.name.$silentErrors"
          :key="error.$message"
        >
          <div>{{ error.$message }}</div>
        </div>
        <q-input
          v-model="formData.email"
          outlined
          dark
          class="q-mb-lg text-body1"
          type="text"
          placeholder="Email"
        />
        <div
          v-for="error of v$.formData.email.$silentErrors"
          :key="error.$message"
        >
          <div>{{ error.$message }}</div>
        </div>
        <q-input
          v-model="formData.password"
          outlined
          dark
          class="q-mb-lg text-body1"
          type="password"
          placeholder="Password"
        />
        <div
          v-for="error of v$.formData.password.$silentErrors"
          :key="error.$message"
        >
          <div>{{ error.$message }}</div>
        </div>
        <q-input
          v-model="formData.password_confirmation"
          outlined
          dark
          class="q-mb-lg text-body1"
          type="password"
          placeholder="Password Confirmation"
        />
        <div
          v-for="error of v$.formData.password_confirmation.$silentErrors"
          :key="error.$message"
        >
          <div>{{ error.$message }}</div>
        </div>
        <q-btn
          class="btn text-secondary"
          outline
          size="md"
          :disabled="pending"
          @click="sendForm"
        >
          Sign up
        </q-btn>
      </q-form>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import useVuelidate from '@vuelidate/core';
import {
  required,
  email,
  minLength,
  maxLength,
  sameAs,
  alphaNum,
} from '@vuelidate/validators';
import { showErrorNotification } from '../functions/function-show-notifications';

export default {
  name: 'Register',
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      formData: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
    };
  },
  validations() {
    return {
      formData: {
        name: {
          required,
          minLength: minLength(1),
          alphaNum,
        },
        email: {
          required,
          email,
        },
        password: {
          required,
          minLength: minLength(8),
          maxLenght: maxLength(32),
        },
        password_confirmation: {
          sameAsPassword: sameAs(this.formData.password),
        },
      },
    };
  },
  methods: {
    ...mapActions('user', ['register']),
    sendForm() {
      this.v$.$validate();
      if (!this.v$.$error) {
        this.register(this.formData);
      } else {
        showErrorNotification('Form failed validation');
      }
    },
    // sendForm() {
    //   if (this.pending === false) {
    //     this.pending = true;
    //     this.$axios
    //       .post('/api/register', this.form)
    //       .then(() => {
    //         this.registered = true;
    //       })
    //       .then(() => {
    //         this.pending = false;
    //       });
    //   }
    // },
  },
};
</script>

<style lang="scss" scoped>
.btn:hover {
  background: $positive !important;
  transition: 0.4;
}
div {
  color: $negative;
}
</style>
