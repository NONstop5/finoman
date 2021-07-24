<template>
  <q-page class="fit row wrap justify-center items-center content-start">
    <div class="col-10">
      <h4 class="text-primary">
        Wallets
      </h4>
      <div class="flex items-center">
        <q-card
          v-for="card in cards"
          :key="card.name"
          class="text-white q-mr-md"
          style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%);
            max-width: 222px"
        >
          <q-card-section>
            <div class="text-h6">
              {{ card.name }}
            </div>
            <div class="text-subtitle2">
              {{ card.balanse }}
            </div>
          </q-card-section>
        </q-card>
        <q-btn
          round
          color="secondary"
        >
          <q-icon
            name="fas fa-plus"
            :size="'1.5em'"
          />
        </q-btn>
      </div>
      <div class="flex items-center q-mt-xl">
        <div
          v-for="category in categories"
          :key="category.name"
          class="text-center q-mr-lg q-mb-md"
        >
          <q-icon
            :name="category.name"
            :size="'1.5em'"
          />
          <div class="text-h6">
            {{ category.title }}
          </div>
        </div>
        <q-btn
          round
          outline
          color="secondary"
        >
          <q-icon
            name="fas fa-plus"
            :size="'1.5em'"
          />
        </q-btn>
      </div>
      <div class="flex justify-between items-center">
        <h4 class="text-primary">
          Last transaction
        </h4>
        <div
          class="text-secondary cursor-pointer"
        >
          All >
        </div>
      </div>
      <q-card
        v-for="transaction in transactions"
        :key="transaction.name"
        class="bg-dark flex justify-between items-center q-mb-lg"
      >
        <q-item>
          <q-item-section avatar>
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
            <q-item-label>{{ transaction.name }}</q-item-label>
            <q-item-label class="text-secondary">
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
    </div>
    <q-btn
      to="/login"
    >
      Login
    </q-btn>
    <q-btn
      v-if="!user"
      @click="handleLogout"
    >
      Logout
    </q-btn>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PageIndex',
  data() {
    return {
      user: null,
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
  handleLogout() {
    this.$axios.post('/logout', this.login).then(() => {
      this.user = null;
    });
  },
});
</script>

<style lang="scss" scoped>

</style>
