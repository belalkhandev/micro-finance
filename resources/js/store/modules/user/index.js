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
            return state.roles
        }
    },

    mutations: {
        SET_USERS(state, users) {
            state.users = users
        },

        SET_USER(state, user) {
            console.log(user)
            if (state.users) {
                state.users.unshift(user)
            }
        },

        UPDATE_USER(state, update_user) {
            const user = state.users.find(user => user.id == update_user.id)
            Object.assign(user, update_user)
        },

        DELETE_USER(state, user_id) {
            const user  = state.users.find(user => user.id == user_id)
            if (user) {
                state.users.splice(state.users.indexOf(user), 1)
            }
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

        async createUser({commit}, formData) {
            const res = await axios.post('user/create', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });

            if (res.data.status) {
                commit('SET_USER', res.data.user)
                commit('SET_VALIDATION_ERRORS', null,  { root:true })
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_VALIDATION_ERRORS', res.data.errors ? res.data.errors : null, { root:true })
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },

        async editUser({commit}, formData) {
            const res = await axios.post('user/update', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })

            if (res.data.status) {
                commit('UPDATE_USER', res.data.user)
                commit('SET_VALIDATION_ERRORS', null,  { root:true })
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_VALIDATION_ERRORS', res.data.errors ? res.data.errors : null, { root:true })
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },

        async deleteUser({commit}, user_id) {
            const res = await axios.delete('user/delete/'+user_id)

            if (res.data.status) {
                commit('DELETE_USER', user_id)
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
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
