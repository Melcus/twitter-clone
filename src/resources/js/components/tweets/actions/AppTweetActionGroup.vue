<template>
    <ul class="flex mt-4">
        <li class="w-3/12">
            <app-tweet-reply-action
                :tweet="tweet"
            />
        </li>
        <li class="w-3/12">
            <app-tweet-retweet-action
                :tweet="tweet"
            />
        </li>
        <li class="w-3/12">
            <app-tweet-like-action
                :tweet="tweet"
            />
        </li>
    </ul>
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
