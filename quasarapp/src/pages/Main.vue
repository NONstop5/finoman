<template>
  <q-page class="flex flex-center column">
    <h1 >FinoMan</h1>
    <div class="btns-container">
    <q-btn class="btn" :to="{path:'/login'}">Login</q-btn>
    <q-btn class="btn q-ml-md" :to="{path:'/registration'}">Sign Up</q-btn>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PageIndex',
});
</script>
