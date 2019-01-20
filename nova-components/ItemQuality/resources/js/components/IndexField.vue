<template>
    <span :style="{ 'color': option.color }">{{ option.label }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],

    computed: {
        option () {
            return this.field.options[this.field.value] || {
                color: 'white',
                label: 'unknown',
                value: this.field.value
            };
        },
    }
}
</script>
