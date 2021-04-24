<template>
  <div class="home-layout">
    <div class="home-row-header">
      <div class="home-infouser">
        <div class="home-avatarcontainer">
          <img :src="user.image" />
        </div>
        <div class="home-userdetails">
          <h2>{{ user.name }}</h2>
          <span>{{ user.email }}</span>
        </div>
      </div>
      <div class="home-date">
        <div class="dia">{{ fecha }}</div>
      </div>
    </div>
    <div class="home-row-body">
      <div class="column-left"><Notificaciones /></div>
      <div><Anuncios @updateuserdata="updateuser" /></div>
    </div>
  </div>
</template>

<script>
import Notificaciones from "./Notificaciones";
import Anuncios from "../anuncio/Anuncios";
export default {
  components: {
    Notificaciones,
    Anuncios,
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
  computed: {
    fecha() {
      return new Date().toDateString();
    },
  },
  methods: {
    updateuser(data) {
      this.user = data;
      this.$emit("updateuserdata", data);
    },
  },
};
</script>

<style>
.home-layout {
  display: grid;
  grid-template-rows: 10% 90%;
  padding: 1rem;
  height: 100%;
}
.home-row-header {
  display: flex;
  height: 100%;
}
.home-infouser {
  height: 100%;
  width: 100%;
  background-color: #fcb036;
  border-radius: 20px;
  padding: 0.5rem;
  overflow: hidden;
}

.home-avatarcontainer {
  width: 3rem;
  height: 3rem;
  border-radius: 50%;
  float: left;
  overflow: hidden;
}

.home-avatarcontainer img {
  width: 100%;
  height: 100%;
}

.home-userdetails {
  padding-left: 5rem;
  max-width: 367px;
}

.home-userdetails h2 {
  font-weight: bold;
  font-size: 14px;
}

.home-imagehome {
  border-radius: 20px;
  overflow: hidden;
  height: 100%;
  border: 1px solid #fdc770;
}

.home-date {
  height: 6rem;
  font-size: 30px;
  text-align: end;
  color: white;
  width: 100%;
}

.home-row-body {
  display: grid;
  grid-template-columns: 25% 75%;
  grid-template-rows: 100%;
}

@media (max-width: 980px) {
  .home-layout {
    display: inherit;
  }
  .home-row-body {
    display: inherit;
  }
  .home-infouser {
    display: none;
  }
  .home-date {
    font-size: 18px;
    height: 2rem;
  }
  .home-imagehome {
    height: 3rem;
  }
  .home-row-header {
    display: none;
  }
  .home-row-body {
    height: 86%;
  }
  .column-left {
    display: none;
  }
}
</style>
