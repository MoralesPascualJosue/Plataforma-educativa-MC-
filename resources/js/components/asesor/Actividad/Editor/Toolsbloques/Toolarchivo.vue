<template>
  <div class="tab-pane-page">
    <div class="tab-pane-page-row">
      <div class="tab-pane-page-row-layout">
        <div class="tab-pane-row-section">
          <div class="tab-pane-row-section-card">
            <h5 role="button" class="tab-pane-row-section-card-header">
              Archivo
            </h5>
            <div class="tab-pane-row-section-card-body">
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
                    Agregar archivo
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
                        Subir archivo
                        <input
                          id="archivofile"
                          type="file"
                          ref="archivofile"
                          autocomplete="off"
                          class="inputimagefile-tool-tab"
                          v-on:change="onChangeArchivoUpload"
                        />
                      </button>
                    </div>
                  </div>
                </div>
                <div v-if="loading" class="inputchangeimage-loading-label">
                  Cargando . . .
                </div>
              </div>
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Color borde
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
                    Tamaño fuente
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
                        v-on:click="updatestatusfontsize(false)"
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
                          :value="prosblockcontent.props.fontSize"
                          readonly
                        />
                      </div>
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatusfontsize(true)"
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
                    Alineación
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
            </div>
            <div class="tab-pane-row-section-card-body">
              <div class="tab-pane-row-section-card-body-item-content-label">
                Lista de archivos
              </div>
              <div class="tab-pane-row-secion-card-body-item">
                <ul class="tab-pane-row-section-card-body-listitem">
                  <li
                    v-for="(archivoitem, indexitema) in this.prosblockcontent
                      .archivos"
                    :key="indexitema + archivoitem.name"
                  >
                    <p>
                      {{ archivoitem.name }}
                      <span
                        class="delete"
                        v-on:click="deletearchivoitem(indexitema)"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 32"
                        >
                          <g transform="translate(-244 -385)">
                            <path
                              class="b"
                              d="M5.194.029,4.97,3.019-2.036,1.412-.742-1.221Z"
                              transform="translate(261 388)"
                            />
                            <g class="b" transform="translate(252 399)">
                              <path
                                class="e"
                                d="M 7.706448078155518 12.35585021972656 L 5.19981861114502 11.88849830627441 L 3.938209772109985 11.29481887817383 L 0.1968925595283508 -0.4927387535572052 L 3.070948600769043 0.5523881912231445 L 3.135668516159058 0.5759181976318359 L 3.204338550567627 0.5810782313346863 L 8.064568519592285 0.946438193321228 L 8.101308822631836 0.9492081999778748 L 8.138058662414551 0.9465482234954834 L 13.19836807250977 0.5811882019042969 L 13.2415885925293 0.5780681967735291 L 13.28361892700195 0.567558228969574 L 16.83906936645508 -0.3212785422801971 L 13.42620372772217 11.01466369628906 L 10.68593978881836 12.14302539825439 L 7.706448078155518 12.35585021972656 Z"
                              />
                              <path
                                class="f"
                                d="M 0.9808139801025391 0.3243570327758789 L 4.348709106445313 10.93539428710938 L 5.354598999023438 11.40873908996582 L 7.734922409057617 11.85254096984863 L 10.5700159072876 11.65003108978271 L 13.01597690582275 10.64285469055176 L 16.10661125183105 0.3772163391113281 L 13.40487861633301 1.052628517150879 L 13.32079887390137 1.073648452758789 L 13.23435878753662 1.079888343811035 L 8.17405891418457 1.445248603820801 L 8.100568771362305 1.450558662414551 L 8.027088165283203 1.445037841796875 L 3.166858673095703 1.079678535461426 L 3.029508590698242 1.069348335266113 L 2.900068283081055 1.02227783203125 L 0.9808139801025391 0.3243570327758789 M -0.5870323181152344 -1.309842109680176 L 3.241818428039551 0.08248805999755859 L 8.102048873901367 0.4478483200073242 L 13.16234874725342 0.08248805999755859 L 17.57152938842773 -1.019771575927734 L 13.83642864227295 11.38647842407227 L 10.80187797546387 12.63601779937744 L 7.677978515625 12.85915851593018 L 5.045048713684082 12.36825847625732 L 3.527709007263184 11.65423774719238 L -0.5870323181152344 -1.309842109680176 Z"
                              />
                            </g>
                            <g class="a" transform="translate(244 385)">
                              <rect class="e" width="33" height="32" rx="4" />
                              <rect
                                class="g"
                                x="0.5"
                                y="0.5"
                                width="32"
                                height="31"
                                rx="3.5"
                              />
                            </g>
                            <line
                              class="b"
                              x2="18"
                              y2="4"
                              transform="translate(253.5 388.5)"
                            />
                            <path
                              class="d"
                              d="M9.135,1.079h8.722"
                              transform="translate(268.424 394.51) rotate(104)"
                            />
                            <g class="c" transform="translate(251 395)">
                              <ellipse
                                class="e"
                                cx="9.5"
                                cy="2.5"
                                rx="9.5"
                                ry="2.5"
                              />
                              <ellipse
                                class="g"
                                cx="9.5"
                                cy="2.5"
                                rx="9"
                                ry="2"
                              />
                            </g>
                            <line
                              class="d"
                              y2="8"
                              transform="translate(260.5 403.5)"
                            />
                            <line
                              class="d"
                              x2="1"
                              y2="8"
                              transform="translate(255.5 402.5)"
                            />
                            <path
                              class="c"
                              d="M1717.389,402c5.833,3.259,10,0,10,0"
                              transform="translate(-1461.889 8.449)"
                            />
                          </g></svg
                      ></span>
                    </p>
                  </li>
                </ul>
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
              fontSize: "18px",
              textAlign: "center",
              backgroundColor: "#2faade",
            },
            archivos: [
              {
                icon: "../resources/icons/work.svg",
                url: "/resources/icons/imagen-vacio.svg",
                name: "imagen-vacio.svg",
                type: "svg",
              },
            ],
          },
        };
      },
    },
  },
  data() {
    return {
      imagefile: "",
      loading: false,
    };
  },
  computed: {
    prosblockcontent() {
      return this.propsblock.propsContainer;
    },
    fontSizec() {
      let fontSize = this.prosblockcontent.props.fontSize.split("p");
      return fontSize[0];
    },
  },
  methods: {
    updatestatusaling(status) {
      this.prosblockcontent.props.textAlign = status;
    },
    updatestatusfontsize(status) {
      let newsize = Number(this.fontSizec);
      if (status) {
        newsize = newsize + 1;
      } else {
        newsize = newsize - 1;
      }

      if (newsize > 8 && newsize < 50) {
        this.prosblockcontent.props.fontSize = newsize + "px";
      }
    },
    onChangeArchivoUpload() {
      this.archivofile = this.$refs.archivofile.files[0];

      let formData = new FormData();
      formData.append("fileToUpload", this.archivofile);
      this.loading = true;
      axios
        .post("/uploadfile", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.prosblockcontent.archivos.push({
            url: response.data.filelink,
            name: response.data.name,
            type: response.data.type,
            icon: response.data.icon,
          });
          flash("Archivo subido", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("Error a subir archivo", "error");
        })
        .finally(() => {
          this.loading = false;
        });
    },
    deletearchivoitem(pos) {
      if (confirm("Eliminar archivo de la lista")) {
        this.prosblockcontent.archivos.splice(pos, 1);
      }
    },
  },
};
</script>
<style>
.tab-pane-row-section-card-body-listitem {
  position: relative;
  padding-right: 15px;
  padding-left: 15px;
  padding-top: 0.5rem;
}
.tab-pane-row-section-card-body-listitem p {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid rgb(225, 228, 231);
  cursor: pointer;
}
.tab-pane-row-section-card-body-listitem p:hover {
  background-color: #eaeaea;
}
.tab-pane-row-section-card-body-listitem p span {
  width: 20px;
  height: 20px;
  display: inline-block;
  position: relative;
}
.tab-pane-row-section-card-body-listitem p span:hover {
  background-color: rgb(194, 40, 44);
}
</style>