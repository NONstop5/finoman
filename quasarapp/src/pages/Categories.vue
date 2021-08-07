<template>
  <q-page
    class="row justify-center items-center content-start"
  >
    <div class="col">
      <h4 class="text-primary q-my-sm">
        Categories
      </h4>
      <q-separator
        class="q-mb-lg"
      />
        <div
          style="padding-bottom: 225px;"
        >
          <q-btn-toggle
            v-model="model"
            class="q-mb-lg"
            color="secondary"
            toggle-color="negative"
            :options="[
              {label: 'Income', value: 1},
              {label: 'Outcome', value: 2},
            ]"
        />
        <q-card
          v-for="category in categories"
          :key="category.id"
          flat
        >
          <div
            v-if="category.category_type_id === model"
            class="flex justify-start items-center q-mb-sm"
            >
            <q-icon
              :name="category.icon"
              :size="'1.5em'"
            />
            <div
              v-if="!idButtons.some(id => id == category.id)"
              class="text-subtitle2 q-ml-lg"
            >
              {{ category.name }}
            </div>
            <q-input
              v-if="idButtons.some(id => id == category.id)"
              @blur="closeChangeMode(category.id)"
              autofocus
              v-model="changeName"
              :rules="[ val => val && val.length > 0 || 'Please type something']"
              class="text-secondary q-mt-md"
              outlined
              label="Name"
            />
            <q-btn
              v-if="!idButtons.some(id => id == category.id)"
              @click="openChangeMode(category.id)"
              round
              color="primary"
              size="xs"
              class="q-ml-lg"
              icon="edit"
            />
          </div>
        </q-card>
        <q-fab
          v-model="fab2"
          label="Add new"
          vertical-actions-align="left"
          color="purple"
          icon="keyboard_arrow_down"
          direction="down"
          class="q-mt-md"
        >
        <q-form
          @submit="onSubmit"
        >
          <div style="width: 300px">
            <q-select
              v-model="opt"
              class="text-secondary"
              outlined
              :options="options"
              label="Select category"
            />
          </div>
          <div>
            <q-input
              v-model="text"
              :rules="[ val => val && val.length > 0 || 'Please type something']"
              class="text-secondary q-mt-md"
              outlined
              label="Name"
            />
          </div>
          <div>
            <q-btn
              label="Submit"
              type="submit"
              color="secondary"
            />
          </div>
        </q-form>
        </q-fab>
        <q-space />
      </div>
    </div>
  </q-page>
</template>

<script>
import { ref } from 'vue';
import {
  mapActions,
  mapState,
} from 'vuex';
import axios from 'axios';

export default {
  name: 'Categories',
  data() {
    return {
      changeMode: false,
      idButtons: [],
    };
  },
  setup() {
    return {
      model: ref(1),
      fab2: ref(true),
      text: ref(null),
      changeName: ref(null),
      opt: ref(null),
      options: [
        { label: 'Income', value: 1 },
        { label: 'Outcome', value: 2 },
      ],
    };
  },
  computed: {
    ...mapState('user', ['categories']),
  },
  async created() {
    await this.loadInfo();
    console.log(this.categories);
  },
  methods: {
    ...mapActions('user', ['getCategoriesAction', 'updateCategoryAction']),
    async loadInfo() {
      await this.getCategoriesAction();
    },
    async updateCategory(category) {
      await this.updateCategoryAction(category);
      const response = await axios.get('api/categories');
      console.log(response);
    },
    onSubmit() {
      // console.log(this.text);
      // console.log(this.opt.value);
      this.fab2 = false;
    },
    openChangeMode(id) {
      this.idButtons = [...this.idButtons, id];
    },
    closeChangeMode(id) {
      this.idButtons = [];
      const ex = {
        ...this.categories[id - 1],
        name: this.changeName,
      };
      this.updateCategory(ex);
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
