<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Inicio</div>
      <div class="section-content">
        <div class="section-content-tittle">Pantalla de inicio</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Al ingresar a la plataforma se te direcciona a la pagina de inicio
            donde se encuentra el panel de navegacion y el de avisos.
            <br />
            <br />
            <p>
              Donde podras visualizar los avisos recientes y navegar hacia otra
              sección.
            </p>
          </div>
          <div class="section-content-resourceai"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-body">
          <div class="section-content-resourceain"></div>
          <div class="section-content-description">
            Puedes navegar entre los avisos mediate sus botones de navegación.
            <br />
            <br />
            <p>O desplazarte mediante su acceso rapido de la izquierda.</p>
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
.section-content-resourceai {
  background-image: url("/resources/help/inicioa.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceain {
  background-image: url("/resources/help/inicioain.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>