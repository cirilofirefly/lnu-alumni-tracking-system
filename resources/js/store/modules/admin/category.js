import axios from '../../../axios'

const ADMIN = "admin"

export default {
    namespaced: true,
    state: {
        categories: {}
    },
    getters: {
        GET_CATEGORIES: (state) => state.categories,

    },
    mutations: {
        SET_CATEGORIES: (state, categories) => {
            state.categories = categories
        },

    },
    actions: {
        FETCH_CATEGORIES: async ({ commit }) => {
            const res = await axios.get(`${ADMIN}/categories?token=${localStorage.getItem('access_token')}`)
                .then((response) => {
                    commit("SET_CATEGORIES", response.data);
                    return response;
                })
                .catch((error) => {
                    return error.response;
                });

            return res;
        }
    }
}