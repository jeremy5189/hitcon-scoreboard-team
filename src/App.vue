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
            v-if="(server.under_attack || server.ddos > 0) && server.alive_level > 0"
          ></FlashAlert>
          <StaticText v-else></StaticText>
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
    <Overlay v-if="server.ddos > 0 && server.alive_level > 0"></Overlay>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import TopDisplay from './components/TopDisplay.vue';
import LeftDisplay from './components/LeftDisplay.vue';
import RightDisplay from './components/RightDisplay.vue';
import ChartDisplay from './components/ChartDisplay.vue';
import FlashAlert from './components/FlashAlert.vue';
import StaticText from './components/StaticText.vue';
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
    StaticText,
  },
  data() {
    return {
      vtimeHandle: null,
    };
  },
  created() {
    const urlParams = new URLSearchParams(window.location.search);
    const teamId = urlParams.get('team_id');
    console.log('?teamId=', teamId);
    this.setTeamId(teamId === null ? '1' : teamId);
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
  font-family: 'Avenir', Helvetica, 'Microsoft JhengHei', Arial, sans-serif;
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
