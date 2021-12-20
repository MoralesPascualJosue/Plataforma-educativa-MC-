<template>
  <div class="resumen-content">
    <div class="resumen-conten-header">
      <h3>Lista de actividades del curso</h3>
    </div>

    <div class="resumen-content-tablecontent">
      <table class="resumen-table">
        <thead>
          <tr>
            <th scope="col"># Actividad</th>
            <th scope="col">Nombre</th>
            <th scope="col">{{ estudiante.name }}</th>
          </tr>
        </thead>
        <tbody class="tb-lc">
          <tr v-for="(actividad, index) in actividades" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ actividad.title }}</td>
            <td>
              <p v-if="calificaciones[index].estado == 1" class="bg-info cur-p">
                {{ calificaciones[index].qualification }}
              </p>
              <p
                v-else
                :class="{
                  nacolor: estadocalificacion(
                    calificaciones[index].qualification
                  ),
                  nacolor: calificaciones[index].qualification < 70,
                }"
              >
                {{ calificaciones[index].qualification }}
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
      return this.$store.getters["cursos/cursoview"];
    },
  },
  data() {
    return {
      actividades: [],
      estudiante: [],
      calificaciones: [],
      cargando: true,
    };
  },
  created() {
    axios
      .get("/calificaciones/" + this.curso.id)
      .then((res) => {
        this.actividades = res.data.actividades;
        this.calificaciones = res.data.calificaciones;
        this.estudiante = res.data.estudiante;
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
  background-color: white;
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