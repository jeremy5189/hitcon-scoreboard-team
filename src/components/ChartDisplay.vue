<template>
  <div id="ChartDisplay">
    <div class="row">
      <div class="col">
        <Chart
          title="BANDWIDTH"
          :current_value="server.bandwidth"
          unit="bps"
        ></Chart>
      </div>
    </div>
    <!--
    <div class="row">
      <div class="col">
        <Chart
          title="ENERGY"
          :current_value="server.energy"
          unit="kW"
        ></Chart>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <Chart
          title="WIFI CLIENT"
          :current_value="server.wifi"
          unit=""
        ></Chart>
      </div>
    </div>-->
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Chart from './Chart.vue';
import config from '../config';

export default {
  name: 'ChartDisplay',
  components: {
    Chart,
  },
  data() {
    return {
      handle: null,
    };
  },
  created() {
    this.handle = setInterval(() => {
      this.fetchServerData().then(() => {
        this.updateChart();
      });
    }, config.fetchInterval);
  },
  computed: {
    ...mapState([
      'server',
    ]),
  },
  methods: {
    ...mapActions([
      'fetchServerData',
    ]),
    updateChart() {
      //console.log('updateChart', this.server);
      // API return data in this.server
    },
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
