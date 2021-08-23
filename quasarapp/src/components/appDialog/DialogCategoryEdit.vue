<template>
  <div>
    <q-dialog
      ref="categoryAddRef"
      @hide="onDialogHide"
    >
      <q-card class="q-dialog-plugin">
        <q-card-section class="text-h6 text-secondary">
          Update selected Category
        </q-card-section>

        <q-separator />

        <q-card-section>
          <q-select
            v-model="form.category_type_id"
            class="q-mb-md"
            :options="category_type_id"
            label="Type of category"
            emit-value
            map-options
            :rules="[val => !!val || 'Field is required']"
          />
          <q-input
            v-model="form.name"
            class="q-mb-md"
            label="Name of category"
            type="text"
            :rules="[val => !!val || 'Field is required']"
          />
          <q-select
            v-model="form.icon"
            class="q-mb-md"
            label="Choose an icon"
            :options="icon"
            emit-value
            map-options
            required
          />
          <q-input
            v-model="form.budget"
            class="q-mb-md"
            label="Enter new budget"
            type="number"
            required
          />
        </q-card-section>

        <q-separator />

        <q-card-section>
          <q-card-actions
            align="center"
          >
            <q-btn
              color="grey"
              label="Cancel"
              @click="onCancelClick"
            />
            <q-btn
              color="secondary"
              label="Ok"
              @click="onOKClick"
            />
          </q-card-actions>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import { showErrorNotification } from 'src/functions/function-show-notifications';
import { mapActions } from 'vuex';

export default {
  name: 'DialogCategoryAdd',
  props: {
    category: {
      type: Object,
      default() {
        return { msg: 'hello' };
      },
    },
  },
  emits: [
    'ok',
    'hide',
    'data',
    'show',
  ],
  setup() {
    return {
      v$: useVuelidate(),
      category_type_id: [
        {
          label: 'Income',
          value: 1,
        },
        {
          label: 'Expenses',
          value: 2,
        },
      ],
      icon: [
        {
          label: 'Home',
          value: 'home',
        },
        {
          label: 'Pets',
          value: 'pets',
        },
        {
          label: 'Sport',
          value: 'fitness_center',
        }, {
          label: 'Cafe',
          value: 'restaurant',
        },
      ],
    };
  },
  data() {
    return {
      form: {
        category_type_id: null,
        name: this.category.name,
        icon: this.category.icon,
        budget: this.category.budget,
        id: this.category.id,
      },
    };
  },
  validations() {
    return {
      form: {
        category_type_id: { required },
        name: { required },
        budget: { required },
        icon: { required },
      },
    };
  },
  methods: {
    ...mapActions('user', ['updateCategoryAction']),
    show() {
      this.$refs.categoryAddRef.show();
    },
    hide() {
      this.$refs.categoryAddRef.hide();
    },
    onDialogHide() {
      this.$emit('hide');
    },
    onOKClick() {
      this.v$.$validate();
      if (!this.v$.$error) {
        this.updateCategoryAction(this.form);
        this.$emit('ok');
        this.hide();
      } else {
        showErrorNotification('Complete all fields');
      }
    },
    onCancelClick() {
      this.hide();
    },
  },
};
</script>
