import {get} from "lodash";

export default {
    PUSH_TWEETS(state, data) {
        state.tweets.push(
            ...data.filter((tweet) => {
                return !state.tweets.map((t) => t.id).includes(tweet.id)
            })
        )
    },

    SET_LIKES(state, {id, count}) {
        state.tweets = state.tweets.map((tweet) => {
            // Normal Tweet case
            if (tweet.id === id) {
                tweet.likes_count = count
            }

            // Retweet or quote case
            if (get(tweet, 'original_tweet.id') === id) {
                tweet.original_tweet.likes_count = count
            }

            // Retweet of a quote case
            if (get(tweet, 'original_tweet.original_tweet.id') === id) {
                tweet.original_tweet.original_tweet.likes_count = count
            }

            return tweet
        })
    },

    SET_RETWEETS(state, {id, count}) {
        state.tweets = state.tweets.map((tweet) => {
            // Normal Tweet case
            if (tweet.id === id) {
                tweet.retweets_count = count
            }

            // Retweet or quote case
            if (get(tweet, 'original_tweet.id') === id) {
                tweet.original_tweet.retweets_count = count
            }

            // Retweet of a quote case
            if (get(tweet, 'original_tweet.original_tweet.id') === id) {
                tweet.original_tweet.original_tweet.retweets_count = count
            }

            return tweet
        })
    },

    SET_REPLIES(state, {id, count}) {
        state.tweets = state.tweets.map((tweet) => {
            // Normal Tweet case
            if (tweet.id === id) {
                tweet.replies_count = count
            }

            // Retweet or quote case
            if (get(tweet, 'original_tweet.id') === id) {
                tweet.original_tweet.replies_count = count
            }

            // Retweet of a quote case
            if (get(tweet, 'original_tweet.original_tweet.id') === id) {
                tweet.original_tweet.original_tweet.replies_count = count
            }

            return tweet
        })
    },

    REMOVE_TWEET(state, id) {
        state.tweets = state.tweets.filter((t) => {
            return t.id !== id
        })
    }
}
