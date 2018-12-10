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
      <div class="row middle-row">
        <div class="col">
          <LeftDisplay></LeftDisplay>
        </div>
        <div class="col-6">
          <!-- Empty in the center -->
        </div>
        <div class="col">
          <RightDisplay></RightDisplay>
        </div>
      </div>
      <div class="row bottom-row">
        <div class="col">
          <ChartDisplay></ChartDisplay>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TopDisplay from './components/TopDisplay.vue';
import LeftDisplay from './components/LeftDisplay.vue';
import RightDisplay from './components/RightDisplay.vue';
import ChartDisplay from './components/ChartDisplay.vue';

export default {
  name: 'app',
  components: {
    TopDisplay,
    LeftDisplay,
    RightDisplay,
    ChartDisplay,
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
  overflow: hidden;
}
.middle-row {
  margin-top: 90px;
}
.bottom-row .col {
  padding: 0px 0px;
}
</style>
