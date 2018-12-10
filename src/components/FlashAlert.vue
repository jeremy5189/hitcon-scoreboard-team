<template>
  <div id="FlashAlert" class="flashit ">
    <h1>{{ text }}</h1>
  </div>
</template>

<script>
export default {
  name: 'FlashAlert',
  created() {

  },
  props: {
    text: {
      type: String,
      default: 'WARNING: INCOMING ATTACK',
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
  align-content: center;
  width: 750px;
  height: 90px;
  flex-direction: column;
}
h1 {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  margin-bottom: 0px;
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
