<template>
  <div id="FlashAlert" class="flashit">
    <h1>WARNING: INCOMING {{ attack_type }}</h1>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'FlashAlert',
  computed: {
    ...mapState([
      'server',
    ]),
    attack_type() {
      if (this.server.under_attack && this.server.ddos <= 0) {
        return 'ATTACK';
      }
      if (this.server.under_attack && this.server.ddos > 0) {
        return 'ATTACK & DDOS';
      }
      return 'DDOS';
    },
  },
};
</script>

<style scoped>
#FlashAlert {
  border: 4px solid #26dafd;
  background-color: rgba(212, 5, 1, 0.4);
  border-radius: 10px;

  display: flex;
  justify-content: center;
  align-items: center;
  height: 100px;
  flex-direction: column;
  padding: 5px 5px 5px 5px;
}
h1 {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  margin: 0px 30px 0px 30px;
  font-size: 45px;
  line-height: 45px;
}
/* Flash class and keyframe animation */
.flashit{
  -webkit-animation: flash linear 1s infinite;
  animation: flash linear 2s infinite;
}
@-webkit-keyframes flash {
  0% { opacity: 1; }
  50% { opacity: .1; }
  100% { opacity: 1; }
}
@keyframes flash {
  0% { opacity: 1; }
  50% { opacity: .1; }
  100% { opacity: 1; }
}
</style>
