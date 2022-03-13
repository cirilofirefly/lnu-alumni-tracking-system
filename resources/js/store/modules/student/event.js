import axios from '../../../axios'

const STUDENT = "student"

export default {
    namespaced: true,
    actions: {
        FETCH_EVENT: async ({ commit }) => {
            const res = await axios.get(`${STUDENT}/events?token=${localStorage.getItem('access_token')}`)
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