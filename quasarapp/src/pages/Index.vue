<template>
  <q-page class="flex flex-center text-primary">
    <h1>FinoMan</h1>
    <q-btn
      to="/login"
    >
      Login
    </q-btn>
    <q-btn v-if="!user" @click="handleLogout">Logout</q-btn>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PageIndex',
  data: () => ({
    user: null,
  }),
  handleLogout() {
    this.$axios.post('/logout', this.login).then(() => {
      this.user = null;
    });
  },
});
</script>
