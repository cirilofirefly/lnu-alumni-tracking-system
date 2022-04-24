import axios from '../../../axios'

const AUTH = "admin"

export default {
    namespaced: true,
    state: {
        total_alumni_by_batch: {
            labels: [],
            data: []
        },
        total_batch: 0,
        total_alumni_record: 0,
        total_alumni: 0

    },
    getters: {
        GET_ALUMNI_COUNT_BY_BATCH: (state) => state.total_alumni_by_batch,
        GET_ALUMNI_RECORD_COUNT: (state) => state.total_alumni_record,
        GET_BATCHES_COUNT: (state) => state.total_batch,
        GET_ALUMNI_COUNT: (state) => state.total_alumni,
    },
    mutations: {
        SET_ALUMNI_COUNT_BY_BATCH: (state, total_alumni_by_batch) => {
            state.total_alumni_by_batch = {
                labels: [],
                data: []
            }
            total_alumni_by_batch.forEach(batch => {
                state.total_alumni_by_batch.labels.push(`${batch.batch} - ${batch.batch + 1}`)
                state.total_alumni_by_batch.data.push(batch.student_account_infos_count)
            });
        },
        SET_BATCH_COUNT: (state, total_batch) => {
            state.total_batch = total_batch
        },
        SET_ALUMNI_RECORD_COUNT: (state, total_alumni_record) => {
            state.total_alumni_record = total_alumni_record
        },
        SET_ALUMN: (state, total_alumni_record) => {
            state.total_alumni_record = total_alumni_record
        },

    },
    actions: {
        TOTAL_ALUMNI_BY_BATCH: async ({ commit }) => {
            const res = await axios.get(`${AUTH}/total-alumni-by-batch?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_ALUMNI_COUNT_BY_BATCH", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        TOTAL_ALUMNI_RECORDS: async ({ commit }) => {
            const res = await axios.get(`${AUTH}/total-alumni-records?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_ALUMNI_RECORD_COUNT", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        TOTAL_BATCHES: async ({ commit }) => {
            const res = await axios.get(`${AUTH}/total-batch?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_BATCH_COUNT", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        }
    }
}