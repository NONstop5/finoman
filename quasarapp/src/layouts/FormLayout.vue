<template>
  <q-layout view="hHh lpR fFf">
    <q-header
      elevated
    >
      <div class="row justify-center" />
      <q-toolbar v-if="loggedIn">
        <q-icon
          class="q-mr-sm"
          name="fas fa-coins"
          size="1.5rem"
        />
        <q-toolbar-title>
          Finoman
        </q-toolbar-title>
        <q-toggle
          v-model="isDarkMode"
          color="white"
          icon-color="black"
          checked-icon="light_mode"
          unchecked-icon="dark_mode"
          :model-value="false"
          @update:model-value="toggleDarkMode"
        />
        <q-space />
        <div class="q-mr-sm text-bold text-no-wrap">
          {{ details.name }}
        </div>
        <q-separator
          class="q-mr-sm"
          vertical
          inset="true"
          color="white"
        />
        <q-btn
          flat
          dense
          size="sm"
          @click="onSubmit"
        >
          <q-icon
            name="fas fa-sign-out-alt"
          />
        </q-btn>
      </q-toolbar>
    </q-header>

    <q-page-container class="q-px-md">
      <router-view />
    </q-page-container>

    <q-footer
      v-if="loggedIn"
      class="text-center"
      elevated
    >
      <q-tabs class="row justify-center">
        <q-route-tab
          to="/index"
          label="Main"
          class="col"
        >
          <q-icon
            name="fas fa-home"
            :size="$q.screen.gt.sm ? '3em' : '1.5em'"
          />
        </q-route-tab>
        <q-route-tab
          to="/wallets"
          label="Wallets"
          class="col"
        >
          <q-icon
            name="fas fa-wallet"
            :size="$q.screen.gt.sm ? '3em' : '1.5em'"
          />
        </q-route-tab>
        <q-route-tab
          to="/categories"
          label="Categories"
          class="col"
        >
          <q-icon
            name="fas fa-list"
            :size="$q.screen.gt.sm ? '3em' : '1.5em'"
          />
        </q-route-tab>
        <q-route-tab
          to="/history"
          label="History"
          class="col"
        >
          <q-icon
            name="fas fa-history"
            :size="$q.screen.gt.sm ? '3em' : '1.5em'"
          />
        </q-route-tab>
      </q-tabs>
    </q-footer>
    <q-footer
      v-else
      class="text-center"
      elevated
    >
      Finoman 2021г.
    </q-footer>
    <q-page-sticky
      v-if="$route.path === '/index'"
      position="bottom"
      :offset="[10, 10]"
    >
      <q-btn
        round
        size="lg"
        icon="fas fa-plus"
        color="secondary"
        padding="sm"
        glossy
        @click="newTransaction"
      />
    </q-page-sticky>
  </q-layout>
</template>

<script>
import { Dark } from 'quasar';
import {
  mapActions,
  mapState,
} from 'vuex';
import DialogTransactionAdd from 'src/components/appDialog/DialogTransactionAdd.vue';

export default {
  name: 'FormLayout',
  data: () => ({
    isDarkMode: false,
  }),
  computed: {
    ...mapState('user', ['loggedIn', 'details']),
  },
  methods: {
    ...mapActions('user', ['logout']),
    toggleDarkMode(isDark) {
      Dark.set(isDark);
    },
    onSubmit() {
      this.logout();
    },
    newTransaction() {
      this.$q.dialog({
        component: DialogTransactionAdd,
        parent: this,
      });
    },
  },
};
</script>
