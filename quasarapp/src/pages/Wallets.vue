<template>
  <q-page class="row justify-center items-center content-start">
    <div class="col">
       <q-pull-to-refresh @refresh='refresh'>
      <div class="row">
        <h4 class="text-primary q-my-sm">
          Wallets
          <h4 v-if="!wallets[0]">Pull-down to Refresh</h4>
        </h4>
      </div>
      <q-separator
        class="q-mb-sm"
      />
      <q-tabs
        v-model="selectedWalletType"
        class="bg-grey-2 text-teal q-mb-sm"
        dense
        align="justify"
      >
        <q-tab
          v-for="toggleOption in toggleOptions"
          :key="toggleOption.id"
          :name="toggleOption.name"
          :label="toggleOption.label"
          :icon="toggleOption.icon"
        />
      </q-tabs>
      <q-tab-panels
        v-model="selectedWalletType"
        animated
      >
        <q-tab-panel
          v-for="toggleOption in toggleOptions"
          :key="toggleOption.id"
          :name="toggleOption.name"
          class="q-pa-none"
        >
          <q-list
            bordered
            separator
          >
            <q-slide-item
              v-for="wallet in wallets.filter((wallet) => wallet.wallet_type_id === toggleOption.id)"
              :key="wallet.id"
              left-color="green"
              right-color="red"
              @left="onEdit"
              @right="onDelete"
            >
              <template #left>
                <q-icon name="edit" />
              </template>
              <template #right>
                <q-icon name="delete" />
              </template>

              <q-item>
                <q-item-section avatar>
                  <q-avatar
                    color="primary"
                    text-color="white"
                    :icon="wallet.icon"
                  />
                </q-item-section>
                <q-item-section>
                  {{ wallet.name }}
                </q-item-section>
              </q-item>
            </q-slide-item>
          </q-list>
        </q-tab-panel>
      </q-tab-panels>

      <q-page-sticky
        position="bottom-right"
        :offset="[18, 18]"
      >
        <q-btn
          fab
          icon="fas fa-plus"
          color="secondary"
          padding="sm"
          glossy
          @click="openDialog"
        />
      </q-page-sticky>
      </q-pull-to-refresh>
    </div>
  </q-page>
</template>

<script>
import {
  mapActions,
  mapState,
} from 'vuex';
import DialogWalletAdd from '../components/appDialog/DialogWalletAdd.vue';

const walletType = {
  DEBIT: 1,
  CREDIT: 2,
};

const toggleOptions = [
  {
    id: walletType.DEBIT,
    name: 'debit',
    label: 'Debit',
    icon: 'add_circle',
  },
  {
    id: walletType.CREDIT,
    name: 'credit',
    label: 'Credit',
    icon: 'remove_circle',
  },
];

export default {
  name: 'Wallets',
  setup: () => ({
    
  }),
  data: () => ({
    selectedWalletType: 'debit',
    toggleOptions,
    
  }),
  computed: {
    ...mapState('user', ['wallets']),
  },
  methods: {
    ...mapActions('user', ['getWalletsAction']),
    openDialog() {
      this.$q.dialog({
        component: DialogWalletAdd,
        parent: this,
      });
    },
    onEdit({ reset }) {
      reset();
    },
    onDelete({ reset }) {
      reset();
    },
    async refresh(done) {
      await this.getWalletsAction();
      done();
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
