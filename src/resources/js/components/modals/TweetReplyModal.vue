<template>
    <div>
        <component
            v-if="tweet"
            class="mb-4"
            :is="`app-tweet-variant-${tweet.type}`"
            :tweet="tweet"
        ></component>

        <app-tweet-reply-compose
            v-if="tweet"
            :tweet="tweet"
            @success="$emit('close')"
        />

    </div>
</template>

<script>
    import AppTweetCompose from "../compose/AppTweetCompose";
    import AppTweetReplyCompose from "../compose/AppTweetReplyCompose";

    export default {
        components: {AppTweetReplyCompose, AppTweetCompose},
        props: {
            tweet: {
                required: true,
                type: Object
            }
        }
    }
</script>
