<template>
  <q-page class="row justify-center items-center content-center">
    <div class="col-xs-12 col-sm-6 q-gutter-lg col-md-3 text-center">
      <q-form>
        <q-input
          v-model="formData.name"
          outlined
          class="q-mb-lg text-body1"
          type="text"
          placeholder="Name"
          :model-value="formData.name"
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
          class="q-mb-lg text-body1"
          type="text"
          placeholder="Email"
          :model-value="formData.email"
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
          class="q-mb-lg text-body1"
          type="password"
          placeholder="Password"
          :model-value="formData.password"
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
          class="q-mb-lg text-body1"
          type="password"
          placeholder="Password Confirmation"
          :model-value="formData.password_confirmation"
        />
        <div
          v-for="error of v$.formData.password_confirmation.$silentErrors"
          :key="error.$message"
        >
          <div>{{ error.$message }}</div>
        </div>
        <q-btn
          color="primary"
          size="lg"
          :disabled="pending"
          @click="sendForm"
        >
          Sign up
        </q-btn>
      </q-form>
    </div>
  </q-page>
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
      name: {
        required,
        maxLength: maxLength(16),
        alphaNum,
      },
      email: {
        required,
        email,
      },
      password: {
        alphaNum,
        required,
        minLength: minLength(8),
        maxLength: maxLength(32),
      },
      password_confirmation: {
        required,
        sameAsPassword: sameAs(this.formData.password),
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
  },
};
</script>

<style lang="scss" scoped>

</style>
