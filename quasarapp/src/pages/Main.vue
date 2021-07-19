<template>
  <q-page class="flex flex-center column">
    <h1 >FinoMan</h1>
    <div class="btns-container">
    <q-btn class="btn" :to="{path:'/login'}">Login</q-btn>
    <q-btn class="btn q-ml-md" :to="{path:'/registration'}">Sign Up</q-btn>
    </div>
  </q-page>
</template>
 <style lang="scss" scoped>
  .btn {
    min-width: 150px;
    background-color: transparent;
    border: 1px solid $secondary;
    color: $secondary;
}
.btn:hover {
    background: $positive;
    transition: 0.4;
    border-color: transparent;
}
 </style>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PageIndex',
});
</script>
