<template>
  <q-page class="row justify-center items-center content-start">
    <div class="col">
      <h4 class="text-primary q-my-sm">
        Summary
      </h4>
      <q-separator
        class="q-mb-lg"
      />
      <div class="row q-mb-lg">
        <div class="row col-10 q-gutter-sm">
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
        </div>
        <div class="col text-right">
          <q-btn
            round
            glossy
            color="secondary"
            @click="openDialog"
          >
            <q-icon
              name="fas fa-plus"
              :size="'1.5em'"
            />
          </q-btn>
        </div>
      </div>
      <q-separator
        class="q-mb-lg"
      />
      <div class="row q-mb-lg">
        <div class="row col-10 q-gutter-sm">
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
        </div>
        <div class="col text-right">
          <q-btn
            round
            glossy
            color="secondary"
            icon="fas fa-plus"
            @click="dialogCategoryAdd"
          />
        </div>
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
        class="q-mb-md"
      >
        <div
          v-if="(transaction.id)"
          class="flex justify-between items-center"
        >
          <q-item>
            <q-item-section avatar>
              <q-avatar>
                <q-icon
                  v-if="transaction.transaction_type_id === 1"
                  class="text-positive"
                  name="fas fa-chevron-up"
                  :size="'1.5em'"
                />
                <q-icon
                  v-else-if="transaction.transaction_type_id === 2"
                  class="text-negative"
                  name="fas fa-chevron-down"
                  :size="'1.5em'"
                />
                <q-icon
                  v-else
                  class="text-grey"
                  name="fas fa-exchange-alt"
                  :size="'1.5em'"
                />
              </q-avatar>
            </q-item-section>
            <q-item-section>
              <q-item-label
                v-if="transaction.transaction_type_id !== transactionType.TRANSFER"
              >
                {{ transaction.category.name }}
              </q-item-label>
              <q-item-label
                v-else
              >
                Transfer
              </q-item-label>
              <q-item-label class="text-secondary">
                {{ transaction.transacted_at }}
              </q-item-label>
            </q-item-section>
          </q-item>
          <q-item>
            <q-item-label
              v-if="transaction.transaction_type_id === transactionType.INCOME"
              class="q-pt-sm text-positive"
            >
              +{{ transaction.amount }} ₽
            </q-item-label>
            <q-item-label
              v-else-if="transaction.transaction_type_id === transactionType.EXPENSE"
              class="q-pt-sm text-negative"
            >
              -{{ transaction.amount }} ₽
            </q-item-label>
            <q-item-label
              v-else
              class="q-pt-sm text-grey"
            >
              {{ transaction.amount }} ₽
            </q-item-label>
          </q-item>
        </div>
      </q-card>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import { mapActions, mapState } from 'vuex';
import DialogCategoryAdd from '../components/appDialog/DialogCategoryAdd.vue';
import DialogWalletAdd from '../components/appDialog/DialogWalletAdd.vue';

const transactionType = {
  INCOME: 1,
  EXPENSE: 2,
  TRANSFER: 3,
};

export default defineComponent({
  name: 'Index',
  data: () => ({
    transactionType,
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
    openDialog() {
      this.$q.dialog({
        component: DialogWalletAdd,
        parent: this,
      });
    },
    dialogCategoryAdd() {
      this.$q.dialog({
        component: DialogCategoryAdd,
        parent: this,
      });
    },
  },
});
</script>

<style lang="scss" scoped>

</style>
