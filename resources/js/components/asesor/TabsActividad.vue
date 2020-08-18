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
        >Entregas</a>
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
        <ActividadShow />
      </div>
      <div
        class="tab-pane fade"
        :class="{ 'active show': isActive('entregas') }"
        id="entregas"
      >Entregas content</div>
      <div
        class="tab-pane fade"
        :class="{ 'active show': isActive('informacion') }"
        id="informacion"
      >Informacion content</div>
    </div>
  </div>
</template>

<script>
import ActividadShow from "./ActividadShow";
export default {
  data() {
    return {
      activeItem: "home"
    };
  },
  components: { ActividadShow },
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