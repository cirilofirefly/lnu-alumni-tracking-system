import axios from '../../../axios'

const AUTH = "auth/admin"

export default {
    namespaced: true,
    state: {

    },
    getters: {
        GET_ADMIN_TOKEN: (state) => state.token,

    },
    mutations: {
        SET_ADMIN_TOKEN: (state, token) => {

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
        }
    }
}