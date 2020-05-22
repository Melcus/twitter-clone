<template>
    <div class="flex w-full">
        <img :src="tweet.user.avatar" class="w-12 h-12 mr-3 rounded-full">
        <div class="flex-grow">
            <app-tweet-username :user="tweet.user"/>

            <app-tweet-body :tweet="tweet"/>

            <div class="flex flex-wrap my-4" v-if="images.length">
                <div
                    class="w-6/12 flex-grow"
                    v-for="(image, index) in images"
                    :key="index"
                >
                    <img :src="image.url" class="rounded-lg">
                </div>
            </div>

            <div v-if="video" class="my-4 ">
                <video :src="video.url" controls class="rounded-lg"></video>
            </div>

            <app-tweet-action-group
                :tweet="tweet"
            />
        </div>
    </div>

</template>

<script>
    import AppTweetBody from "../AppTweetBody";
    export default {
        components: {AppTweetBody},
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        computed: {
            images() {
                return this.tweet.media.data.filter(media => media.type === 'image')
            },
            video() {
                return this.tweet.media.data.filter(media => media.type === 'video')[0]
            }
        }
    }
</script>




