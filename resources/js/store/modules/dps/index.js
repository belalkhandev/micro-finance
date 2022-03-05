import axios from "axios";

export default {
    namespaced: true,
    state: {
        applications: null
    },

    getters: {
        applications(state) {
            return state.applications
        }
    },

    mutations: {
        SET_APPLICATIONS(state, applications) {
            state.applications = applications
        },

        SET_APPLICATION(state, application) {
            if (state.applications) {
                state.applications.unshift(application)
            }else {
                state.applications = [application]
            }
        },

        UPDATE_APPLICATION(state, application) {
            const item = state.applications.find(item => item.id === application.id)
            Object.assign(item, application)
        },

        DELETE_APPLICATION(state, item_id) {
            const application  = state.applications.find(item => item.id == item_id)
            if (application) {
                state.applications.splice(state.applications.indexOf(application), 1)
            }
        },
    },

    actions: {
        //application actions
        async getApplications({ commit }) {
            const res = await axios.get('application/dps/list')

            if (res.data.status) {
                commit('SET_APPLICATIONS', res.data.applications)
            }
        },

        async createApplication({ commit }, formdata) {
            const res = await axios.post('application/dps/create', formdata)

            if (res.data.status) {
                commit('SET_APPLICATION', res.data.application)
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

        async editApplication({ commit }, formdata) {
            const res = await axios.put('application/dps/update/'+formdata.application_id, formdata)

            if (res.data.status) {
                commit('UPDATE_APPLICATION', res.data.application)
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

        async deleteApplication({ commit }, item_id) {
            const res = await axios.delete('application/dps/delete/'+item_id)
            if (res.data.status) {
                commit('DELETE_APPLICATION', item_id)
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },
    },
}
