<template>
    <panel-item :field="field">
        <div slot="value">
            {{ field.value }}

            <img class="block h-16 sm:h-24 sm:mb-0 sm:mr-4 sm:ml-0" :src="imageUrl" :alt="field.icon">

            <p v-if="shouldShowToolbar" class="flex items-center text-sm mt-3">
                <a
                    v-if="field.downloadable"
                    :dusk="field.attribute + '-download-link'"
                    @keydown.enter.prevent="download"
                    @click.prevent="download"
                    tabindex="0"
                    class="cursor-pointer dim btn btn-link text-primary inline-flex items-center"
                >
                    <icon
                        class="mr-2"
                        type="download"
                        view-box="0 0 24 24"
                        width="16"
                        height="16"
                    />
                    <span class="class mt-1"> Download </span>
                </a>
            </p>
        </div>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    computed: {
        imageUrl() {
            return this.field.previewUrl || this.field.thumbnailUrl
        },

        shouldShowToolbar() {
            return Boolean(this.field.downloadable || this.field.deletable) && this.hasValue
        },
    }
}
</script>
