<template>
    <a href="#" class="flex items-center text-base" @click="$emit('click', $event)">
        <inline-svg
            src="assets/svg/retweet.svg"
            width="24"
            height="24"
            class="fill-current text-gray-600  mr-2 w-5"
            :class="{
                        'text-green-600' : retweeted
                    }"
        />
        <span
            class="text-gray-600"
            :class="{
                        'text-green-600' : retweeted
                    }"
        >{{ tweet.retweets_count }}</span>
    </a>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        computed: {
            ...mapGetters({
                retweets: 'retweets/retweets'
            }),
            retweeted() {
                return this.retweets.includes(this.tweet.id)
            }
        },
        methods: {}
    }
</script>

