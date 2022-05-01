
import axios from '../../../axios'

const STUDENT = "admin"

export default {
    namespaced: true,
    state: {
        student_id_requests: {},
        student_id_request: {}

    },
    mutations: {
        SET_STUDENT_ID_REQUESTS: (state, student_id_requests) => {
            state.student_id_requests = student_id_requests
        },
        SET_STUDENT_ID_REQUEST: (state, student_id_request) => {
            state.student_id_request = student_id_request
        },
    },
    getters: {
        GET_STUDENT_ID_REQUESTS: (state) => state.student_id_requests,
        GET_STUDENT_ID_REQUEST: (state) => state.student_id_request,
    },
    actions: {
        FETCH_STUDENT_ID_REQUESTS: async ({ commit }, requestType) => {
            return await axios.get(`${STUDENT}/get-student-id-requests/${requestType}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_STUDENT_ID_REQUESTS', response.data)
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

        },
        FETCH_STUDENT_ID_REQUEST: async ({ commit }, id) => {
            return await axios.get(`${STUDENT}/get-student-id-request/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_STUDENT_ID_REQUEST', response.data)
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

        },
        APPROVE_ID_REQUEST: async ({ commit }, id) => {
            return await axios.post(`${STUDENT}/approve-student-id-request/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

        },
        DISAPPROVE_ID_REQUEST: async ({ commit }, id) => {
            return await axios.post(`${STUDENT}/disapprove-student-id-request/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

        },
    }
}