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
        }
    }
}
