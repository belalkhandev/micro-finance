import axios from "axios";

export default {
    namespaced: true,

    state: {
        savings: null,
        savings_transactions: null
    },

    getters: {
        savings(state){
            return state.savings
        },

        savings_transactions(state) {
            return state.savings_transactions
        }
    },

    mutations: {
        SET_SAVINGS(state, savings) {
            state.savings = savings
        },

        SET_SAVINGS_TRANSACTIONS(state, savings) {
            state.savings_transactions = savings
        },

        SET_SAVING(state, saving) {
            if (state.savings && state.savings.length) {
                state.savings.unshift(saving)
            }else {
                state.savings = [saving]
            }
        },

        UPDATE_SAVING(state, saving) {
            const item = state.savings.find(item => item.id === saving.id)
            Object.assign(item, saving)
        },

        DELETE_SAVING(state, item_id) {
            const saving  = state.savings.find(item => item.id == item_id)
            if (saving) {
                state.savings.splice(state.savings.indexOf(saving), 1)
            }
        },
    },

    actions: {
        async getSavingsTransactions({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('member/savings/list?page='+page_no)

            if (res.data.status) {
                commit('SET_SAVINGS_TRANSACTIONS', res.data.savings)
            }
        },

        async filterSavingsTransactions({ commit }, formData) {
            const res = await axios.get('member/savings/list', {
                params: formData
            })

            if (res.data.status) {
                commit('SET_SAVINGS_TRANSACTIONS', res.data.savings)
            }
        },

        async getSavings({ commit }, member_id) {
            const res = await axios.get('member/savings/list/'+member_id)

            if (res.data.status) {
                commit('SET_SAVINGS', res.data.savings)
            }
        },

        async createSaving({ commit }, formdata) {
            try {
                const res = await axios.post('member/savings/create', formdata)

                if (res.data.status) {
                    commit('SET_SAVING', res.data.savings)
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
            }catch (err) {
                commit('SET_ERROR_MESSAGE', 'Something went wrong', { root:true })
            }
        },

        async editSaving({ commit }, formdata) {
            const res = await axios.put('member/savings/update/'+formdata.saving_id, formdata)

            if (res.data.status) {
                commit('UPDATE_SAVING', res.data.saving)
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

        async deleteSaving({ commit }, item_id) {
            const res = await axios.delete('member/savings/delete/'+item_id)
            if (res.data.status) {
                commit('DELETE_SAVING', item_id)
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
