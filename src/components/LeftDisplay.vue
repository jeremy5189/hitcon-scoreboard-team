<template>
  <div id="LeftDisplay">
    <span>
      <h3>INCOMING ATTACK</h3>
      <h1>WARNING</h1>
    </span>
    <span>
      <h3>INCOMING DDOS</h3>
      <h1>100</h1>
    </span>
  </div>
</template>

<script>
export default {
  name: 'LeftDisplay',
  props: {
    text: {
      type: String,
      default: '-',
    },
  },
};
</script>

<style scoped>
#LeftDisplay {
  border: 4px solid #26dafd;
  background-color: rgba(0, 72, 110, 0.4);
  border-radius: 10px;

  display: flex;
  justify-content: space-around;
  align-content: center;
  height: 450px;
  margin-left: -25px;
  margin-right: 150px;
  flex-direction: column;
  padding: 20px 0px;
}
span {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  text-align: center;
}
</style>
