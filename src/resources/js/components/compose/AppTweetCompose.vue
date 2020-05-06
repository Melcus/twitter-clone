<template>
    <form class="flex" @submit.prevent="submit">

        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full"/>

        <div class="flex-grow">
            <app-tweet-compose-textarea
                v-model="form.body"
            />

            <image-preview
                :images="media.images"
                v-if="media.images.length"
                @removed="removeImage"
            />

            <video-preview
                :video="media.video"
                v-if="media.video"
                @removed="removeVideo"
            />

            <div class="flex justify-between">
                <ul class="flex items-center">
                    <li class="mr-4">
                        <media-button
                            id="media-compose"
                            @selected="handleMediaSelected"
                        />
                    </li>
                </ul>
                <div class="flex items-center justify-end">
                    <div>
                        <app-tweet-compose-limit
                            class="mr-2"
                            :body="form.body"
                        />
                    </div>
                    <button type="submit"
                            class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    >
                        Twoot
                    </button>
                </div>

            </div>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'
    import ImagePreview from "./media/ImagePreview";

    export default {
        components: {ImagePreview},
        data() {
            return {
                form: {
                    body: "",
                    media: []
                },

                media: {
                    images: [],
                    video: null
                },

                mediaTypes: {}
            }
        },
        methods: {
            async submit() {
                let media = await this.uploadMedia()

                this.form.media = media.data.data.map(entry => entry.id)

                await axios.post('/api/tweets', this.form)

                this.resetForm()
            },

            async getMediaTypes() {
                let response = await axios.get('/api/media/types')

                this.mediaTypes = response.data.data
            },

            handleMediaSelected(files) {
                Array.from(files).slice(0, 4).forEach((file) => {
                    if (this.mediaTypes.image.includes(file.type)) {
                        this.media.images.push(file)
                    }

                    if (this.mediaTypes.video.includes(file.type)) {
                        this.media.video = file
                    }
                })

                if (this.media.video) {
                    this.media.images = []
                }
            },

            removeVideo() {
                this.media.video = null
            },

            removeImage(image) {
                this.media.images = this.media.images.filter((i) => {
                    return image !== i
                })
            },
            buildMediaForm() {
                let form = new FormData()

                if (this.media.images.length) {
                    this.media.images.forEach((image, index) => {
                        form.append(`media[${index}]`, image)
                    })
                }

                if (this.media.video) {
                    form.append('media[0]', this.media.video)
                }

                return form
            },

            async uploadMedia() {
                return await axios.post('/api/media', this.buildMediaForm(), {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
            },
            resetForm() {
                this.form.body = ''
                this.form.media = []
                this.media.video = null
                this.media.images = []
            }
        },

        mounted() {
            this.getMediaTypes()
        }
    }
</script>
