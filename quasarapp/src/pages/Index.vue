<template>
  <q-page class="flex flex-center text-primary">
    <h1>FinoMan</h1>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  name: 'PageIndex',
  setup() {
    axios
      .get('/sanctum/csrf-cookie')
      .then(() => {
        console.log(`>>> ${document.cookie}`);
      });
  },
});
</script>
