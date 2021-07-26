<template>
  <q-layout view="hHh lpR fFf">
    <q-header
      elevated
      class="bg-dark text-primary"
      height-hint="100"
    v-if="loggedIn">
      <q-toolbar class="full-width row justify-between">
        <div class="column absolute-top-left">
          <div class="text-secondary text-body2">
            Total Balance
          </div>
          <div class="text-subtitle2">
            {5000}
          </div>
        </div>
        <q-toolbar-title class="absolute-top-right" v-bind="details">
          {{details.name}}
          <q-btn @click="onSubmit" color="negative">Logout</q-btn>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>

    <q-footer
      elevated
      class="bg-dark text-secondary"
    v-if="loggedIn">
      <div class="fit column">
        <q-btn
          class="self-center"
          align="center"
          to="/transaction"
          outline
          round
          glossy
          color="positive"
          @click="linkClick"
        >
          <q-icon
            name="fas fa-plus-circle"
          />
        </q-btn>
      </div>
      <q-tabs class="row col-12 col-md-auto justify-center">
        <q-route-tab
          to="/"
          label="Home"
          class="col"
        >
          <q-icon
            name="fas fa-home"
            :size="$q.screen.gt.sm ? '3em' : '1.5em'"
          />
        </q-route-tab>
        <q-route-tab
          to="/category"
          label="Category"
          class="col"
        >
          <q-icon
            name="fas fa-list"
            :size="$q.screen.gt.sm ? '3em' : '1.5em'"
          />
        </q-route-tab>
        <q-route-tab
          to="/transaction"
          label="Transaction"
          class="col"
        >
          <q-icon
            name="fas fa-money-check-alt"
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
  </q-layout>
</template>

<script>
import { mapActions, mapState } from 'vuex';

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
