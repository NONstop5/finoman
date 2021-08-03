<template>
  <q-layout view="hHh lpR fFf">
    <q-header
      elevated
    >
      <q-toolbar v-if="loggedIn">
        <q-icon
          class="q-mr-sm"
          name="fas fa-coins"
          size="1.5rem"
        />
        <q-toolbar-title>Finoman</q-toolbar-title>
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
      <q-btn
        round
        glossy
        size="lg"
        icon="fas fa-plus"
        color="secondary"
      />
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
  </q-layout>
</template>

<script>
import {
  mapActions,
  mapState,
} from 'vuex';

export default {
  name: 'FormLayout',
  data: () => ({}),
  computed: {
    ...mapState('user', ['loggedIn', 'details']),
  },
  methods: {
    ...mapActions('user', ['logout']),
    onSubmit() {
      this.logout();
    },
  },
};
</script>
