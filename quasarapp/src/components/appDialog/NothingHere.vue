<template>
    <div class="nothing-here absolute-center text-center">
        <q-icon
            :name="icon"
            size="100px"
            color="light"
        />
        <div class="text-size-21 text-light">
            {{ $t(label) }}
        </div>
    </div>
</template>

<script>
export default {
    props: ['label', 'icon'],
    setup(props) {
        return {
            label: props.label,
            icon: props.icon,
        }
    }
}
</script>