<template>
  <div class="app-container">
    <div class="app-navegationmenu">
      <div class="navegationmenu-logocontent">
        <p>PDEPI</p>
        <img src="/resources/logo/Logo comp orange.svg" alt="PDEPI" />
      </div>
      <div class="navegationmenu-user">
        <div class="navegationmenu-user-image">
          <img :src="user.image" alt="Coordinador" />
        </div>
        <p>{{ user.name }}</p>
        <span>Asesor</span>
      </div>
      <div class="navegationmenu-menu" :class="showMenu">
        <div class="navegationmenu-menu-row">
          <router-link :to="{ name: 'Inicio' }">
            <p class="icon">🏠</p>
            <span class="icontext">Inicio</span></router-link
          >
          <router-link :to="{ name: 'Clases' }">
            <p class="icon">✍</p>
            <span class="icontext">Clases</span></router-link
          >
        </div>
        <div class="navegationmenu-menu-row">
          <router-link :to="{ name: 'Miinformacion' }"
            ><p class="icon">🎓</p>
            <span class="icontext">Mi información</span></router-link
          >
        </div>
      </div>
      <div class="navegationmenu-options" :class="showMenu">
        <li v-if="isLoggedIn">
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
        </li>
      </div>
      <div class="navegationmenu-openmenu">
        <div class="navegationmenu-openmenu-bottom" @click="openmenu">X</div>
      </div>
    </div>

    <div class="app-containertabs">
      <transition name="fade" mode="out-in">
        <router-view @updateuserdata="updateuser"></router-view>
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
      open: false,
    };
  },
  computed: {
    user() {
      return this.$store.getters.loginview;
    },
    showMenu() {
      if (this.open) {
        return "navegationmenu-showmenu";
      } else {
        return "navegationmenu-closemenu";
      }
    },
    actividad() {
      return this.$store.getters.actividadview;
    },
  },
  methods: {
    updateuser(data) {
      this.$store.commit("changelogin", data);
    },
    openmenu() {
      this.open = !this.open;
    },
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

* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
}
html {
  font-family: "Poppins", sans-serif;
  background-color: #fdc770;
}
p {
  font-size: 14px;
  line-height: 1.7;
  color: #666666;
  margin: 0px;
}

/* width */
::-webkit-scrollbar {
  width: 4px;
  border-radius: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #266fae;
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #262626;
}

#app {
  background-color: #f0f0f0;
}

.app-container {
  display: grid;
  height: 100%;
  width: 100%;
  grid-template-columns: 20% auto;
  overflow: hidden;
}

.app-navegationmenu {
  padding: 1rem;
  margin: 1rem;
  background-color: #fdc770;
  border-radius: 20px;
}

.navegationmenu-user {
  text-align: center;
}
.navegationmenu-user-image {
  display: flex;
  border: 5px solid #fcb036;
  border-radius: 50%;
  overflow: hidden;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
  width: 100%;
  padding-top: 97%;
  position: relative;
}
.navegationmenu-user-image img {
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  bottom: 0;
  position: absolute;
  right: 0;
}
.navegationmenu-user p {
  margin-top: 0.5rem;
  font-size: 1rem;
  margin-bottom: inherit;
  font-weight: 600;
}
.navegationmenu-user span {
  font-size: 12px;
  color: #595959;
}

.navegationmenu-menu {
  margin-top: 0.5rem;
  border: 1px solid #fcb036;
}
.navegationmenu-menu-row {
  display: flex;
  justify-content: center;
}
.navegationmenu-menu-row a {
  cursor: pointer;
  background-color: #fcb036;
  opacity: 0.5;
  display: block;
  text-align: center;
  width: 100%;
  padding: 0.5rem;
}
.navegationmenu-menu-row a .icon {
  font-size: 20px;
  border: solid 2px #3490dc;
  height: 30px;
  width: 30px;
  display: block;
  margin: 0 auto;
  line-height: 28px;
  border-radius: 50%;
}
.navegationmenu-options {
  list-style: none;
  display: block;
  text-align: center;
  margin-top: 0.5rem;
}
.navegationmenu-options li {
  padding: 0.5rem;
  background-color: #fcb036;
}
.navegationmenu-openmenu {
  display: none;
  height: 2rem;
}
.navegationmenu-showmenu {
  display: block;
}
.navegationmenu-openmenu-bottom {
  padding: 0.3rem;
  float: right;
  line-height: 1.5rem;
  font-size: 16px;
  font-weight: bold;
  width: 2rem;
  text-align: center;
  background-color: #fcb036;
  cursor: pointer;
}

.app-containertabs {
  overflow-y: auto;
  border-radius: 20px;
  margin: 1rem 1rem 1rem 0rem;
  background-color: white;
  padding: 1rem;
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

.navegationmenu-logocontent {
  padding: 0.5rem;
}

.navegationmenu-logocontent img {
  width: 30%;
}

.navegationmenu-logocontent p {
  position: absolute;
  font-size: 1rem;
  color: #266fae;
  font-weight: bold;
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
  box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1);
}

@media (max-width: 1050px) {
  #app {
    min-height: 100%;
  }
  .icontext {
    display: none;
  }
  .navegationmenu-user {
    display: none;
  }
  .app-container {
    display: inline;
  }
  .navegationmenu-menu,
  .navegationmenu-options,
  .navegationmenu-logocontent img {
    display: none;
  }
  .navegationmenu-menu-row a {
    padding: inherit;
  }
  .app-containertabs {
    margin: inherit;
    padding: 0.5rem;
    height: 90%;
  }
  .navegationmenu-openmenu,
  .navegationmenu-showmenu {
    display: block;
  }
  .app-navegationmenu {
    padding-top: 0rem;
  }
}
</style>
