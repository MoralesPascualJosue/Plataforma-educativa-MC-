<template>
  <div class="actividad-tabs-layout">
    <div class="actividad-tabs-menunav">
          <a
            class="actividad-tabs-menunav-item"
            @click.prevent="setActive('home')"
            :class="{ active: isActive('home') }"
            href="#home"
            >Actividad</a>
          <a
            class="actividad-tabs-menunav-item"
            @click.prevent="setActive('entregas')"
            :class="{ active: isActive('entregas') }"
            href="#profile"
            >Entregas</a>
          <a
            class="actividad-tabs-menunav-item"
            @click.prevent="setActive('informacion')"
            :class="{ active: isActive('informacion') }"
            href="#informacion"
            >Detalles</a>
    </div>
    <div class="actividad-tabs-contentpane" id="myTabContent">
      <div v-show="isActive('home')">
        <ActividadShow />
      </div>
      <div v-show="isActive('entregas')">
        <EntregasActividad />
      </div>
      <div v-show="isActive('informacion')">
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
  },
};
</script>

<style>
.actividad-tabs-menunav {
  background-color: #fcd770;
  padding: 0.7rem;
  border-radius: 20px;
  margin-left: 3rem;
}
.actividad-tabs-menunav-item {
 padding: 0.5rem;
 border-radius: 20px;
}
.actividad-tabs-menunav-item:hover {
 background-color:#fcb036;
}
.actividad-tabs-menunav-item.active {
 background-color: white;
}
.actividad-tabs-contentpane {
 margin-top: 0.5rem;
}
@media only screen and (max-width: 1050px) {
  .actividad-tabs-menunav-item {
    padding: 0.3rem;
    line-height: 1.5rem;
  }
}
</style>
