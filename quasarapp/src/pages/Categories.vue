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
      <div>
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
            v-if="category.category_type_id == model"
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
              v-model="changeName"
              autofocus
              :rules="[ val => val && val.length > 0 || 'Please type something']"
              class="text-secondary q-mt-md"
              outlined
              label="Name"
              @blur="closeChangeMode(category.id)"
            />
            <q-btn
              v-if="!idButtons.some(id => id == category.id)"
              round
              color="primary"
              size="xs"
              class="q-ml-lg"
              icon="edit"
              @click="openChangeMode(category.id)"
            />
            <q-btn
              v-if="!idButtons.some(id => id == category.id)"
              round
              color="primary"
              size="xs"
              class="q-ml-lg"
              icon="delete"
              @click="deleteCategory(category.id)"
            />
          </div>
        </q-card>
        <q-btn
          color="secondary"
          label="Add category"
          @click="openDialogCat"
        >
          <q-icon
            name="fas fa-plus"
            :size="'1em'"
            class="q-pl-md"
          />
        </q-btn>
        <q-space />
      </div>
    </div>
    <DialogFormCat />
  </q-page>
</template>

<script>
import { ref } from 'vue';
import {
  mapActions,
  mapState,
} from 'vuex';
import DialogCategoryAdd from '../components/appDialog/DialogCategoryAdd.vue';

export default {
  name: 'Categories',
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
  data() {
    return {
      changeMode: false,
      idButtons: [],
    };
  },
  computed: {
    ...mapState('user', ['categories']),
  },
  async created() {
    await this.loadInfo();
  },
  methods: {
    ...mapActions('user', ['getCategoriesAction', 'updateCategoryAction', 'deleteCategoryAction']),
    async loadInfo() {
      await this.getCategoriesAction();
    },
    async updateCategory(category) {
      await this.updateCategoryAction(category);
    },
    onSubmit() {
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
    deleteCategory(id) {
      this.deleteCategoryAction(id);
    },
    openDialogCat() {
      this.$q.dialog({
        component: DialogCategoryAdd,
        parent: this,
      });
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
