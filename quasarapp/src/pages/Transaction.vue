<template>
  <q-page class="container main">
    <h4 class="text-secondary">
      Transaction
    </h4>
    <div class="wallets-container">
    <div class="q-pa-md">
      <q-form
        @submit="onSubmit"
      >
      <q-btn-toggle
        color="secondary"
        v-model="transaction_types_id"
        toggle-color="info"
        :options="[
          {label: 'Income', value: 1},
          {label: 'Transfer', value: 3},
          {label: 'Outcome', value: 2}
        ]"
      />
      <div>
        <q-select
          class="text-secondary q-my-lg"
          outlined
          v-model="model"
          :options="options"
          label="Select category"
          :rules="[ val => val && val.length > 0 || 'Please type something']"
        />
      </div>
      <div>
        <q-input
          :rules="[ val => val && val.length > 0 || 'Please type something']"
          class="text-secondary q-my-lg"
          outlined
          v-model="text"
          label="Value"
        />
      </div>
      <div>
        <q-input
          class="text-secondary q-my-lg"
          outlined
          v-model="date"
          mask="date"
          :rules="['date']"
        >
          <q-icon name="event" size="md" class="cursor-pointer q-pt-md">
            <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
              <q-date
                color="secondary"
                class="text-secondary"
                v-model="date"
              >
                <div class="row items-center justify-end">
                  <q-btn v-close-popup label="Close" color="secondary" flat />
                </div>
              </q-date>
            </q-popup-proxy>
          </q-icon>
      </q-input>
      </div>
       <div>
        <q-btn label="Submit" type="submit" color="secondary"/>
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
