<template>
    <div class="flex flex-wrap mb-4">
        <div
            v-for="(image, index) in images"
            :key="index"
            class="w-6/12 flex-grow relative">
            <img :src="generateImagePreview(image)" class="rounded-lg">

            <a
                href=""
                @click.prevent="$emit('removed', image)"
                class="bg-gray-900 w-8 h-8 rounded-full absolute top-0 right-0 mt-3 mr-3 flex items-center justify-center"
            >
                <inline-svg
                    :src="`assets/svg/x.svg`"
                    fill="black"
                    width="16"
                    height="16"
                    class="fill-current text-gray-300"
                />
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            images: {
                required: false,
                type: Array
            }
        },

        methods: {
            generateImagePreview(image) {
                return URL.createObjectURL(image)
            }
        }
    }
</script>
