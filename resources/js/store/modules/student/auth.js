import axios from '../../../axios'

const AUTH = "auth/student"

export default {
    namespaced: true,
    state: {
        user: {},
        token: localStorage.getItem('access_token') || '',
    },
    getters: {
        GET_STUDENT_TOKEN: (state) => state.token,
        GET_STUDENT_USER: (state) => state.user,

    },
    mutations: {
        SET_STUDENT_TOKEN: (state, token) => {
            localStorage.setItem("access_token", token);
            state.token = token;
            const bearer_token = localStorage.getItem("access_token") || "";
            axios.defaults.headers.common["Authorization"] = `Bearer ${bearer_token}`;
        },
        SET_STUDENT_USER: (state, user) => {
            localStorage.setItem('isStudent', 'true');
            state.user = user;

        },
        UNSET_STUDENT_TOKEN: (state) => {
            localStorage.removeItem("access_token");
            localStorage.removeItem('isStudent');
            state.token = "";
            axios.defaults.headers.common["Authorization"] = "";
        },
        UNSET_STUDENT_USER: (state) => {
            state.user = {}
        },
    },
    actions: {
        LOGOUT: async ({ commit }) => {
            const res = await axios.post(`${AUTH}/logout?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("UNSET_STUDENT_TOKEN");
                    commit("UNSET_STUDENT_USER");
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        LOGIN: async ({ commit }, user) => {
            const res = await axios.post(`${AUTH}/login`, user)
                .then((response) => {
                    if (response.data?.access_token) {
                        commit("SET_STUDENT_TOKEN", response.data.access_token);
                        commit("SET_STUDENT_USER", response.data.user);
                    }
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },
        CHECK: async ({ commit }) => {
            const res = await axios.post(
                `${AUTH}/me?token=` + localStorage.getItem("access_token")
            )
                .then((response) => {
                    commit("SET_STUDENT_USER", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        },

        SIGNUP: async ({ commit }, data) => {

            const res = await axios.post(`${AUTH}/signup`, data, {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            })
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