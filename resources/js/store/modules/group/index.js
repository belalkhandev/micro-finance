import axios from "axios";

export default {
    namespaced: true,

    state: {
        groups: null,
        days: [
            {'code': 'Saturday', 'name': 'Saturday', 'bn_name': 'শনিবার'},
            {'code': 'Sunday', 'name': 'Sunday', 'bn_name': 'রবিবার'},
            {'code': 'Monday', 'name': 'Monday', 'bn_name': 'সোমবার'},
            {'code': 'Tuesday', 'name': 'Tuesday', 'bn_name': 'মঙ্গলবার'},
            {'code': 'Wednesday', 'name': 'Wednesday', 'bn_name': 'বুধবার'},
            {'code': 'Thursday', 'name': 'Thursday', 'bn_name': 'বৃহস্পতিবার'},
            {'code': 'Friday', 'name': 'Friday', 'bn_name': 'শুক্রবার'},
        ]
    },

    getters: {
        groups(state){
            return state.groups
        },

        days(state) {
            return state.days
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
