
import axios from '../../../axios'

const STUDENT = "student"

export default {
    namespaced: true,
    state: {
        account: {}
    },
    mutations: {
        SET_STUDENT_ACCOUNT: (state, account) => {
            state.account = account
        },
    },
    getters: {
        GET_STUDENT_ACCOUNT: (state) => state.account,
    },
    actions: {
        FETCH_STUDENT_ACCOUNT: async ({ commit }, id) => {
            const res = await axios.get(`${STUDENT}/id-student-account/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_STUDENT_ACCOUNT', response.data)
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        UPDATE_STUDENT_ACCOUNT: async ({ commit }, data) => {
            const res = await axios.put(`${STUDENT}/update-student-account?token=${localStorage.getItem('access_token')}`, data)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
    }

}