<template>
  <div id="app">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <TopDisplay :text="`Score ${server.score}`"></TopDisplay>
        </div>
        <div class="col-1"></div>
        <div class="col-4">
          <TopDisplay :text="server.teamname"></TopDisplay>
        </div>
        <div class="col-1"></div>
        <div class="col">
          <TopDisplay :text="`Day ${vtime.day} / Hour ${vtime.hour}`"></TopDisplay>
        </div>
      </div>
      <div class="row middle-row">
        <div class="col">
          <LeftDisplay></LeftDisplay>
        </div>
        <div class="col-6">
          <FlashAlert
            v-if_="(server.under_attack || server.ddos > 0) && server.alive_level > 0"
            v-if="false"
          ></FlashAlert>
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
    <Overlay v-if_="server.ddos > 0 && server.alive_level" v-if="false" > 0"></Overlay>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import TopDisplay from './components/TopDisplay.vue';
import LeftDisplay from './components/LeftDisplay.vue';
import RightDisplay from './components/RightDisplay.vue';
import ChartDisplay from './components/ChartDisplay.vue';
import FlashAlert from './components/FlashAlert.vue';
import Overlay from './components/Overlay.vue';
import config from './config';

export default {
  name: 'app',
  components: {
    TopDisplay,
    LeftDisplay,
    RightDisplay,
    ChartDisplay,
    FlashAlert,
    Overlay,
  },
  data() {
    return {
      vtimeHandle: null,
    };
  },
  created() {
    this.setTeamId('T1');
    this.fetchServerData(this.teamId);
    this.fetchVTime().then(() => {
      this.vtimeHandle = setInterval(() => {
        this.fetchVTime();
      }, config.fetchVTimeInterval);
    });
  },
  methods: {
    ...mapActions([
      'setTeamId',
      'fetchServerData',
      'fetchVTime',
    ]),
  },
  computed: {
    ...mapState([
      'server',
      'teamId',
      'vtime',
    ]),
  },
};
</script>

<style>
body {
  margin: 0px;
  overflow: hidden;
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
.middle-row .col-6 {
  display: flex;
  justify-content: center;
  align-items: center;
}
.bottom-row .col {
  padding: 0px 0px;
}
</style>
