<template>
    <q-dialog 
        class="app-dialog"
        :full-width="$q.screen.lt.md"
        v-model="showAdd"
    >
        <q-card class="bg-backdrop q-pt-md" flat>
            <q-form @submit="$emit('submit')">
                <q-card-section 
                    v-if="label"
                    class="q-pt-none"
                >
                    <div class="text-size-16 text-darl">{{ label }}</div>
                </q-card-section>
                <q-card-section class="q-pt-none">
                    <slot/>        
                </q-card-section>
                <q-card-actions align="right" class="text-primary">
                    <slot name="buttons"></slot>
                </q-card-actions>    
            </q-form>
        </q-card>
</template>

<script>
export default {
    props: ['label'],
    emits: ['submit'],
    setup(props) {
        return {
            label: props.label
        }
    },
}
</script>