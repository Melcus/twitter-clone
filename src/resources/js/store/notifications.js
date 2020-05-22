import actions from "./tweet/actions";
import getters from "./tweet/getters";
import mutations from "./tweet/mutations";

export default {
    namespaced: true,

    state: {
        notifications: [],
        tweets: []
    },

    getters: {
        ...getters,

        notifications(state) {
            return state.notifications
        },

        tweetIdsFromNotifications(state) {
            return state.notifications.map(n => n.data.tweet.id)
        }
    },

    mutations: {
        ...mutations,

        PUSH_NOTIFICATIONS(state, data) {
            state.notifications.push(...data)
        }
    },

    actions: {
        ...actions,

        async getNotifications({commit, dispatch, getters}, url) {
            let response = await axios.get(url)

            commit('PUSH_NOTIFICATIONS', response.data.data)

            dispatch('getTweets', `/api/tweets?ids=${getters.tweetIdsFromNotifications.join(',')}`)

            return response
        }
    }
}
