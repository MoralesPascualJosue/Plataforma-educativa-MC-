<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Registro</div>
      <div class="section-content">
        <div class="section-content-tittle">Registrarse</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Para crear una cuenta en la plataforma se ingresa al apartado de
            registro, en donde completando 3 sencillos pasos podras registrarte
            en la plataforma.
            <span> Para lo cual ingresa en el apartado de registro.</span>
            <br />
            <br />
            <a href="/register">Registrarse</a>
          </div>
          <div class="section-content-resource"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Registro paso 1</div>
        <div class="section-content-body">
          <div class="section-content-resource-registera"></div>
          <div class="section-content-description">
            Al ingresar al proceso de registro como primer paso se solicita un
            correo para poder identificar tu cuenta, y la creacion de una
            contraseña la cual servira para que ingreses a la plataforma.
            <br />
            <br />
            <p>Una vez llenado este formulario selecciona continuar.</p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Registro paso 2</div>
        <div class="section-content-body">
          <div class="section-content-resource-registerb"></div>
          <div class="section-content-description">
            Como segundo paso del proceso de registro se te pide que selecciones
            que tipo de cuenta deseas crear. Si deseas una cuenta como
            estudiante o como asesor.
            <br />
            <br />
            <p>Una vez selecionado el tipo de cuenta, puedes continuar.</p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Registro paso 3</div>
        <div class="section-content-body">
          <div class="section-content-resource-registerc"></div>
          <div class="section-content-description">
            El tercer paso del proceso de registro te solicita llenar un
            formulario, en el cual se solicitan algunos datos para poder
            identificarte.
            <br />
            <br />
            <p>
              Una vez llenado este formulario selecciona registrarme y si todos
              los datos son adecuados tu proceso de registro abra terminado .
            </p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Ejemplo de error</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Al concluir con exito tu registro se te direccionara automaticamente
            a tu pantalla de inicio, si algun dato no es adecuado se te
            solicitara que revises los datos que has ingresado.
            <br />
            <br />
            <p>
              Una vez en la pantalla de inicio, podras salir y volver a ingresar
              con la cuenta que has creado.
            </p>
          </div>
          <div class="section-content-resource-registerea"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.section-content-resource-registera {
  background-image: url("/resources/help/registro1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
}
.section-content-resource-registerb {
  background-image: url("/resources/help/registro2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
}
.section-content-resource-registerc {
  background-image: url("/resources/help/registro3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
}
.section-content-resource-registerea {
  background-image: url("/resources/help/error1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
}
</style>