<template align="center">
  <div class="text-center container q-mx-auto q-mt-xl">
    <h1 class="text-h2 q-mb-lg">Finoman</h1>
   <q-icon class="q-mb-lg"
            name="fas fa-coins"
            :size=" '3em'"
        />
    <span v-if="loggedIn">Successfully logged in</span>
    <input class="full-width no-outline rounded-borders q-mb-lg q-py-sm q-px-md text-body1" type="email" v-model="login.email" placeholder="Email" name="email">
    <span  v-if="err">Uncorrect password</span>
    <input class="full-width no-outline rounded-borders q-mb-lg q-py-sm q-px-md text-body1" type="password" v-model="login.password" placeholder="Password" name="password">
    <div class="flex justify-between">
    <q-btn class="btn cursor-pointer" @click="handleLogin">Login</q-btn>
    <q-btn class="btn cursor-pointer" :to="{path:'/registration'}">Sign Up</q-btn>
    </div>
  </div>
</template>

 <style lang="scss" scoped>
  .container {
    max-width: 335px;
  }
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
input {
    color: $primary;
    border: 1px solid $secondary;
    background-color: transparent;
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
