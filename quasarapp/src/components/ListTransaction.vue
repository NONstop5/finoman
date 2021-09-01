<template>
  <div>
    <q-card
      v-for="transaction in transactions"
      :key="transaction.id"
      flat
      bordered
      class="q-mb-md"
    >
      <div
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
</template>

<script>
import { defineComponent } from 'vue';

const transactionType = {
  INCOME: 1,
  EXPENSE: 2,
  TRANSFER: 3,
};

export default defineComponent({
  name: 'ListTransaction',
  props: {
    transactions: {
      type: Array,
      required: true,
    },
  },
  data: () => ({
    transactionType,
  }),
});
</script>
