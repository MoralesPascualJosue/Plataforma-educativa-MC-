<template>
  <div class="resumen-content">
    <div class="resumen-content-header">
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
    </div>

    <div class="resumen-content-tablecontent">
      <table class="resumen-table">
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
              <p
                v-if="calificacion.estado == 1"
                class="resumen-table-status-revision"
              >
                Revision
              </p>
              <p
                v-else
                :class="{
                  nacolor: estadocalificacion(calificacion.qualification),
                }"
              >
                {{ calificacion.qualification }}
              </p>
            </td>
          </tr>
        </tbody>
        <thead v-if="cargando">
          <h3>Cargando ...</h3>
        </thead>
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
      cargando: true,
    };
  },
  created() {
    axios
      .get("/actividadescurso/" + this.curso.id)
      .then((res) => {
        this.actividades = res.data.actividades;
        this.estudiantes = res.data.estudiantes;
        this.cursoi = res.data.curso;
        this.cargando = false;
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
.resumen-content {
  padding: 1rem;
}
.resumen-content-header {
  background-color: #fdc770;
  padding: 0.5rem;
}
.resumen-content-tablecontent {
  width: 100%;
}
.resumen-table {
  width: 100%;
  background-color: white;
}

.resumen-table th {
  text-align: left;
  background-color: #fdc770;
  padding: 0.5rem;
}

.resumen-table tbody tr:hover {
  background-color: #fcb036;
}
.resumen-table tbody td {
  padding: 0.2rem;
}

.resumen-table-status-revision {
  background-color: #c1d3d9;
  padding: 0.5rem;
}

.nacolor {
  color: red;
}

.tb-lc td:last-child {
  background-color: #c1d3d9;
  text-align: center;
  font-size: 25px;
}
</style>
