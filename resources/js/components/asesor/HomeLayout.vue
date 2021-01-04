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
      <div class="image-h">
        <div class="background"></div>
      </div>
    </div>
    <div class="col-8"><Anuncio @updateuserdata="updateuser" /></div>
  </div>
</template>

<script>
import Anuncio from "../Anuncio";
export default {
  components: {
    Anuncio,
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
.image-h {
  border-radius: 4px;
  overflow: hidden;
  height: 10.6875rem;
  margin-top: 1rem;
}
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
