<template>
  <div class="row">
    <div>
      <div
        class="banner"
        style="background-image: url('../resources/welcome1.jpg')"
      >
        <h2 class="banner-tittle">
          <span class="banner-ttitle-text">Maestría en contrucción</span>
        </h2>
      </div>

      <Anuncio />

      <div class>
        <div class="content-mensaje">
          <div class="content-img-mision">
            <img alt="Mision imagen" class="img-decoration" :src="image" />
          </div>
          <div>Misión</div>

          <span class="mensaje-texto">
            Formar recursos humanos de alto nivel profesional que logren
            proponer soluciones adecuadas y favorables a las necesidades que
            demanda la construcción de obras de infraestructura para el
            bienestar de nuestro Estado.
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Anuncio from "./Anuncio";
export default {
  components: {
    Anuncio,
  },
  data() {
    return {
      image: "../resources/img-msg100.jpg",
    };
  },
};
</script>

<style>
.img-decoration {
  width: 100%;
}

.banner {
  background-size: cover;
  padding-top: 0;
  width: 100%;
  height: 10rem;
}

.banner-tittle {
  padding-top: 8%;
  padding-left: 74%;
}

.banner-ttitle-text {
  color: #fff;
}
</style>
