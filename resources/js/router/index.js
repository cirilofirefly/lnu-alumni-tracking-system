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
            { path: "", redirect: "dashboard" }
        ],
    },
]


Vue.use(VueRouter)


export default new VueRouter({
    mode: 'history',
    routes: ROUTES
})