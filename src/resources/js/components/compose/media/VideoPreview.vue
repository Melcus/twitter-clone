<template>
    <div class="mb-4 relative">
        <video controls preload :src="generateVideoPreview(video)" class="rounded-lg"></video>

        <a
            href=""
            @click.prevent="$emit('removed', video)"
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
</template>

<script>
    export default {
        props: {
            video: {
                required: true,
                type: File
            }
        },

        methods: {
            generateVideoPreview(video) {
                return URL.createObjectURL(video)
            }
        }
    }
</script>
