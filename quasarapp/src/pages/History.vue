<template>
  <q-page class="flex column ">
    <div class="flex justify-between items-center q-ma-lg">
      <span class="text-h5">History: {{ getDate(date.from) }} {{ date.to == date.from ? '' : '- ' + getDate(date.to) }}</span>
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
            range
            color="secondary"
            class="text-secondary"
            model-value=""
            @click="save"
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
                @click="getSortTran(date)"
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
        :value="diagramValue"
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
            {{ transactions.total }}  ₽
          </div>
          <div
            class="text-h5"
          >
            {{ getMonth(date) }}
          </div>
        </div>
      </q-circular-progress>
    </div>
    <ListTransaction :transactions="transactions.transactions" />
  </q-page>
</template>

<script>
import { date as qdate } from 'quasar';
import { defineComponent, ref } from 'vue';
import { mapActions, mapState } from 'vuex';
import ListTransaction from '../components/ListTransaction.vue';

export default defineComponent({
  name: 'History',
  components: { ListTransaction },
  setup() {
    const date = ref({ from: Date.now(), to: Date.now() });
    const proxyDate = ref({ from: Date.now(), to: Date.now() });

    return {
      date,
      proxyDate,
      diagramValue: 100,

      updateProxy() {
        proxyDate.value = date.value;
      },

      save() {
        date.value = proxyDate.value;
      },
    };
  },
  computed: {
    ...mapState('user', ['transactions']),
    total() {
      if (this.transactions.transactions.total) {
        return this.transactions.transactions.total.toFixed(2);
      } return '0.00';
    },
  },
  async created() {
    await this.loadInfo();
  },
  methods: {
    ...mapActions('user', ['getTransactionsAction']),
    async loadInfo(date = {}) {
      await this.getTransactionsAction(date);
    },
    getDate(timeStamp) {
      return qdate.formatDate(timeStamp, 'YYYY-MM-DD');
    },
    getMonth(timeStamp) {
      return qdate.formatDate(timeStamp, 'MMMM');
    },
    getSortTran(date) {
      this.loadInfo({
        transacted_at_from: this.getDate(date.from),
        transacted_at_to: this.getDate(date.to),
      });
    },
  },
});
</script>
