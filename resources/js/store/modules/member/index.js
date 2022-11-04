import axios from "axios";

export default {
    namespaced: true,

    state: {
        members: null,
        groupMembers: null,
        member: null,
        dps_transactions: null,
        loan_transactions: null,
    },

    getters: {
        members(state){
            return state.members
        },

        groupMembers(state){
            return state.groupMembers
        },

        member(state){
            return state.member
        },

        dps_transactions(state){
            return state.dps_transactions
        },

        loan_transactions(state){
            return state.loan_transactions
        },
    },

    mutations: {
        SET_MEMBERS(state, members) {
            state.members = members
        },

        SET_GROUP_MEMBERS(state, members) {
            state.groupMembers = members
        },

        SET_MEMBER_DPS_TRANSACTIONS(state, dps_transactions) {
            state.dps_transactions = dps_transactions
        },

        SET_MEMBER_LOAN_TRANSACTIONS(state, loan_transactions) {
            state.loan_transactions = loan_transactions
        },

        SET_MEMBER(state, member) {
            if (state.members) {
                state.members.unshift(member)
            }else {
                state.members = [member]
            }
        },

        SET_SINGLE_MEMBER(state, member) {
            state.member = member;
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
        async getMembers({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('member/list?page='+page_no)

            if (res.data.status) {
                commit('SET_MEMBERS', res.data.members)
            }
        },

        //member actions
        async getGroupMembers({ commit }, groupId, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('member/group/'+groupId+'?page='+page_no)

            if (res.data.status) {
                commit('SET_GROUP_MEMBERS', res.data.members)
            }
        },

        async getByMemberId({ commit }, member_id) {
            const res = await axios.get('member/'+member_id+'/show')

            if (res.data.status) {
                commit('SET_SINGLE_MEMBER', res.data.member)
            }
        },

        async getLoanTransactions({ dispatch, commit }, member_id) {
            const res = await axios.get('member/transactions/loan/'+member_id)
            if (res.data.status) {
                commit('SET_MEMBER_LOAN_TRANSACTIONS', res.data.transactions)
            }
        },

        async getDpsTransactions({ commit }, member_id) {
            const res = await axios.get('member/transactions/dps/'+member_id)

            if (res.data.status) {
                commit('SET_MEMBER_DPS_TRANSACTIONS', res.data.transactions)
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
            const res = await axios.post('member/update/'+formdata.get('member_id'), formdata)

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
