<template>
    <form class="flex" @submit.prevent="submit">

        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full"/>

        <div class="flex-grow">
            <app-tweet-compose-textarea
                v-model="form.body"
                placeholder="What's happening?"
            />

            <tweet-media-progress
                v-if="media.progress"
                class="mb-4"
                :progress="media.progress"
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
    import compose from '../../mixins/compose'
    import axios from "axios";

    export default {
        mixins: [
            compose
        ],

        methods: {
            async post() {
                await axios.post('/api/tweets', this.form)
            }
        }
    }

</script>
