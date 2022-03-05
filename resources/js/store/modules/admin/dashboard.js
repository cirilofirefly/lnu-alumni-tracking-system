import axios from '../../../axios'

const AUTH = "admin"

export default {
    namespaced: true,
    state: {
        total_alumni: {
            labels: [],
            data: []
        }
    },
    getters: {
        GET_ALUMNI_ACOUNT_BY_BATCH: (state) => state.total_alumni,

    },
    mutations: {
        SET_ALUMNI_ACOUNT_BY_BATCH: (state, total_alumni) => {
            state.total_alumni = {
                labels: [],
                data: []
            }
            total_alumni.forEach(batch => {
                state.total_alumni.labels.push(`${batch.batch} - ${batch.batch + 1}`)
                state.total_alumni.data.push(batch.student_account_infos_count)
            });
        },

    },
    actions: {
        TOTAL_ALUMNI: async ({ commit }) => {
            const res = await axios.get(`${AUTH}/total-alumni-by-batch?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_ALUMNI_ACOUNT_BY_BATCH", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        }
    }
}