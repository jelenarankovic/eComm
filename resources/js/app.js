require('./bootstrap');

import VueRouter from "vue-router";
import router from "./routes";
import Index from "./Index";
import moment from "moment";
import StarRating from "./shared/components/StarRating.vue";
import Vue from "vue";

window.Vue = require('vue').default;

// Vue.component(
//     'example-component',
//     require('./components/ExampleComponent.vue').default
// );
// Vue.component(
//     'example-2',
//     require('./components/Example2.vue').default
// );
// ovo ne mora vise da postoji jer ih routes.js vidi i tamo smo ih naveli

Vue.use(VueRouter);
Vue.filter("fromNow", value => moment(value).fromNow());
Vue.component("star-rating", StarRating);

const app = new Vue({
    el: '#app',
    router, // router: router;
    components: {
        "index": Index
    }
});
