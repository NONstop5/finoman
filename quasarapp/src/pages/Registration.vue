<template align="center">
  <div>
    <span v-if="registered">Successfully registered</span><br />
    <input type="text" v-model="form.name" placeholder="Name" /><br />
    <input type="text" v-model="form.email" placeholder="Email" /><br />
    <input
      type="password"
      v-model="form.password"
      placeholder="Password"
    /><br />
    <input
      type="password"
      v-model="form.password_confirmation"
      placeholder="Password Confirmation"
    /><br />
    <button @click="sendForm" :disabled="pending">Registration</button>
  </div>
</template>

<script>
import axios from "axios";
import { API_REGISTRATION_URL } from "../data/auth";

export default {
  name: "Registration",
  data() {
    return {
      pending: false,
      registered: false,
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
    };
  },
  methods: {
    sendForm() {
      if (this.pending === false) {
        this.pending = true;
        axios
          .post(API_REGISTRATION_URL, this.form)
          .then((response) => {
            this.registered = true;
          })
          .catch((errors) => {})
          .then(() => {
            this.pending = false;
          });
      }
    },
  },
};
</script>

<!--<template>-->
<!--  <q-page-->
<!--    class="window-height window-width row justify-center items-center"-->
<!--    style="background: linear-gradient(#8274C5, #5A4A9F);"-->
<!--  >-->
<!--&lt;!&ndash;    <div class="column q-pa-lg">&ndash;&gt;-->
<!--&lt;!&ndash;      <div class="row">&ndash;&gt;-->
<!--&lt;!&ndash;        <q-card square class="shadow-24" style="width:300px;height:485px;">&ndash;&gt;-->
<!--&lt;!&ndash;          <q-card-section class="bg-deep-purple-7">&ndash;&gt;-->
<!--&lt;!&ndash;            <h4 class="text-h5 text-white q-my-md">Company &amp; Co</h4>&ndash;&gt;-->
<!--&lt;!&ndash;            <div class="absolute-bottom-right q-pr-md" style="transform: translateY(50%);">&ndash;&gt;-->
<!--&lt;!&ndash;              <q-btn fab icon="add" color="purple-4" />&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--&lt;!&ndash;          </q-card-section>&ndash;&gt;-->
<!--&lt;!&ndash;          <q-card-section>&ndash;&gt;-->
<!--&lt;!&ndash;            <q-form class="q-px-sm q-pt-xl">&ndash;&gt;-->
<!--&lt;!&ndash;              <q-input square clearable v-model="email" type="email" label="Email">&ndash;&gt;-->
<!--&lt;!&ndash;                <template v-slot:prepend>&ndash;&gt;-->
<!--&lt;!&ndash;                  <q-icon name="email" />&ndash;&gt;-->
<!--&lt;!&ndash;                </template>&ndash;&gt;-->
<!--&lt;!&ndash;              </q-input>&ndash;&gt;-->
<!--&lt;!&ndash;              <q-input square clearable v-model="password" type="password" label="Password">&ndash;&gt;-->
<!--&lt;!&ndash;                <template v-slot:prepend>&ndash;&gt;-->
<!--&lt;!&ndash;                  <q-icon name="lock" />&ndash;&gt;-->
<!--&lt;!&ndash;                </template>&ndash;&gt;-->
<!--&lt;!&ndash;              </q-input>&ndash;&gt;-->
<!--&lt;!&ndash;            </q-form>&ndash;&gt;-->
<!--&lt;!&ndash;          </q-card-section>&ndash;&gt;-->
<!--&lt;!&ndash;          <q-card-section>&ndash;&gt;-->
<!--&lt;!&ndash;            <div class="text-center q-pa-md q-gutter-md">&ndash;&gt;-->
<!--&lt;!&ndash;              <q-btn round color="indigo-7">&ndash;&gt;-->
<!--&lt;!&ndash;                <q-icon name="fab fa-facebook-f" size="1.2rem" />&ndash;&gt;-->
<!--&lt;!&ndash;              </q-btn>&ndash;&gt;-->
<!--&lt;!&ndash;              <q-btn round color="red-8">&ndash;&gt;-->
<!--&lt;!&ndash;                <q-icon name="fab fa-google-plus-g" size="1.2rem" />&ndash;&gt;-->
<!--&lt;!&ndash;              </q-btn>&ndash;&gt;-->
<!--&lt;!&ndash;              <q-btn round color="light-blue-5">&ndash;&gt;-->
<!--&lt;!&ndash;                <q-icon name="fab fa-twitter" size="1.2rem" />&ndash;&gt;-->
<!--&lt;!&ndash;              </q-btn>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--&lt;!&ndash;          </q-card-section>&ndash;&gt;-->
<!--&lt;!&ndash;          <q-card-actions class="q-px-lg">&ndash;&gt;-->
<!--&lt;!&ndash;            <q-btn unelevated size="lg" color="purple-4" class="full-width text-white" label="Sign In" />&ndash;&gt;-->
<!--&lt;!&ndash;          </q-card-actions>&ndash;&gt;-->
<!--&lt;!&ndash;          <q-card-section class="text-center q-pa-sm">&ndash;&gt;-->
<!--&lt;!&ndash;            <p class="text-grey-6">Forgot your password?</p>&ndash;&gt;-->
<!--&lt;!&ndash;          </q-card-section>&ndash;&gt;-->
<!--&lt;!&ndash;        </q-card>&ndash;&gt;-->
<!--&lt;!&ndash;      </div>&ndash;&gt;-->
<!--&lt;!&ndash;    </div>&ndash;&gt;-->
<!--        <div class="column q-pa-lg">-->
<!--          <div class="row">-->
<!--            <q-card square class="shadow-24" style="width:300px;height:485px;">-->
<!--              <q-card-section class="bg-deep-purple-7">-->
<!--                <h4 class="text-h5 text-white q-my-md">Registration</h4>-->
<!--                <div class="absolute-bottom-right q-pr-md" style="transform: translateY(50%);">-->
<!--                  <q-btn fab icon="close" color="purple-4" />-->
<!--                </div>-->
<!--              </q-card-section>-->
<!--              <q-card-section>-->
<!--                <q-form class="q-px-sm q-pt-xl q-pb-lg">-->
<!--                  <q-input square clearable v-model="email" type="email" label="Email">-->
<!--                    <template v-slot:prepend>-->
<!--                      <q-icon name="email" />-->
<!--                    </template>-->
<!--                  </q-input>-->
<!--                  <q-input square clearable v-model="username" type="username" label="Username">-->
<!--                    <template v-slot:prepend>-->
<!--                      <q-icon name="person" />-->
<!--                    </template>-->
<!--                  </q-input>-->
<!--                  <q-input square clearable v-model="password" type="password" label="Password">-->
<!--                    <template v-slot:prepend>-->
<!--                      <q-icon name="lock" />-->
<!--                    </template>-->
<!--                  </q-input>-->
<!--                </q-form>-->
<!--              </q-card-section>-->
<!--              <q-card-actions class="q-px-lg">-->
<!--                <q-btn unelevated size="lg" color="purple-4" class="full-width text-white" label="Get Started" />-->
<!--              </q-card-actions>-->
<!--              <q-card-section class="text-center q-pa-sm">-->
<!--                <p class="text-grey-6">Return to login</p>-->
<!--              </q-card-section>-->
<!--            </q-card>-->
<!--          </div>-->
<!--        </div>-->
<!--  </q-page>-->
<!--</template>-->

<!--<script>-->
<!--import { defineComponent } from 'vue'-->
<!--import axios from 'axios';-->
<!--export default {-->
<!--  name: 'Login',-->
<!--  data () {-->
<!--    return {-->
<!--      email: '',-->
<!--      username: '',-->
<!--      password: ''-->
<!--    }-->
<!--  },-->
<!--  methods: {-->
<!--    fetchData() {-->
<!--      // this.error = this.users = null;-->
<!--      // this.loading = true;-->
<!--      axios-->
<!--        .get('/api/test')-->
<!--        .then(response => {-->
<!--          console.log(response);-->
<!--        });-->
<!--    }-->
<!--  }-->
<!--}-->
<!--</script>-->

<!--<style>-->
<!--</style>-->
