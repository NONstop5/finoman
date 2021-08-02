<template>
  <q-page class="row justify-center items-center content-center">
    <div class="col-xs-12 col-sm-6 col-md-3 text-center">
      <div class="q-gutter-lg">
        <q-input
          v-model="formData.email"
          outlined
          type="email"
          placeholder="Email"
          name="email"
          :model-value="formData.email"
        />
        <q-input
          v-model="formData.password"
          outlined
          type="password"
          placeholder="Password"
          name="password"
          :model-value="formData.password"
        />
        <q-btn
          size="lg"
          color="secondary"
          @click="onSubmit"
        >
          Login
        </q-btn>
        <q-btn
          color="primary"
          size="lg"
          to="/registration"
        >
          Sign Up
        </q-btn>
      </div>
    </div>
  </q-page>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: 'Login',
  data() {
    return {
      formData: {
        email: 'john_doe@finoman.ru.com',
        password: 'password',
      },
    };
  },
  methods: {
    ...mapActions('user', ['login']),
    onSubmit() {
      this.login(this.formData);
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
