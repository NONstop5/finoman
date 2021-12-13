<template>
  <q-layout view="hhh LpR fFf">
    <q-header
      elevated
      class="bg-primary text-white"
    >
      <q-toolbar>
        <q-toolbar-title>
          Api documentation
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      show-if-above
      side="left"
      bordered
      width="500"
    >
      <q-list
        bordered
        class="rounded-borders"
      >
        <q-item-label
          header
          class="text-h6"
        >
          Route names
        </q-item-label>
        <q-separator />
        <template
          v-for="(routes, routeGroup) in apiData"
          :key="routeGroup"
        >
          <q-expansion-item
            icon="label"
            :label="capitalizeFirstLetter(routeGroup)"
            header-class="text-primary"
            group="accordion"
          >
            <q-list
              bordered
              separator
            >
              <q-item
                v-for="(route, index) in routes"
                :key="index"
                clickable
                inset-level="1"
                @click="onSelectRoute(route)"
              >
                <q-item-section avatar>
                  <q-icon
                    color="primary"
                    name="link"
                  />
                </q-item-section>
                <q-item-section>
                  {{ route.uri }}
                </q-item-section>
              </q-item>
            </q-list>
          </q-expansion-item>
          <q-separator />
        </template>
      </q-list>
    </q-drawer>

    <q-page-container>
      <q-page
        v-if="selectedRoute"
        padding
      >
        <p class="text-h5">
          Route: <span class="text-primary">{{ selectedRoute.uri }}</span>
        </p>
        <q-separator />
        <div class="q-gutter-md">
          <q-card
            v-for="(methodParams, method) in selectedRoute.request"
            :key="method"
            flat
            bordered
          >
            <q-card-section>
              <q-chip
                class="q-ma-none text-white text-subtitle1 text-bold glossy"
                :class="`bg-${methodsColorsMap[method]}`"
                square
              >
                {{ method }}
              </q-chip>
            </q-card-section>
            <q-card-section class="text-secondary text-subtitle1 bg-blue-grey-1 q-py-none q-mb-sm">
              REQUEST BODY
              <q-badge color="secondary">
                application/json
              </q-badge>
            </q-card-section>
            <q-card-section>
              <q-table
                v-if="methodParams.length > 0"
                :rows="methodParams"
                :columns="columns"
                row-key="field"
                flat
                bordered
                separator="cell"
                hide-bottom
              >
                <template #header="props">
                  <q-tr :props="props">
                    <q-th
                      v-for="col in props.cols"
                      :key="col.name"
                      :props="props"
                    >
                      <span class="text-subtitle2">{{ col.label }}</span>
                    </q-th>
                  </q-tr>
                </template>
                <template #body-cell-field="props">
                  <q-td
                    :props="props"
                  >
                    <div class="text-body2">
                      {{ props.value }}
                    </div>
                  </q-td>
                </template>
                <template #body-cell-required="props">
                  <q-td :props="props">
                    <q-checkbox
                      color="secondary"
                      :model-value="props.value"
                    />
                  </q-td>
                </template>
                <template #body-cell-nullable="props">
                  <q-td :props="props">
                    <q-checkbox
                      color="grey"
                      :model-value="props.value"
                    />
                  </q-td>
                </template>
                <template #body-cell-type="props">
                  <q-td :props="props">
                    <q-chip
                      class="q-ma-none text-white"
                      square
                      color="secondary"
                    >
                      {{ props.value }}
                    </q-chip>
                  </q-td>
                </template>
                <template #body-cell-otherRules="props">
                  <q-td :props="props">
                    <div class="flex flex-center flex-wrap">
                      <q-chip
                        v-for="(otherRule, otherRuleIndex) in props.value"
                        :key="otherRuleIndex"
                        class="text-white"
                        square
                        color="grey"
                      >
                        {{ otherRule }}
                      </q-chip>
                    </div>
                  </q-td>
                </template>
              </q-table>
              <span
                v-else
                class="text-bold"
              >
                empty
              </span>
            </q-card-section>
          </q-card>
        </div>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import { showErrorNotification } from 'src/functions/function-show-notifications';

const methodsColorsMap = {
  GET: 'positive',
  POST: 'orange',
  PUT: 'primary',
  PATCH: 'primary',
  DELETE: 'negative',
  HEAD: 'blue',
};
const columns = [
  {
    name: 'field',
    label: 'Field',
    align: 'center',
    field: 'field',
  },
  {
    name: 'required',
    label: 'Required',
    align: 'center',
    field: 'required',
  },
  {
    name: 'nullable',
    label: 'Nullable',
    align: 'center',
    field: 'nullable',
  },
  {
    name: 'type',
    label: 'Type',
    align: 'center',
    field: 'type',
  },
  {
    name: 'otherRules',
    label: 'Other rules',
    align: 'center',
    field: 'otherRules',
  },
  {
    name: 'description',
    label: 'Description',
    align: 'center',
    field: 'description',
  },
];

export default {
  name: 'ApiDoc',
  data() {
    return {
      apiData: null,
      selectedRoute: null,
      methodsColorsMap,
      columns,
    };
  },
  async created() {
    const fieldTypes = [
      'string',
      'numeric',
      'digits',
      'integer',
      'int',
      'array',
      'boolean',
      'bool',
      'date',
    ];

    try {
      const response = await this.$api.post('api/get-api-doc-data');
      const apiData = response.data;

      Object.entries(apiData).forEach(([groupName, route]) => {
        apiData[groupName] = route.map((routeParams) => {
          const request = {};
          Object.entries(routeParams.request).forEach(([methodName, methodParams]) => {
            request[methodName] = methodParams.map((methodParamsItem) => {
              const { rules } = methodParamsItem;
              const isRequired = rules.includes('required');
              const isNullable = rules.includes('nullable');
              const fieldType = rules.find((rule) => fieldTypes.includes(rule));
              const otherRules = rules.filter((rule) => rule !== 'required' && rule !== 'nullable' && !fieldTypes.includes(rule));

              return {
                field: methodParamsItem.field,
                required: isRequired,
                nullable: isNullable,
                type: fieldType,
                otherRules,
                description: methodParamsItem.description,
              };
            });
          });

          return {
            uri: routeParams.uri,
            methods: routeParams.methods,
            request,
          };
        });
      });
      this.apiData = apiData;
    } catch ({ message }) {
      showErrorNotification(message);
    }
  },
  methods: {
    onSelectRoute(route) {
      this.selectedRoute = route;
    },
    capitalizeFirstLetter(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
