<template align="center">
  <div class="text-center column items-center q-mt-xl">
    <h1 class="text-h2 q-mb-lg">Finoman</h1>
   <q-icon class="q-mb-lg"
            name="fas fa-coins"
            :size=" '3em'"
        />
    <div style="min-width: 300px">
      <q-input
        outlined
        dark
        class="q-mb-lg text-body1"
        type="email"
        v-model="formData.email"
        placeholder="Email"
        name="email"/>
      <q-input
        outlined
        dark
        class="q-mb-lg text-body1"
        type="password"
        v-model="formData.password"
        placeholder="Password"
        name="password"/>
      <div class="flex justify-center">
      <q-btn
        class="btn text-secondary"
        outline
        size="md"
        @click="onSubmit">Login</q-btn>
      <q-btn
        class="btn q-ml-md text-secondary"
        outline
        size="md"
        :to="{path:'/registration'}">Sign Up</q-btn>
      </div>
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
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      formData: {
        email: '',
        password: '',
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
