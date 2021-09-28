<template>
  <div class="page">
    <div class="container">
      <div class="left">
        <div class="login">Login</div>
      </div>
      <div class="right">
        <form v-on:submit.prevent="login()" class="form">
          <div id="error">{{ error }}</div>
          <label for="login">Login</label>
          <input
            class="border_bot"
            id="login"
            type="login"
            name="login"
            v-model="input.login"
          />
          <label for="password">Mot de passe</label>
          <input
            class="border_bot"
            id="password"
            type="password"
            name="password"
            v-model="input.password"
          />
          <input
            input
            type="submit"
            id="submit"
            value="Submit"
            v-on:click="login()"
          />
        </form>
      </div>
    </div>
  </div>
</template>

<script>
// <button v-on:click="redirect('/')">Home</button>
export default {
  name: "Login",
  data() {
    return {
      input: {
        login: "",
        password: "",
      },
      error: "",
    };
  },
  methods: {
    login() {
      if (this.input.login != "" && this.input.password != "") {
        fetch("http://localhost:8000/auth/login", {
          method: "post",
          body: JSON.stringify({
            login: this.input.login,
            password: this.input.password,
          }),
        })
          .then((res) => res.json())
          .then((response) => {
            if (response.error) {
              this.error = response.error;
            } else {
              localStorage.setItem("user", response.user);
              this.$router.push({ path: "/" });
            }
          });
      } else {
        this.error = "Tu n'as pas oublier un truc ?";
      }
    },
    redirect($path) {
      this.$router.push({ path: $path });
    },
  },
};
</script>

<style scoped>
@import url("https://rsms.me/inter/inter-ui.css");
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");
::selection {
  background: #2d2f36;
}
::-webkit-selection {
  background: #2d2f36;
}
::-moz-selection {
  background: #2d2f36;
}
body {
  background: white;
  font-family: Montserrat, sans-serif;
  margin: 0;
  padding: 20px;
}
.page {
  font-family: Montserrat, sans-serif;

  display: flex;
  flex-direction: column;
  height: calc(100% - 40px);
  position: absolute;
  place-content: center;
  width: calc(100% - 40px);
}
@media (max-width: 767px) {
  .page {
    height: auto;
    margin-bottom: 20px;
    padding-bottom: 20px;
  }
}
.container {
  display: flex;
  height: 320px;
  margin: 0 auto;
  width: 640px;
}
@media (max-width: 767px) {
  .container {
    flex-direction: column;
    height: 630px;
    width: 320px;
  }
}
.left {
  background: #e2e2e5;
  height: calc(100% - 40px);
  top: 20px;
  position: relative;
  width: 50%;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
}
@media (max-width: 767px) {
  .left {
    height: 100%;
    left: 20px;
    width: calc(100% - 40px);
    max-height: 270px;
    border-top-right-radius: 20px;
  }
}

.login {
  font-size: 5em;
  font-weight: 900;
  margin: 50px 40px 40px;
}
.eula {
  color: #999;
  font-size: 14px;
  line-height: 1.5;
  margin: 40px;
}
.right {
  background: #474a59;
  box-shadow: 0px 0px 40px 16px rgba(0, 0, 0, 0.22);
  color: #f1f1f2;
  position: relative;
  width: 50%;
  border-radius: 20px;
}
@media (max-width: 767px) {
  .right {
    flex-shrink: 0;
    height: 100%;
    width: 100%;
    max-height: 350px;
  }
}
.form {
  margin: 40px;
  position: absolute;
}
label {
  color: #c2c2c5;
  display: block;
  font-size: 14px;
  height: 16px;
  margin-top: 20px;
  margin-bottom: 5px;
}
input {
  background: transparent;
  border: 0;
  color: #f2f2f2;
  font-size: 20px;
  height: 30px;
  line-height: 30px;

  outline: none !important;
  width: 100%;
}
.border_bot {
  background: linear-gradient(45deg, #837e7f, #0b1f53);
  border-radius: 20px;
}
#submit {
  color: var(--inv);
  margin: 40px;
  transition: color 300ms;
  width: 75%;
  border-radius: 30px;
  cursor: pointer;
  transition: 0.5s;
}

#submit:hover {
  color: var(--def);
  box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
  transform: translateY(-2px);
  background: linear-gradient(45deg, #837e7f, #0b1f53);
}
#submit:active {
  transition: 0.25s;
  box-shadow: rgb(85, 91, 255) 0px 0px 0px 3px, rgb(31, 193, 27) 0px 0px 0px 6px,
    rgb(255, 217, 19) 0px 0px 0px 9px, rgb(255, 156, 85) 0px 0px 0px 12px,
    rgb(255, 85, 85) 0px 0px 0px 15px;
  background: linear-gradient(45deg, #504c4d, #071435);
  transform: translateZ(2px);
}
#error {
  height: 10px;
  width: 100%;
  position: relative;
  text-align: center;
  color: red;
  text-transform: uppercase;
}
</style>

