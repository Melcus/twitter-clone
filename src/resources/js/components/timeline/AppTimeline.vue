<template>
    <div>
        <app-tweet
            v-for="tweet in tweets"
            :key="tweet.id"
            :tweet="tweet"
        />
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                tweets: 'timeline/tweets'
            })
        },
        methods: {
            ...mapActions({
                getTweets: 'timeline/getTweets'
            })
        },
        mounted() {
            this.getTweets()
        }
    }
</script>
