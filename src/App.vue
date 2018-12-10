<template>
  <div id="app">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <TopDisplay text="Team Name"></TopDisplay>
        </div>
        <div class="col-6">
          <!-- Empty in the center -->
        </div>
        <div class="col">
          <TopDisplay text="Day 0 / Hour 00"></TopDisplay>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TopDisplay from './components/TopDisplay.vue';

export default {
  name: 'app',
  components: {
    TopDisplay,
  },
};
</script>

<style>
body {
  margin: 0px;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  width: 1920px;
  height: 1080px;
  background-image: url('./assets/stars.jpg');
}
</style>
