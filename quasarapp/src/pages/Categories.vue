<template>
  <q-pull-to-refresh @refresh="refresh">
    <q-page class="row justify-center items-center content-start">
      <div class="col">
        <div class="row">
          <h4 class="text-primary q-my-sm">
            Categories
          </h4>
        </div>
        <q-separator
          class="q-mb-sm"
        />
        <q-tabs
          v-model="selectedCategoryType"
          class="bg-grey-2 text-teal q-mb-sm"
          dense
          align="justify"
        >
          <q-tab
            v-for="toggleOption in toggleOptions"
            :key="toggleOption.id"
            :name="toggleOption.name"
            :label="toggleOption.label"
            :icon="toggleOption.icon"
          />
        </q-tabs>
        <q-tab-panels
          v-model="selectedCategoryType"
          animated
        >
          <q-tab-panel
            v-for="toggleOption in toggleOptions"
            :key="toggleOption.id"
            :name="toggleOption.name"
            class="q-pa-none"
          >
            <q-list
              bordered
              separator
            >
              <q-slide-item
                v-for="category in categories.filter((category) => category.category_type_id === toggleOption.id)"
                :key="category.id"
                left-color="green"
                right-color="red"
                @left="onEdit"
                @right="onDelete(category.id)"
              >
                <template #left>
                  <q-icon name="edit" />
                </template>
                <template #right>
                  <q-icon name="delete" />
                </template>

                <q-item>
                  <q-item-section avatar>
                    <q-avatar
                      color="primary"
                      text-color="white"
                      :icon="category.icon"
                    />
                  </q-item-section>
                  <q-item-section>
                    {{ category.name }}
                  </q-item-section>
                </q-item>
              </q-slide-item>
            </q-list>
          </q-tab-panel>
        </q-tab-panels>

        <q-page-sticky
          position="bottom-right"
          :offset="[18, 18]"
        >
          <q-btn
            fab
            icon="fas fa-plus"
            color="secondary"
            padding="sm"
            glossy
            @click="onAdd"
          />
        </q-page-sticky>
      </div>
      <DialogFormCat />
    </q-page>
  </q-pull-to-refresh>
</template>

<script>
import DialogCategoryAdd from 'src/components/appDialog/DialogCategoryAdd.vue';
import {
  mapActions,
  mapState,
} from 'vuex';

const categoryType = {
  INCOME: 1,
  OUTCOME: 2,
};

const toggleOptions = [
  {
    id: categoryType.INCOME,
    name: 'income',
    label: 'Income',
    icon: 'add_circle',
  },
  {
    id: categoryType.OUTCOME,
    name: 'outcome',
    label: 'Outcome',
    icon: 'remove_circle',
  },
];

export default {
  name: 'Categories',
  data() {
    return {
      selectedCategoryType: 'income',
      toggleOptions,
    };
  },
  computed: {
    ...mapState('user', ['categories']),
  },
  created() {
    if (!this.categories[0]) {
      this.getCategoriesAction();
    }
  },
  methods: {
    ...mapActions('user', ['getCategoriesAction', 'updateCategoryAction', 'deleteCategoryAction']),
    onAdd() {
      this.$q.dialog({
        component: DialogCategoryAdd,
        parent: this,
      });
    },
    onEdit({ reset }) {
      reset();
    },
    onDelete(id) {
      this.deleteCategoryAction(id);
    },
    async updateCategory(category) {
      await this.updateCategoryAction(category);
    },
    async refresh(done) {
      await this.getCategoriesAction();
      done();
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
