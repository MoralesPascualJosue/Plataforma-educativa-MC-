<template>
  <div class="app-container">
    <div class="app-navegationmenu">
      <div class="navegationmenu-logocontent">
        <img src="/resources/logo/Logo minmin white.svg" alt="PDEPI" />
      </div>
      <router-link :to="{ name: 'Inicio' }">
        <p class="icon">🏠</p>
        <span class="icontext">Inicio</span></router-link
      >
      <router-link :to="{ name: 'Clases' }">
        <p class="icon">✍</p>
        <span class="icontext">Clases</span></router-link
      >
      <router-link :to="{ name: 'Miinformacion' }"
        ><p class="icon">🎓</p>
        <span class="icontext">Mi información</span></router-link
      >

      <div>
        <div v-if="isLoggedIn">
          <a id="logout-link" href="#" @click.prevent="isLogOut = true"
            >Salir</a
          >
          <ConfirmationComponent
            v-if="isLogOut"
            @status="logout"
            cancelText="Cancelar"
            titleText="Seguro de salir ?"
            confirmText="Salir"
            confirmSuccessText="Saliendo"
          />
        </div>
      </div>
    </div>

    <div class="app-containertabs">
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </div>
  </div>
</template>
<script>
import ConfirmationComponent from "../subcomponents/ConfirmationComponent";

export default {
  components: {
    ConfirmationComponent,
  },
  data() {
    return {
      isLoggedIn: true,
      isLogOut: false,
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    },
  },
  methods: {
    logout(evt) {
      if (evt) {
        axios
          .post("/logout")
          .then((response) => {
            localStorage.removeItem("auth_token");
            // remove any other authenticated user data you put in local storage
            // Assuming that you set this earlier for subsequent Ajax request at some point like so:
            // axios.defaults.headers.common['Authorization'] = 'Bearer ' + auth_token ;
            delete axios.defaults.headers.common["Authorization"];
            // If using 'vue-router' redirect to login page
            this.$router.go("/login");
          })
          .catch((error) => {
            // If the api request failed then you still might want to remove
            // the same data from localStorage anyways
            // perhaps this code should go in a finally method instead of then and catch
            // methods to avoid duplication.
            localStorage.removeItem("auth_token");
            delete axios.defaults.headers.common["Authorization"];
            this.$router.go("/login");
          });
      } else {
        this.isLogOut = false;
      }
    },
  },
};
</script>
<style>
@font-face {
  font-family: "Poppins";
  src: local("Poppins"),
    url(/fonts/poppins/Poppins-Regular.ttf) format("truetype");
}

html {
  font-family: "Poppins", sans-serif;
}

body {
  height: 100vh;
  background-color: white;
  padding: 1rem;
}

.app-container {
  display: grid;
  grid-template-columns: 15% auto;
  height: 95vh;
  border-radius: 20px;
  overflow: hidden;
}

.app-navegationmenu {
  background-color: #266fae;
}

.app-navegationmenu a {
  background-color: #fcb036;
  opacity: 0.5;
  display: block;
  height: 3rem;
  margin-top: 1rem;
  line-height: 3rem;
  text-align: center;
}

.app-containertabs {
  background-color: #fcb036;
  overflow-y: auto;
}

.fade-enter-active,
.fade-leave-active {
  transition-duration: 0.2s;
  transition-property: opacity;
  transition-timing-function: ease;
}

.fade-enter,
.fade-leave-active {
  opacity: 0;
}

.app-navegationmenu a:hover {
  cursor: pointer;
  color: #666;
}

.app-navegationmenu a .icon {
  font-size: 20px;
  border: solid 2px #3490dc;
  height: 30px;
  width: 30px;
  display: block;
  margin: 0 auto;
  line-height: 28px;
  border-radius: 50%;
  display: inline;
}

.navegationmenu-logocontent {
  padding: 0.5rem;
}

.navegationmenu-logocontent img {
  width: 100%;
}

#logout-link:hover {
  opacity: 1;
  background-color: #fcb036;
  font-weight: bold;
  color: red;
}

/*Animations*/
.app-navegationmenu a {
  transition: all 500ms ease-in-out;
  -webkit-transition: all 500ms ease-in-out;
  -moz-transition: all 500ms ease-in-out;
}

/*Toggle*/
.app-navegationmenu .router-link-active {
  opacity: 1;
}

@media (max-width: 1050px) {
  .icontext {
    display: none;
  }
}
</style>
