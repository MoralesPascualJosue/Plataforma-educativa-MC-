<template>
  <div class="tab-pane-page">
    <div class="tab-pane-page-row">
      <div class="tab-pane-page-row-layout">
        <div class="tab-pane-row-section">
          <div class="tab-pane-row-section-card">
            <h5 role="button" class="tab-pane-row-section-card-header">
              Imagen
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
                    Ancho de la imagen
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
                        v-on:click="updatestatuswidth(false)"
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
                          :value="prosblockcontent.src.width"
                          readonly
                        />
                      </div>
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatuswidth(true)"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Alineación imagen
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <a role="button" v-on:click="updatestatusaling('left')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.textAlign == 'left',
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 32"
                        >
                          <g transform="translate(-191 -229)">
                            <g class="a" transform="translate(191 229)">
                              <rect class="c" width="33" height="32" rx="4" />
                              <rect
                                class="d"
                                x="0.5"
                                y="0.5"
                                width="32"
                                height="31"
                                rx="3.5"
                              />
                            </g>
                            <line
                              class="b"
                              x2="14"
                              transform="translate(195.5 236.5)"
                            />
                            <path
                              class="b"
                              d="M0,0H19"
                              transform="translate(195.5 240.5)"
                            />
                            <line
                              class="b"
                              x2="19"
                              transform="translate(195.5 244.5)"
                            />
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(195.5 242.5)"
                            />
                            <line
                              class="b"
                              x2="16"
                              transform="translate(195.5 252.5)"
                            />
                            <line
                              class="b"
                              x2="12"
                              transform="translate(195.5 248.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(195.5 254.5)"
                            />
                          </g></svg
                      ></span>
                    </a>
                    <a role="button" v-on:click="updatestatusaling('center')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.textAlign == 'center',
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 32"
                        >
                          <g transform="translate(-191 -229)">
                            <g class="a" transform="translate(191 229)">
                              <rect class="c" width="33" height="32" rx="4" />
                              <rect
                                class="d"
                                x="0.5"
                                y="0.5"
                                width="32"
                                height="31"
                                rx="3.5"
                              />
                            </g>
                            <line
                              class="b"
                              x2="14"
                              transform="translate(200.5 236.5)"
                            />
                            <path
                              class="b"
                              d="M0,0H19"
                              transform="translate(198.5 240.5)"
                            />
                            <line
                              class="b"
                              x2="17"
                              transform="translate(199.5 244.5)"
                            />
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(195.5 242.5)"
                            />
                            <line
                              class="b"
                              x2="16"
                              transform="translate(199.5 252.5)"
                            />
                            <line
                              class="b"
                              x2="12"
                              transform="translate(201.5 248.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(195.5 254.5)"
                            />
                          </g></svg
                      ></span>
                    </a>
                    <a role="button" v-on:click="updatestatusaling('right')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.textAlign == 'right',
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 32"
                        >
                          <g transform="translate(-297 -229)">
                            <g class="a" transform="translate(297 229)">
                              <rect class="c" width="33" height="32" rx="4" />
                              <rect
                                class="d"
                                x="0.5"
                                y="0.5"
                                width="32"
                                height="31"
                                rx="3.5"
                              />
                            </g>
                            <line
                              class="b"
                              x2="14"
                              transform="translate(311.5 236.5)"
                            />
                            <path
                              class="b"
                              d="M0,0H19"
                              transform="translate(306.5 240.5)"
                            />
                            <line
                              class="b"
                              x2="19"
                              transform="translate(306.5 244.5)"
                            />
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(301.5 242.5)"
                            />
                            <line
                              class="b"
                              x2="16"
                              transform="translate(309.5 252.5)"
                            />
                            <line
                              class="b"
                              x2="12"
                              transform="translate(313.5 248.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(301.5 254.5)"
                            />
                          </g></svg
                      ></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Largo de imagen
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
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Imagen
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
                        Subir imagen
                        <input
                          id="imagefile"
                          type="file"
                          ref="imagefile"
                          accept="image/*"
                          autocomplete="off"
                          class="inputimagefile-tool-tab"
                          v-on:change="onChangeImageUpload"
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
                      ref="urlimagefile"
                      :value="url"
                    />
                    <button
                      class="
                        tab-pane-row-section-card-body-item-content-element-button
                      "
                      v-on:click="changeImage"
                    >
                      Cambiar imagen
                    </button>
                  </div>
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
              textAlign: "center",
              backgroundColor: "#ffffff",
            },
            src: {
              url: "/resources/icons/imagen-vacio.svg",
              height: "100",
              width: "179",
            },
          },
        };
      },
    },
  },
  data() {
    return {
      imagefile: "",
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
    updatestatusaling(status) {
      this.prosblockcontent.props.textAlign = status;
    },
    updatestatuswidth(status) {
      let newsize = Number(this.prosblockcontent.src.width);
      if (status) {
        newsize = newsize + 10;
      } else {
        newsize = newsize - 10;
      }

      if (newsize > 100 && newsize < 800) {
        this.prosblockcontent.src.width = newsize;
      }
    },
    updatestatusheight(status) {
      let newsize = Number(this.prosblockcontent.src.height);
      if (status) {
        newsize = newsize + 10;
      } else {
        newsize = newsize - 10;
      }

      if (newsize > 100 && newsize < 500) {
        this.prosblockcontent.src.height = newsize;
      }
    },
    onChangeImageUpload() {
      this.imagefile = this.$refs.imagefile.files[0];

      let formData = new FormData();
      formData.append("file", this.imagefile);

      axios
        .post("/uploadfilei", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.prosblockcontent.src.url = response.data.filelink;
          flash("Imagen subida", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("Error a subir imagen", "error");
        });
    },
    changeImage() {
      let newurl = this.$refs.urlimagefile.value;
      let patt = /image/;
      axios
        .get(newurl)
        .then((response) => {
          if (patt.test(response.headers["content-type"])) {
            this.prosblockcontent.src.url = newurl;
            flash("Imagen cambiada", "success");
          } else {
            flash("Asegura especificar una imagen", "warning");
          }
        })
        .catch((error) => {
          flash("Error al cambiar imagen", "error");
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
.inputimagefile-tool-tab {
  opacity: 0;
  position: absolute;
  left: 15px;
  width: 6.5rem;
  height: 2rem;
  top: 5px;
}
</style>