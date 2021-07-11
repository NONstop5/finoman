<template>
  <div>
    <span v-if="loggedIn">Successfully logged in</span><br>
    <input type="text" v-model="form.email" placeholder="Email"><br>
    <input type="password" v-model="form.password" placeholder="Password"><br>
    <button @click="sendForm" :disabled="pending">Login</button>
  </div>
</template>

<script>
import axios from 'axios';
import { API_LOGIN_URL } from '../data/auth';

export default {
  name: 'Login',
  data() {
    return {
      pending: false,
      loggedIn: false,
      form: {
        email: null,
        password: null
      }
    }
  },
  methods: {
    sendForm() {
      if (this.pending === false) {
        this.pending = true;
        axios.post(API_LOGIN_URL, this.form)
          .then(response => {
            this.loggedIn = true;
          })
          .catch(errors => {})
          .then(() => {
            this.pending = false;
          });
      }
    }
  }
}
</script>

<style scoped>

</style>
<!--<template>-->
<!--  <div>-->
<!--    <div v-if="!secrets.length" class="row">-->
<!--      <form action="#" @submit.prevent="handleLogin">-->
<!--        <div class="form-row">-->
<!--          <input type="email" v-model="formData.email">-->
<!--        </div>-->
<!--        <div class="form-row">-->
<!--          <input type="password" v-model="formData.password">-->
<!--        </div>-->
<!--        <div class="form-row">-->
<!--          <button type="submit">Sign In</button>-->
<!--        </div>-->
<!--      </form>-->
<!--    </div>-->
<!--  </div>-->
<!--</template>-->

<!--<script>-->
<!--import { defineComponent } from 'vue'-->
<!--import axios from 'axios';-->
<!--export default {-->
<!--  name: 'Login',-->
<!--  data () {-->
<!--    return {-->
<!--      secrets: [],-->
<!--      formData: {-->
<!--        email: '',-->
<!--        password: ''-->
<!--      }-->
<!--    }-->
<!--  },-->
<!--  methods: {-->
<!--    handleLogin() {-->
<!--      axios.get('/sanctum/csrf-cookie').then(response => {-->
<!--        axios.post('/login', this.formData).then(response => {-->
<!--          console.log('User signed in!');-->
<!--          console.log(this.formData)-->
<!--        }).catch(error => console.log(this.formData)); // credentials didn't match-->
<!--      });-->
<!--    },-->
<!--    getSecrets() {-->
<!--      axios.get('/api/secrets').then(response => this.secrets = response.data);-->
<!--    }-->
<!--  }-->
<!--}-->
<!--</script>-->

<!--<style>-->
<!--</style>-->
