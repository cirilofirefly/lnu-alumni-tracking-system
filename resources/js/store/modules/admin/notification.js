import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        notification: {},
    },
    getters: {
        GET_NOTIF: (state) => state.notification,
    },
    mutations: {
        SET_NOTIF: (state, notification) => {
            state.notification = notification
        },
    },
    actions: {
        FETCH_NOTIF: async ({ commit }) => {
            const res = await axios.get(`${ADMIN}/get-notification`)
                .then((response) => {
                    commit("SET_NOTIF", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        STORE_NOTIF: async ({ commit }, data) => {
            const res = await axios.post(`${ADMIN}/notification?token=${localStorage.getItem('access_token'), data}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        UPDATE_NOTIF: async (data) => {
            const res = await axios.put(`admin/update-notification`, data)
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
