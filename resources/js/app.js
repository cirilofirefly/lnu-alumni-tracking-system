import Vue from 'vue'
import App from './views/App.vue'
import router from './router'
import store from './store'
import { BootstrapVue } from 'bootstrap-vue'

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const options = {
    position: "top-left",
    timeout: 4500,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
    rtl: false
};

Vue.use(Toast, options);
Vue.use(BootstrapVue)


new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')