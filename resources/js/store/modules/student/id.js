
import axios from '../../../axios'

const STUDENT = "student"

export default {
    namespaced: true,
    state: {
        account: {},
        logs: {}
    },
    mutations: {
        SET_STUDENT_ACCOUNT: (state, account) => {
            state.account = account
        },
        SET_REQUEST_LOGS: (state, logs) => {
            state.logs = logs
        },
    },
    getters: {
        GET_STUDENT_ACCOUNT: (state) => state.account,
        GET_REQUEST_LOGS: (state) => state.logs,

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
        FETCH_REQUEST_LOGS: async ({ commit }, id) => {
            const res = await axios.get(`${STUDENT}/request-logs/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_REQUEST_LOGS', response.data)
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        UPDATE_STUDENT_ACCOUNT: async ({ commit }, data) => {
            const response = await axios.put(`${STUDENT}/update-student-account?token=${localStorage.getItem('access_token')}`, data)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return response;
        },

        UPLOAD_IMAGE: async ({ commit }, image) => {
            return await axios.post(`${STUDENT}/upload-image?token=${localStorage.getItem('access_token')}`, image)
                .then(response => {
                    return response;
                })
                .catch(error => {
                    return error.response
                })
        },
        UPLOAD_SIGNATURE: async ({ commit }, signature) => {
            return await axios.post(`${STUDENT}/upload-signature?token=${localStorage.getItem('access_token')}`, signature)
                .then(response => {
                    return response;
                })
                .catch(error => {
                    return error.response
                })
        },
        SEND_ID_REQUEST: async ({ commit }, id_ino) => {
            return await axios.post(`${STUDENT}/send-id-request?token=${localStorage.getItem('access_token')}`, id_ino)
                .then(response => {
                    return response;
                })
                .catch(error => {
                    return error.response
                })
        }
    }

}
