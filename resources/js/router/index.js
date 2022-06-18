import Vue from 'vue'
import VueRouter from 'vue-router'
import Signin from '../views/Auth/Signin.vue'
import Signup from '../views/Auth/Signup.vue'
import AdminSignin from '../views/Auth/AdminSignin.vue'
// Student
import Student from '../views/Student/Student.vue'
import StudentHome from '../views/Student/Home.vue'
import StudentAccountSetting from '../views/Student/AccountSetting.vue'
import StudentEvents from '../views/Student/Events.vue'
import StudentEvent from '../views/Student/Event.vue'
import StudentFeedbacks from '../views/Student/Feedbacks.vue'
import StudentFeedback from '../views/Student/Feedback.vue'
import StudentIDRequest from '../views/Student/IDRequest.vue'
import StudentUpdateAccount from '../views/Student/UpdateAccount.vue'

// Admin
import Admin from '../views/Admin/Admin.vue'
import AdminDashboard from '../views/Admin/Dashboard.vue'
import AdminAlumniApproval from '../views/Admin/Alumni/Approval.vue'
import AdminAlumniIDRequest from '../views/Admin/Alumni/IDRequest.vue'
import AdminAlumniBatch from '../views/Admin/Alumni/Batch.vue'
import AdminBatchAlumni from '../views/Admin/Alumni/BatchAlumni.vue'
import AdminAlumniRecords from '../views/Admin/Alumni/Records.vue'
import AdminAlumniRecord from '../views/Admin/Alumni/Record.vue'
import AdminEvents from '../views/Admin/Events.vue'
import AdminEvent from '../views/Admin/Event.vue'
import AdminFeedback from '../views/Admin/Feedback.vue'
import AdminFeedbacks from '../views/Admin/Feedbacks.vue'
import AdminNotification from '../views/Admin/Notification.vue'
import AdminAccount from '../views/Admin/Account.vue'
import AdminIDPrintable from '../views/Admin/Alumni/IDLayout.vue'




import Landing from '../views/Landing.vue'


const ROUTES = [
    {
        path: '/signin',
        name: 'signin',
        component: Signin
    },
    {
        path: '/admin-signin',
        name: 'admin-signin',
        component: AdminSignin
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
            { path: 'home', name: 'student.home', component: StudentHome },
            { path: 'account-setting', name: 'student.account-setting', component: StudentAccountSetting },
            { path: 'events', name: 'student.events', component: StudentEvents },
            { path: 'event/:slug', name: 'student.event', component: StudentEvent, props: true },
            { path: 'feedbacks', name: 'student.feedbacks', component: StudentFeedbacks },
            { path: 'feedback/:id', name: 'student.feedback', component: StudentFeedback, props: true },
            { path: 'id-request', name: 'student.id-request', component: StudentIDRequest },
            { path: 'id-request/:id', name: 'student.update-account', component: StudentUpdateAccount, props: true },
            { path: "", redirect: "home" }
        ],
    },
    {
        path: '/admin',
        component: Admin,
        children: [
            { path: 'dashboard', name: 'admin.dashboard', component: AdminDashboard },
            { path: 'approval', name: 'admin.alumni.approval', component: AdminAlumniApproval },
            { path: 'id-request', name: 'admin.alumni.id-request', component: AdminAlumniIDRequest },
            { path: 'id-printable/:request_id', name: 'id.printable', component: AdminIDPrintable, props: true },
            { path: 'batch', name: 'admin.alumni.batch', component: AdminAlumniBatch },
            { path: 'batch-alumni/:batch_id', name: 'admin.batch.alumni', component: AdminBatchAlumni, props: true },
            { path: 'records', name: 'admin.alumni.records', component: AdminAlumniRecords },
            { path: 'record/:id', name: 'admin.alumni.record', component: AdminAlumniRecord, props: true },
            { path: 'events', name: 'admin.events', component: AdminEvents },
            { path: 'event/:slug', name: 'admin.event', component: AdminEvent, props: true },
            { path: 'account', name: 'admin.account', component: AdminAccount },
            { path: 'feedbacks', name: 'admin.feedbacks', component: AdminFeedbacks },
            { path: 'feedback/:id', name: 'admin.feedback', component: AdminFeedback, props: true },
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