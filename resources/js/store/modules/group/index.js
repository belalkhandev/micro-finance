import axios from "axios";

export default {
    namespaced: true,

    state: {
        groups: null,

        days: [
            {code: 'Saturday', name: 'Saturday', bn_name: 'শনিবার'},
            {code: 'Sunday', name: 'Sunday', bn_name: 'রবিবার'},
            {code: 'Monday', name: 'Monday', bn_name: 'সোমবার'},
            {code: 'Tuesday', name: 'Tuesday', bn_name: 'মঙ্গলবার'},
            {code: 'Wednesday', name: 'Wednesday', bn_name: 'বুধবার'},
            {code: 'Thursday', name: 'Thursday', bn_name: 'বৃহস্পতিবার'},
            {code: 'Friday', name: 'Friday', bn_name: 'শুক্রবার'},
        ],

        member_types: [
            {code: 'deposit_weekly', name: 'DPS Weekly', bn_name: 'ডিপিএস সাপ্তাহিক'},
            {code: 'deposit_monthly', name: 'DPS Monthly', bn_name: 'ডিপিএস মাসিক'},
            {code: 'loan_weekly', name: 'Loan Weekly', bn_name: 'লোন সাপ্তাহিক'},
            {code: 'loan_monthly', name: 'Loan Monthly', bn_name: 'লোন মাসিক'},
        ],

        relations: [
            {code: 'father', name: 'Father', bn_name: 'বাবা'},
            {code: 'mother', name: 'Mother', bn_name: 'মা'},
            {code: 'son', name: 'Son', bn_name: 'পুত্র'},
            {code: 'daughter', name: 'Daughter', bn_name: 'কন্যা'},
            {code: 'brother', name: 'Brother', bn_name: 'ভাই'},
            {code: 'sister', name: 'Sister', bn_name: 'বোন'},
            {code: 'wife', name: 'Husband', bn_name: 'স্বামী'},
            {code: 'wife', name: 'Wife', bn_name: 'স্ত্রী'},
            {code: 'uncle', name: 'Uncle', bn_name: 'চাচা/মামা'},
            {code: 'aunty', name: 'Aunty', bn_name: 'চাচি/খালা'},
        ],

        application_types: [
            {code: 'weekly', name: 'Weekly', bn_name: 'সাপ্তাহিক'},
            {code: 'monthly', name: 'Monthly', bn_name: 'মাসিক'},
        ]
    },

    getters: {
        groups(state){
            return state.groups
        },

        days(state) {
            return state.days
        },

        member_types(state) {
            return state.member_types
        },

        relations(state) {
            return state.relations
        },

        application_types (state) {
            return state.application_types
        }
    },

    mutations: {
        SET_GROUPS(state, groups) {
            state.groups = groups
        },

        SET_GROUP(state, group) {
            if (state.groups) {
                state.groups.unshift(group)
            }else {
                state.groups = [group]
            }
        },

        UPDATE_GROUP(state, group) {
            const item = state.groups.find(item => item.id === group.id)
            Object.assign(item, group)
        },

        DELETE_GROUP(state, item_id) {
            const group  = state.groups.find(item => item.id == item_id)
            if (group) {
                state.groups.splice(state.groups.indexOf(group), 1)
            }
        },
    },

    actions: {
        //group actions
        async getGroups({ commit }) {
            const res = await axios.get('member-group/list')

            if (res.data.status) {
                commit('SET_GROUPS', res.data.groups)
            }
        },

        async createGroup({ commit }, formdata) {
            const res = await axios.post('member-group/create', formdata)

            if (res.data.status) {
                commit('SET_GROUP', res.data.group)
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

        async editGroup({ commit }, formdata) {
            const res = await axios.put('member-group/update/'+formdata.group_id, formdata)

            if (res.data.status) {
                commit('UPDATE_GROUP', res.data.group)
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

        async deleteGroup({ commit }, item_id) {
            const res = await axios.delete('member-group/delete/'+item_id)
            if (res.data.status) {
                commit('DELETE_GROUP', item_id)
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
