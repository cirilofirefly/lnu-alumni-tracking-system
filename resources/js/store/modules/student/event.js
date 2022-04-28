import axios from '../../../axios'

const STUDENT = "student"

export default {
    namespaced: true,
    state: {
        event: {},
        events: {}

    },
    mutations: {
        SET_EVENT: (state, event) => {
            state.event = event
        },
        SET_EVENTS: (state, events) => {
            state.events = events
        },
    },
    getters: {
        GET_EVENT: (state) => state.event,
        GET_EVENTS: (state) => state.events,
    },
    actions: {
        FETCH_LATEST_EVENT: async ({ commit }) => {
            const res = await axios.get(`${STUDENT}/latest-event?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        FETCH_EVENT: async ({ commit }, slug) => {
            const res = await axios.get(`${STUDENT}/event/${slug}?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_EVENT', response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },

        FETCH_EVENTS: async ({ commit }) => {
            const res = await axios.get(`${STUDENT}/events?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit('SET_EVENTS', response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },

        POST_COMMENT: async ({ commit }, comment) => {
            const response = await axios.post(`${STUDENT}/post-comment?token=${localStorage.getItem('access_token')}`, comment)
                .then((response) => {
                    commit('SET_EVENTS', response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return response;
        },
    }
}