<template>
    <div>
        <div class="text-gray-600 font-medium text-xs flex items-center mb-2">
            <inline-svg
                src="assets/svg/retweet.svg"
                width="24"
                height="24"
                class="fill-current text-gray-600  mr-2"
            ></inline-svg>
            <span>{{ tweet.user.name }} retweeted</span>
        </div>

        <component
            :is="`app-tweet-variant-${tweet.original_tweet.type}`"
            :tweet="tweet.original_tweet"
        />
    </div>
</template>

<script>
    export default {
        props: {
            tweet: {
                required: true,
                type: Object
            }
        }
    }
</script>
