<template>
  <div id="ChartDisplay">
    <div class="row">
      <div class="col">
        <Chart></Chart>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <Chart></Chart>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <Chart></Chart>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from './Chart.vue';

export default {
  name: 'ChartDisplay',
  components: {
    Chart,
  },
};
</script>

<style scoped>
#ChartDisplay {
  border: 4px solid #26dafd;
  background-color: rgba(0, 72, 110, 0.4);
  border-radius: 10px;

  margin-top: 90px;
  margin-bottom: 0px;
  height: 378px;
  flex-direction: column;
}
h1 {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  margin-bottom: 15px;
}
.col {
  border-bottom: 2px solid #a1ecfb;
  margin: 0 18px;
}
</style>
