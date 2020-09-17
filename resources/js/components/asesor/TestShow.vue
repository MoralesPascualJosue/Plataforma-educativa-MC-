<template>
  <div class="panel panel-default">
    <div class="panel-heading">Contenido</div>
    <div class="panel-body">
      <vue-form-generator :schema="schema" :model="model" :options="formOptions"></vue-form-generator>
    </div>
    <hr />
    <div class="footer">
      <h3>Genera tus preguntas</h3>
      <vue-form-generator
        :schema="schemagenerator"
        :model="modelgenerator"
        :options="formOptionsgenerator"
      ></vue-form-generator>
      <button class="btn btn-primary" @click="agregarpregunta">Agregar pregunta</button>
    </div>
  </div>
</template>

<script>
import VueFormGenerator from "vue-form-generator";
import "vue-form-generator/dist/vfg.css";

export default {
  components: {
    "vue-form-generator": VueFormGenerator.component
  },
  data() {
    return {
      model: {},
      schema: {
        fields: []
      },

      formOptions: {
        validateAfterLoad: true,
        validateAfterChanged: true
      },
      modelgenerator: {
        type: "input",
        label: "",
        optiondefault: "",
        values: function() {
          return [];
        }
      },
      schemagenerator: {
        fields: [
          {
            type: "select",
            label: "Tipo de pregunta",
            model: "type",
            values: function() {
              return [
                { id: "input", name: "Respuesta corta" },
                { id: "select", name: "Selección" },
                { id: "checklist", name: "Selección multiple" },
                { id: "textArea", name: "Respuesta larga" }
              ];
            },
            onChanged: function(model, newVal, oldVal, field) {
              if (newVal == "select" || newVal == "checklist") {
                model.values = [];
              }
            }
          },
          {
            type: "input",
            inputType: "text",
            label: "Pregunta",
            placeholder: "Pregunta",
            model: "label"
          },
          {
            type: "label",
            label: "Lista de opciones",
            model: "values",
            visible: function(model) {
              return (
                model && (model.type == "select" || model.type == "checklist")
              );
            }
          },
          {
            type: "switch",
            label: "Status",
            model: "status",
            multi: true,
            readonly: false,
            featured: false,
            disabled: false,
            default: true,
            textOn: "Es respuesta",
            textOff: "Marcar respuesta",
            visible: function(model) {
              return (
                model && (model.type == "select" || model.type == "checklist")
              );
            }
          },
          {
            type: "input",
            inputType: "text",
            label: "Agrega una opción",
            placeholder: "Opción ",
            model: "optiondefault",
            visible: function(model) {
              return (
                model && (model.type == "select" || model.type == "checklist")
              );
            },
            buttons: [
              {
                classes: "btn-clear",
                label: "Agregar opción",
                type: "reset",
                onclick: function(model, field) {
                  if (model.optiondefault == "") {
                    flash("Opción vacia", "info");
                    return "fail";
                  }

                  let option;

                  if (model.type == "checklist") {
                    option = {
                      name: model.optiondefault,
                      value: model.optiondefault,
                      respuesta: "no"
                    };
                  }

                  if (model.type == "select") {
                    option = {
                      name: model.optiondefault,
                      id: model.optiondefault,
                      respuesta: "no"
                    };
                  }

                  if (model.status) {
                    option.respuesta = "si";
                  }
                  model.values.push(option);
                  model.optiondefault = "";
                }
              }
            ]
          }
        ]
      },

      formOptionsgenerator: {
        validateAfterLoad: true,
        validateAfterChanged: true
      }
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    }
  },
  created() {
    this.actividad.questions.forEach(element => {
      let question = {
        inputType: "text",
        type: element.type,
        label: element.question,
        model: element.question,
        listBox: true
      };

      let options = [];
      element.options.forEach(opt => {
        let option;
        if (question.type == "checklist") {
          option = {
            name: opt.option,
            value: opt.option,
            respuesta: "no"
          };
        }

        if (question.type == "select") {
          option = {
            name: opt.option,
            id: opt.option,
            respuesta: "no"
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
        model: this.modelgenerator.label
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
        this.modelgenerator.values.forEach(element => {
          valuesoptions.push(Object.values(element));
        });
      }

      axios
        .post("/test/question/" + this.actividad.id, {
          type: this.modelgenerator.type,
          label: this.modelgenerator.label,
          options: valuesoptions
        })
        .then(response => {
          this.schema.fields.push(form);

          this.modelgenerator.label = "";
          this.modelgenerator.values = [];
          flash("Pregunta creada", "success");
        })
        .catch(response => {
          this.errorr = true;
          flash(
            "Fallo la creacion de la pregunta: revisa los campos solicitados.",
            "error"
          );
        })
        .finally(() => {});
    }
  }
};
</script>

<style>
.footer {
  background-color: #f0f0f0;
  padding: 10px;
}
</style>