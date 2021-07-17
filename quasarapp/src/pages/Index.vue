<template>
  <q-page class="container main">
    <h3>
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
  .main {
    color: #fff;
    margin-top: 41px;
    span {
      color: #74757A;
      display: block;
    }
    .main-header {
      display: flex;
      justify-content: space-between;
    }
  }
</style>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PageIndex',
  data () {
    return {
      user: {
        balanse: 500000,
        name: "Joy Doe"
      }
    }
  }
})
</script>
