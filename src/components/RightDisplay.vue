<template>
  <div id="RightDisplay">
    <span>
      <h3>SERVICE: WEB</h3>
      <h1 :class="displayBoolean(server.alive_web)">
        {{ displayBoolean(server.alive_web) }}
      </h1>
    </span>
    <span>
      <h3>SERVICE: ERP</h3>
      <h1 :class="displayBoolean(true)">
        {{ displayBoolean(true) }}
      </h1>
    </span>
    <span>
      <h3>SERVICE: SSLVPN</h3>
      <h1 :class="displayBoolean(server.alive_sslvpn)">
        {{ displayBoolean(server.alive_sslvpn) }}
      </h1>
    </span>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'RightDisplay',
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
  },
  methods: {
    displayBoolean(bool) {
      return bool ? 'UP' : 'DOWN';
    },
  },
};
</script>

<style scoped>
#RightDisplay {
  border: 4px solid #26dafd;
  background-color: rgba(0, 72, 110, 0.4);
  border-radius: 10px;
  box-shadow: 0 0 8px #97d0de;

  display: flex;
  justify-content: space-around;
  align-content: center;
  height: 450px;
  margin-right: -25px;
  margin-left: 25px;
  padding: 20px 0 0 0;
  flex-direction: column;
}
span {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  text-align: center;
}
h1.DOWN {
  color: rgba(212, 5, 1, 0.8);
  text-shadow: 0 0 1.5px rgba(212, 5, 1, 0.8);
}
h1.UP {
  color: rgba(118, 191, 138, 0.8);
  text-shadow: 0 0 1.5px rgba(118, 191, 138, 0.8);
}
</style>
