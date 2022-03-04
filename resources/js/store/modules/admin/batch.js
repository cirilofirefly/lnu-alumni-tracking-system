import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        batches: {}
    },
    getters: {
        GET_BATCHES: (state) => state.batches,

    },
    mutations: {
        SET_BATCHES: (state, batches) => {
            state.batches = batches
        },

    },
    actions: {
        FETCH_BATCHES: async ({ commit }) => {
            const res = await axios.get(`${ADMIN}/batches?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_BATCHES", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        STORE_BATCH: async ({ commit }) => {
            const res = await axios.post(`${ADMIN}/batches?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        DELETE_BATCH: async ({ commit }, id) => {
            const res = await axios.delete(`${ADMIN}/batches/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        }
    }
}