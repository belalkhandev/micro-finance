import axios from "axios";

export default {
    namespaced: true,

    state: {
        dashboard_data: null,
    },

    getters: {
        dashboard_data (state) {
            return state.dashboard_data
        },

    },

    mutations: {
        SET_DASHBOARD_DATA(state, dashboard) {
            state.dashboard_data = dashboard
        },
    },

    actions: {
        async getDashboardData({ commit }) {
            const res = await axios.get('/dashboard/widgets/data')

            if (res.data.status) {
                commit('SET_DASHBOARD_DATA', res.data.data)
            }
        },
    }
}
