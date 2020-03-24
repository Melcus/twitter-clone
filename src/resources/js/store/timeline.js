import axios from "axios";


export default {
    namespaced: true,
    state: {
        tweets: []
    },

    getters: {
        tweets(state) {
            return state.tweets
        }
    },

    mutations: {
        PUSH_TWEETS(state, data) {
            state.tweets.push(...data)
        }
    },

    actions: {
        async getTweets({commit}) {
            let response = await axios.get('/api/timeline')
            commit('PUSH_TWEETS', response.data.data)
        }
    }
}
