import TweetMediaProgress from "../components/compose/media/TweetMediaProgress";
import ImagePreview from "../components/compose/media/ImagePreview";
import axios from "axios";

export default {
    components: {TweetMediaProgress, ImagePreview},

    data() {
        return {
            form: {
                body: "",
                media: []
            },

            media: {
                images: [],
                video: null,
                progress: 0
            },

            mediaTypes: {}
        }
    },

    methods: {
        async submit() {
            if (this.media.images.length || this.media.images.video) {

                let media = await this.uploadMedia()

                this.form.media = media.data.data.map(entry => entry.id)
            }

            await this.post()

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

        resetForm() {
            this.form.body = ''
            this.form.media = []
            this.media.video = null
            this.media.images = []
            this.media.progress = 0
        },

        async uploadMedia() {
            return await axios.post('/api/media', this.buildMediaForm(), {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: this.handleUploadProgress
            })
        },

        handleUploadProgress(event) {
            this.media.progress = Math.round((event.loaded / event.total) * 100)
        }
    },

    mounted() {
        this.getMediaTypes()
    }
}
