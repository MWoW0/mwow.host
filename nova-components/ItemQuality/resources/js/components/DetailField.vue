<template>
    <panel-item :field="field">
        <span slot="value" :style="{ 'color': option.color }">{{ option.label }}</span>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

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
