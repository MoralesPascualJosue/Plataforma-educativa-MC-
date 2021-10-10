<template>
  <div class="tab-pane-page">
    <div class="tab-pane-page-row">
      <div class="tab-pane-page-row-layout">
        <div class="tab-pane-row-section">
          <div class="tab-pane-row-section-card">
            <h5 role="button" class="tab-pane-row-section-card-header">
              Texto
            </h5>
            <div class="tab-pane-row-section-card-body">
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Color texto
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
                          v-model="prosblockcontent.props.color"
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
                    Alineación texto
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
                    <a role="button" v-on:click="updatestatusaling('justify')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.textAlign == 'justify',
                        }"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 32"
                        >
                          <g transform="translate(-350 -229)">
                            <g class="a" transform="translate(350 229)">
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
                              x2="24"
                              transform="translate(354.5 236.5)"
                            />
                            <line
                              class="b"
                              x2="24"
                              transform="translate(354.5 244.5)"
                            />
                            <line
                              class="b"
                              x2="24"
                              transform="translate(354.5 252.5)"
                            />
                            <line
                              class="b"
                              x2="24"
                              transform="translate(354.5 248.5)"
                            />
                            <line
                              class="b"
                              x2="24"
                              transform="translate(354.5 240.5)"
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
                    Tamaño linea
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
                        v-on:click="updatestatuslineheight(false)"
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
                          :value="prosblockcontent.props.lineHeight"
                          readonly
                        />
                      </div>
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatuslineheight(true)"
                      >
                        +
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
              color: "#a2a2a2",
              fontSize: "22px",
              lineHeight: "140%",
              textAlign: "left",
            },
            value: "Text default tools",
          },
        };
      },
    },
  },
  computed: {
    prosblockcontent() {
      return this.propsblock.propsContainer;
    },
    fontSizec() {
      let fontSize = this.prosblockcontent.props.fontSize.split("p");
      return fontSize[0];
    },
    lineHeightc() {
      let lineHeight = this.prosblockcontent.props.lineHeight.split("%");
      return lineHeight[0];
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
    updatestatuslineheight(status) {
      let newsize = Number(this.lineHeightc);
      if (status) {
        newsize = newsize + 10;
      } else {
        newsize = newsize - 10;
      }

      if (newsize > 99 && newsize < 500) {
        this.prosblockcontent.props.lineHeight = newsize + "%";
      }
    },
  },
};
</script>
<style>
</style>