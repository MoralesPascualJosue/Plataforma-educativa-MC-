<template>
  <div class="row movil">
    <div class="col-4">
      <div class="info-user">
        <div class="container-top">
          <div class="avatar-container">
            <div class="avatari" id="avatarImage">
              <img :src="user.image" width="142px" />
            </div>
          </div>

          <div class="user-name-container">
            <span id="name-u">{{ user.name }}</span>
          </div>
          <div class="username-container">
            <span>{{ user.email }}</span>
          </div>
        </div>
      </div>
      <div>
        <Anuncio @updateuserdata="updateuser" />
      </div>
    </div>
    <div class="col-8">
      <Notificaciones />
    </div>
  </div>
</template>

<script>
import Anuncio from "../Anuncio";
import Notificaciones from "./Notificaciones";
export default {
  components: {
    Anuncio,
    Notificaciones,
  },
  data() {
    return {
      user: {
        name: "Default name",
        email: "default@email.com",
        image: "resources/users/user-default.svg",
      },
    };
  },
  methods: {
    updateuser(data) {
      this.user = data;
    },
  },
};
</script>

<style>
@media (max-width: 1050px) {
  .info-user {
    display: none;
  }
  .movil {
    display: inline;
    margin: inherit;
  }
  .movil div {
    padding-left: inherit;
    padding-right: inherit;
    max-width: inherit;
  }
}
</style>
