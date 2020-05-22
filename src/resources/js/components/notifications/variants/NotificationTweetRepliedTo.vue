<template>
    <div class="p-4 flex-grow">
        <div class="text-gray-300 mb-4">
            <app-tweet v-if="resolvedTweet" :tweet="resolvedTweet" class="!border-0"/>
<!--            {{ resolvedTweet }}-->
            <!--            <app-tweet-username :user="notification.data.user"/>-->
            <!--            replied to your tweet-->
        </div>

        <p class="text-gray-600">
<!--            {{ notification.data.tweet.body }}-->
        </p>
    </div>
</template>

<script>
    import AppTweet from "../../tweets/AppTweet";
    import {mapGetters} from "vuex";

    export default {
        components: {AppTweet},
        props: {
            notification: {
                required: true,
                type: Object
            }
        },
        computed: {
            ...mapGetters({
                tweet: 'notifications/tweet'
            }),

            resolvedTweet() {
                return this.tweet(this.notification.data.tweet.id)
            }
        }
    }
</script>
