<template>
  <div class="tab-pane-page">
    <div class="tab-pane-page-row">
      <div class="tab-pane-page-row-layout">
        <div class="tab-pane-row-section">
          <div class="tab-pane-row-section-card">
            <h5 role="button" class="tab-pane-row-section-card-header">
              Video
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
                    Largo de video
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
                    Video
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
                        Subir video
                        <input
                          id="videofile"
                          type="file"
                          ref="videofile"
                          accept="video/*"
                          autocomplete="off"
                          class="inputimagefile-tool-tab"
                          v-on:change="onChangeVideoUpload"
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
                      ref="urlvideofile"
                      :value="url"
                    />
                    <button
                      class="
                        tab-pane-row-section-card-body-item-content-element-button
                      "
                      v-on:click="changeVideo"
                    >
                      Cambiar video
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
              textAlign: "center",
              backgroundColor: "#ffffff",
            },
            src: {
              url: "/resources/icons/video-vacio.svg",
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

      if (newsize > 300 && newsize < 800) {
        this.prosblockcontent.src.height = newsize;
      }
    },
    onChangeVideoUpload() {
      this.videofile = this.$refs.videofile.files[0];

      let formData = new FormData();
      formData.append("fileToUpload", this.videofile);
      this.loading = true;
      axios
        .post("/uploadfilev", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.prosblockcontent.src.url = response.data.filelink;
          flash("Video subido", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("Error a subir video", "error");
        })
        .finally(() => {
          this.loading = false;
        });
    },
    changeVideo() {
      let newurl = this.$refs.urlvideofile.value;
      let patt = /video/;
      this.loading = true;
      axios
        .get(newurl)
        .then((response) => {
          if (patt.test(response.headers["content-type"])) {
            this.prosblockcontent.src.url = newurl;
            flash("Video cambiado", "success");
          } else {
            flash("Asegura especificar un video", "warning");
          }
        })
        .catch((error) => {
          flash("Error al cambiar video", "error");
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
<style>
.inputchangeimage-loading {
  position: relative;
}
.inputchangeimage-loading .tab-pane-row-section-card-body-item-content {
  opacity: 0.5;
}
.inputchangeimage-loading-label {
  font-size: 2rem;
  font-weight: bold;
  position: absolute;
  top: 35%;
  color: #2faade;
  left: 20%;
}
</style>