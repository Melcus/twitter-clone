export default {
    namespaced: true,

    state: {
        notifications: []
    },

    getters: {
        notifications(state) {
            return state.notifications
        }
    },

    mutations: {
        PUSH_NOTIFICATIONS(state, data) {
            state.notifications.push(...data)
        }
    },

    actions: {
        async getNotifications({commit}, url) {
            let response = await axios.get(url)

            commit('PUSH_NOTIFICATIONS', response.data.data)

            return response
        }
    }
}
