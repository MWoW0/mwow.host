<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <input :id="field.name" type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model.lazy="preparedValue"
            />
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    computed: {
        preparedValue: {
            get() {
                let value = this.value;

                let copper = value % 100;

                value = (value - copper) / 100;

                let silver = value % 100;

                let gold = (value - silver) / 100;

                return `${gold}g ${silver}s ${copper}c`;
            },

            set (value) {
                this.value = value.replace(/[^0-9]/g, '');
            }
        }
    },

    watch: {
        value (v) {
            console.log(v)
        }
    },

    methods: {
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
