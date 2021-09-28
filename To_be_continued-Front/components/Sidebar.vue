<template>
  <div class="page">
    <header tabindex="0" class="titre"><h1>TO BE CONTINUED...</h1></header>
    <div id="nav-container">
      <div class="bg"></div>
      <div class="button" tabindex="0">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </div>
      <div id="nav-content" tabindex="0">
        <ul class="list">
          <li><a href="/">Home</a></li>
          <li><a href="/recherche">Rechercher</a></li>

          <li v-if="log">
            <a href="/profil">Profils</a>
          </li>
          <li v-else><a href="/login">Login</a></li>
          <li v-if="log"><a @click="logout()">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Sidebar",
  props:['log'],
    data() {
      return {
        condition: false,
      };
    },
    mount() {
      if (localStorage.getItem("user") != null) {
        this.condition = true;
      }
    },
    updated(){

    },
  methods: {
    logout() {
      if (localStorage.clear("user") != null);
      this.condition = true;
              window.location.reload();
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css?family=Encode+Sans+Condensed:400,600");
@import url("https://fonts.googleapis.com/css2?family=Anton&display=swap");

* {
  outline: none;
}
.titre {
  font-family: "Anton", sans-serif;
}
strong {
  font-weight: 600;
}

.page {
  width: 100%;
  height: 100px;
  font-family: "Encode Sans Condensed", sans-serif;
  font-weight: 600;
  letter-spacing: 0.03em;
  color: #212121;
  cursor: pointer;
}

header {
  z-index: 200;
  display: flex;
  position: fixed;
  width: 100%;
  height: 70px;
  background: #000000;
  color: #fff;
  justify-content: center;
  align-items: center;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

main {
  padding: 70px 20px 0;
  display: flex;
  flex-direction: column;
  height: 100%;
}

main > div {
  margin: auto;
  max-width: 600px;
}

main p {
  line-height: 1.5;
  font-weight: 200;
  margin: 20px 0;
}

main small {
  font-weight: 300;
  color: #888;
}

#nav-container {
  position: fixed;
  height: 100vh;
  width: 100%;
  pointer-events: none;
  z-index: 999;
}
#nav-container .bg {
  position: absolute;
  top: 70px;
  left: 0;
  width: 100%;
  height: calc(100% - 70px);
  visibility: hidden;
  opacity: 0;
  transition: 0.3s;
  background: #000;
}
#nav-container:focus-within .bg {
  visibility: visible;
  opacity: 0.6;
}
#nav-container * {
  visibility: visible;
}

.button {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  z-index: 1;
  -webkit-appearance: none;
  border: 0;
  background: transparent;
  border-radius: 0;
  height: 70px;
  width: 30px;
  cursor: pointer;
  pointer-events: auto;
  margin-left: 25px;
  touch-action: manipulation;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
.icon-bar {
  display: block;
  width: 100%;
  height: 3px;
  background: #aaa;
  transition: 0.3s;
}
.icon-bar + .icon-bar {
  margin-top: 5px;
}

#nav-container:focus-within .button {
  pointer-events: none;
}
#nav-container:focus-within .icon-bar:nth-of-type(1) {
  transform: translate3d(0, 8px, 0) rotate(45deg);
}
#nav-container:focus-within .icon-bar:nth-of-type(2) {
  opacity: 0;
}
#nav-container:focus-within .icon-bar:nth-of-type(3) {
  transform: translate3d(0, -8px, 0) rotate(-45deg);
}

#nav-content {
  margin-top: 70px;
  padding: 20px;
  width: 90%;
  max-width: 300px;
  position: absolute;
  top: 0;
  left: 0;
  height: calc(100% - 70px);
  background: #0d131d;
  pointer-events: auto;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  transform: translateX(-100%);
  transition: transform 0.3s;
  will-change: transform;
  contain: paint;
}

#nav-content ul {
  text-decoration: none;
  height: 100%;
  display: flex;
  flex-direction: column;
  list-style: none;
}

#nav-content ul li a {
  text-decoration: none;
  padding: 50px 5px;
  display: block;
  text-transform: uppercase;
  transition: color 0.1s;
  color: #fff;
  border-bottom: solid 1px #535480;
}

#nav-content li a:hover {
  color: #535480;
}

#nav-content li:not(.small) + .small {
  margin-top: auto;
}

.small {
  display: flex;
  align-self: center;
}

.small a {
  font-size: 12px;
  font-weight: 400;
  color: #888;
}
.small a + a {
  margin-left: 15px;
}

#nav-container:focus-within #nav-content {
  transform: none;
}
</style>
