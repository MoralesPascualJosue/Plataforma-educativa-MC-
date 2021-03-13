<!--
Confirm component sucess or cancel

On sucess 'true' - On cancel 'false'

this.$emit('status',value);

titleText 		Component title
cancelText		Componentt option cancel
confirmText     	Component option inner swipe text 
confirmSuccessText 	Component option inner swipe text on sucess
-->

<template>
  <div class="confirmationcomponent-content">
    <div class="confirmationcomponent-layout">
      <div class="confirmationcomponent-title">
        {{ titleText }}
      </div>
      <div class="confirmationcomponent-options">
        <div class="confirmationcomponent-option" @click="status(false)">
          <p>{{ cancelText }}</p>
        </div>
        <div class="confirmationcomponent-option">
          <div class="content-swipecomponentomponent">
            <SwipeComponent
              @control="status"
              :width="208"
              :height="40"
              textSize="15px"
              :text="confirmText"
              :successText="confirmSuccessText"
              background="#fcd770"
              progressBarBg="#fcb036"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SwipeComponent from "./Swipecomponent";
export default {
  props: {
    titleText: {
      type: String,
      default: "Default title",
    },
    cancelText: {
      type: String,
      default: "Default cancel text",
    },
    confirmText: {
      type: String,
      default: "Default confirm text",
    },
    confirmSuccessText: {
      type: String,
      default: "Sucess",
    },
  },
  components: {
    SwipeComponent,
  },
  data() {
    return {};
  },
  methods: {
    status(value) {
      if (value) {
        this.$emit("status", true);
      } else {
        this.$emit("status", false);
      }
    },
  },
};
</script>

<style >
.confirmationcomponent-content {
  height: 100%;
  width: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 1;
  background-color: #0000005c;
}
.confirmationcomponent-layout {
  border-radius: 20px;
  width: 15rem;
  background: #266fae;
  height: 12rem;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -7.5rem;
  margin-left: -7.5rem;
}
.confirmationcomponent-title {
  text-align: center;
  margin: 1rem;
  font-size: 20px;
  color: black;
}
.confirmationcomponent-options {
  padding: 1rem;
}
.confirmationcomponent-option p {
  background-color: #fcd770;
  padding: 0.5rem;
  border-radius: 20px;
  text-align: center;
  cursor: pointer;
  margin-bottom: 0.5rem;
}
.confirmationcomponent-option p:hover {
  background-color: #fcb036;
}
</style>

