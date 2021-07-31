<template>
  <q-page class="flex column ">
    <div class="flex justify-between items-center q-ma-lg">
      <span class="text-h5">History: {{ date }}</span>
      <q-btn
        icon="event"
        round
        size="lg"
        color="info"
      >
        <q-popup-proxy
          transition-show="scale"
          transition-hide="scale"
          @before-show="updateProxy"
        >
          <q-date
            v-model="proxyDate"
            color="secondary"
            class="text-secondary"
          >
            <div
              class="row items-center justify-end q-gutter-sm"
            >
              <q-btn
                v-close-popup
                label="Cancel"
                color="secondary"
                flat
              />
              <q-btn
                v-close-popup
                label="OK"
                color="secondary"
                flat
                @click="save"
              />
            </div>
          </q-date>
        </q-popup-proxy>
      </q-btn>
    </div>
    <div class="text-center q-my-lg">
      <q-circular-progress
        show-value
        font-size="10px"
        class="q-ma-md"
        value="100"
        size="280px"
        color="light-blue"
        track-color="grey-3"
      >
        <div
          size="220px"
          class="flex column"
        >
          <div
            class="text-h4 text-positive"
          >
            5000  ₽
          </div>
          <div
            class="text-h5"
          >
            January
          </div>
        </div>
      </q-circular-progress>
    </div>
    <q-card
      v-for="transaction in transactions"
      :key="transaction.name"
      class="bg-dark flex justify-between items-center q-mb-lg"
    >
      <q-item>
        <q-item-section
          avatar
        >
          <q-avatar>
            <q-icon
              v-if="transaction.spending"
              name="fas fa-chevron-down"
              :size="'1.5em'"
            />
            <q-icon
              v-else
              name="fas fa-chevron-up"
              :size="'1.5em'"
            />
          </q-avatar>
        </q-item-section>
        <q-item-section>
          <q-item-label>
            {{ transaction.name }}
          </q-item-label>
          <q-item-label
            class="text-secondary"
          >
            {{ transaction.date }}
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-item>
        <q-item-label
          v-if="transaction.spending"
          class="q-pt-sm"
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
  </q-page>
</template>

<script>
import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'PageIndex',
  setup() {
    const date = ref('2021/07/29');
    const proxyDate = ref('2021/07/29');

    return {
      date,
      proxyDate,

      updateProxy() {
        proxyDate.value = date.value;
      },

      save() {
        date.value = proxyDate.value;
      },
    };
  },
  data() {
    return {
      cards: [
        {
          name: 'card.name',
          balanse: 'card.balanse',
        },
      ],
      accounts: null,
      categories: [
        {
          title: 'Product',
          name: 'fas fa-hamburger',
        },
        {
          title: 'Product',
          name: 'fas fa-hamburger',
        },
        {
          title: 'Product',
          name: 'fas fa-hamburger',
        },
      ],
      transactions: [
        {
          name: 'Products',
          date: '10 Jan, 10:55',
          price: 1500,
          spending: true,
        },
        {
          name: 'Products',
          date: '10 Jan, 10:55',
          price: 1500,
          spending: false,
        },
      ],
    };
  },
});
</script>
