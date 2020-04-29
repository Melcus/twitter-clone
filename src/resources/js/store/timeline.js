import axios from "axios";
import {get} from 'lodash'

export default {
    namespaced: true,
    state: {
        tweets: []
    },

    getters: {
        tweets(state) {
            return state.tweets
                .sort((a, b) => b.created_at - a.created_at)
        }
    },

    mutations: {
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

        REMOVE_TWEET(state, id) {
            state.tweets = state.tweets.filter((t) => {
                return t.id !== id
            })
        }
    },

    actions: {
        async getTweets({commit}, url) {
            let response = await axios.get(url)
            commit('PUSH_TWEETS', response.data.data)
            commit('likes/PUSH_LIKES', response.data.meta.likes, {root: true})
            commit('retweets/PUSH_RETWEETS', response.data.meta.retweets, {root: true})
            return response
        }
    }
}
