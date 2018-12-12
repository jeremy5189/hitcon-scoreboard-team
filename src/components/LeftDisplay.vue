<template>
  <div id="LeftDisplay">
    <span>
      <h3>INCOMING ATTACK</h3>
      <h1 :class="server.under_attack ? 'warning' : 'normal'">
        {{ server.under_attack ? 'WARNING' : '-' }}
      </h1>
    </span>
    <span>
      <h3>INCOMING DDOS</h3>
      <h1>{{ ddosLevel }}</h1>
    </span>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'LeftDisplay',
  props: {
    text: {
      type: String,
      default: '-',
    },
  },
  computed: {
    ...mapState([
      'server',
    ]),
    ddosLevel() {
      let level;
      if (this.server.ddos <= 33) {
        level = 'LOW';
      } else if (this.server.ddos > 33 && this.server.ddos <= 66) {
        level = 'MEDIUM';
      } else {
        level = 'HIGH';
      }
      return level;
    },
  },
};
</script>

<style scoped>
#LeftDisplay {
  border: 4px solid #26dafd;
  background-color: rgba(0, 72, 110, 0.4);
  border-radius: 10px;
  box-shadow: 0 0 8px #97d0de;

  display: flex;
  justify-content: space-around;
  align-content: center;
  height: 450px;
  margin-left: -25px;
  margin-right: 25px;
  flex-direction: column;
  padding: 20px 0px;
  box-shadow: 0 0 10px #97d0de;
}
span {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  text-align: center;
}
h1.warning {
  color: rgba(212, 5, 1, 0.8);
  text-shadow: 0 0 1.5px rgba(212, 5, 1, 0.8);
}
</style>
