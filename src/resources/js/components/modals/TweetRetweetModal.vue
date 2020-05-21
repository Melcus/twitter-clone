<template>
    <div>
        <app-tweet-retweet-compose
            :tweet="tweet"
            @success="$emit('close')"
        />

        <component
            v-if="tweet"
            class="border border-gray-700 rounded-lg mt-4 p-4"
            :is="`app-tweet-variant-${tweet.type}`"
            :tweet="tweet"
        ></component>
    </div>
</template>

<script>
    import AppTweetCompose from "../compose/AppTweetCompose";

    export default {
        components: {AppTweetCompose},
        props: {
            tweet: {
                required: true,
                type: Object
            }
        }
    }
</script>
