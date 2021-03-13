<template>
  <div class="curso-tabs-layout" id="curso-tabs-layout">
    <div class="curso-tabs-navegationmenu">
      <div clase="curso-tabs-options">
        <div class="curso-tabs-closeoption" @click="closeCurse">X</div>
      </div>
      <ul class="curso-tabs-nav">
        <li class="curso-tabs-nav-item">
          <a
            @click.prevent="setActive('home')"
            :class="{ active: isActive('home') }"
            href="#home"
            >Curso <span v-show="isActive('resumen')">Resumen</span></a
          >
        </li>
        <li class="curso-tabs-nav-item">
          <a
            @click.prevent="setActive('profile')"
            :class="{ active: isActive('profile') }"
            href="#profile"
            >foro</a
          >
        </li>
        <li class="curso-tabs-nav-item">
          <a
            @click.prevent="setActive('contact')"
            :class="{ active: isActive('contact') }"
            href="#contact"
          >
            Mensajes
            <span
              v-if="mensajesnuevos > 0"
              class="badge badge-primary float-right fontct"
              >{{ mensajesnuevos }}</span
            >
          </a>
        </li>
        <li class="curso-tabs-nav-item">
          <a
            @click.prevent="setActive('informacion')"
            :class="{ active: isActive('informacion') }"
            href="#informacion"
            >Informacion</a
          >
        </li>
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
      <div v-show="isActive('informacion')">
        <InformacionShow />
      </div>
    </div>
  </div>
</template>

<script>
import ListaActividades from "../Actividad/ListaActividades";
import Foro from "../Discusion/Foro";
import ListaMensajes from "../Mensaje/ListaMensajes";
import InformacionShow from "../Informacion/InformacionShow";
import Resumen from "./Resumen";
export default {
  data() {
    return {
      activeItem: "home",
      mensajesnuevos: 0,
    };
  },
  components: {
    ListaActividades,
    Foro,
    ListaMensajes,
    InformacionShow,
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
      var pos = 100;
      var curseTabs = document.getElementById("curso-tabs-layout");
      setTimeout(
        function () {
          this.$emit("closetabs");
        }.bind(this),
        300
      );
      var id = setInterval(frame, 5);
      function frame() {
        if (pos < 16) {
          clearInterval(id);
        } else {
          pos -= 5;
          curseTabs.style.width = pos + "%";
        }
      }
    },
  },
};
</script>
<style>
.curso-tabs-layout {
  position: relative;
  background-color: #266fae;
  width: 100%;
  height: 100%;
  border-radius: 20px;
  display: grid;
  grid-template-columns: 10% auto;
  overflow: hidden;
}
@media only screen and (max-width: 1080px) {
  .curso-tabs-layout {
    display: inherit;
  }
}
.curso-tabs-closeoption {
  position: relative;
  text-align: center;
  color: #050505;
  font-size: 30px;
  cursor: pointer;
  background-color: #fcb036;
  border-radius: 8px;
  padding: 8px;
  margin: 5px;
}
.curso-tabs-closeoption:hover {
  color: white;
}
.curso-tabs-nav-item {
  margin-top: 1rem;
}
.curso-tabs-nav-item a {
  display: block;
  margin: 0.2rem;
  padding: 0.5rem;
  padding-left: 0.1rem;
  background-color: white;
  width: 100%;
}
.curso-tabs-nav-item a span {
  font-size: 14px;
  background-color: #fdc770;
  padding: 0.2rem;
}
.curso-tabs-nav-item a:hover {
  background-color: #fdc770;
}
.curso-tabs-nav-item .active {
  background-color: #fcb036;
}
.curso-tabs-contentpane {
  background-color: #fcb036;
  border-radius: 20px;
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
  .curso-tabs-nav-item {
    margin: inherit;
    display: inline-block;
    width: 22.5%;
  }
  .curso-tabs-contentpane {
    height: 89.5%;
  }
}
</style>
