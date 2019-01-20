<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <select
                :id="field.attribute"
                v-model="value"
                class="w-full form-control form-select"
                :class="errorClasses"
            >
                <option value="" selected>{{ __('Choose an option') }}</option>

                <option
                    v-for="option in field.options"
                    :value="option.value"
                    :selected="option.value == value"
                    :class="textColor(option.color)"
                >
                    {{ option.label }}
                </option>
            </select>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        textColor(value) {
            return `text-${value} !important`;
        },

        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },
    },
}
</script>
