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

    <div class="footer">
      <h3>Genera tus preguntas</h3>
      <vue-form-generator
        :schema="schemagenerator"
        :model="modelgenerator"
        :options="formOptionsgenerator"
      ></vue-form-generator>
      <div
        v-for="item in modelgenerator.values"
        :key="item.name"
        class="testshow-generator-option"
      >
        {{ item.name }}
      </div>
      <br />
      <button class="testshow-generator-addbottom" @click="agregarpregunta">
        Agregar pregunta
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
      model: {},
      schema: {
        fields: [],
      },

      formOptions: {
        validateAfterLoad: true,
        validateAfterChanged: true,
      },
      modelgenerator: {
        type: "input",
        label: "",
        optiondefault: "",
        values: function () {
          return [];
        },
      },
      schemagenerator: {
        fields: [
          {
            type: "select",
            label: "Tipo de pregunta",
            model: "type",
            values: function () {
              return [
                { id: "input", name: "Respuesta corta" },
                { id: "select", name: "Selección" },
                { id: "checklist", name: "Selección multiple" },
                { id: "textArea", name: "Respuesta larga" },
              ];
            },
            onChanged: function (model, newVal, oldVal, field) {
              model.values = [];
            },
          },
          {
            type: "input",
            inputType: "text",
            label: "Pregunta",
            placeholder: "Pregunta",
            model: "label",
          },
          {
            type: "input",
            inputType: "text",
            label: "Agrega una opción",
            placeholder: "Opción ",
            model: "optiondefault",
            visible: function (model) {
              return (
                model && (model.type == "select" || model.type == "checklist")
              );
            },
            buttons: [
              {
                classes: "btn-clear",
                label: "Agregar opción",
                type: "reset",
                onclick: function (model, field) {
                  if (model.optiondefault == "") {
                    flash("Opción vacia", "info");
                    return "fail";
                  }

                  let option;

                  if (model.type == "checklist") {
                    option = {
                      name: model.optiondefault,
                      value: model.optiondefault,
                    };
                  }

                  if (model.type == "select") {
                    option = {
                      name: model.optiondefault,
                      id: model.optiondefault,
                    };
                  }

                  model.values.push(option);
                  model.optiondefault = "";
                },
              },
            ],
          },
          {
            type: "label",
            label: "Lista de opciones",
            visible: function (model) {
              return (
                model && (model.type == "select" || model.type == "checklist")
              );
            },
          },
        ],
      },

      formOptionsgenerator: {
        validateAfterLoad: true,
        validateAfterChanged: true,
      },
    };
  },
  computed: {
    actividad() {
      return this.$store.getters["activities/actividadview"];
    },
  },
  created() {
    this.actividad.questions.forEach((element) => {
      let question = {
        inputType: "text",
        type: element.type,
        label: element.question,
        model: element.question,
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
    });
  },
  methods: {
    agregarpregunta() {
      if (!this.modelgenerator.type) {
        flash("Slecciona un tipo de pregunta", "info");
        return "fail";
      }

      if (this.modelgenerator.label == "") {
        flash("Pregunta vacia", "info");
        return "fail";
      }

      let form = {
        type: this.modelgenerator.type,
        label: this.modelgenerator.label,
        inputType: "text",
        model: this.modelgenerator.label,
      };

      if (form.type == "select" && this.modelgenerator.values.length == 0) {
        flash("No se han agregado opciones para esta pregunta", "info");
        return "fail";
      }

      let valuesoptions = [];

      if (
        (form.type == "select" || form.type == "checklist") &&
        this.modelgenerator.values.length
      ) {
        form.values = this.modelgenerator.values;
        form.listBox = true;
        this.modelgenerator.values.forEach((element) => {
          valuesoptions.push(Object.values(element));
        });
      }

      axios
        .post("/test/question/" + this.actividad.id, {
          type: this.modelgenerator.type,
          label: this.modelgenerator.label,
          options: valuesoptions,
        })
        .then((response) => {
          this.schema.fields.push(form);

          this.modelgenerator.label = "";
          this.modelgenerator.values = [];
          flash("Pregunta creada", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          this.errorr = true;
          flash(
            "Fallo la creacion de la pregunta: revisa los campos solicitados.",
            "error"
          );
        });
    },
  },
};
</script>

<style>
.panel-body .vue-form-generator fieldset {
  background-color: #fcd770;
  display: grid;
  grid-template-columns: repeat(10, auto);
  border: none;
  border-radius: 20px;
}
.panel-body .vue-form-generator fieldset .form-group {
  padding: 1rem;
}
.form-group.field-input {
  grid-column: span 5;
}
.form-group.field-select {
  grid-column: span 5;
}
.form-group.field-checklist {
  grid-column: span 5;
}
.form-group.field-textArea {
  grid-column: span 10;
}
.form-group.field-textArea textarea {
  resize: none;
}
.footer {
  background-color: #f0f0f0;
  margin-top: 1rem;
  padding: 1rem;
}
.footer fieldset {
  border: none;
  padding: 0.5rem;
}
.testshow-generator-option {
  margin-left: 1rem;
  display: inline-block;
  background: #fcd770;
  padding: 0.5rem;
}
.testshow-generator-addbottom {
  margin: 1rem;
  border: none;
  background-color: white;
  padding: 1rem;
  cursor: pointer;
}
.testshow-generator-addbottom:hover {
  background-color: #fcd770;
}
@media only screen and (max-width: 1050px) {
  .panel-body .vue-form-generator fieldset {
    display: inherit;
  }
  .footer .vue-form-generator .field-wrap {
    display: block;
  }
}
</style>
