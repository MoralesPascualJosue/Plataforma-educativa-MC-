<template>
  <div
    class="messageitem-layout"
    v-bind:class="{ 'messageitem-layout-read': news }"
  >
    <div class="messageitem-left">
      <div class="messageitem-icon">
        <svg viewBox="0 0 33 32">
          <g transform="translate(-244 -489)">
            <g class="a" transform="translate(244 489)">
              <path
                class="c"
                d="M 30 31.5 L 3 31.5 C 1.621500015258789 31.5 0.5 30.37849998474121 0.5 29 L 0.5 3 C 0.5 1.621500015258789 1.621500015258789 0.5 3 0.5 L 30 0.5 C 31.37849998474121 0.5 32.5 1.621500015258789 32.5 3 L 32.5 29 C 32.5 30.37849998474121 31.37849998474121 31.5 30 31.5 Z"
              />
              <path
                class="d"
                d="M 3 1 C 1.897199630737305 1 1 1.897199630737305 1 3 L 1 29 C 1 30.1028003692627 1.897199630737305 31 3 31 L 30 31 C 31.1028003692627 31 32 30.1028003692627 32 29 L 32 3 C 32 1.897199630737305 31.1028003692627 1 30 1 L 3 1 M 3 0 L 30 0 C 31.65685081481934 0 33 1.3431396484375 33 3 L 33 29 C 33 30.65685081481934 31.65685081481934 32 30 32 L 3 32 C 1.3431396484375 32 0 30.65685081481934 0 29 L 0 3 C 0 1.3431396484375 1.3431396484375 0 3 0 Z"
              />
            </g>
            <path
              class="b"
              d="M1692,496l14.6,9.7L1692,515.31Z"
              transform="translate(-1436)"
            />
          </g>
        </svg>
      </div>
      <img :src="mensaje.user.image" alt="userimage" />
      <div class="messageitem-details">
        <div class="messageitem-details-username">{{ mensaje.user.name }}</div>
        <div class="messageitem-details-matter">{{ mensaje.asunto }}</div>
      </div>
    </div>
    <div
      class="messageitem-date"
      v-bind:class="{ 'messageitem-date-news-p': !news }"
    >
      {{ mensaje.created_at }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    mensaje: {
      typeof: Object,
      default() {
        return {
          asunto: "Default asunto",
          user: {
            name: "Default name",
            image: "resources/users/user-default.svg",
          },
          crated_at: "Hoy",
          pivot: {
            news: 0,
          },
        };
      },
    },
  },
  computed: {
    news() {
      if (!this.mensaje.pivot) {
        return true;
      } else {
        return this.mensaje.pivot.news == 0;
      }
    },
  },
};
</script>

<style>
.messageitem-icon {
  width: 2rem;
  height: 1rem;
  opacity: 0;
  margin-right: 0.5rem;
}
.messageitem-icon .a {
  fill: none;
}
.messageitem-icon .b {
  fill: #fcb036;
  stroke: #fcb036;
}
.messageitem-icon .c,
.messageitem-icon .d {
  stroke: none;
}
.messageitem-icon .d {
  fill: none;
}

.messageitem-layout {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1rem 1rem 1rem;
  background-color: #f1f1f1;
  cursor: pointer;
  font-weight: bold;
}
.messageitem-layout-read {
  font-weight: normal;
}
.messageitem-layout:hover {
  box-shadow: inset 0px -4px 10px 0px rgb(0 0 0 / 10%),
    0px -2px 0px 0px rgb(0 0 0 / 10%);
}
.messageitem-layout:hover .messageitem-icon {
  opacity: 1;
}

.messageitem-left {
  display: flex;
  align-items: center;
}

.messageitem-left img {
  width: 3rem;
  height: 3rem;
  border-radius: 50%;
  background-color: #fff;
}
.messageitem-details {
  padding-left: 0.5rem;
  width: 100%;
}
.messageitem-details-username {
  font-size: 16px;
}
.messageitem-details-matter {
  font-size: 14px;
}
.messageitem-date-news-p {
  position: relative;
}
.messageitem-date-news-p:before {
  content: "";
  position: absolute;
  background: #84b145;
  bottom: 21%;
  left: -20px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
}
</style>
