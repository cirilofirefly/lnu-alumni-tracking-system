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

import VueHtmlToPaper from 'vue-html-to-paper';

const option = {
  name: '_blank',
  specs: [
    'fullscreen=yes',
    'titlebar=yes',
    'scrollbars=yes'
  ],
  styles: [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'https://unpkg.com/kidlat-css/css/kidlat.css'
  ],
  timeout: 1000, // default timeout before the print window appears
  autoClose: true, // if false, the window will not close after printing
  windowTitle: window.document.title, // override the window title
}
Vue.use(VueHtmlToPaper, option);
Vue.use(Toast, options);
Vue.use(BootstrapVue)


new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
