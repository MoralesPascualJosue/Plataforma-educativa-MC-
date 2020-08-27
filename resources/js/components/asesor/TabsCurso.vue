<template>
  <div class="container sizec">
    <ul class="nav nav-tabs nav-justified">
      <li class="nav-item">
        <a
          class="nav-link"
          @click.prevent="setActive('home')"
          :class="{ active: isActive('home') }"
          href="#home"
        >Curso</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          @click.prevent="setActive('profile')"
          :class="{ active: isActive('profile') }"
          href="#profile"
        >foro</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          @click.prevent="setActive('contact')"
          :class="{ active: isActive('contact') }"
          href="#contact"
        >Mensages</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          @click.prevent="setActive('informacion')"
          :class="{ active: isActive('informacion') }"
          href="#informacion"
        >Informacion</a>
      </li>
    </ul>
    <div class="tab-content py-3" id="myTabContent">
      <div class="tab-pane fade" :class="{ 'active show': isActive('resumen') }" id="resumen">
        <Resumen v-if="isActive('resumen')" />
      </div>
      <div class="tab-pane fade" :class="{ 'active show': isActive('home') }" id="home">
        <ListaActividades @ver-resumen="setActive('resumen')" />
      </div>
      <div class="tab-pane fade" :class="{ 'active show': isActive('profile') }" id="profile">
        <Foro />
      </div>
      <div class="tab-pane fade" :class="{ 'active show': isActive('contact') }" id="contact">
        <ListaMensajes />
      </div>
      <div
        class="tab-pane fade"
        :class="{ 'active show': isActive('informacion') }"
        id="informacion"
      >
        <InformacionShow />
      </div>
    </div>
  </div>
</template>

<script>
import ListaActividades from "./ListaActividades";
import Foro from "./Foro";
import ListaMensajes from "./ListaMensajes";
import InformacionShow from "./InformacionShow";
import Resumen from "./Resumen";
export default {
  data() {
    return {
      activeItem: "home"
    };
  },
  components: {
    ListaActividades,
    Foro,
    ListaMensajes,
    InformacionShow,
    Resumen
  },
  methods: {
    isActive(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive(menuItem) {
      this.activeItem = menuItem;
    }
  }
};
</script>

<style>
html {
  scrollbar-width: thin;
}
body {
  padding: 20px 0;
}

.sizec {
  display: block;
  height: 95%;
  margin: 0;
  max-width: inherit;
}

#myTabContent {
  display: block;
  overflow-y: auto;
  scrollbar-width: thin;
  height: 98%;
}

/* width */
::-webkit-scrollbar {
  width: 7px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #5b99d7;
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #5b9911;
}
</style>