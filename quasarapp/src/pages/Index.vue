<template>
  <q-page class="row justify-center items-center content-start">
    <div class="col">
      <h4 class="text-primary q-my-sm">
        Summary
      </h4>
      <q-separator
        class="q-mb-lg"
      />
      <div class="flex items-center q-gutter-sm q-mb-lg">
        <q-card
          v-for="wallet in wallets"
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
        <q-space />
        <q-btn
          round
          color="secondary"
          icon="fas fa-plus"
        />
      </div>
      <q-separator
        class="q-mb-lg"
      />
      <div class="flex items-center q-gutter-sm q-mb-lg">
        <q-card
          v-for="category in categories"
          :key="category.id"
          class="text-center q-pa-xs"
        >
          <q-icon
            :name="category.icon"
            :size="'1.5em'"
          />
          <div class="text-subtitle2">
            {{ category.name }}
          </div>
        </q-card>
        <q-space />
        <q-btn
          round
          color="secondary"
          icon="fas fa-plus"
        />
      </div>
      <q-separator
        class="q-mb-lg"
      />
      <h5 class="text-primary q-mb-sm q-mt-none">
        Last transaction
      </h5>
      <q-card
        v-for="transaction in transactions"
        :key="transaction.id"
        flat
        bordered
        class="flex justify-between items-center q-mb-sm"
      >
        <q-item>
          <q-item-section avatar>
            <q-avatar>
              <q-icon
                v-if="transaction.spending"
                class="text-negative"
                name="fas fa-chevron-up"
                :size="'1.5em'"
              />
              <q-icon
                v-else
                class="text-positive"
                name="fas fa-chevron-down"
                :size="'1.5em'"
              />
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ transaction.name }}</q-item-label>
            <q-item-label class="text-secondary">
              {{ transaction.date }}
            </q-item-label>
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-label
            v-if="transaction.spending"
            class="q-pt-sm text-negative"
          >
            -{{ transaction.price }} ₽
          </q-item-label>
          <q-item-label
            v-else
            class="q-pt-sm text-positive"
          >
            +{{ transaction.price }} ₽
          </q-item-label>
        </q-item>
      </q-card>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import {
  mapActions,
  mapState,
} from 'vuex';

export default defineComponent({
  name: 'Index',
  data: () => ({
    wallets: [
      {
        id: 1,
        name: 'Cash',
        icon: 'fas fa-wallet',
      },
      {
        id: 2,
        name: 'Card VTB',
        icon: 'fas fa-credit-card',
      },
      {
        id: 3,
        name: 'Card SBER',
        icon: 'fas fa-credit-card',
      },
    ],
    categories: [
      {
        id: 1,
        name: 'Food',
        icon: 'fas fa-shopping-cart',
      },
      {
        id: 2,
        name: 'Pets',
        icon: 'fas fa-paw',
      },
      {
        id: 3,
        name: 'Transport',
        icon: 'fas fa-car',
      },
    ],
    transactions: [
      {
        id: 1,
        name: 'Food',
        date: '10 Jan, 10:55',
        price: 1500,
        spending: true,
      },
      {
        id: 2,
        name: 'Transport',
        date: '10 Jan, 10:55',
        price: 1500,
        spending: false,
      },
      {
        id: 3,
        name: 'Pets',
        date: '10 Jan, 10:55',
        price: 1500,
        spending: false,
      },
      {
        id: 4,
        name: 'Food',
        date: '10 Jan, 10:55',
        price: 1500,
        spending: true,
      },
      {
        id: 5,
        name: 'Transport',
        date: '10 Jan, 10:55',
        price: 1500,
        spending: false,
      },
    ],
  }),
  computed: {
    ...mapState('user', ['wallets', 'categories', 'transactions']),
  },
  async created() {
    await this.loadInfo();
  },
  methods: {
    ...mapActions('user', ['getWalletsAction', 'getCategoriesAction', 'getTransactionsAction']),
    async loadInfo() {
      await this.getWalletsAction();
      await this.getCategoriesAction();
      await this.getTransactionsAction();
    },
  },
});
</script>

<style lang="scss" scoped>

</style>
