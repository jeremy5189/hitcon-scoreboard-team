<template>
  <div id="ChartDisplay">
    <div class="row">
      <div class="col col-border">
        <Chart
          title="BANDWIDTH"
          :current_value="server.bandwidth"
          col="bandwidth"
          unit="Mbps"
          ref="bandwidth_chart"
        ></Chart>
      </div>
    </div>
    <div class="row">
      <div class="col col-border">
        <Chart
          title="ENERGY"
          :current_value="server.energy"
          col="energy"
          unit="A"
          ref="energy_chart"
        ></Chart>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <Chart
          title="WIFI CLIENT"
          :current_value="server.wifi"
          col="wifi"
          unit="DEVICES"
          ref="wifi_chart"
        ></Chart>
      </div>
    </div>
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
    this.handle = setTimeout(this.polling, config.fetchInterval);
  },
  computed: {
    ...mapState([
      'server',
      'teamId',
    ]),
  },
  methods: {
    ...mapActions([
      'fetchServerData',
    ]),
    polling() {
      this.fetchServerData(this.teamId).then(() => {
        this.updateChart();
        this.handle = setTimeout(this.polling, config.fetchInterval);
      });
    },
    updateChart() {
      // API return data in this.server
      this.$refs.bandwidth_chart.updateDisplayedValue();
      this.$refs.energy_chart.updateDisplayedValue();
      this.$refs.wifi_chart.updateDisplayedValue();
    },
  },
};
</script>

<style scoped>
#ChartDisplay {
  border: 4px solid #26dafd;
  background-color: rgba(0, 72, 110, 0.4);
  margin-top: 81px;
  margin-bottom: 0px;
  height: 382px;
  flex-direction: column;
}
h1 {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  margin-bottom: 15px;
}
.col {
  margin: 0 18px;
}
.col-border {
  border-bottom: 2px solid #a1ecfb;
}
</style>
