<template>
    <q-page padding>
        <q-dialog v-model="showDialog" ref="dialog">
            <q-card>
                <q-toolbar class="bg-positive text-white">
                    <q-toolbar-title>
                        something
                    </q-toolbar-title>
                </q-toolbar>
                <q-btn flat icon="close" round v-close-popup>

                </q-btn>
            <q-card-section>
                something
            </q-card-section>
            </q-card>
        </q-dialog>
        <q-btn
            label="add"
            @click="showDialog = true"
        />
        <q-btn label="method" @click="$refs.dialog.show()" />
    </q-page>
</template>
<script>
export default {
    data() {
        return {
            showDialog: false,        }
    },
    methods: {
        
    }
}
</script>