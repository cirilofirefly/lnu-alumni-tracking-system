import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        batches: {},
        batches_count: 0,
        students: {}
    },
    getters: {
        GET_BATCHES: (state) => state.batches,
        GET_BATCHES_COUNT: (state) => state.batches_count,
        GET_STUDENTS: (state) => state.students,

    },
    mutations: {
        SET_BATCHES: (state, batches) => {
            state.batches = batches
        },
        SET_BATCHES_COUNT: (state, batches_count) => {
            state.batches_count = batches_count
        },
        SET_STUDENTS: (state, students) => {
            state.students = students
        },

    },
    actions: {
        FETCH_BATCHES: async ({ commit }) => {
            const res = await axios.get(`${ADMIN}/batches?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_BATCHES", response.data);
                    commit("SET_BATCHES_COUNT", response.data.length);
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
        },
        FETCH_STUDENTS_BY_BATCH: async ({ commit }, id) => {
            const res = await axios.get(`${ADMIN}/get-students-by-batch?batch_id=${id}token=${localStorage.getItem('access_token')}`, )
                .then((response) => {
                    commit("SET_STUDENTS", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        }

    }
}