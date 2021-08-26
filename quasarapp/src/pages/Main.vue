<template>
  <q-page class="flex flex-center column">
    <h1>FinoMan</h1>
    <div>
      <q-btn
        class="btn text-secondary"
        outline
        size="md"
        to="/login"
      >
        Login
      </q-btn>
      <q-btn
        class="btn q-ml-md text-secondary"
        outline
        size="md"
        to="/register"
      >
        Sign Up
      </q-btn>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'Main',
});
</script>

<style lang="scss" scoped>
.btn:hover {
  background: $positive !important;
  transition: 0.4;
}
</style>
