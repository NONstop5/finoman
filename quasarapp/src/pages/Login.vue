<template align="center">
  <div class="text-center column items-center q-mt-xl">
    <h1 class="text-h2 q-mb-lg">Finoman</h1>
   <q-icon class="q-mb-lg"
            name="fas fa-coins"
            :size=" '3em'"
        />
    <div style="min-width: 300px">
      <span v-if="loggedIn">Successfully logged in</span>
      <q-input
        outlined
        dark
        class="q-mb-lg text-body1"
        type="email"
        v-model="login.email"
        placeholder="Email"
        name="email"/>
      <span  v-if="err">Uncorrect password</span>
      <q-input
        outlined
        dark
        class="q-mb-lg text-body1"
        type="password"
        v-model="login.password"
        placeholder="Password"
        name="password"/>
      <div class="flex justify-center">
      <q-btn
        class="btn text-secondary"
        outline
        size="md"
        @click="handleLogin">Login</q-btn>
      <q-btn
        class="btn q-ml-md text-secondary"
        outline
        size="md"
        :to="{path:'/registration'}">Sign Up</q-btn>
      </div>
    </div>
  </div>
</template>

<script>
import { API_LOGIN_URL } from '../data/auth';

export default {
  name: 'Login',
  data() {
    return {
      secrets: [],
      err: false,
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
          .post(API_LOGIN_URL, this.form)
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
        .then(() => {
          this.$router.push('/index');
        })
        .catch(() => {
          this.err = true;
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

<style lang="scss" scoped>
.btn:hover {
  background: $positive !important;
  transition: 0.4;
}
</style>
