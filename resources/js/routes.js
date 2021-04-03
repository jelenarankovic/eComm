import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables";
import Exmaple2 from "./components/Example2";

const routes = [
    {
        path: "/",
        component: Bookables,
        name: "home",

    },
    {
        path: "/second",
        component: Exmaple2,
        name: "second",

    },
];

const router = new VueRouter({
    routes, //short for `routes:routes`
    mode: "history",
});

export default router;
