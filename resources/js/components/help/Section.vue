<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Comenzando</div>
      <div class="section-content">
        <div class="section-content-tittle">Pantalla de bienvenida</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Para ingresar a la plataforma primero debes crear una cuenta.
            <span> Para lo cual ingresa en la opción de registro.</span>
            <br />
            <br />
            <a href="/register">Registrarse</a>
          </div>
          <div class="section-content-resource"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-body">
          <div class="section-content-description">
            Si ya te encuentras registrado y posees una cuenta, puedes acceder.
            <span> Para lo cual ingresa en la opción de ingreso.</span>
            <br />
            <br />
            <a href="/login">Ingresar</a>
          </div>
          <div class="section-content-resourceia"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.section-container {
  position: relative;
  padding: 0.5rem;
}
.section-layout {
  display: block;
}
.section-tittle {
  padding: 1rem;
  font-size: 2rem;
}
.section-content {
  padding: 1rem;
  height: 24rem;
  width: 100%;
}

.section-content-tittle {
  color: #797373;
  font-size: xx-large;
}
.section-content-body {
  display: flex;
  flex-direction: row;
  justify-content: center;
}
.section-content-description {
  width: 30%;
  text-align: justify;
  padding: 0.5rem;
}
.section-content-description a {
  padding: 0.5rem;
}
.section-content-description p {
  color: #797373;
}
.section-content-resource {
  background-image: url("/resources/help/presentacion.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
}
.section-content-resourceia {
  background-image: url("/resources/help/ingresar.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
}

@media (max-width: 1024px) {
  .section-content {
    height: inherit;
  }
  .section-content-body {
    flex-direction: column;
    align-items: center;
  }
  .section-content-body div {
    width: 85%;
  }
}
</style>