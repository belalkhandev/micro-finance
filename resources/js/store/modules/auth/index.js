import axios from "axios"

export default {
    namespaced: true,

    state: {
        token: null,
        user:null,
        permissions: null
    },

    getters: {
        authenticated (state) {
            return state.token && state.user
        },

        user (state) {
            return state.user
        },

        permissions (state) {
            return state.permissions
        }
    },

    mutations: {
        SET_TOKEN (state, token) {
            state.token = token
        },

        SET_USER (state, user) {
            state.user = user
        },

        SET_PERMISSION (state, permissions) {
            state.permissions = permissions
        },

        UPDATE_USER_PASSWORD (state, user) {
            state.user = user
        }
    },

    actions: {
        async signIn({ dispatch, commit }, credentials) {
            const res = await axios.post('login', credentials)
            if (res.data.status) {
                commit('SET_VALIDATION_ERRORS', null,  { root:true })
                commit('SET_ERROR_MESSAGE', null,  { root:true })

                return dispatch('attempt', res.data.token)
            }else {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)

                if (!res.data.status) {
                    commit('SET_VALIDATION_ERRORS', res.data.errors ? res.data.errors : null, { root:true })
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },

        async attempt({ commit, state}, token) {
            if (token) {
                commit('SET_TOKEN', token)
            }

            if (!state.token) {
                return
            }

            try{
                const resuser = await axios.get('user/me')
                if (resuser.data.status) {
                    commit('SET_USER', resuser.data.user)
                    commit('SET_PERMISSION', resuser.data.permissions)
                } else {
                    commit('SET_TOKEN', null)
                    commit('SET_USER', null)
                    commit('SET_USER', null)
                }
            }catch (e) {
                console.log(e)
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            }
        },

        async signOut({ commit }) {
            return axios.post('user/logout').then(() => {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
                commit('SET_USER', null)
            })
        },

        //password change
        async changePassword({ commit }, formData) {
            const res = await axios.post('user/change/password', formData)
            if (res.data.status) {
                commit('SET_VALIDATION_ERRORS', null,  { root:true })
                commit('SET_ERROR_MESSAGE', null,  { root:true })
                commit('UPDATE_USER_PASSWORD', res.data.user)
            }else {
                if (res.data.errors) {
                    commit('SET_VALIDATION_ERRORS', res.data.errors, { root:true })
                    commit('SET_ERROR_MESSAGE', null, { root:true })
                } else if (res.data.message) {
                    commit('SET_ERROR_MESSAGE', res.data.message, { root:true })
                    commit('SET_VALIDATION_ERRORS', null, { root:true })
                } else {
                    console.log('Something went wrong');
                }
            }
        },

    }

}
