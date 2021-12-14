<template>
  <div class="buttonmessage-layout">
    <div class="buttonmessage-icon">
      <svg viewBox="0 0 33 32">
        <g transform="translate(-244 -437)">
          <g class="a" transform="translate(244 437)">
            <path
              class="d"
              d="M 29 31.5 L 4 31.5 C 2.070090055465698 31.5 0.5 29.92991065979004 0.5 28 L 0.5 4 C 0.5 2.070090055465698 2.070090055465698 0.5 4 0.5 L 29 0.5 C 30.92991065979004 0.5 32.5 2.070090055465698 32.5 4 L 32.5 28 C 32.5 29.92991065979004 30.92991065979004 31.5 29 31.5 Z"
            />
            <path
              class="e"
              d="M 4 1 C 2.345790863037109 1 1 2.345790863037109 1 4 L 1 28 C 1 29.65420913696289 2.345790863037109 31 4 31 L 29 31 C 30.65420913696289 31 32 29.65420913696289 32 28 L 32 4 C 32 2.345790863037109 30.65420913696289 1 29 1 L 4 1 M 4 0 L 29 0 C 31.20914077758789 0 33 1.790859222412109 33 4 L 33 28 C 33 30.20914077758789 31.20914077758789 32 29 32 L 4 32 C 1.790859222412109 32 0 30.20914077758789 0 28 L 0 4 C 0 1.790859222412109 1.790859222412109 0 4 0 Z"
            />
          </g>
          <path
            class="b"
            d="M1686.421,463.521l5.579-8,3.5-3.92,9.613-9.032"
            transform="translate(-1436 0.479)"
          />
          <path
            class="c"
            d="M1690.074,459.579a29.594,29.594,0,0,0,3.354,0c.452-.169,10.3-5.426,11.38-7.307a7.949,7.949,0,0,0,.508-1.222C1706.374,448.155,1708,440,1708,440s-13.853,3.886-16.488,8.618c-.029.052-1.983,3.324-2.156,3.654-2.412,4.478.719,7.307.719,7.307Z"
            transform="translate(-1436)"
          />
        </g>
      </svg>
    </div>
    <div class="buttonmessage-name">Crear mensage</div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.buttonmessage-icon .a {
  fill: #fff;
}
.buttonmessage-icon .b,
.buttonmessage-icon .c {
  fill: none;
  stroke: #fcb036;
}
.buttonmessage-icon.c {
  stroke-linejoin: round;
  stroke-width: 2px;
}
.buttonmessage-icon.d,
.buttonmessage-icon.e {
  stroke: none;
}
.buttonmessage-icon.e {
  fill: #fcb036;
}

.buttonmessage-layout {
  display: flex;
  align-items: center;
  width: 100%;
  background-color: #f1f1f1;
  padding: 0.5rem;
  border-radius: 8px;
  cursor: pointer;
}
.buttonmessage-layout:hover {
  background-color: #fcb036;
}
.buttonmessage-icon {
  width: 2rem;
  height: 2rem;
}
.buttonmessage-name {
  margin-left: 0.5rem;
}
</style>
