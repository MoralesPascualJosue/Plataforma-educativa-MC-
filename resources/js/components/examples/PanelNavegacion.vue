<template>
<div>
<div class="sidebar-wrapper">    
    <h1>Invitado</h1>    
    <div class="header">
        <div class="photo">
            <img src="resources/logo/Logo comp white.svg" />
        </div>
        <div class="grey-rule w-hidden-small w-hidden-tiny"></div>
        <p class="site-description">
            <small>Miembro desde </small>
        </p>
        <div class="grey-rule w-hidden-small w-hidden-tiny"></div>

        <nav class="navigation">
            <a id="perfil-nav-a"
                class="nav-link name-u ">Nombre de usuario</a>
            <input type="hidden" id="perfil-input" value="">
            <a href="" class="nav-link log-out"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img src="resources/icons/log-out.svg" alt=""> Salir
            </a>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
            </form>
            <a id="home-nav-n" class="nav-link">Mis Actividades</a>
                <a id="home-nav-a" class="">Inicio</a>
                <a id="clases-nav-a" class="">Clases</a>
                <a class="nav-link" href="/">VER WEB </a>
                <div class="grey-rule w-hidden-small w-hidden-tiny"></div>
        </nav>

        <div class="social-link-group hide-on-medium">
            <a class="social-icon-link w-inline-block" href="#"><img
                    src="resources/social-redes/facebook-icon.svg"></a>
            <a class="social-icon-link w-inline-block" href="#"><img
                    src="resources/social-redes/instagram-icon.svg"></a>
            <a class="social-icon-link w-inline-block" href="#"><img
                    src="resources/social-redes/twitter-icon.svg"></a>
            <a class="social-icon-link w-inline-block" href="#"><img
                    src="resources/social-redes/linkedin-icon.svg"></a>
            <a class="social-icon-link w-inline-block" href="/contact"><img
                    src="resources/social-redes/correo-icon.svg"></a>
        </div>
    </div>
</div>
</div>
</template>
<script>
export default {
  data() {
    return {
      iconactividad: "../resources/icons/home-work-c.svg",
      iconprueba: "../resources/icons/test.svg",
    };
  },
  props: {
    activitie: Object,
  },
  computed: {
    ruta() {
      return "javascript:void(0)";
    },
  },
};
</script>
