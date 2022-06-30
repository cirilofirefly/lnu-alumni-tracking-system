import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        events: {},
        event: {}
    },
    getters: {
        GET_EVENTS: (state) => state.events,
        GET_EVENT: (state) => state.event,

    },
    mutations: {
        SET_EVENTS: (state, events) => {
            state.events = events
        },
        SET_EVENT: (state, event) => {
            state.event = event
        },

    },
    actions: {
        FETCH_EVENTS: async ({ commit }, search) => {
            const res = await axios.get(`${ADMIN}/events?search=${search}&token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_EVENTS", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        FETCH_EVENT: async ({ commit }, slug) => {
            const res = await axios.get(`${ADMIN}/event/${slug}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_EVENT", response.data);
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
