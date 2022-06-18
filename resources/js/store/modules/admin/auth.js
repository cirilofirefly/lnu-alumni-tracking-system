import axios from '../../../axios'

const AUTH = "auth/admin"

export default {
    namespaced: true,
    state: {
        user: {},
        token: localStorage.getItem('access_token') || '',
    },
    getters: {
        GET_ADMIN_TOKEN: (state) => state.token,
        GET_ADMIN_USER: (state) => state.user,

    },
    mutations: {
        SET_ADMIN_TOKEN: (state, token) => {
            localStorage.setItem("access_token", token);
            state.token = token;
            const bearer_token = localStorage.getItem("access_token") || "";
            axios.defaults.headers.common["Authorization"] = `Bearer ${bearer_token}`;
        },
        SET_ADMIN_USER: (state, user) => {
            localStorage.setItem('isAdmin', 'true');
            state.user = user;

        },
        UNSET_ADMIN_TOKEN: (state) => {
            localStorage.removeItem("access_token");
            localStorage.removeItem('isAdmin');
            state.token = "";
            axios.defaults.headers.common["Authorization"] = "";
        },
        UNSET_ADMIN_USER: (state) => {
            state.user = {}
        },
    },
    actions: {
        LOGOUT: async ({ commit }) => {
            const res = await axios.post(`${AUTH}/logout?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("UNSET_ADMIN_TOKEN");
                    commit("UNSET_ADMIN_USER");
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
                        commit("SET_ADMIN_TOKEN", response.data.access_token);
                        commit("SET_ADMIN_USER", response.data.user);
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
                    commit("SET_ADMIN_USER", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        }
    }
}