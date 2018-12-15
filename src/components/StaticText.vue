<template>
  <div id="StaticText">
    <img v-show="!show_alert" id="logo"
      src="../assets/hitcon-reverse.svg" alt="hitcon-defence-logo">
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
  props: {
    show_alert: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    ...mapState([
      'teamId',
    ]),
  },
  data() {
    return {
      ssidMap: {
        1: ['Team1-Guest', '00001111'],
        2: ['Team2-Guest', '00001111'],
        3: ['Team3-Guest', '00001111'],
        4: ['Team4-Guest', '00001111'],
        5: ['Team5-Guest', '00001111'],
        6: ['Team6-Guest', '00001111'],
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
