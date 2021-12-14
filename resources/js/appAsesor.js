/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueRouter from "vue-router";
import Vuex from "vuex";
import xmodal from "xmodal-vue";
import vSelect from "vue-select";

import "vue-select/dist/vue-select.css";

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
import HomeLayout from "./components/asesor/HomeLayout";
import Miinformacion from "./components/Miinformacion";
import ListaCursos from "./components/asesor/Curso/ListaCursos";
import App from "./components/asesor/App";
import Flash from "./components/Flash";

Vue.component("v-select", vSelect);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
    state: {
        login: {
            name: "Default name",
            email: "default@email.com",
            image: "resources/users/user-default.svg"
        },
        cursos: {
            data: [],
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
        },
        categorias: {},
        discuss: {},
        discu: {
            id: 0
        },
        comentario: {
            id: -1,
            body: "mi comentario"
        }
    },
    mutations: {
        changelogin(state, user) {
            state.login = user;
        },
        changecomentario(state, coment) {
            state.comentario = coment;
        },
        changediscuss(state, discuss) {
            state.discuss = discuss;
        },
        changecategorias(state, categorias) {
            state.categorias = categorias;
        },
        changediscu(state, discu) {
            state.discu = discu;
        },
        changecursos(state, cursos) {
            state.cursos = cursos;
        },
        changecurso(state, curso) {
            state.curso = curso;
        },
        updatecurso(state, curso) {
            const indexuc = state.cursos.data.findIndex(
                item => item.id === curso.id
            );
            state.cursos.data[indexuc] = curso;
        },
        deletecurso(state, curso) {
            const index = state.cursos.data.findIndex(
                item => item.id === curso.id
            );
            state.cursos.data.splice(index, 1);
        },
        deletetema(state, discu) {
            const index = state.discuss.discuss.findIndex(
                item => item.id === discu.id
            );
            state.discuss.discuss.splice(index, 1);
        },
        deleteteactividad(state, actividad) {
            const index = state.actividades.data.findIndex(
                item => item.id === actividad.id
            );
            state.actividades.data.splice(index, 1);
        },
        changeactividades(state, actividades) {
            state.actividades = actividades;
        },
        changeactividad(state, actividad) {
            state.actividad = actividad;
        },
        updateactividad(state, actividad) {
            let title = "";
            if (actividad.type == "activitie") {
                title = state.actividad.activitie.title;
                state.actividad.activitie = actividad;
            } else {
                title = state.actividad.title;
                state.actividad = actividad;
            }

            const indexa = state.actividades.data.findIndex(
                item => item.title === title
            );

            state.actividades.data[indexa] = actividad;
        },
        updatediscuss(state, discu) {
            const index = state.discuss.discuss.findIndex(
                item => item.id === discu.id
            );
            state.discuss.discuss[index] = discu;
        }
    },
    actions: {},
    getters: {
        loginview(state) {
            return state.login;
        },
        //retornar datos procesados,
        comentarioview(state) {
            return state.comentario;
        },
        discuview(state) {
            return state.discu;
        },
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
        },
        categoriasview(state) {
            return state.categorias;
        },
        discussview(state) {
            return state.discuss;
        }
    }
});

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/home",
            name: "Inicio",
            component: HomeLayout
        },
        {
            path: "/Clases",
            name: "Clases",
            component: ListaCursos
        },
        {
            path: "/Miinformacion",
            name: "Miinformacion",
            component: Miinformacion
        },
        { path: "*", redirect: { name: "Inicio" } }
    ]
});

const app = new Vue({
    //el: "#app",
    components: {
        App,
        Flash
    },
    store: store,
    router
}).$mount("#app");
