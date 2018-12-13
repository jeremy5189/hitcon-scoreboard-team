<template>
  <div id="StaticText">
    <img src="../assets/hitcon-reverse.svg" alt="hitcon-defence-logo">
    <h2>SSID: {{ ssidMap[teamId][0] }} // PW: {{ ssidMap[teamId][1] }}</h2>
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
  color: rgba(161, 236, 251, 0.7);
  align-self: center;
  font-weight: 500;
  margin-bottom: 0px;
}
img {
  width: 200px;
  opacity: 0.7;
  margin-bottom: 30px;
  filter: drop-shadow(0 0 5px #eee);
}
</style>
