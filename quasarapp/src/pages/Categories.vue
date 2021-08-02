<template>
  <q-page class="row justify-center items-center content-start">
    <div class="col">
      <h4 class="text-primary q-my-sm">
        Categories
      </h4>
      <q-separator
        class="q-mb-lg"
      />
      <div>
        <q-card
          v-for="category in categories"
          :key="category.id"
          flat
          class="flex justify-start items-center q-mb-sm"
        >
          <q-icon
            :name="category.icon"
            :size="'1.5em'"
            @click="click"
          />
          <div class="q-ml-lg">
            <div class="text-subtitle2">
              {{ category.name }}
            </div>
            <div class="text-subtitle2">
              {{ showDate(category.created_at) }}
            </div>
          </div>
        </q-card>
        <q-space />
      </div>
    </div>
  </q-page>
</template>

<script>
import {
  mapActions,
  mapState,
} from 'vuex';
import { date } from 'quasar';

export default {
  name: 'Categories',
  data: () => ({}),
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
    showDate(dt) {
      const timeStamp = new Date(dt);
      return date.formatDate(timeStamp, 'YYYY-MM-DD HH:mm');
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
