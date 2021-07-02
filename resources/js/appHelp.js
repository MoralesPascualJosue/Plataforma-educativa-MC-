/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueRouter from "vue-router";

require("./bootstrap");

window.Vue = require("vue");
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import Section from "./components/help/Section";
import SectionRegister from "./components/help/SectionRegister";
import SectionIngreso from "./components/help/SectionIngreso";
import SectionMiinformacion from "./components/help/SectionMiinformacion";
import Inicioah from "./components/help/asesor/Inicioah";
import Clasesah from "./components/help/asesor/Clasesah";
import Actividadah from "./components/help/asesor/Actividadah";
import Pruebaah from "./components/help/asesor/Pruebaah";

import Inicioeh from "./components/help/estudiante/Inicioeh";
import Claseseh from "./components/help/estudiante/Claseseh";
import Actividadeh from "./components/help/estudiante/Actividadeh";
import Pruebaeh from "./components/help/estudiante/Pruebaeh";
import Trabajoseh from "./components/help/estudiante/Trabajoseh";

import Foroah from "./components/help/Foroah";
import Mensajesah from "./components/help/Mensajesah";

import App from "./components/help/App";
import Flash from "./components/Flash";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/help",
            name: "Help",
            component: Section
        },
        {
            path: "/help-register",
            name: "help-register",
            component: SectionRegister
        },
        {
            path: "/help-ingreso",
            name: "help-ingreso",
            component: SectionIngreso
        },
        {
            path: "/help-miinformacion",
            name: "help-miinformacion",
            component: SectionMiinformacion
        },
        {
            path: "/help-inicioa",
            name: "help-inicioa",
            component: Inicioah
        },
        {
            path: "/help-clasesa",
            name: "help-clasesa",
            component: Clasesah
        },
        {
            path: "/help-actividada",
            name: "help-actividada",
            component: Actividadah
        },
        {
            path: "/help-pruebaa",
            name: "help-pruebaa",
            component: Pruebaah
        },
        {
            path: "/help-foroa",
            name: "help-foroa",
            component: Foroah
        },
        {
            path: "/help-mensajea",
            name: "help-mensajea",
            component: Mensajesah
        },
        {
            path: "/help-inicioe",
            name: "help-inicioe",
            component: Inicioeh
        },
        {
            path: "/help-clasese",
            name: "help-clasese",
            component: Claseseh
        },
        {
            path: "/help-actividade",
            name: "help-actividade",
            component: Actividadeh
        },
        {
            path: "/help-pruebae",
            name: "help-pruebae",
            component: Pruebaeh
        },
        {
            path: "/help-trabajose",
            name: "help-trabajose",
            component: Trabajoseh
        },
        { path: "*", redirect: { name: "Help" } }
    ]
});

const app = new Vue({
    //el: "#app",
    components: {
        App,
        Flash
    },
    router
}).$mount("#app");
