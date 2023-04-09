import axios from "axios";

export default {
    namespaced: true,
    state: {
        applications: null,
        application: null,
        statistics: null,
        loan: null
    },

    getters: {
        applications(state) {
            return state.applications
        },

        application(state) {
            return state.application
        },

        statistics(state) {
            return state.statistics
        },

        loan (state) {
            return state.loan
        }
    },

    mutations: {
        SET_APPLICATIONS(state, applications) {
            state.applications = applications
        },

        GET_APPLICATION(state, application) {
            state.application = application
        },

        SET_STATISTICS(state, total) {
            state.statistics = total
        },

        SET_LOAN(state, loan) {
            state.loan = loan
        },

        SET_APPLICATION(state, application) {
            if (state.applications && state.applications.data) {
                state.applications.data.unshift(application)
            }else {
                state.applications.data = [application]
            }
        },

        UPDATE_APPLICATION(state, application) {
            if (state.applications && state.applications.data) {
                const item = state.applications.data.find(item => item.id === application.id)
                if (item) {
                    Object.assign(item, application)
                }
            }
        },

        DELETE_APPLICATION(state, item_id) {
            const application  = state.applications.data.find(item => item.id == item_id)
            if (application) {
                state.applications.data.splice(state.applications.data.indexOf(application), 1)
            }
        },
    },

    actions: {
        async getApplications({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('application/loan/list?page='+page_no)

            if (res.data.status) {
                commit('SET_APPLICATIONS', res.data.applications)
            }
        },

        async getApplicationById({ commit }, application_id) {
            const res = await axios.get('application/loan/list/'+application_id)

            if (res.data.status) {
                commit('GET_APPLICATION', res.data.application)
            }
        },

        async filterApplications({ commit }, formData) {
            const res = await axios.get('application/loan/list', {
                params: formData
            })

            if (res.data.status) {
                commit('SET_APPLICATIONS', res.data.applications)
            } else {
                commit('SET_APPLICATIONS', null)
            }
        },

        async getMemberApplications({ commit }, member_id) {
            const res = await axios.get('application/loan/member/list/'+member_id)

            if (res.data.status) {
                commit('SET_LOAN', res.data.loan)
            }
        },


        async getLoanStatistics({ commit }) {
            const res = await axios.get('application/loan/statistics')

            if (res.data.status) {
                commit('SET_STATISTICS', res.data.total)
            }
        },

        async createApplication({ commit }, formdata) {
            const res = await axios.post('application/loan/create', formdata)

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
            const res = await axios.put('application/loan/update/'+formdata.application_id, formdata)

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

        async closeApplication({ commit }, formdata) {
            const res = await axios.post('application/loan/close/'+formdata.application_id, formdata)

            if (res.data.status) {
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
            const res = await axios.delete('application/loan/delete/'+item_id)
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
