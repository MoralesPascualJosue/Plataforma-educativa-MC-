<template>
  <div class="tab-pane-page">
    <div class="tab-pane-page-row">
      <div class="tab-pane-page-row-layout">
        <div class="tab-pane-row-section">
          <div class="tab-pane-row-section-card">
            <h5 role="button" class="tab-pane-row-section-card-header">
              General
            </h5>
            <div class="tab-pane-row-section-card-body">
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Text color
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
                          v-model="propsPage.textColor"
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
                    Background color
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
                          name="backgound"
                          v-model="propsPage.backgroundColor"
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
                    Tamaño horizontal
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
                        v-on:click="updatestatuspagewidth(false)"
                      >
                        -
                      </button>
                      <div
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-container
                        "
                      >
                        <input type="number" :value="propsPage.widthPage" />
                      </div>
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatuspagewidth(true)"
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
                    Alineación página
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <a
                      role="button"
                      v-on:click="updatestatuspage({ alignPage: 'left' })"
                    >
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
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
                    <a
                      role="button"
                      v-on:click="updatestatuspage({ alignPage: 'center' })"
                    >
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
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
    propsPage: Object,
  },
  methods: {
    updatestatuspage(status) {
      this.$emit("statuspage-change", status);
    },
    updatestatuspagewidth(status) {
      let newwidth = this.propsPage.widthPage;
      if (status) {
        newwidth = newwidth + 50;
      } else {
        newwidth = newwidth - 50;
      }

      if (newwidth > 200 && newwidth < 1400) {
        this.$emit("statuspage-change", { widthPage: newwidth });
      } else {
        this.$emit("statuspage-change", {
          widthPage: this.propsPage.widthPage,
        });
      }
    },
  },
};
</script>
<style>
.tab-pane-page {
  height: 100%;
  animation: 0.25s ease 0s 1 normal none running fadedrop;
}
.tab-pane-page-row {
  height: 100%;
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
.tab-pane-page-row-layout {
  height: 100%;
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
}
@media (min-width: 576px) {
  .tab-pane-page-row-layout {
    flex: 0 0 100%;
    max-width: 100%;
  }
}
.tab-pane-row-section-card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  margin-bottom: 0.75rem;
  border: 0px !important;
  border-radius: 0px !important;
  background-color: transparent !important;
}
.tab-pane-row-section-card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  font-weight: 600;
  font-size: 12px;
  color: rgb(81, 97, 103);
  background-color: rgb(234, 234, 234);
  cursor: pointer;
  text-transform: uppercase;
  border-bottom: 0px !important;
  flex: 0 0 83.33333%;
  position: relative;
  width: 100%;
}
.tab-pane-row-section-card-header:first-child {
  border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.tab-pane-row-section-card-body {
  padding: 15px 20px !important;
  flex: 1 1 auto;
}
.tab-pane-row-section-card-body-item {
  padding: 15px 0px;
  border-bottom: 1px solid rgb(225, 228, 231);
}
.tab-pane-row-section-card-body-item:first-child {
  padding-top: 0px;
}
.tab-pane-row-section-card-body-item-content {
  display: flex;
  flex-wrap: wrap;
  height: 100%;
  justify-content: space-between;
}
.tab-pane-row-section-card-body-item-content-label {
  display: flex;
  flex-flow: row wrap;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: justify;
  justify-content: space-between;
  color: rgb(143, 150, 153);
}
.tab-pane-row-section-card-body-item-content-element {
  text-align: right !important;
  position: relative;
  padding-right: 15px;
  padding-left: 15px;
}
.tab-pane-row-section-card-body-item-content-element-border {
  padding: 2px;
  background-color: rgb(255, 255, 255);
  border-radius: 5px;
  display: inline-block;
  cursor: pointer;
  border: 1px solid rgb(204, 204, 204);
  box-shadow: rgb(239 239 239) 0px 0px 0px 2px inset !important;
}
.tab-pane-row-section-card-body-item-content-element-border input {
  border: none;
  cursor: pointer;
  text-align: right !important;
}
.tab-pane-row-section-card-body-item-content-element-border:hover {
  color: rgb(85, 85, 85);
  border: 1px solid rgb(153, 153, 153);
}
.tab-pane-row-section-card-body-item-content-element-counter {
  color: rgb(55, 58, 60);
  background-color: rgb(255, 255, 255);
  border: 1px solid rgb(222, 225, 226);
  border-radius: 4px;
  display: inline-block;
  font-size: 11px;
  font-weight: 700;
  margin-top: 3px;
  margin-bottom: 3px;
  user-select: none;
}
.tab-pane-row-section-card-body-item-content-element-counter-button {
  cursor: pointer;
  cursor: pointer;
  display: inline-block;
  height: 30px;
  width: 30px;
  text-align: center;
  line-height: 30px;
  vertical-align: middle;
  background: unset;
  box-shadow: unset;
  border: unset;
  color: inherit;
  appearance: none !important;
}
.tab-pane-row-section-card-body-item-content-element-counter-button:hover {
  color: rgb(55, 58, 60);
  background-color: rgb(249, 249, 249);
  border: 1px solid rgb(153, 153, 153);
}
.tab-pane-row-section-card-body-item-content-element-counter-container {
  position: relative;
  display: inline-block;
}
.tab-pane-row-section-card-body-item-content-element-counter-container input {
  border-width: 0px 1px;
  border-top-style: initial;
  border-bottom-style: initial;
  border-top-color: initial;
  border-bottom-color: initial;
  border-image: initial;
  border-left-style: solid;
  border-left-color: rgb(222, 225, 226);
  border-right-style: solid;
  border-right-color: rgb(222, 225, 226);
  color: rgb(127, 127, 127);
  background-color: rgb(249, 249, 249);
  display: inline-block;
  height: 30px;
  width: 40px;
  text-align: center;
  line-height: 30px;
  padding: 0px;
  vertical-align: middle;
}
.tab-pane-row-section-card-body-item-content-element-counter-container
  input[type="number"]::-webkit-inner-spin-button,
.tab-pane-row-section-card-body-item-content-element-counter-container
  input[type="number"]::-webkit-outer-spin-button {
  display: none;
}
.tab-pane-row-section-card-body-item-content-element-item {
  display: inline-block;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: 100%;
  border-radius: 3px;
  margin-left: 4px;
  text-align: center;
  cursor: pointer;
  width: 35px;
  height: 35px;
  line-height: 35px;
  font-size: 20px;
  color: rgb(170, 170, 170);
  border: 1px solid rgb(222, 225, 226);
}
.tab-pane-row-section-card-body-item-content-element-item:hover {
  color: rgb(85, 85, 85);
  border: 1px solid rgb(153, 153, 153);
}

.a {
  fill: #fff;
  opacity: 0;
}
.a,
.b {
  stroke: #707070;
}
.b,
.d {
  fill: none;
}
.b {
  stroke-width: 2px;
}
.c {
  stroke: none;
}
</style>