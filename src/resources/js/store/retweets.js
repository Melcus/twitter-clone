import axios from 'axios'
import {without} from 'lodash'

export default {
    namespaced: true,

    state: {
        retweets: []
    },

    getters: {
        retweets(state) {
            return state.retweets
        }
    },

    mutations: {
        PUSH_RETWEETS(state, data) {
            state.retweets.push(...data)
        },

        PUSH_RETWEET(state, id) {
            state.retweets.push(id)
        },

        REMOVE_RETWEET(state, id) {
            state.retweets = without(state.retweets, id)
        }
    },
    actions: {
        async retweetTweet(_, tweet) {
            await axios.post(`/api/tweets/${tweet.id}/retweets`)
        },

        async unRetweetTweet(_, tweet) {
            await axios.delete(`/api/tweets/${tweet.id}/retweets`)
        },

        syncRetweet({commit, state}, id) {
            if (state.retweets.includes(id)) {
                commit('REMOVE_RETWEET', id);
                return
            }

            commit('PUSH_RETWEET', id)
        }
    }
}
