<template>
  <div class="app-container">
    <div class="app-layout">
      <aside class="app-navegationmenu" :class="{ show: openmenu }">
        <a href="/" class="navegationmenu-logocontent">
          <img src="/resources/logo/Logo comp white.svg" alt="PDEPI" />
          <p>PDEPI</p>
        </a>
        <div class="navegationmenu-menu">
          <ul>
            <li
              :class="{ active: active == 'comenzando' }"
              @click="
                {
                  active = 'comenzando';
                  open = 'none';
                }
              "
            >
              <router-link :to="{ name: 'Help' }">Comenzando</router-link>
            </li>
            <li
              :class="{ active: active == 'registro' }"
              @click="
                {
                  active = 'registro';
                  open = 'none';
                }
              "
            >
              <router-link :to="{ name: 'help-register' }"
                >Registro</router-link
              >
            </li>
            <li
              :class="{ active: active == 'ingreso' }"
              @click="
                {
                  active = 'ingreso';
                  open = 'none';
                }
              "
            >
              <router-link :to="{ name: 'help-ingreso' }">Ingreso</router-link>
            </li>
            <li :class="{ 'sub--on': open == 'asesor' }">
              <h2 @click="open = 'asesor'">
                <p class="icon">👨‍🏫</p>
                <span class="icontext">Asesor</span>
              </h2>
              <ul>
                <li
                  :class="{ active: active == 'inicioa' }"
                  @click="
                    {
                      active = 'inicioa';
                      open = 'asesor';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-inicioa' }"
                    >Inicio</router-link
                  >
                </li>
                <li
                  :class="{ active: active == 'clasesa' }"
                  @click="
                    {
                      active = 'clasesa';
                      open = 'asesor';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-clasesa' }"
                    >Clases</router-link
                  >
                </li>
                <li
                  :class="{ active: active == 'actividada' }"
                  @click="
                    {
                      active = 'actividada';
                      open = 'asesor';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-actividada' }"
                    >Actividad</router-link
                  >
                </li>
                <li
                  :class="{ active: active == 'pruebaa' }"
                  @click="
                    {
                      active = 'pruebaa';
                      open = 'asesor';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-pruebaa' }"
                    >Prueba</router-link
                  >
                </li>
              </ul>
            </li>
            <li :class="{ 'sub--on': open == 'estudiante' }">
              <h2 @click="open = 'estudiante'">
                <p class="icon">🎓</p>
                <span class="icontext">Estudiante</span>
              </h2>
              <ul>
                <li
                  :class="{ active: active == 'inicioe' }"
                  @click="
                    {
                      active = 'inicioe';
                      open = 'estudiante';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-inicioe' }"
                    >Inicio</router-link
                  >
                </li>
                <li
                  :class="{ active: active == 'clasese' }"
                  @click="
                    {
                      active = 'clasese';
                      open = 'estudiante';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-clasese' }"
                    >Clases</router-link
                  >
                </li>
                <li
                  :class="{ active: active == 'actividade' }"
                  @click="
                    {
                      active = 'actividade';
                      open = 'estudiante';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-actividade' }"
                    >Actividad</router-link
                  >
                </li>
                <li
                  :class="{ active: active == 'pruebae' }"
                  @click="
                    {
                      active = 'pruebae';
                      open = 'estudiante';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-pruebae' }"
                    >Prueba</router-link
                  >
                </li>
                <li
                  :class="{ active: active == 'trabajose' }"
                  @click="
                    {
                      active = 'trabajose';
                      open = 'estudiante';
                    }
                  "
                >
                  <router-link :to="{ name: 'help-trabajose' }"
                    >Trabajos</router-link
                  >
                </li>
              </ul>
            </li>
            <li
              :class="{ active: active == 'foroa' }"
              @click="
                {
                  active = 'foroa';
                  open = 'none';
                }
              "
            >
              <router-link :to="{ name: 'help-foroa' }">Foro</router-link>
            </li>
            <li
              :class="{ active: active == 'mensajea' }"
              @click="
                {
                  active = 'mensajea';
                  open = 'none';
                }
              "
            >
              <router-link :to="{ name: 'help-mensajea' }"
                >Mensajes</router-link
              >
            </li>
            <li
              :class="{ active: active == 'miinformacion' }"
              @click="
                {
                  active = 'miinformacion';
                  open = 'none';
                }
              "
            >
              <router-link :to="{ name: 'help-miinformacion' }"
                >Mi información</router-link
              >
            </li>
          </ul>
        </div>
      </aside>
      <div class="app-containertabs">
        <div
          class="navegationmenu-openmenu"
          :class="{ openmenul: openmenu }"
          @click="
            {
              openmenu = !openmenu;
            }
          "
        >
          <div class="navegationmenu-openmenu-bottom">📑</div>
        </div>
        <transition name="fade" mode="out-in">
          <router-view></router-view>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showMenu: false,
      open: "comenzando",
      active: "comenzando",
      openmenu: false,
    };
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
  background-color: #fdc770;
}

.app-container {
  position: relative !important;
  overflow: auto !important;
}

.app-layout {
  position: relative !important;
}

@media (min-width: 1024px) {
  .app-layout {
    display: flex !important;
    align-items: flex-start !important;
  }
}

.app-navegationmenu {
  padding: 1rem;
  overflow: hidden !important;
  flex-direction: column !important;
  height: 100% !important;
  top: 0 !important;
  bottom: 0 !important;
  left: 0 !important;
  transition-duration: 0.3s !important;
  transition-property: all !important;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
  transition-duration: 0.15s !important;
  position: fixed !important;
  width: 4rem !important;
  z-index: 20 !important;
  display: none !important;
  align-items: flex-start !important;

  background-image: linear-gradient(
    180deg,
    var(--tw-gradient-stops)
  ) !important;
  --tw-gradient-from: #fcb036 !important;
  --tw-gradient-stops: var(--tw-gradient-from),
    var(--tw-gradient-to, rgba(245, 245, 250, 0)) !important;
}
.navegationmenu-openmenu {
  display: block;
  top: 4rem !important;
  bottom: 0 !important;
  left: 0.1rem !important;
  transition-duration: 0.3s !important;
  transition-property: all !important;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
  transition-duration: 0.15s !important;
  position: fixed !important;
  background-color: white;
  height: 4rem;
  width: 4rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: bolder;
  z-index: 1;
  cursor: pointer;
}

.navegationmenu-openmenu:hover {
  background-color: blue;
}

@media (min-width: 1024px) {
  .app-navegationmenu {
    display: flex !important;
    align-items: flex-end !important;
    justify-content: flex-end !important;
    flex-shrink: 0 !important;
    position: -webkit-sticky !important;
    position: sticky !important;
    width: 20rem !important;
  }
  .navegationmenu-openmenu {
    display: none;
  }
}

@media (min-width: 1536px) {
  .app-navegationmenu {
    max-width: 32rem !important;
    width: 100% !important;
    padding-left: 4rem;
    padding-right: 4rem;
  }
}

.navegationmenu-logocontent {
  text-decoration: none;
}

.navegationmenu-logocontent img {
  width: 6.643rem;
  margin-top: 0.1rem;
}
.navegationmenu-logocontent p {
  font-family: Poppins-Regular, sans-serif;
  font-size: 2rem;
  display: inline;
  color: white;
  text-align: left;
  font-weight: 700;
}

.navegationmenu-menu {
  margin-top: 0.5rem;
  padding: 0.5rem;
}

.navegationmenu-menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0.4rem;
}

.navegationmenu-menu ul li {
  display: block;
  margin-top: 1.1rem;
  white-space: nowrap;
}

.navegationmenu-menu ul li h2 {
  display: flex;
  font-size: 1em;
  font-weight: 500;
  color: #090910;
  text-decoration: none;
  margin-bottom: 0;
  cursor: pointer;
  transition: all 0.3s ease;
}

.navegationmenu-menu ul li a {
  display: block;
  font-size: 0.875em;
  font-weight: 500;
  color: #090910;
  text-decoration: none;
  transition: transform 0.3s ease;
}

.navegationmenu-menu ul li a:hover {
  transform: translate3d(5px, 0, 0);
}

.navegationmenu-menu ul ul {
  overflow: hidden;
  max-height: 0;
  transition: max-height 0.45s ease;
  margin-left: 1.3rem;
}

.navegationmenu-menu ul ul li.active a:before {
  content: "🔖";
  position: absolute;
  top: 0.1rem;
  left: -0.4rem;
  width: 0.5rem;
  height: 0.5rem;
}

.navegationmenu-menu ul li.active a:before {
  content: "🔖";
  position: relative;
  top: 0.1rem;
  left: -0.4rem;
  width: 0.5rem;
  height: 0.5rem;
}

.navegationmenu-menu ul ul li a {
  position: relative;
  padding-left: 1em;
  font-weight: 400;
  line-height: 1.25;
}

.navegationmenu-menu ul .sub--on ul {
  max-height: none;
}
.navegationmenu-menu ul .sub--on h2 {
  margin-bottom: 1em;
}
.navegationmenu-menu-row {
  display: inline;
}
.navegationmenu-menu-row a {
  cursor: pointer;
  width: 100%;
  padding: 0.5rem;
  display: flex;
}
.navegationmenu-menu-row a .icon,
.navegationmenu-menu .icon {
  font-size: 20px;
  border: solid 2px #3490dc;
  height: 30px;
  width: 30px;
  display: block;
  margin: 0 1rem;
  line-height: 28px;
  border-radius: 50%;
}

.app-containertabs {
  flex: 1 1 0% !important;
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

@media (max-width: 1024px) {
  .show {
    display: flex !important;
    width: 16rem !important;
  }
}
.openmenul {
  left: 16rem !important;
}
</style>
