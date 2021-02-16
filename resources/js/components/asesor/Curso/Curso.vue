<template>
<div>
    <div v-if="curso.cover" class="curso-image"
      :style="{
        height: `${height}px`,
        backgroundImage: `url(${curso.cover})`,
      }" @click="openCurse"
    >
	    <span v-if="curso.entregas > 0" class="curso-status">
		 <img src="resources/icons/apilar.svg" alt=""/> 
		 <span class="curso-status-text">{{ curso.entregas }}</span>
	    </span>
    </div>
    
	<div v-if="show" class="curso-tabs-content" id="curso-tabs-content">  
		<TabsCurso @closetabs="closeCurse" />
	 </div>
   </div>
</div>
</template>

<script>
import TabsCurso from "./TabsCurso";
export default {
  components: {
    TabsCurso,
  },
  props: {
    curso: {
      type: Object,
    },
    height: {
      type: Number,
      default: 168,
    },
  },data(){
	return {
		show: false,
	};
  },methods: {
     openCurse(){
       this.show = true;
       this.$store.commit("changecurso", this.curso);
     },
    closeCurse(){
	this.show = false;
    },
  },
};
</script>
<style>
.curso-image {
  background-position: center;
  background-size: cover;
  height: 200px;
  cursor: pointer;
  overflow: hidden;
}
.curso-status {
  background-color: #fdc770;
  padding: 1rem;  
  line-height: 3rem;
}
.curso-status img {
  width: 1.5rem;
  height: 1.5rem;
}
.curso-tabs-content {
  position: fixed;
  left: 0;
  top: 0;
  padding: 1rem;
  animation-name: stretch;
  animation-duration: 0.5s; 
  animation-timing-function: ease-out; 
  animation-fill-mode: forwards;
}
@keyframes stretch {
  from {
    width:0%;
    height: 100%;
  }
 to {
    width: 100%;
    height: 100%;
  }
}
.curso-status-text {
 font-size: 14px;
}
</style>
