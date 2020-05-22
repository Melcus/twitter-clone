import getters from "./tweet/getters";
import mutations from "./tweet/mutations";
import actions from "./tweet/actions";

export default {
    namespaced: true,

    state: {
        tweets: []
    },

    getters,

    mutations,

    actions
}
