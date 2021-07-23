<template align="center">
  <div v-if="user">
    <h1 class="success">Hi</h1>
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
    />
    <br />
    <button @click="handleLogin">Login</button>
  </div>
</template>

<script>
import { API_LOGIN_URL } from '../data/auth';

export default {
  name: 'Login',
  data() {
    return {
      secrets: [],
      user: null,
      login: {
        email: 'dylan82@example.org',
        password: 'password',
      },
      token: '',
    };
  },
  created() {
    this.$axios
      .get('/sanctum/csrf-cookie')
      .then(() => {
        console.log(`>>> ${document.cookie}`);
        this.getUser();
      });
  },
  methods: {
    sendForm() {
      if (this.pending === false) {
        this.pending = true;
        this.$axios
          .post('/654', this.form)
          .then(() => {
            this.loggedIn = true;
          })
          .catch(() => {
          })
          .then(() => {
            this.pending = false;
          });
      }
    },
    getUser() {
      this.$axios
        .get('/api/user')
        .then((response) => {
          this.user = response.data;
        })
        .catch(() => {
          alert('Not auth!');
        });
    },
    handleLogin() {
      this.$axios.post(API_LOGIN_URL, this.login).then(() => {
        console.log('User signed in!');
        this.getUser();
      })
        .catch(() => {
          console.log(`Fail: ${this.login}`);
        });
    },
    getSecrets() {
      this.$axios.get('/api/secrets').then((response) => {
        this.secrets = response.data;
      });
    },
    getToken() {
      this.$axios
        .post('/api/tokens/create', {
          token_name: 'My token',
        })
        .then((response) => {
          this.token = response.data.token;
        });
    },
    handleLogout() {
      this.$axios
        .post('/logout', this.login)
        .then(() => {
          this.user = null;
          console.log('User logout!');
        });
    },
  },
};
</script>

<style scoped>

</style>
