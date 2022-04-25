import axios from '../../../axios'

const STUDENT = "student"

export default {
    namespaced: true,
    state: {
        event: {}
    },
    mutations: {
        SET_EVENT: (state, event) => {
            state.event = event
        },
    },
    getters: {
        GET_EVENT: (state) => state.event,
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
    }
}