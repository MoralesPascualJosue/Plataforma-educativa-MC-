/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueRouter from "vue-router";
import Vuex from "vuex";
import xmodal from "xmodal-vue";

require("./bootstrap");

window.Vue = require("vue");

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(xmodal);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import HomeLayout from "./components/HomeLayout";

import ListaCursos from "./components/asesor/ListaCursos";
import App from "./components/asesor/App";
import Modal from "./components/asesor/modal";
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
    state: {
        curso: {
            id: 0,
            title: "0"
        },
        actividad: {
            id: 0,
            title: "0"
        }
    },
    mutations: {
        changecurso(state, curso) {
            state.curso = curso;
        }
    },
    actions: {},
    getters: {
        //retornar datos procesados
        cursoview(state) {
            return state.curso;
        }
    }
});

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/homevue",
            name: "Inicio",
            component: HomeLayout
        },
        {
            path: "/Clases",
            name: "Clases",
            component: ListaCursos
        }
    ]
});

const app = new Vue({
    //el: "#app",
    data() {
        return {
            ismodalOpen: false,
            // basic modal options
            options: {
                component: Modal,
                backgroundColor: "rgb(194 213 207)",
                opacity: "0.7",
                animation: "scaleLeft"
            }
        };
    },
    components: { App, Modal },
    store: store,
    router
}).$mount("#app");

$("#myList a").on("click", function(e) {
    e.preventDefault();
    $(this).tab("show");
});
