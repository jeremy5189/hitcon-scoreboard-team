<template>
  <div id="app">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <TopDisplay :text="`Score ${server.score}`"></TopDisplay>
        </div>
        <div class="col-1"></div>
        <div class="col-4">
          <TopDisplay :text="server.teamname" type="teamname"></TopDisplay>
        </div>
        <div class="col-1"></div>
        <div class="col">
          <TopDisplay
            :text="`Day ${vtime.day} / Hour ${vtime.hour < 10 ? `0${vtime.hour}` : vtime.hour}`"
          ></TopDisplay>
        </div>
      </div>
      <div class="row middle-row">
        <div class="col">
          <LeftDisplay></LeftDisplay>
        </div>
        <div class="col-7 col-center">
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
    this.setTeamId(teamId === null ? '1' : teamId);
    console.log('teamId', teamId);
    this.fetchServerData(this.teamId);
    this.vtimeHandle = setTimeout(this.fetchVTimeWrap, config.fetchVTimeInterval);
  },
  watch: {
    apiErrorCount: (val) => {
      console.log('apiErrorCount', val);
      if (val >= 3 && config.autoRedirect) {
        window.location.href = config.sponsorURL;
      }
    },
  },
  methods: {
    ...mapActions([
      'setTeamId',
      'fetchServerData',
      'fetchVTime',
    ]),
    fetchVTimeWrap() {
      this.fetchVTime();
      this.vtimeHandle = setTimeout(this.fetchVTimeWrap, config.fetchVTimeInterval);
    },
  },
  computed: {
    ...mapState([
      'server',
      'teamId',
      'vtime',
      'apiErrorCount',
    ]),
  },
};
</script>

<style>
@font-face {
  font-family: 'Orbitron Black';
  src: url('./assets/Orbitron Black.otf');
}

body {
  margin: 0px;
  overflow: hidden;
  cursor: none;
}
#app {
  font-family: 'Orbitron Black', 'Avenir', Helvetica, 'Microsoft JhengHei', Arial, sans-serif;
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
.middle-row .col-center {
  display: flex;
  justify-content: center;
  align-items: center;
}
.bottom-row .col {
  padding: 0px 0px;
}
h1 {
  font-size: 40px;
  text-shadow: 0 0 1.5px #97d0de;
}
h2, h3 {
  text-shadow: 0 0 1.5px #97d0de;
}
#LeftDisplay {
  box-shadow: 0 0 10px #97d0de;
}
</style>
