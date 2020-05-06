<template>
    <div>
        <div class="border-b-8 border-gray-800 p-4 w-full">
            <app-tweet-compose/>
        </div>

        <div class="p-4 border-gray-800 border-b text-gray-300" v-if="!tweets.length">It's pretty quiet around here.</div>

        <app-tweet
            v-for="tweet in tweets"
            :key="tweet.id"
            :tweet="tweet"
        />
        <div v-if="tweets.length"
             v-observe-visibility="{
                callback: handleScrolledToBottomOfTimeline
             }"
        />
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapMutations} from 'vuex'
    import AppTweet from "../tweets/AppTweet";

    export default {
        components: {AppTweet},
        data() {
            return {
                page: 1,
                lastPage: 1
            }
        },
        computed: {
            ...mapGetters({
                tweets: 'timeline/tweets'
            }),

            urlWithPage() {
                return `/api/timeline?page=${this.page}`
            }
        },
        methods: {
            ...mapActions({
                getTweets: 'timeline/getTweets'
            }),

            ...mapMutations({
                PUSH_TWEETS: 'timeline/PUSH_TWEETS'
            }),

            loadTweets() {
                this.getTweets(this.urlWithPage).then((response) => {
                    this.lastPage = response.data.meta.last_page
                })
            },

            handleScrolledToBottomOfTimeline(isVisible) {
                if (!isVisible) {
                    return
                }

                if (this.lastPage === this.page) { // end of timeline
                    return
                }

                this.page++

                this.loadTweets()
            }
        },
        mounted() {
            this.loadTweets()

            console.log(`stating listening on timeline.${this.$user.id} for TweetWasCreated`)

            Echo.private(`timeline.${this.$user.id}`)
                .listen('.TweetWasCreated', (e) => {
                    this.PUSH_TWEETS([e])
                    console.log('event', e)
                })
        }
    }
</script>
