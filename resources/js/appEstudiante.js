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

import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

require("./bootstrap");

window.Vue = require("vue");

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(xmodal);

Vue.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import HomeLayout from "./components/estudiante/HomeLayout";
import Miinformacion from "./components/Miinformacion";
import ListaCursos from "./components/estudiante/Curso/ListaCursos";
import Homeworks from "./components/estudiante/Curso/Homeworks";
import App from "./components/estudiante/App";
import Flash from "./components/Flash";

Vue.component("v-select", vSelect);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const moduleNotifications = {
    namespaced: true,
    state: () => ({
        inUse: false,
        notifications: {
            data: []
        }
    }),
    mutations: {
        changeInUse(state) {
            const use = state.inUse;
            state.inUse = !use;
        },
        updateNotifications(state, notifications) {
            state.notifications = notifications;
        }
    },
    actions: {
        discoverNotifications(context) {
            if (context.getters.inUseview) {
                axios
                    .get("/notificaciones")
                    .then(res => {
                        context.commit("updateNotifications", res.data);
                    })
                    .catch(response => {
                        if (
                            response.status === 401 ||
                            response.status === 419
                        ) {
                            window.location.href = "login";
                        }
                    });
            }
        }
    },
    getters: {
        inUseview(state) {
            return state.inUse;
        },
        notificationsview(state) {
            return state.notifications;
        }
    }
};

const moduleCursos = {
    namespaced: true,
    state: () => ({
        inUse: false,
        cursos: {
            data: [],
            next_page_url: ""
        },
        curso: {
            id: 0,
            title: "0"
        }
    }),
    mutations: {
        changeInUse(state) {
            const use = state.inUse;
            state.inUse = !use;
        },
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
        }
    },
    actions: {},
    getters: {
        inUseview(state) {
            return state.inUse;
        },
        cursosview(state) {
            return state.cursos;
        },
        cursoview(state) {
            return state.curso;
        },
        cursosviewindex: state => index => {
            return state.cursos.data[index];
        }
    }
};

const moduleActivities = {
    namespaced: true,
    state: () => ({
        inUse: false,
        actividades: {},
        actividad: {
            id: 0,
            activitie: {
                title: "0"
            }
        }
    }),
    mutations: {
        changeInUse(state) {
            const use = state.inUse;
            state.inUse = !use;
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
            state.actividad.activitie = actividad;

            const indexa = state.actividades.data.findIndex(
                item => item.id === actividad.id
            );
            state.actividades.data[indexa] = actividad;
        }
    },
    actions: {},
    getters: {
        inUseview(state) {
            return state.inUse;
        },
        actividadesview(state) {
            return state.actividades;
        },
        actividadview(state) {
            return state.actividad;
        }
    }
};

const moduleForo = {
    namespaced: true,
    state: () => ({
        inUse: false,
        categorias: {},
        discuss: {},
        discu: {
            id: 0
        },
        comentarios: [],
        comentario: {
            id: -1,
            body: "mi comentario"
        }
    }),
    mutations: {
        changeInUse(state) {
            const use = state.inUse;
            state.inUse = !use;
        },
        changecomentario(state, coment) {
            state.comentario = coment;
        },
        changecomentarios(state, comentarios) {
            state.comentarios = comentarios;
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
        deletetema(state, discu) {
            const index = state.discuss.discuss.findIndex(
                item => item.id === discu.id
            );
            state.discuss.discuss.splice(index, 1);
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
        inUseview(state) {
            return state.inUse;
        },
        comentarioview(state) {
            return state.comentario;
        },
        comentariosview(state) {
            return state.comentarios;
        },
        discuview(state) {
            return state.discu;
        },
        categoriasview(state) {
            return state.categorias;
        },
        discussview(state) {
            return state.discuss;
        }
    }
};

const moduleMensajes = {
    namespaced: true,
    state: () => ({
        inUse: false,
        notifications: {
            data: []
        }
    }),
    mutations: {
        changeInUse(state) {
            const use = state.inUse;
            state.inUse = !use;
        },
        updateNotifications(state, notifications) {
            state.notifications = notifications;
        }
    },
    actions: {},
    getters: {
        inUseview(state) {
            return state.inUse;
        },
        notificationsview(state) {
            return state.notifications;
        }
    }
};

const store = new Vuex.Store({
    state: {
        login: {
            name: "Default name",
            email: "default@email.com",
            image: "resources/users/user-default.svg"
        }
    },
    mutations: {
        changelogin(state, logindata) {
            state.login = logindata;
        }
    },
    actions: {},
    getters: {
        loginview(state) {
            return state.login;
        }
    },
    modules: {
        notifications: moduleNotifications,
        cursos: moduleCursos,
        activities: moduleActivities,
        foro: moduleForo,
        mensajes: moduleMensajes
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
        {
            path: "/Homeworks",
            name: "Homeworks",
            component: Homeworks
        },
        { path: "*", redirect: { name: "Inicio" } }
    ]
});

const app = new Vue({
    //el: "#app",
    components: { App, Flash },
    store: store,
    router
}).$mount("#app");
