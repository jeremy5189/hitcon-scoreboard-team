<template>
  <div id="LeftDisplay">
    <span>
      <h3>SERVICE: Web</h3>
      <h1>UP</h1>
    </span>
    <span>
      <h3>SERVICE: ERP</h3>
      <h1>UP</h1>
    </span>
    <span>
      <h3>SERVICE: SSLVPN</h3>
      <h1>UP</h1>
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
  margin-right: -25px;
  margin-left: 150px;
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
