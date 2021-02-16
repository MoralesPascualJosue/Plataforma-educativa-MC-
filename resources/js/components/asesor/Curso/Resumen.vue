<template>
  <div>
    <h3>Lista de participantes del curso</h3>
    <a
      class="export-option"
      :href="'/generarlista/' + curso.id"
      rel="noopener noreferrer"
      target="_blank"
      >Exportar pdf</a
    >
    |
    <a class="export-option" :href="'/generarexcel/' + curso.id"
      >Exportar excel</a
    >
    <div class="table-responsive">
      <table class="table table-hover">
        <thead class="tb-h">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th
              scope="col"
              v-for="actividad in actividades"
              :key="actividad.type + actividad.id"
            >
              {{ actividad.title }}
            </th>
            <th scope="col" class="b-color">Promedio</th>
          </tr>
        </thead>
        <tbody class="tb-lc">
          <tr v-for="(estudiante, indexes) in estudiantes" :key="indexes">
            <th scope="row">{{ indexes + 1 }}</th>
            <td>{{ estudiante.name }}</td>
            <td
              v-for="(calificacion, indexb) in estudiante.calificaciones"
              :key="indexb"
            >
              <p v-if="calificacion.estado == 1" class="bg-info cur-p">
                Revision
              </p>
              <p
                v-else
                :class="{
                  'bg-warning': estadocalificacion(calificacion.qualification),
                  nacolor: calificacion.qualification < 70,
                }"
              >
                {{ calificacion.qualification }}
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    },
  },
  data() {
    return {
      actividades: [],
      estudiantes: [],
      cursoi: [],
    };
  },
  created() {
    axios
      .get("/actividadescurso/" + this.curso.id)
      .then((res) => {
        this.actividades = res.data.actividades;
        this.estudiantes = res.data.estudiantes;
        this.cursoi = res.data.curso;
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    estadocalificacion(value) {
      if (value == "NA") {
        return true;
      }

      return false;
    },
  },
};
</script>

<style>
.tb-h tr th {
  padding: 0.3rem;
  max-width: 250px;
  max-height: 25px;
  text-overflow: ellipsis;
  overflow: hidden;
}

.tb-h tr th:hover {
  color: #5b99d7;
}

.b-color {
  background-color: #c1d3d9;
}

.nacolor {
  color: red;
}

.tb-lc td {
  padding: 0.1rem;
}

.tb-lc td:last-child {
  background-color: #c1d3d9;
}
.table-responsive > .fixed-column {
  position: absolute;
  /* display: inline-block; */
  background-color: white;
  width: auto;
  border-right: 1px solid #ddd;
}
@media (min-width: 768px) {
  .table-responsive > .fixed-column {
    display: none;
  }
}

@media (max-width: 767px) {
  .tb-h tr th {
    white-space: nowrap;
  }
}
</style>