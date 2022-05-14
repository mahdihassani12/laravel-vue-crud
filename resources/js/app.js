require('./bootstrap');
window.Vue = require('vue').default;
import VueRouter from "vue-router";
import router from "./routes";
import index from "./index";
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components: {
        index
    },
});
