<template>
    <div>
        <app-dropdown v-if="!retweeted">
            <template slot="trigger">
                <app-tweet-retweet-action-button :tweet="tweet"/>
            </template>
            <app-dropdown-item @click.prevent="retweetOrUnRetweet">
                Retwoot
            </app-dropdown-item>
            <app-dropdown-item @click.prevent="$modal.show(TweetRetweetModal, {tweet})">
                Retwoot with comment
            </app-dropdown-item>
        </app-dropdown>

        <app-tweet-retweet-action-button v-else :tweet="tweet" @click.prevent="retweetOrUnRetweet"/>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import TweetRetweetModal from "../../modals/TweetRetweetModal";

    export default {
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                TweetRetweetModal
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

        methods: {
            ...mapActions({
                retweetTweet: 'retweets/retweetTweet',
                unRetweetTweet: 'retweets/unRetweetTweet',
            }),

            retweetOrUnRetweet() {
                if (this.retweeted) {
                    this.unRetweetTweet(this.tweet);
                    return
                }

                this.retweetTweet(this.tweet)
            }
        }
    }
</script>
