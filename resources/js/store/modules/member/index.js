import axios from "axios";

export default {
    namespaced: true,

    state: {
        members: null,
    },

    getters: {
        members(state){
            return state.members
        },
    },

    mutations: {
        SET_MEMBERS(state, members) {
            state.members = members
        },

        SET_MEMBER(state, member) {
            if (state.members) {
                state.members.unshift(member)
            }else {
                state.members = [member]
            }
        },

        UPDATE_MEMBER(state, member) {
            const item = state.members.find(item => item.id === member.id)
            Object.assign(item, member)
        },

        DELETE_MEMBER(state, item_id) {
            const member  = state.members.find(item => item.id == item_id)
            if (member) {
                state.members.splice(state.members.indexOf(member), 1)
            }
        },
    },

    actions: {
        //member actions
        async getMembers({ commit }) {
            const res = await axios.get('member/list')

            if (res.data.status) {
                commit('SET_MEMBERS', res.data.members)
            }
        },

        async createMember({ commit }, formdata) {
            const res = await axios.post('member/create', formdata)

            if (res.data.status) {
                commit('SET_MEMBER', res.data.member)
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

        async editMember({ commit }, formdata) {
            const res = await axios.put('member/update/'+formdata.member_id, formdata)

            if (res.data.status) {
                commit('UPDATE_MEMBER', res.data.member)
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

        async deleteMember({ commit }, item_id) {
            const res = await axios.delete('member/delete/'+item_id)
            if (res.data.status) {
                commit('DELETE_MEMBER', item_id)
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
