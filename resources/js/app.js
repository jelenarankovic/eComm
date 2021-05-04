require('./bootstrap');

import VueRouter from "vue-router";
import router from "./routes";
import Vuex from 'vuex';
import Index from "./Index";
import moment from "moment";
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError";
import Success from "./shared/components/Success";
import ValidationErrors from "./shared/components/ValidationErrors";
import Vue from "vue";
import storeDefinition from "./store";

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
Vue.use(Vuex);
Vue.filter("fromNow", value => moment(value).fromNow());

Vue.component("star-rating", StarRating);
Vue.component("fatal-error", FatalError);
Vue.component("success", Success);
Vue.component("v-errors", ValidationErrors);

const store = new Vuex.Store(storeDefinition);

const app = new Vue({
    el: '#app',
    router, // router: router;
    store,

    components: {
        "index": Index
    },
    beforeCreate() {
        this.$store.dispatch("loadStoredState"); //ucitava state iz lokalnog storidza
    },
});
