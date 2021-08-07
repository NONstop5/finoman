<template>
    <app-dialog 
    v-model='store.budgets.state.showAddBudgetDialog'
    label="Add Budget"
    @submit="onSubmit"
    >
    <app-dialog-input 
    v-model="addBudgetForm.name"
    class="w-mb-sm"
    placeholdet="Budget name e.g. March"
    icon="las la-pencil-alt"
    autofocus
    />
    <app-dialog-select 
    v-model="addBudgetForm.currencySymbol"
    :options="currencySymbolOptions"
    placeholder="Currency symbol"
    icon="las la-coins"
    />
    <template v-slot:buttons>
        <btn 
        label="Create"
        color="secondary"
        :disable="!addBudgetForm.name"
        type="submit"
        />
    </template>
    </app-dialog>
</template>

<script>
import { inject, reactive, ref, onMounted } from 'vue';

export default {
    name: 'DialogAddBudget',
    setup() {
        const store = inject('store')

        let addBudgetForm = reactive({
            name: null,
            currencySymbol: '$'
        })
        const currencySymbolOptions = ref(
            [
                {
                    label: '$ - Dollar',
                    value: '$',
                },
                {
                    label: 'Ru - Ruble',
                    value: 'Ru',
                },
            ],
        )
        const onSubmit = () => {
            console.log('addBudgetForm: ', addBudgetForm)
            store.budgets.actions.addBudget(addBudgetForm)
        }
        onMounted(() => {
            console.log('Mounted');
            addBudgetForm.name = null,
            addBudgetForm.currencySymbol = '$',
        })
        return {
            store,
            addBudgetForm,
        }
    }
}
</script>