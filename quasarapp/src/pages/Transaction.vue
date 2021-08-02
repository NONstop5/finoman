<template>
  <q-page class="container main">
    <h3 class="text-secondary">
      Transaction
    </h3>
    <div class="wallets-container">
      <div class="q-pa-md">
        <q-form
          @submit="onSubmit"
        >
          <q-btn-toggle
            v-model="transaction_types_id"
            color="secondary"
            toggle-color="info"
            :options="[
              {label: 'Income', value: 1},
              {label: 'Transfer', value: 3},
              {label: 'Outcome', value: 2}
            ]"
          />
          <div>
            <q-select
              v-model="model"
              class="text-secondary q-my-lg"
              outlined
              :options="options"
              label="Select category"
              :rules="[ val => val && val.length > 0 || 'Please type something']"
            />
          </div>
          <div>
            <q-input
              v-model="text"
              :rules="[ val => val && val.length > 0 || 'Please type something']"
              class="text-secondary q-my-lg"
              outlined
              label="Value"
            />
          </div>
          <div>
            <q-input
              v-model="date"
              class="text-secondary q-my-lg"
              outlined
              mask="date"
              :rules="['date']"
            >
              <q-icon
                name="event"
                size="md"
                class="cursor-pointer q-pt-md"
              >
                <q-popup-proxy
                  ref="qDateProxy"
                  transition-show="scale"
                  transition-hide="scale"
                >
                  <q-date
                    v-model="date"
                    color="secondary"
                    class="text-secondary"
                  >
                    <div class="row items-center justify-end">
                      <q-btn
                        v-close-popup
                        label="Close"
                        color="secondary"
                        flat
                      />
                    </div>
                  </q-date>
                </q-popup-proxy>
              </q-icon>
            </q-input>
          </div>
          <div>
            <q-btn
              label="Submit"
              type="submit"
              color="secondary"
            />
          </div>
        </q-form>
      </div>
    </div>
    <div />
  </q-page>
</template>

<script>
import { useQuasar } from 'quasar';
import { ref } from 'vue';

export default {
  setup() {
    const $q = useQuasar();
    return {
      transaction_types_id: ref(1),
      model: ref(null),
      text: ref(''),
      date: ref('2019/02/01'),
      options: [
        'Продукты', 'Транспорт', 'Здоровье',
      ],
      onSubmit() {
        $q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Submitted',
        });
      },
    };
  },
};
</script>

<style lang="scss" scoped>

</style>
