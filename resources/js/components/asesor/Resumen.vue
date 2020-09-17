<template>
  <div>
    <h3>Lista de participantes del curso</h3>
    <a
      class="export-option"
      :href="'/generarlista/'+curso.id"
      rel="noopener noreferrer"
      target="_blank"
    >Exportar pdf</a> |
    <a class="export-option" :href="'/generarexcel/'+curso.id">Exportar excel</a>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col" v-for="actividad in actividades" :key="actividad.id">{{actividad.title}}</th>
            <th scope="col" class="b-color">Promedio</th>
          </tr>
        </thead>
        <tbody class="tb-lc">
          <tr v-for="(estudiante,indexes) in estudiantes" :key="indexes">
            <th scope="row">{{indexes+1}}</th>
            <td>{{estudiante.name}}</td>
            <td v-for="(calificacion,indexb) in estudiante.calificaciones" :key="indexb">
              <p v-if="calificacion.estado == 1" class="bg-info cur-p">Revision</p>
              <p
                v-else
                :class="{ 'bg-warning': estadocalificacion(calificacion.qualification),'nacolor':calificacion.qualification<70 }"
              >{{calificacion.qualification}}</p>
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
    }
  },
  data() {
    return {
      actividades: [],
      estudiantes: [],
      cursoi: []
    };
  },
  created() {
    axios.get("/actividadescurso/" + this.curso.id).then(res => {
      this.actividades = res.data.actividades;
      this.estudiantes = res.data.estudiantes;
      this.cursoi = res.data.curso;
    });
  },
  methods: {
    estadocalificacion(value) {
      if (value == "NA") {
        return true;
      }

      return false;
    }
  }
};
</script>

<style>
.b-color {
  background-color: #c1d3d9;
}

.nacolor {
  color: red;
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
</style>