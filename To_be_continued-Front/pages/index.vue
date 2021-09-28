<template>
  <div>
    <Sidebar :log="bool"/>
    <Cards />
    <!-- <Footer /> -->
  </div>
</template>

<script>
export default {
  name:"home",
  data(){
    return{
      bool:false
    }
  },
  mounted(){
          if (localStorage.getItem("user") != null) {
        this.bool = true;
      }

  }
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
}

body {
  background: radial-gradient(ellipse at bottom, #2360aa 0%, #0c0d13 100%);
  cursor: pointer;
}
</style>
