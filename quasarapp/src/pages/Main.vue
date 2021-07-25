<template>
  <q-page class="flex flex-center column">
    <h1>FinoMan</h1>
    <div>
      <q-btn
        class="btn text-secondary"
        outline
        size="md"
        :to="{path:'/login'}"
      >
        Login
      </q-btn>
      <q-btn
        class="btn q-ml-md text-secondary"
        outline
        size="md"
        :to="{path:'/registration'}"
      >
        Sign Up
      </q-btn>
      <q-btn
        v-if="!user"
        @click="handleLogout"
      >
        Logout
      </q-btn>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PageIndex',
  data: () => ({
    user: null,
  }),
  methods: {
    handleLogout() {
      this.$axios.post('/logout', this.login).then(() => {
        this.user = null;
      });
    },
  },
});
</script>

<style lang="scss" scoped>
.btn:hover {
  background: $positive !important;
  transition: 0.4;
}
</style>
