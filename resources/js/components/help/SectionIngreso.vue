<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Ingreso</div>
      <div class="section-content">
        <div class="section-content-tittle">Ingresar</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Para acceder a la plataforma debes de estar previamente registrado
            <span> Para lo cual ingresa en el apartado de registro.</span>
            <br />
            <br />
            <a href="/register">Registrarse</a>
          </div>
          <div class="section-content-resourceia"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-body">          
          <div class="section-content-description">
            Si ya te encuentras registrado puede ingresar con tu usuario y
            contraseña.
            <br />
            <br />
            <p>Lo cual te llevara a tu pantalla de inicio</p>
          </div>
          <div class="section-content-resourcepi"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.section-content-resourceia {
  background-image: url("/resources/help/ingreso1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
}
.section-content-resourcepi {
  background-image: url("/resources/help/inicioe1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>