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
          glossy
          color="secondary"
          label="Add Wallet"
          @click="openDialog"
        >
          <q-icon
            name="fas fa-plus"
            :size="'1.5em'"
          />
        </q-btn>
      </div>
      <q-separator
        class="q-mb-lg"
      />
      <div class="flex items-center q-gutter-sm q-mb-lg">
        <q-card
          v-for="category in categories"
          :key="category.id"
          class="text-center q-mr-lg q-mb-md"
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
          glossy
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
                v-if="transaction.transaction_type.id === transactionType.INCOME"
                class="text-positive"
                name="fas fa-chevron-down"
                :size="'1.5em'"
              />
              <q-icon
                v-else-if="transaction.transaction_type.id === transactionType.EXPENSE"
                class="text-negative"
                name="fas fa-chevron-up"
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
              v-if="transaction.transaction_type.id !== transactionType.TRANSFER"
            >
              {{ transaction.category.name }}
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
      </q-card>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import { mapActions, mapState } from 'vuex';
import { useQuasar } from 'quasar';
import DialogForm from '../components/appDialog/DialogForm.vue';

export default defineComponent({

  name: 'Index',
  data: () => ({
    transactionType,
  }),

  const transactionType = {
    INCOME: 1,
    EXPENSE: 2,
    TRANSFER: 3,
  };

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
    async openDialog() {
      const $q = useQuasar();
      $q.dialog({
        component: DialogForm,
        parent: this,
        componentProps: {
          text: 'something',
          // ...more..props...
        },
      }).onOk(() => {
        console.log('OK');
        // place where data should be sent to API
      }).onCancel(() => {
        console.log('Cancel');
      }).onDismiss(() => {
        console.log('Called on OK or Cancel'); // DELETE CONSOLE AFTER UPDATE WITH FORM VERIFICATION
      });
    },
  },
});
</script>

<style lang="scss" scoped>

</style>
