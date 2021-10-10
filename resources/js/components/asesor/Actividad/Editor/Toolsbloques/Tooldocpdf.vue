<template>
  <div class="tab-pane-page">
    <div class="tab-pane-page-row">
      <div class="tab-pane-page-row-layout">
        <div class="tab-pane-row-section">
          <div class="tab-pane-row-section-card">
            <h5 role="button" class="tab-pane-row-section-card-header">
              Documento
            </h5>
            <div class="tab-pane-row-section-card-body">
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Color fondo
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <div
                      class="
                        tab-pane-row-section-card-body-item-content-element-border
                      "
                    >
                      <div>
                        <input
                          type="color"
                          name="textcolor"
                          v-model="prosblockcontent.props.backgroundColor"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Largo de documento
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <div
                      class="
                        tab-pane-row-section-card-body-item-content-element-counter
                      "
                    >
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatusheight(false)"
                      >
                        -
                      </button>
                      <div
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-container
                        "
                      >
                        <input
                          type="text"
                          :value="prosblockcontent.src.height"
                          readonly
                        />
                      </div>
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatusheight(true)"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="tab-pane-row-section-card-body-item"
                :class="{
                  'inputchangeimage-loading': loading,
                }"
              >
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Documento
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <div
                      class="
                        tab-pane-row-section-card-body-item-content-element-counter
                      "
                    >
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-button
                        "
                      >
                        Subir documento
                        <input
                          id="docpdffile"
                          type="file"
                          ref="docpdffile"
                          accept="application/pdf"
                          autocomplete="off"
                          class="inputdocpdffile-tool-tab"
                          v-on:change="onChangeDocpdfUpload"
                        />
                      </button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    Url
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  ></div>
                </div>
                <div
                  class="
                    tab-pane-row-section-card-body-item-content
                    inputtext-tool-tab
                  "
                >
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  ></div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <input
                      type="text"
                      class="
                        tab-pane-row-section-card-body-item-content-inputtext
                      "
                      ref="urldocpdffile"
                      :value="url"
                    />
                    <button
                      class="
                        tab-pane-row-section-card-body-item-content-element-button
                      "
                      v-on:click="changeDocpdf"
                    >
                      Cambiar documento
                    </button>
                  </div>
                </div>
                <div v-if="loading" class="inputchangeimage-loading-label">
                  Cargando . . .
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propsblock: {
      type: Object,
      default: function () {
        return {
          propsContainer: {
            props: {
              backgroundColor: "#f2f2f2",
            },
            src: {
              url: "/resources/icons/document-vacio.svg",
              height: "650",
            },
          },
        };
      },
    },
  },
  data() {
    return {
      docpdffile: "",
      loading: false,
    };
  },
  computed: {
    prosblockcontent() {
      return this.propsblock.propsContainer;
    },
    url() {
      return this.prosblockcontent.src.url;
    },
  },
  methods: {
    updatestatusheight(status) {
      let newsize = Number(this.prosblockcontent.src.height);
      if (status) {
        newsize = newsize + 10;
      } else {
        newsize = newsize - 10;
      }

      if (newsize > 450 && newsize < 950) {
        this.prosblockcontent.src.height = newsize;
      }
    },
    onChangeDocpdfUpload() {
      this.docpdffile = this.$refs.docpdffile.files[0];

      let formData = new FormData();
      formData.append("fileToUpload", this.docpdffile);
      this.loading = true;
      axios
        .post("/uploadfiled", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.prosblockcontent.src.url = response.data.filelink;
          flash("Documento subido", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("Error a subir documento", "error");
        })
        .finally(() => {
          this.loading = false;
        });
    },
    changeDocpdf() {
      let newurl = this.$refs.urldocpdffile.value;
      let patt = /pdf/;
      this.loading = true;
      axios
        .get(newurl)
        .then((response) => {
          if (patt.test(response.headers["content-type"])) {
            this.prosblockcontent.src.url = newurl;
            flash("Documento cambiado", "success");
          } else {
            flash("Asegura especificar un pdf", "warning");
          }
        })
        .catch((error) => {
          flash("Error al cambiar documento", "error");
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
<style>
.tab-pane-row-section-card-body-item-content-element-button {
  background-color: rgb(0, 123, 255) !important;
  color: rgb(255, 255, 255) !important;
  border-color: rgb(0, 123, 255) !important;
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  line-height: 1.5;
  border-radius: 0.2rem;
}
.tab-pane-row-section-card-body-item-content-element-button:hover {
  background-color: rgb(0, 105, 217) !important;
  color: rgb(255, 255, 255) !important;
  border-color: rgb(0, 98, 204) !important;
}
.tab-pane-row-section-card-body-item-content-inputtext {
  background-color: rgb(255, 255, 255) !important;
  color: rgb(73, 80, 87) !important;
  border-color: rgb(206, 212, 218) !important;
  display: block;
  width: 100%;
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
}
.tab-pane-row-section-card-body-item-content-inputtext:focus {
  color: #495057;
  background-color: #fff;
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);
}
.inputtext-tool-tab {
  display: block;
}
.inputdocpdffile-tool-tab {
  opacity: 0;
  position: absolute;
  left: 15px;
  width: 6.5rem;
  height: 2rem;
  top: 5px;
}
</style>