import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        feedbacks: {},
    },
    getters: {
        GET_FEEDBACKS: (state) => state.feedbacks,
    },
    mutations: {
        SET_FEEDBACKS: (state, feedbacks) => {
            state.feedbacks = feedbacks
        },
    },
    actions: {
        FETCH_FEEDBACKS: async ({ commit }) => {
            const res = await axios.get(`${ADMIN}/get-feedbacks?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_FEEDBACKS", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        STORE_FEEDBACK: async ({ commit }) => {
            const res = await axios.post(`${ADMIN}/feedbacks?token=${localStorage.getItem('access_token')}`)
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