<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Foro</div>
      <div class="section-content">
        <div class="section-content-tittle">Mis temas</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Creando un tema de discusión se agregara a la lista de contenido del
            curso y podras ingresar a el seleccionandolo.
            <br />
            <br />
            <p>Al ingresar a un tema podras interactuar con sus opciones.</p>
          </div>
          <div class="section-content-resourceafa"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Crear tema</div>
        <div class="section-content-body">
          <div class="section-content-resourceafb"></div>
          <div class="section-content-description">
            Al momento de crear un tema podras darle una categoria, o crear una
            nueva.
            <br />
            <br />
            <p>Ingresando al tema tambien podras modificarlo o eliminarlo.</p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Tema</div>
        <div class="section-content-body">
          <div class="section-content-resourceafc"></div>
          <div class="section-content-description">
            Dentro del tema podras agregar comentarios de manera general.
            <br />
            <br />
            <p>
              O replicar algun comentario seleccionando la imagen que antecede a
              este.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.section-content-resourceafa {
  background-image: url("/resources/help/foroa1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceafb {
  background-image: url("/resources/help/foroa2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceafc {
  background-image: url("/resources/help/foroa3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>