<template>
  <div class="actividad-item">
    <a href="javascript:void(0);" @click="$emit('pop-image', activitie)">
      <div class="actividad-item-icon">
        <img
          v-if="activitie.type != 'activitie'"
          :src="iconprueba"
          alt="Prueba"
        />
        <img v-else :src="iconactividad" alt="Actividad" />
      </div>

      <div class="actividad-item-details">
        <div class="actividad-item-details-name">
          {{ activitie.title }} {{ activitie.fecha_inicio }}
          <span v-if="activitie.entregas > 0"
            >Pendientes: {{ activitie.entregas }}</span
          >
        </div>
        <div class="actividad-item-details-fechalimit">
          Fecha de vencimiento: {{ activitie.fecha_final }}
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      iconactividad: "../resources/icons/home-work-c.svg",
      iconprueba: "../resources/icons/test.svg",
    };
  },
  props: {
    activitie: Object,
  },
};
</script>
<style>
.actividad-item {
  background-color: #fcb036;
  width: 100%;
  height: 100px;
  padding-left: 1rem;
  padding-top: 1rem;
  margin-bottom: 1rem;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
  border-radius: 10px;
}
.actividad-item:hover {
  border-bottom: orange solid 2px;
  background-color: #f8f8f8;
}
.actividad-item a {
  position: relative;
  min-height: 2.375rem;
  text-decoration: none;
  clear: none;
  margin-right: 0;
  margin-top: 0;
  margin-bottom: 0.625rem;
  display: flex;
  align-items: flex-start;
  padding: 0;
  color: inherit;
}
.actividad-item-icon img {
  width: 50px;
}
.actividad-item-details {
  display: flex;
  flex-direction: column;
  justify-content: center;
  position: relative;
  overflow: hidden;
  text-decoration: none;
  line-height: 1.1875rem;
  padding-right: 0;
  flex-grow: 1;
  text-align: left;
  padding-left: 1.5rem;
}
.actividad-item-details-name {
  color: #1b396a;
  font-weight: 600;
  text-overflow: ellipsis;
  white-space: nowrap;
  word-wrap: normal;
  display: block;
  overflow: hidden;
}
.actividad-item-details-name span {
  float: right;
  padding-right: 0.5rem;
}
</style>
