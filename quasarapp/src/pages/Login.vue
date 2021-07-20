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
 <style lang="scss" scoped>
  .btn:hover {
      background: $positive !important;
      transition: 0.4;
  }
 </style>
<script>
import axios from 'axios';
import { API_LOGIN_URL } from '../data/auth';

export default {
  name: 'Login',
  data() {
    return {
      secrets: [],
      err: false,
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
      })
        .then(() => {
          this.$router.push('/index');
        })
        .catch(() => {
          this.err = true;
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
