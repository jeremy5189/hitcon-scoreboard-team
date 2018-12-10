<template>
  <div id="LeftDisplay">
    <h1>{{ text }}</h1>
    <h1>{{ text }}</h1>
    <h1>{{ text }}</h1>
  </div>
</template>

<script>
export default {
  name: 'LeftDisplay',
  props: {
    text: {
      type: String,
      default: '-'
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
  justify-content: center;
  align-content: center;
  height: 450px;
  margin-right: -25px;
  margin-left: 150px;
  flex-direction: column;
}
h1 {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  margin-bottom: 15px;
}
</style>
