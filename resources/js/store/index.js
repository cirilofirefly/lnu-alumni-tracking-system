import Vue from 'vue'
import Vuex from 'vuex'
import ADMIN_AUTH from './modules/admin/auth';
import ADMIN_BATCH from './modules/admin/batch';
import ADMIN_FEEDBACK from './modules/admin/feedback';
import ADMIN_CATEGORIES from './modules/admin/category';
import ADMIN_DASHBOARD from './modules/admin/dashboard';
import ADMIN_EVENT from './modules/admin/event';
import ADMIN_ID_MANAGEMENT from './modules/admin/id';
import ALUMNAE_APPROVAL from './modules/admin/approval';
import STUDENT_AUTH from './modules/student/auth';
import STUDENT_EVENT from './modules/student/event';
import STUDENT_ID_REQUEST from './modules/student/id';

import UTILS_BATCH from './modules/utils/batch';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        ADMIN_AUTH,
        ALUMNAE_APPROVAL,
        ADMIN_DASHBOARD,
        ADMIN_BATCH,
        ADMIN_FEEDBACK,
        ADMIN_CATEGORIES,
        ADMIN_EVENT,
        ADMIN_ID_MANAGEMENT,
        STUDENT_AUTH,
        STUDENT_EVENT,
        STUDENT_ID_REQUEST,
        UTILS_BATCH,
    }
})