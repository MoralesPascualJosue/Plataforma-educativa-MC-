<template>
  <div class="course-actividad">
    <a :href="ruta" @click="$emit('pop-image', activitie)">
      <div class="course-link-icon">
        <img
          v-if="activitie.type != 'activitie'"
          :src="iconprueba"
          alt="Prueba"
        />
        <img v-else :src="iconactividad" alt="Actividad" />
      </div>

      <div v-if="activitie.type != 'activitie'" class="course-link-details">
        <div class="course-link-name">
          {{ activitie.title }} {{ activitie.fecha_inicio }}
          <span
            v-if="activitie.entregas > 0"
            class="badge badge-primary float-right fontct"
            >Pendientes: {{ activitie.entregas }}</span
          >
        </div>
        <div class="course-link-content">
          Fecha de vencimiento: {{ activitie.fecha_final }}
        </div>
      </div>

      <div v-else class="course-link-details">
        <div class="course-link-name" v-if="activitie.type == 'activitie'">
          {{ activitie.title }} {{ activitie.fecha_inicio }}
          <span
            v-if="activitie.entregas > 0"
            class="badge badge-primary float-right fontct"
            >Pendientes: {{ activitie.entregas }}</span
          >
        </div>

        <div class="course-link-content">
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
  computed: {
    ruta() {
      return "javascript:void(0)";
    },
  },
};
</script>
<style>
.course-actividad {
  width: 100%;
  height: 100px;
  padding-left: 1rem;
  padding-top: 1rem;
  margin-bottom: 1rem;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}

.course-actividad a {
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

.course-link-icon img {
  width: 50px;
}

.course-link-details {
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

.course-link-name {
  color: #1b396a;
  font-weight: 600;
  text-overflow: ellipsis;
  white-space: nowrap;
  word-wrap: normal;
  display: block;
  overflow: hidden;
}

.course-link-content {
  text-overflow: ellipsis;
  white-space: nowrap;
  word-wrap: normal;
  display: block;
  overflow: hidden;
  white-space: normal;
  line-height: 1.1875rem;
  font-style: normal;
  font-weight: 400;
}

.course-actividad:hover {
  border-bottom: orange solid 2px;
  background-color: #f8f8f8;
}

.fontct {
  font-size: 14px;
}
</style>