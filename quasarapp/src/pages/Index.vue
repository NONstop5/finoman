<template>
  <q-page class="container main">
    <h3 class="text-primary">
      Wallets
    </h3>
    <div class="wallets-container">
      <div class="wallets">

      </div>
    </div>
    <div>

    </div>
  </q-page>
</template>
<style lang="scss" scoped>

</style>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PageIndex',
  data() {
    return {
      user: {
        balance: 500000,
        name: 'Joy Doe',
      },
    };
  },
});
</script>
