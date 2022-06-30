import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        alumnae: {},
        alumnae_count: 0,
        records: {},
        record: {},
        records_count: 0
    },

    mutations: {
        SET_ALUMNAE: (state, alumnae) => {
            state.alumnae = alumnae
        },

        SET_ALUMNAE_COUNT: (state, alumnae_count) => {
            state.alumnae_count = alumnae_count
        },
        SET_ALUMNAE_RECORDS: (state, records) => {
            state.records = records
        },

        SET_ALUMNAE_RECORD: (state, record) => {
            state.record = record
        },
        SET_ALUMNAE_RECORDS_COUNT: (state, records_count) => {
            state.records_count = records_count
        },

    },

    getters: {
        GET_ALUMNAE: (state) => state.alumnae,
        GET_ALUMNAE_COUNT: (state) => state.alumnae_count,
        GET_ALUMNAE_RECORDS: (state) => state.records,
        GET_ALUMNAE_RECORD: (state) => state.record,
        GET_ALUMNAE_RECORDS_COUNT: (state) => state.records_count
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
        FETCH_ALUMNAE: async ({ commit }, search) => {
            const res = await axios.get(`${ADMIN}/alumnae?search=${search}&token=${localStorage.getItem('access_token')}`)
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

        FETCH_ALUMNAE_RECORDS: async ({ commit }) => {
            const res = await axios.get(`${ADMIN}/records?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_ALUMNAE_RECORDS', response.data)
                    commit('SET_ALUMNAE_RECORDS_COUNT', response.data.length)
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },

        FETCH_ALUMNAE_RECORD: async ({ commit }, id) => {
            const res = await axios.get(`${ADMIN}/record/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_ALUMNAE_RECORD', response.data)
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },


    }
}
