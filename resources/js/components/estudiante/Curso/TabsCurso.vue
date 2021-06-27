<template>
  <div class="curso-tabs-layout" id="curso-tabs-layout">
    <div class="curso-tabs-navegationinfo">
      <div class="curso-tabs-closeoption" @click="closeCurse">
        <img src="resources/icons/navegation-back-button.svg" alt="X" />
      </div>
      <div class="curso-tabs-cursetitle">
        <p>{{ curso.title }}</p>
      </div>
    </div>
    <div class="curso-tabs-navegationmenu">
      <div class="navegationmenu-logocontent">
        <p>PDEPI</p>
        <img src="/resources/logo/Logo comp orange.svg" alt="PDEPI" />
      </div>
      <ul class="curso-tabs-nav">
        <div class="curso-tabs-nav-item">
          <a
            @click.prevent="setActive('home')"
            :class="{ active: isActive('home') }"
            href="#home"
            >Curso</a
          >
          <a
            v-show="isActive('resumen')"
            @click.prevent="setActive('home')"
            :class="{ active: isActive('resumen') }"
            >◀ Volver a curso</a
          >
        </div>
        <div class="curso-tabs-nav-item">
          <a
            @click.prevent="setActive('profile')"
            :class="{ active: isActive('profile') }"
            href="#profile"
            >foro</a
          >
        </div>
        <div class="curso-tabs-nav-item">
          <a
            @click.prevent="setActive('contact')"
            :class="{ active: isActive('contact') }"
            href="#contact"
          >
            <span
              v-if="mensajesnuevos > 0"
              class="badge badge-primary float-right fontct"
              >{{ mensajesnuevos }}</span
            >
            Mensajes
          </a>
        </div>
      </ul>
    </div>

    <div class="curso-tabs-contentpane">
      <div v-show="isActive('resumen')">
        <Resumen v-if="isActive('resumen')" />
      </div>
      <ListaActividades
        v-show="isActive('home')"
        @ver-resumen="setActive('resumen')"
      />
      <div v-show="isActive('profile')">
        <Foro />
      </div>
      <div v-show="isActive('contact')">
        <ListaMensajes @mensajes="mensajes" @set-mensajes="mensajesnuevoss" />
      </div>
    </div>
  </div>
</template>

<script>
import ListaActividades from "../Actividad/ListaActividades";
import Foro from "../Discusion/Foro";
import ListaMensajes from "../Mensaje/ListaMensajes";
import Resumen from "./Resumen";
export default {
  data() {
    return {
      activeItem: "home",
      mensajesnuevos: 0,
    };
  },
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    },
  },
  components: {
    ListaActividades,
    Foro,
    ListaMensajes,
    Resumen,
  },
  methods: {
    isActive(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive(menuItem) {
      this.activeItem = menuItem;
    },
    mensajesnuevoss(value) {
      this.mensajesnuevos = value;
    },
    mensajes(operacion) {
      if (operacion) {
        this.mensajesnuevos++;
      } else {
        this.mensajesnuevos--;
      }
    },
    closeCurse() {
      this.$emit("closetabs");
    },
  },
};
</script>
<style>
.curso-tabs-layout {
  position: relative;
  width: 100%;
  height: 100%;
  display: grid;
  grid-template-columns: 15% auto;
  grid-template-rows: 5% 90%;
  overflow: hidden;
}
@media only screen and (max-width: 1080px) {
  .curso-tabs-layout {
    display: inherit;
  }
}
.curso-tabs-navegationinfo {
  grid-column-end: span 2;
  display: grid;
  grid-template-columns: 15% auto;
}
.curso-tabs-closeoption {
  position: relative;
  text-align: center;
  cursor: pointer;
  background-color: #fcb036;
  border-radius: 50%;
  margin: 5px;
  width: 40px;
  height: 40px;
}
.curso-tabs-cursetitle {
  margin-bottom: 0.5rem;
  background-color: #fcb036;
  border-radius: 20px;
  padding: 0.5rem;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}
.curso-tabs-cursetitle p {
  padding: 0.4rem;
}
.curso-tabs-closeoption:hover {
  color: #266fae;
}
.curso-tabs-navegationmenu {
  padding: 1rem;
}
.curso-tabs-nav {
  margin-top: 0.5rem;
  border: 1px solid #fcb036;
}
.curso-tabs-nav-item {
  display: flex;
  justify-content: center;
}
.curso-tabs-nav-item a {
  cursor: pointer;
  background-color: #fcb036;
  opacity: 0.5;
  display: block;
  text-align: center;
  width: 100%;
  padding: 0.5rem;
}
.curso-tabs-nav-item a span {
  font-size: 14px;
  background-color: white;
  position: absolute;
  margin-top: -1rem;
  border-radius: 50%;
  width: 1.5rem;
}
.curso-tabs-nav-item .active {
  background-color: #fcb036;
  opacity: 1;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}
.curso-tabs-contentpane {
  overflow-y: auto;
  height: 100%;
}
@media only screen and (max-width: 1080px) {
  .curso-tabs-nav {
    margin-bottom: -2px;
  }
  .curso-tabs-closeoption {
    font-size: 25px;
    margin: inherit;
    padding: inherit;
  }
  .curso-tabs-navegationmenu {
    padding: inherit;
  }
  .curso-tabs-nav-item {
    margin: inherit;
    display: inline-block;
    width: 22.5%;
    overflow: hidden;
  }
  .curso-tabs-navegationinfo {
    display: flex;
  }
  .curso-tabs-cursetitle {
    padding: 0.2rem;
  }
  .curso-tabs-contentpane {
    height: 79.5%;
  }
}
</style>