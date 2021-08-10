<template>
  <div class="fullscreen bg-dark text-white text-center q-pa-md flex flex-center">
    <div class="column justify-around">
      <div
        class="text-secondary text-h4"
      >
        Your Logo can be here...
      </div>
      <div
        style="font-size: 10em"
        text-color="info"
      >
        404
      </div>

      <div
        class="text-h6"
        style="opacity:.4"
      >
        Oops. Nothing here... Try to Login first?
      </div>

      <div class="row justify-around">
        <q-btn
          class="q-mt-xl"
          color="dark"
          text-color="positive"
          unelevated
          outline
          to="/login"
          label="Log in"
          no-caps
        />
        <q-btn
          class="q-mt-xl"
          color="white"
          text-color="positive"
          no-caps
          outline
          unelevated
          to="/registration"
          label="Sign up"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'Error404',
});
</script>
