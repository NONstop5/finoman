<template align="center">
  <div v-if="user">
    <h1>Hi</h1>
    <div v-for="secret in secrets" :key="secret.id">
      <p v-text="secret.secret"></p>
    </div>
    <button @click="getSecrets">Get my secrets</button>
    <br />
    <button @click="getToken">Get my token</button>
    <br />
    <input type="text" disabled v-model="token" />
    <br />
    <button @click="handleLogout">Logout</button>
  </div>
  <div v-else>
    <span v-if="loggedIn">Successfully logged in</span><br />
    <input
      type="email"
      v-model="login.email"
      placeholder="Email"
      name="email"
    /><br />
    <input
      type="password"
      v-model="login.password"
      placeholder="Password"
      name="password"
    /><br />
    <button @click="handleLogin">Login</button>
  </div>
</template>

<script>
import axios from 'axios';
import { API_LOGIN_URL } from '../data/auth';

export default {
  name: 'Login',
  data() {
    return {
      secrets: [],
      user: null,
      login: {
        email: '',
        password: '',
      },
      token: '',
    };
  },
  created() {
    axios.get('/sanctum/csrf-cookie').then(() => {
      this.getUser();
    });
  },
  methods: {
    sendForm() {
      if (this.pending === false) {
        this.pending = true;
        axios
          .post(API_LOGIN_URL, this.form)
          .then(() => {
            this.loggedIn = true;
          })
          .catch(() => {})
          .then(() => {
            this.pending = false;
          });
      }
    },
    getUser() {
      axios.get('/api/user').then((response) => {
        this.user = response.data;
      });
    },
    handleLogin() {
      axios.post('/login', this.login).then(() => {
        this.getUser();
      });
    },
    getSecrets() {
      axios.get('/api/secrets').then((response) => {
        this.secrets = response.data;
      });
    },
    getToken() {
      axios
        .post('/api/tokens/create', {
          token_name: 'My token',
        })
        .then((response) => {
          this.token = response.data.token;
        });
    },
    handleLogout() {
      axios.post('/logout', this.login).then(() => {
        this.user = null;
      });
    },
  },
};
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
