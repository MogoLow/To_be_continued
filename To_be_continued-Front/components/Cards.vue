<template>
  <div class="container" v-if="dataset != ''">
    <div class="card" v-for="item in dataset" :key="item.dataset_id">
      <div class="card__image-container" v-if="item.images">
        <img class="card__image" :src="item.images.poster" alt="" />
      </div>
      <div class="info">
        <h3>
          <p>Créé en: {{ item.creation }}</p>
        </h3>
        <h3>
          <p>Durée: {{ item.length }}m</p>
        </h3>
        <h3>
          <p>Saisons: {{ item.seasons }}</p>
        </h3>
        <h3>
          <p>Épisode: {{ item.episodes }}</p>
        </h3>
        <h3>
          <p>langue: {{ item.language }}</p>
        </h3>
      </div>

      <svg class="card__svg" viewBox="0 0 800 500">
        <path
          d="M 0 100 Q 50 200 100 250 Q 250 400 350 300 C 400 250 550 150 650 300 Q 750 450 800 400 L 800 500 L 0 500"
          stroke="transparent"
          fill="#333"
        />
        <path
          class="card__line"
          d="M 0 100 Q 50 200 100 250 Q 250 400 350 300 C 400 250 550 150 650 300 Q 750 450 800 400"
          stroke="pink"
          stroke-width="3"
          fill="transparent"
        />
      </svg>

      <div class="card__content">
        <h1 class="card__title">{{ item.title }}</h1>
        <br />
        <p class="description"></p>
        <div class="bouton" @click="path('/One_series/' + item.id)">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          Plus
        </div>
        <div v-if="item.in_account">SUIVIE</div>
      </div>
    </div>
  </div>
</template>

<script>
// import { ref } from "vue";
export default {
  name: "",

  methods: {
    path(path) {
      this.$router.push({
        path: path,
      });
    },
  },
  data() {
    return {
      dataset: "",
      creation: "",
      images: "",
      seasons: "",
      title: "",
      episodes: "",
      language: "",
      length: "",
      genres: "",
      LocalData: {
        token: "",
      },
    };
  },
  mounted() {
    if (localStorage.getItem("user")) {
      this.LocalData = JSON.parse(localStorage.getItem("user"));
    }

    fetch("http://127.0.0.1:8000/series", {
      method: "POST",
      body: JSON.stringify({
        token: this.LocalData.token,
      }),
    })
      .then((response) => {
        return response.json();
      })
      .then((result) => {
        this.dataset = result.content.shows;
      });
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap");
.bouton {
  position: relative;
  display: inline-block;
  padding: 30px 61px;
  border-radius: 4px;
  color: #03e9f4;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  margin: 25px;
  margin-left: 100px;
  font-family: "Roboto", sans-serif;
  filter: hue-rotate(0deg);
  border: 2px solid #d2bdff;
  transition: all 0.1s linear;
}
.bouton:hover {
  border: 1px solid transparent;
}
.bouton:hover span {
  position: absolute;
  display: block;
}
.bouton:hover span:nth-child(1) {
  filter: hue-rotate(0deg);
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(90deg, transparent, #3a86ff);
  animation: animate1 1s linear infinite;
}
@keyframes animate1 {
  0% {
    left: -100%;
  }
  50%,
  100% {
    left: 100%;
  }
}
.bouton:hover span:nth-child(2) {
  filter: hue-rotate(60deg);
  top: -100%;
  right: 0;
  width: 3px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #3a86ff);
  animation: animate2 1s linear infinite;
  animation-delay: 0.25s;
}
@keyframes animate2 {
  0% {
    top: -100%;
  }
  50%,
  100% {
    top: 100%;
  }
}
.bouton:hover span:nth-child(3) {
  filter: hue-rotate(120deg);
  bottom: 0;
  right: 0;
  width: 100%;
  background: linear-gradient(270deg, transparent, #3a86ff);
  animation: animate3 1s linear infinite;
  animation-delay: 0.5s;
}
@keyframes animate3 {
  0% {
    right: -100%;
    height: 3px;
  }
  50%,
  100% {
    height: 2px;
    right: 100%;
  }
}
.bouton:hover span:nth-child(4) {
  filter: hue-rotate(300deg);
  bottom: -100%;
  left: 0;
  width: 3px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #3a86ff);
  animation: animate4 1s linear infinite;
  animation-delay: 0.75s;
}
@keyframes animate4 {
  0% {
    bottom: -100%;
  }
  50%,
  100% {
    bottom: 100%;
  }
}
.description {
  color: lightgray;
  padding: 10px;
  font-size: 18px;
}
.description:hover {
  padding: 10px;
  transition: 1.5s;
  color: white;
}
.info {
  position: absolute;
  margin-top: -400px;
  margin-left: 250px;
  font-size: 17px;
  padding: 20px;
}
img {
  height: 400px;
}

.container {
  display: grid;
  grid-template-columns: 2fr 2fr 2fr;
  margin: 30px;
  align-items: center;
  justify-content: center;
  margin-left: 100px;
}

.card {
  margin: 20px;
  position: relative;
  background: #333;
  width: 400px;
  height: 70vh;
  border-radius: 6px;
  padding: 2rem;
  color: rgb(255, 255, 255);
  box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.2), 0 0 1rem rgba(0, 0, 0, 0.2);
  overflow: hidden;
}
.card__image-container {
  margin: -2rem -2rem 1rem -2rem;
  background-size: cover;
}
.card__line {
  opacity: 0;
  animation: LineFadeIn 0.8s 0.8s forwards ease-in;
}
.card__image {
  opacity: 0;
  animation: ImageFadeIn 0.8s 1.4s forwards;
}
.card__title {
  font-family: "Bebas Neue", cursive;
  color: white;
  margin-top: 0;
  font-weight: 800;
  letter-spacing: 0.01em;
  padding: 5px;
  border-bottom: solid 2px #535480;
}
.card__content {
  margin-top: -1rem;
  opacity: 0;
  animation: ContentFadeIn 0.8s 1.6s forwards;
}
.card__svg {
  position: absolute;
  left: 0;
  top: 115px;
}

@keyframes LineFadeIn {
  0% {
    opacity: 0;
    d: path(
      "M 0 300 Q 0 300 0 300 Q 0 300 0 300 C 0 300 0 300 0 300 Q 0 300 0 300 "
    );
    stroke: #fff;
  }
  50% {
    opacity: 1;
    d: path(
      "M 0 300 Q 50 300 100 300 Q 250 300 350 300 C 350 300 500 300 650 300 Q 750 300 800 300"
    );
    stroke: #888bff;
  }
  100% {
    opacity: 1;
    d: path(
      "M -2 100 Q 50 200 100 250 Q 250 400 350 300 C 400 250 550 150 650 300 Q 750 450 802 400"
    );
    stroke: #545581;
  }
}
@keyframes ContentFadeIn {
  0% {
    transform: translateY(-1rem);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}
@keyframes ImageFadeIn {
  0% {
    transform: translate(-0.5rem, -0.5rem) scale(1.05);
    opacity: 0;
    filter: blur(2px);
  }
  50% {
    opacity: 1;
    filter: blur(2px);
  }
  100% {
    transform: translateY(0) scale(1);
    opacity: 1;
    filter: blur(0);
  }
}
</style>
