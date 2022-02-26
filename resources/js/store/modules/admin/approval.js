import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        alumnae: {}
    },

    mutations: {
        SET_ALUMNAE: (state, alumnae) => {
            state.alumnae = alumnae
        },

    },

    getters: {
        GET_ALUMNAE: (state) => state.alumnae,
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
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },

    }
}