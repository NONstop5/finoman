<template>
  <q-page class="fit row wrap justify-center items-center content-start">
    <profile-dialog />
    <div class="col-10">
      <h4 class="text-primary">
        Wallets
      </h4>
      <div class="flex items-center">
        <q-card
          v-for="wallet in wallets"
          :key="wallet.id"
          class="text-white q-mr-md"
          style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%);
            max-width: 222px"
        >
          <q-card-section>
            <div class="text-h6">
              {{ wallet.name }}
            </div>
            <div class="text-subtitle2">
              {{ wallet.balance }}
            </div>
          </q-card-section>
        </q-card>
        <q-btn
          round
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
      <div class="flex items-center q-mt-xl">
        <div
          v-for="category in categories"
          :key="category.id"
          class="text-center q-mr-lg q-mb-md"
        >
          <q-icon
            :name="category.name"
            :size="'1.5em'"
          />
          <div class="text-h6">
            {{ category.budget }}
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
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import { mapActions, mapState } from 'vuex';
import { useQuasar } from 'quasar';
import DialogForm from '../components/appDialog/DialogForm.vue';
// import DialogForm from '../components/appDialog/DialogForm.vue';

export default defineComponent({
  name: 'PageIndex',
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
