import axios from '../../../axios'

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
            const res = await axios.get(`batches?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_BATCHES", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        }
    }
}