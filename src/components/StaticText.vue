<template>
  <div id="StaticText">
    <img id="logo" src="../assets/hitcon-reverse.svg" alt="hitcon-defence-logo">
    <div class="row">
      <div class="col-3">
        <img src="../assets/wifi.svg" id="wifi">
      </div>
      <div class="col-9 flex">
        <span>
          <h2>{{ ssidMap[teamId][0] }}</h2>
          <h2>{{ ssidMap[teamId][1] }}</h2>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'StaticText',
  computed: {
    ...mapState([
      'teamId',
    ]),
  },
  data() {
    return {
      ssidMap: {
        1: ['Team1-Guest', '023939889'],
        2: ['Team2-Guest', '028825252'],
        3: ['Team3-Guest', '024121234'],
        4: ['Team4-Guest', '024128000'],
        5: ['Team5-Guest', '0800080365'],
        6: ['Team6-Guest', '40666888'],
      },
    };
  },
};
</script>

<style scoped>
#StaticText {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 850px;
  height: 90px;
  flex-direction: column;
}
h2 {
  color: rgba(161, 236, 251, 1);
  align-self: center;
  font-weight: 500;
  margin-bottom: 0px;
  margin-top: 6px;
  letter-spacing: 2px;
  font-family: 'Microsoft JhengHei', Arial, sans-serif;
}
span h2:first-child {
  margin-top: 10px;
}
#logo {
  width: 250px;
  opacity: 0.7;
  margin-bottom: 40px;
  filter: drop-shadow(0 0 5px #eee);
}
#wifi {
  opacity: 0.7;
  width: 90px;
}
.flex {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
