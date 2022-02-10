import axios from "axios";

export default {
    namespaced: true,

    state: {
        divisions: null,
        districts: null,
        upazillas: null,
        unions: null,
        post_offices: null,
        villages: null
    },

    getters: {
        divisions (state) {
            return state.divisions
        },

        districts (state) {
            return state.districts
        },

        upazillas (state) {
            return state.upazillas
        },

        unions (state) {
            return state.unions
        },

        post_offices (state) {
            return state.post_offices
        },

        villages (state) {
            return state.villages
        }

    },

    mutations: {
        SET_DIVISIONS(state, divisions) {
            state.divisions = divisions
        },

        SET_DISTRICTS(state, districts) {
            state.districts = districts
        },

        SET_UPAZILLAS(state, upazillas) {
            state.upazillas = upazillas
        },

        SET_UNIONS(state, unions) {
            state.unions = unions
        },

        //village mutations
        SET_VILLAGES(state, villages) {
            state.villages = villages
        },

        SET_VILLAGE(state, village) {
            if (state.villages) {
                state.villages.unshift(village)
            }
        },

        UPDATE_VILLAGE(state, village) {
            const item = state.villages.find(item => item.id === village.id)
            Object.assign(item, village)
        },

        DELETE_VILLAGE(state, item_id) {
            const village  = state.villages.find(item => item.id == item_id)
            if (village) {
                state.villages.splice(state.villages.indexOf(village), 1)
            }
        },

        //set post office
        SET_POST_OFFICES(state, post_offices) {
            state.post_offices = post_offices
        },

        SET_POST_OFFICE(state, post_office) {
            if (state.post_offices) {
                state.post_offices.unshift(post_office)
            }
        },

        UPDATE_POST_OFFICE(state, post_office) {
            const item = state.post_offices.find(item => item.id === post_office.id)
            Object.assign(item, post_office)
        },

        DELETE_POST_OFFICE(state, item_id) {
            const post_office  = state.post_offices.find(item => item.id == item_id)
            if (post_office) {
                state.post_offices.splice(state.post_offices.indexOf(post_office), 1)
            }
        }
    },

    actions: {
        async getDivisions({ commit }) {
            const res = await axios.get('/division/list')

            if (res.data.status) {
                commit('SET_DIVISIONS', res.data.divisions)
            }
        },

        async getDistricts({ commit }) {
            const res = await axios.get('/district/list')

            if (res.data.status) {
                commit('SET_DISTRICTS', res.data.districts)
            }
        },

        async getUpazillas({ commit }) {
            const res = await axios.get('/upazilla/list')

            if (res.data.status) {
                commit('SET_UPAZILLAS', res.data.upazillas)
            }
        },

        async getUnions({ commit }) {
            const res = await axios.get('/union/list')

            if (res.data.status) {
                commit('SET_UNIONS', res.data.unions)
            }
        },

        async getPostOffice({ commit }) {
            const res = await axios.get('/post-office/list')

            if (res.data.status) {
                commit('SET_POST_OFFICES', res.data.post_offices)
            }
        },

        //village actions
        async getVillages({ commit }) {
            const res = await axios.get('/village/list')

            if (res.data.status) {
                commit('SET_VILLAGES', res.data.villages)
            }
        },

        async createVillage({ commit }, formdata) {
            const res = await axios.post('/village/create', formdata)

            if (res.data.status) {
                commit('SET_VILLAGE', res.data.village)
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

        async editVillage({ commit }, formdata) {
            const res = await axios.put('/village/update/'+formdata.village_id, formdata)

            if (res.data.status) {
                commit('UPDATE_VILLAGE', res.data.village)
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

        async deleteVillage({ commit }, item_id) {
            const res = await axios.delete('/village/delete/'+item_id)
            if (res.data.status) {
                commit('DELETE_VILLAGE', item_id)
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },

        //post office actions
        async createPostOffice({ commit }, formdata) {
            const res = await axios.post('/post-office/create', formdata)

            if (res.data.status) {
                commit('SET_POST_OFFICE', res.data.post_office)
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

        async editPostOffice({ commit }, formdata) {
            const res = await axios.put('/post-office/update/'+formdata.post_office_id, formdata)

            if (res.data.status) {
                commit('UPDATE_POST_OFFICE', res.data.post_office)
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

        async deletePostOffice({ commit }, item_id) {
            const res = await axios.delete('/post-office/delete/'+item_id)
            if (res.data.status) {
                commit('DELETE_POST_OFFICE', item_id)
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },
    }
}
