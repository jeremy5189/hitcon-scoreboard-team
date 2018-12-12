<template>
  <div id="StaticText">
    <img src="../assets/hitcon-reverse.svg" alt="hitcon-defence-logo">
    <h2>SSID: {{ ssidMap[teamId] }} // PW: PASSWORD</h2>
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
        1: 'HITCON-DEFENCE',
        2: 'HITCON-DEFENCE',
        3: 'HITCON-DEFENCE',
        4: 'HITCON-DEFENCE',
        5: 'HITCON-DEFENCE',
        6: 'HITCON-DEFENCE',
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
