import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        alumnae: {},
        alumnae_count: 0
    },

    mutations: {
        SET_ALUMNAE: (state, alumnae) => {
            state.alumnae = alumnae
        },

        SET_ALUMNAE_COUNT: (state, alumnae_count) => {
            state.alumnae_count = alumnae_count
        },

    },

    getters: {
        GET_ALUMNAE: (state) => state.alumnae,
        GET_ALUMNAE_COUNT: (state) => state.alumnae_count
    },
    actions: {
        APPROVE_ALUMNI: async ({ commit }, id) => {
            const res = await axios.put(`${ADMIN}/approve-alumni/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        DISAPPROVE_ALUMNI: async ({ commit }, id) => {
            const res = await axios.put(`${ADMIN}/disapprove-alumni/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        FETCH_ALUMNAE: async ({ commit }) => {
            const res = await axios.get(`${ADMIN}/alumnae?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_ALUMNAE', response.data)
                    commit('SET_ALUMNAE_COUNT', response.data.length)
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },

    }
}