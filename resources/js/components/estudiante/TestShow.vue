<template>
  <div class="panel panel-default">
    <div class="panel-heading">Contenido</div>
    <div class="panel-body">
      <vue-form-generator
        :schema="schema"
        :model="model"
        :options="formOptions"
      ></vue-form-generator>
    </div>
    <hr />
    <div class="footer" v-if="!this.actividad.estado">
      <button class="btn btn-primary" @click="responder">
        Registrar respuestas
      </button>
    </div>
  </div>
</template>

<script>
import VueFormGenerator from "vue-form-generator";
import "vue-form-generator/dist/vfg.css";

export default {
  components: {
    "vue-form-generator": VueFormGenerator.component,
  },
  data() {
    return {
      numpreguntas: 0,
      model: {},
      schema: {
        fields: [],
        groups: [],
      },
      formOptions: {
        validateAfterLoad: true,
        validateAfterChanged: true,
      },
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    },
  },
  created() {
    if (this.actividad.estado) {
      this.actividad.questions.forEach((element) => {
        let questiongroup = {
          legend: element.question,
          fields: [],
        };

        let options = [];
        element.respuesta.forEach((opt) => {
          let option = {
            type: "label",
            label: opt.answer,
            model: opt.answer,
            listBox: true,
          };

          questiongroup.fields.push(option);
        });

        this.schema.groups.push(questiongroup);
        this.numpreguntas++;
      });
    } else {
      this.actividad.questions.forEach((element) => {
        let question = {
          inputType: "text",
          type: element.type,
          label: element.question,
          model: element.id + "",
          listBox: true,
        };

        let options = [];
        element.options.forEach((opt) => {
          let option;
          if (question.type == "checklist") {
            option = {
              name: opt.option,
              value: opt.option,
              respuesta: "no",
            };
          }

          if (question.type == "select") {
            option = {
              name: opt.option,
              id: opt.option,
              respuesta: "no",
            };
          }

          options.push(option);
        });

        question.values = options;

        this.schema.fields.push(question);
        this.numpreguntas++;
      });
    }
  },
  methods: {
    responder() {
      const propertyValues = Object.values(this.model);
      let status = true;
      propertyValues.forEach((element) => {
        if (element == null || element.length == 0) {
          status = false;
        }
      });

      if (propertyValues.length != this.numpreguntas || !status) {
        flash("Tienes preguntas sin contestar", "warning");
        return "fail";
      }
      axios
        .post("/test/result/" + this.actividad.id, {
          respuestas: this.model,
          preguntas: Object.keys(this.model),
        })
        .then((response) => {
          let actividad = this.actividad;
          actividad.result = [response.data];
          actividad.estado = true;
          this.$store.commit("changeactividad", actividad);
          this.$emit("entregas", true);
          flash("Respuestas registradas", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorr = true;
          flash(
            "Fallo el registro de respuestas: revisa los campos solicitados.",
            "error"
          );
        });
    },
  },
};
</script>

<style>
.footer {
  background-color: #f0f0f0;
  padding: 10px;
}
</style>