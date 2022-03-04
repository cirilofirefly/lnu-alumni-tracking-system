import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        events: {}
    },
    getters: {
        GET_EVENTS: (state) => state.events,

    },
    mutations: {
        SET_EVENTS: (state, events) => {
            state.events = events
        },

    },
    actions: {
        FETCH_EVENTS: async ({ commit }) => {
            const res = await axios.get(`${ADMIN}/events?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_EVENTS", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        STORE_EVENT: async ({ commit }, data) => {
            const res = await axios.post(`${ADMIN}/events?token=${localStorage.getItem('access_token')}`, data)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        UPDATE_EVENT: async ({ commit }, { id, data }) => {
            const res = await axios.put(`${ADMIN}/events/${id}?token=${localStorage.getItem('access_token')}`, data)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        DELETE_EVENT: async ({ commit }, id) => {
            const res = await axios.delete(`${ADMIN}/events/${id}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        }
    }
}