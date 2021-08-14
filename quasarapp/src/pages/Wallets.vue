<template>
  <q-page class="row justify-center items-center content-start">
    <div class="col">
      <div class="row">
        <h4 class="text-primary q-my-sm">
          Wallets
        </h4>
      </div>
      <q-separator
        class="q-mb-sm"
      />
      <q-tabs
        v-model="selectedWalletType"
        class="bg-grey-2 text-teal"
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
        >
          <div class="row items-center q-gutter-sm q-mb-lg">
            <q-card
              v-for="wallet in wallets.filter((wallet) => wallet.wallet_type_id === toggleOption.id)"
              :key="wallet.id"
              class="text-center bg-primary glossy text-white q-pa-xs"
            >
              <q-icon
                :name="wallet.icon"
                :size="'1.5em'"
              />
              <div class="text-subtitle2">
                {{ wallet.name }}
              </div>
            </q-card>
          </div>
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
        />
      </q-page-sticky>
    </div>
  </q-page>
</template>

<script>
import {
  mapActions,
  mapState,
} from 'vuex';

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
  data: () => ({
    selectedWalletType: 'debit',
    toggleOptions,
  }),
  computed: {
    ...mapState('user', ['wallets']),
  },
  async created() {
    await this.loadInfo();
  },
  methods: {
    ...mapActions('user', ['getWalletsAction']),
    async loadInfo() {
      await this.getWalletsAction();
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
