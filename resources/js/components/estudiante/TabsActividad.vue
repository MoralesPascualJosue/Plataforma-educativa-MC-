<template>
  <div class="container sizec">
    <ul class="nav nav-tabs nav-justified">
      <li class="nav-item">
        <a
          class="nav-link"
          @click.prevent="setActive('home')"
          :class="{ active: isActive('home') }"
          href="#home"
        >Actividad</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          @click.prevent="setActive('entregas')"
          :class="{ active: isActive('entregas') }"
          href="#profile"
        >
          Entregas
          <span
            v-if="entregas>0"
            class="badge badge-primary float-right fontct"
          >{{entregas}}</span>
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          @click.prevent="setActive('informacion')"
          :class="{ active: isActive('informacion') }"
          href="#informacion"
        >Detalles</a>
      </li>
    </ul>
    <div class="tab-content py-3" id="myTabContent">
      <div class="tab-pane fade" :class="{ 'active show': isActive('home') }" id="home">
        <ActividadShow @entregas="entrega" />
      </div>
      <div class="tab-pane fade" :class="{ 'active show': isActive('entregas') }" id="entregas">
        <keep-alive>
          <EntregasActividad v-if="activeItem == 'entregas'" />
        </keep-alive>
      </div>
      <div
        class="tab-pane fade"
        :class="{ 'active show': isActive('informacion') }"
        id="informacion"
      >
        <FormActividad @close="close" />
      </div>
    </div>
  </div>
</template>

<script>
import ActividadShow from "./ActividadShow";
import FormActividad from "./FormActividad";
import EntregasActividad from "./EntregasActividad";
export default {
  data() {
    return {
      activeItem: "home",
      entregas: 0
    };
  },
  components: { ActividadShow, FormActividad, EntregasActividad },
  methods: {
    close() {
      this.$emit("close");
    },
    isActive(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive(menuItem) {
      this.activeItem = menuItem;
    },
    entrega(operacion) {
      if (operacion) {
        this.entregas++;
      } else {
        this.entregas--;
      }
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