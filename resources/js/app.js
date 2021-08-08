
require('./bootstrap');

window.Vue = require('vue').default;

import router from  './router';
import { Form} from 'vform'
window.Form = Form;

import persistentState from 'vue-persistent-state';  
import VueCardCarousel from "vue-card-carousel";
import VueSocialauth from 'vue-social-auth'



const initialState = {
 
  }
Vue.use(persistentState, initialState);
Vue.use(VueCardCarousel);


Vue.component("app-component", require("./components/App.vue").default);
Vue.component("body-component", require("./components/Body.vue").default);
Vue.component("footer-component", require("./components/Footer.vue").default);
Vue.component("header-component", require("./components/Header.vue").default);
Vue.component("cover-component", require("./components/Cover.vue").default);
Vue.component("main-component", require("./components/MainView.vue").default);
Vue.component("groups-component", require("./components/Groups.vue").default);
Vue.component("connections-component", require("./components/Connections.vue").default);
Vue.component("create-comment", require("./components/CreateComment.vue").default);
Vue.component("create-reply", require("./components/CreateReply.vue").default);
Vue.component("VueMomentsAgo", require("vue-moments-ago").default);
const app = new Vue({
    el: '#app',
    router
});
