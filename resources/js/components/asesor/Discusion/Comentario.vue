<template>
<div>
<div id="comments-list" class="comments-list" v-if="comentario.id">
 <div>
<div class="comment-main-level" v-if="comentario.parent == null">
    <!-- Avatar -->
 	<div class="tooltip"> 
  	<div class="comment-avatar" @click="replicar = !replicar">
	        <img class="bg-white" :src="comentario.image" />
	</div>
	  <span class="tooltiptext">Replicar comentario</span>
	</div> 
    <!-- Contenedor del Comentario -->
       <div class="comment-box">
		<div class="comment-head">
			<h6 class="comment-name by-author">
	                	<a href="javascript:void(0)">{{ comentario.usuarioName }}</a>
                  	</h6>
	                <span>{{ tiempo(comentario.created_at) }}</span>
                 	<i class="fa fa-reply"></i>
			<i class="fa fa-heart"></i>
                  	<div v-if="comentario.propiedad == 1">
		                <a href="javascript:void(0)" class="aside-link" @click="editarc(comentario)">Editar</a>
                  		<a href="javascript:void(0)" class="aside-link" @click="eliminarc(comentario.id)">Eliminar</a>
                	</div>
		</div>
        	<div class="comment-content" v-html="comentario.body"></div>
	</div>	
	<div v-for="(comentarioch, indexch) in comentario.childrens" :key="indexch"  class="childrens-c">		
		<Comentario :initialComentario="comentarioch" :initialEditable="initialEditable" @eliminarc="eliminarc"/>	
	</div>	

 </div>

<!-- Respuestas de los comentarios -->
<!--<ul class="comments-list reply-list" v-else>
	<li>-->
<ul class="comments-list reply-list" v-else>
<li>
        <!-- Avatar -->
	<div class="tooltip">
		<div class="comment-avatar" @click="replicar = !replicar">
			<img class="bg-white" :src="comentario.image" />
                </div>
	  <span class="tooltiptext">Replicar comentario</span>
	</div> 
	<!-- Contenedor del Comentario -->
                <div class="comment-box">
                  	<div class="comment-head">
                    		<h6 class="comment-name">
                      			<a href="javascript:void(0)">{{ comentario.usuarioName }}</a>
	                    	</h6>
	                	<span>{{ tiempo(comentario.created_at) }}</span>
	        	        <i class="fa fa-reply"></i>
        	        	<i class="fa fa-heart"></i>
                	    	<div v-if="comentario.user_id == initialEditable">
	                	      <a href="javascript:void(0)" class="aside-link" @click="editarc(comentario)">Editar</a>
	        	              <a href="javascript:void(0)" class="aside-link" @click="eliminarc(comentario.id)">Eliminar</a>
        	        	</div>
			</div>
                	<div class="comment-content" v-html="comentario.body"></div>
                </div>
		<div v-for="(comentarioch, indexch) in comentario.childrens" :key="indexch" class="childrens-c">		
			<Comentario :initialComentario="comentarioch" :initialEditable="initialEditable" @eliminarc="eliminarc"/>	
		</div>	
</li>
</ul>

<!--	</li>
 </ul>-->
	<FormComentarioUpdate v-if="updatecomentario" :show="updatecomentario" @close="cerrarupdate" />
	<div class="comments-comment" v-show="replicar">
		<FormComentario @crear-comentario="createcomentario" :parentc="comentario.id" :header="replicara"/>
	</div>

 </div>
</div>

</div>
</template>

<script>
import Comentario from "./Comentario";
import FormComentarioUpdate from "./FormComentarioUpdate";
import FormComentario from "./FormComentario";
export default {
	name: "Comentario",
	components:{
		Comentario,
		FormComentarioUpdate,
		FormComentario,
	},
	props: {
		initialComentario: Object,
		initialEditable: Number,
	},
	data(){
		return {
			comentario: this.initialComentario,
			updatecomentario: false,
			replicar: false,						
		};
	},
	computed: {
		curso() {
			return this.$store.getters.cursoview;
		},
		replicara() {
			return "Replicar a:  " + this.comentario.usuarioName;
		},
		dicus() {
			return this.$store.getters.discuview;
		},		
	},
	methods: {
		   createcomentario(comentario) {
		      if (comentario.id) {
		        this.comentario.childrens.push(comentario);
		        this.respuestas++;
		        this.$store.getters.discuview.answered++;
		        this.$store.commit("updatediscuss", this.$store.getters.discuview);
			this.replicar = false;
		      }
			
		 },
		tiempo(fecha) {
			let fecha1 = new Date(fecha);
		        let fecha2 = new Date();
		        let resta = fecha2.getTime() - fecha1.getTime();
		        return "hace " + Math.round(resta / (1000 * 60 * 60 * 24)) + " dias";
		},
		cerrarupdate(comentario) {
		      comentario.comentario.childrens = this.initialComentario.childrens;
		      if (comentario.comentario.id) {
		        this.comentario = comentario.comentario;
		      }
		      this.updatecomentario = comentario.cerrar;
		      this.$emit("close", { comentario: comentario, cerrar: false });
	    	},
		editarc(value) {
		      this.$store.commit("changecomentario", value);
		      this.updatecomentario = true;
		},
	    eliminarc(value) {
	      if(this.comentario.id == value){
		       const confirmacion = confirm(`Eliminar comentario`);
		      if (confirmacion) {
				this.comentario = {};
				this.$emit("eliminarc", value );
			}
		}else{		     
		        axios
	        	  .delete("/foro/" + this.curso.id + "/eliminarco/" + value)
		          .then((res) => {
				const index = this.comentario.childrens.findIndex(
		        	      (item) => item.id === value 
		        	);
				this.comentario.childrens.splice(index, 1);
  		      		this.$store.getters.discuview.answered--;
			        this.$store.commit("updatediscuss", this.$store.getters.discuview);
				flash("Comentario eliminado", "info");
		          })
		          .catch((error) => {
	        	    if (error.response.status === 401) {
		              window.location.href = "login";
		            }
	        	  });
		 }
	    },
	},
}
</script>

<style>
/** ====================
 * Lista de Comentarios
 =======================*/
.comments-list {
  position: relative;
}

/**
 * Lineas / Detalles
 -----------------------*/
.comments-list:before {
  content: "";
  width: 2px;
  height: 100%;
  background: #c7cacb;
  position: absolute;
  left: 32px;
  top: 0;
}

.comments-list:after {
  content: "";
  position: absolute;
  background: #c7cacb;
  bottom: 0;
  left: 27px;
  width: 7px;
  height: 7px;
  border: 3px solid #dee1e3;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
}

.reply-list:before,
.reply-list:after {
  display: none;
}
.reply-list li:before {
  content: "";
  width: 1rem;
  height: 2px;
  background: #c7cacb;
  position: absolute;
  top: 25px;
  left: -1rem;
}

.comments-list li {
  display: block;
  position: relative;
}

.comments-list li:after {
  content: "";
  display: block;
  clear: both;
  height: 0;
  width: 0;
}

.reply-list {
  padding-left: 3rem;
  clear: both;
  padding-top: 0.5rem;
}
/**
 * Avatar
 ---------------------------*/
.comments-list .comment-avatar {
  width: 65px;
  height: 65px;
  position: relative;
  float: left;
  border: 3px solid #fff;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.comments-list .comment-avatar img {
  width: 100%;
  height: 100%;
}

.reply-list .comment-avatar {
  width: 50px;
  height: 50px;
  cursor: pointer;	
}
 .reply-list .comment-avatar:hover {
	border:2px solid #03658c;
}
.comment-main-level .comment-avatar {
cursor:pointer;
}
.comment-main-level .comment-avatar:hover {
	border: 2px solid #03658c;
} 
.comment-main-level:after {
  content: "";
  width: 0;
  height: 0;
  display: block;
  clear: both;
}
/**
 * Caja del Comentario
 ---------------------------*/
.comments-list .comment-box {
  width: 85%;
  float: right;
  position: relative;
  -webkit-box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.075);
  -moz-box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.075);
  box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.075);
}

.comments-list .comment-box:before,
.comments-list .comment-box:after {
  content: "";
  height: 0;
  width: 0;
  position: absolute;
  display: block;
  border-width: 10px 12px 10px 0;
  border-style: solid;
  border-color: transparent #e0e0e2;
  top: 8px;
  left: -11px;
}

.comments-list .comment-box:before {
  border-width: 11px 13px 11px 0;
  border-color: transparent rgba(0, 0, 0, 0.05);
  left: -12px;
}

.reply-list .comment-box {
  width: 80%;
}
.comment-box .comment-head {
  background: #e0e0e2;
  padding: 10px 12px;
  border-bottom: 1px solid #e5e5e5;
  overflow: hidden;
  -webkit-border-radius: 4px 4px 0 0;
  -moz-border-radius: 4px 4px 0 0;
  border-radius: 4px 4px 0 0;
}

.comment-box .comment-head i {
  float: right;
  margin-left: 14px;
  position: relative;
  top: 2px;
  color: #a6a6a6;
  cursor: pointer;
  -webkit-transition: color 0.3s ease;
  -o-transition: color 0.3s ease;
  transition: color 0.3s ease;
}

.comment-box .comment-head i:hover {
  color: #03658c;
}

.comment-box .comment-name {
  color: #283035;
  font-size: 14px;
  font-weight: 700;
  float: left;
  margin-right: 10px;
}

.comment-box .comment-name a {
  color: #283035;
}

.comment-box .comment-head span {
  float: left;
  color: #999;
  font-size: 13px;
  position: relative;
  top: 1px;
}

.comment-box .comment-content {
  background: #f8f8f8;
  padding: 12px;
  font-size: 15px;
  color: #595959;
  -webkit-border-radius: 0 0 4px 4px;
  -moz-border-radius: 0 0 4px 4px;
  border-radius: 0 0 4px 4px;
}

.comment-box .comment-name.by-author,
.comment-box .comment-name.by-author a {
  color: #03658c;
}
.comment-box .comment-name.by-author:after {
  content: "O";
  background: #03658c;
  color: #fff;
  font-size: 12px;
  padding: 3px 5px;
  font-weight: 700;
  margin-left: 10px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}
.childrens-c {
 position:relative;
 float: left;
 width: 100%;
}
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
  left: 110%;
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility:visible;
}
/*arrot left*/
.tooltip .tooltiptext::after {
  content: " ";
  position: absolute;
  top: 50%;
  right: 100%; /* To the left of the tooltip */
  margin-top: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent black transparent transparent;
}
.comments-comment {
	padding-top: 1rem;
}
/** =====================
 * Responsive
 ========================*/
@media only screen and (max-width: 766px) {
  .comments-list .comment-box {
    width: 100%;
  }
  .reply-list .comment-box {
    width: 100%;
  }
  .reply-list {
    padding-left: 0;
  }
  .reply-list li::before {
    width: 0px;
  }
}
</style>
