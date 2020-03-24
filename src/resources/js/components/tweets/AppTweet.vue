<template>
    <div class="w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800">
        <div class="flex w-full">
            <div class="mr-3">
                <img :src="tweet.user.avatar" class="w-12 rounded-full">
            </div>
            <div>
                <app-tweet-username :user="tweet.user"></app-tweet-username>
                <p class="text-gray-300 whitespace-pre-wrap">{{ tweet.body }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import AppTweetUsername from "./AppTweetUsername";

    export default {
        components: {AppTweetUsername},
        props: {
            tweet: {
                required: true,
                type: Object
            }
        }
    }
</script>
