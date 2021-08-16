<template>
  <q-page class="container main">
    <h4 class="text-primary q-my-sm">
      Transaction
    </h4>
    <q-separator
      class="q-mb-lg"
    />
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
          <div v-if="transaction_types_id === 1||transaction_types_id ===2">
            <div>
              <q-select
                v-model="model"
                class="text-secondary q-my-lg"
                outlined
                :options="optionsWal"
                label="Select wallet"
                :rules="[ val => val && val.length > 0 || 'Please type something']"
              />
            </div>
            <div>
              <q-select
                v-model="model2"
                class="text-secondary q-my-lg"
                outlined
                :options="optionsCat"
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
                mask="##-##-####"
                :rules="[ val => val && val.length > 9 || 'Incorrect date']"
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
                      v-close-popup
                      color="secondary"
                      class="text-secondary"
                      mask="DD-MM-YYYY"
                    />
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
          </div>
          <div v-if="transaction_types_id === 3">
            <div>
              <q-select
                v-model="model"
                class="text-secondary q-my-lg"
                outlined
                :options="optionsWal"
                label="Select wallet"
                :rules="[ val => val && val.length > 0 || 'Please type something']"
              />
            </div>
            <div>
              <q-select
                v-model="model3"
                class="text-secondary q-my-lg"
                outlined
                :options="optionsWal"
                label="Select wallet"
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
                mask="##-##-####"
                :rules="[ val => val && val.length > 9 || 'Incorrect date']"
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
                      v-close-popup
                      mask="DD-MM-YYYY"
                      color="secondary"
                      class="text-secondary"
                    />
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
      model2: ref(null),
      model3: ref(null),
      text: ref(''),
      date: ref('04-08-2021'),
      optionsCat: [
        'Продукты', 'Транспорт', 'Здоровье',
      ],
      optionsWal: [
        'Сбер', 'ВТБ', 'Тинькоф',
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
