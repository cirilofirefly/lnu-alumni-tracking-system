import Vue from 'vue'
import VueRouter from 'vue-router'
import Signin from '../views/Auth/Signin.vue'
import Signup from '../views/Auth/Signup.vue'
// Student
import Student from '../views/Student/Student.vue'
import StudentDashboard from '../views/Student/Dashboard.vue'
// Admin
import Admin from '../views/Admin/Admin.vue'
import AdminDashboard from '../views/Admin/Dashboard.vue'
import AdminAlumniApproval from '../views/Admin/Alumni/Approval.vue'
import AdminAlumniIDRequest from '../views/Admin/Alumni/IDRequest.vue'
import AdminAlumniRecords from '../views/Admin/Alumni/Records.vue'
import AdminEvent from '../views/Admin/Event.vue'
import AdminFeedback from '../views/Admin/Feedback.vue'
import AdminNotification from '../views/Admin/Notification.vue'
import AdminAccount from '../views/Admin/Account.vue'



import Landing from '../views/Landing.vue'


const ROUTES = [
    {
        path: '/signin',
        name: 'signin',
        component: Signin
    },
    {
        path: '/signup',
        name: 'signup',
        component: Signup
    },
    {
        path: '/',
        name: 'landing',
        component: Landing
    },
    {
        path: '/student',
        component: Student,
        children: [
            { path: 'dashboard', name: 'student.dashboard', component: StudentDashboard },
            { path: "", redirect: "dashboard" }
        ],
    },
    {
        path: '/admin',
        component: Admin,
        children: [
            { path: 'dashboard', name: 'admin.dashboard', component: AdminDashboard },
            { path: 'approval', name: 'admin.alumni.approval', component: AdminAlumniApproval },
            { path: 'id-request', name: 'admin.alumni.id-request', component: AdminAlumniIDRequest },
            { path: 'records', name: 'admin.alumni.records', component: AdminAlumniRecords },
            { path: 'event', name: 'admin.event', component: AdminEvent },
            { path: 'account', name: 'admin.account', component: AdminAccount },
            { path: 'feedback', name: 'admin.feedback', component: AdminFeedback },
            { path: 'notification', name: 'admin.notification', component: AdminNotification },
            { path: "", redirect: "dashboard" }
        ],
    },
]


Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: ROUTES
})