import Vue from 'vue'
import Vuex from 'vuex'

import ADMIN_AUTH from './modules/admin/auth';
import STUDENT_AUTH from './modules/student/auth';


Vue.use(Vuex);


export default new Vuex.Store({
    modules: {
        ADMIN_AUTH,
        STUDENT_AUTH
    }
})