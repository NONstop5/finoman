<template align="center">
  <div class="text-center column content-center q-mt-xl">
    <div style="min-width: 300px">
      <span v-if="registered">Successfully registered</span><br>
      <q-input
        v-model="form.name"
        outlined
        dark
        class="q-mb-lg text-body1"
        type="text"
        placeholder="Name"
      />
      <q-input
        v-model="form.email"
        outlined
        dark
        class="q-mb-lg text-body1"
        type="text"
        placeholder="Email"
      />
      <q-input
        v-model="form.password"
        outlined
        dark
        class="q-mb-lg text-body1"
        type="password"
        placeholder="Password"
      />
      <q-input
        v-model="form.password_confirmation"
        outlined
        dark
        class="q-mb-lg text-body1"
        type="password"
        placeholder="Password Confirmation"
      />
      <q-btn
        class="btn text-secondary"
        outline
        size="md"
        :disabled="pending"
        @click="sendForm"
      >
        Sign up
      </q-btn>
    </div>
  </div>
</template>

<script>
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
</style>
