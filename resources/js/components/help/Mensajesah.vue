<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Mensajes</div>
      <div class="section-content">
        <div class="section-content-tittle">Mis mensajes</div>
        <div class="section-content-body">
          <div class="section-content-description">
            En la seccion de mensajes se listaran todos los mensajes creados
            divididos en dos categorias, recibido y enviados.
            <br />
            <br />
            <p>Al seleccionar un mensaje podras ingresar a ver su contenido.</p>
          </div>
          <div class="section-content-resourceama"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-body">
          <div class="section-content-resourceamb"></div>
          <div class="section-content-description">
            Dentro del mensaje podras revisar su contenido asi como algunos de
            talles de este.
            <br />
            <br />
            <p>También podras eliminarlo.</p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Crear mensaje</div>
        <div class="section-content-body">
          <div class="section-content-resourceamc"></div>
          <div class="section-content-description">
            Para crear un mensaje se debe seleccionar la opcion enviar mensaje,
            lo que desplegara un panel en donde se podra encribir el contenido y
            tambien elegir su destino.
            <br />
            <br />
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
.section-content-resourceama {
  background-image: url("/resources/help/mensajea1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceamb {
  background-image: url("/resources/help/mensajea2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceamc {
  background-image: url("/resources/help/mensajea3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>