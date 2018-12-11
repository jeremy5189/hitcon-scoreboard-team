<template>
  <div id="overlay" class="flashit"></div>
</template>

<script>
export default {
  name: 'Overlay',
};
</script>

<style scoped>
#overlay {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  z-index: 1000;
  background-color: #12F42C;
  opacity: 0.15;
}
/* Flash class and keyframe animation */
.flashit {
  -webkit-animation: flash linear 1s infinite;
  animation: flash linear 2s infinite;
}
@-webkit-keyframes flash {
  0% { opacity: .2; }
  50% { opacity: 0; }
  100% { opacity: .2; }
}
@keyframes flash {
  0% { opacity: .2; }
  50% { opacity: 0; }
  100% { opacity: .2; }
}
</style>
