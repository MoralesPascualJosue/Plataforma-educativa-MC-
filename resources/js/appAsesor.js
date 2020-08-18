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
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
    state: {
        cursos: {
            next_page_url: ""
        },
        actividades: {},
        curso: {
            id: 0,
            title: "0"
        },
        actividad: {
            id: 0,
            activitie: {
                title: "0"
            }
        }
    },
    mutations: {
        changecursos(state, cursos) {
            state.cursos = cursos;
        },
        changecurso(state, curso) {
            state.curso = curso;
        },
        updatecurso(state, curso) {
            const index = state.cursos.data.findIndex(
                item => item.id === curso.id
            );
            state.cursos.data[index] = curso;
        },
        deletecurso(state, curso) {
            const index = state.cursos.data.findIndex(
                item => item.id === curso.id
            );
            state.cursos.data.splice(index, 1);
        },
        changeactividades(state, actividades) {
            state.actividades = actividades;
        },
        changeactividad(state, actividad) {
            state.actividad = actividad;
        }
    },
    actions: {},
    getters: {
        //retornar datos procesados,
        cursosview(state) {
            return state.cursos;
        },
        cursoview(state) {
            return state.curso;
        },
        actividadesview(state) {
            return state.actividades;
        },
        actividadview(state) {
            return state.actividad;
        },
        cursosviewindex: state => index => {
            return state.cursos.data[index];
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
    components: { App },
    store: store,
    router
}).$mount("#app");
