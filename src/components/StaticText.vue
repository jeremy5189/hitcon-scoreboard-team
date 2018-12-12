<template>
  <div id="StaticText">
    <img src="../assets/hitcon-reverse.svg" alt="hitcon-defence-logo">
    <h2>SSID: HITCON-DEFENCE / PW: PASSWORD</h2>
  </div>
</template>

<script>
export default {
  name: 'StaticText',
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
