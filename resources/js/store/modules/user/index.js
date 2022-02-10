import axios from "axios";

export default {
    namespaced: true,

    state: {
        users: null,
        roles: null
    },

    getters: {
        users(state) {
            return state.users
        },

        roles(state) {
            return roles
        }
    },

    mutations: {
        SET_USERS(state, users) {
            state.users = users
        },

        SET_ROLES(state, roles) {
            state.roles = roles
        }
    },

    actions: {
        //get user list
        async getUsers({commit}) {
            const res = await axios.get('/user/list')

            if (res.data.status)  {
                commit('SET_USERS', res.data.users)
            }
        },

        //get role list
        async getRoles({commit}) {
            const res = await axios.get('/role/list')

            if (res.data.status)  {
                commit('SET_ROLES', res.data.roles)
            }
        }
    },
}
