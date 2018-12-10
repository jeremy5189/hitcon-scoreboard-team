<template>
  <div id="TopDisplay">
    <h1>{{ text }}</h1>
  </div>
</template>

<script>
export default {
  name: 'TopDisplay',
  props: {
    text: {
      type: String,
      default: '-',
    },
  },
};
</script>

<style scoped>
#TopDisplay {
  border: 4px solid #26dafd;
  background-color: rgba(0, 72, 110, 0.4);
  border-radius: 10px;

  border-top: none;
  display: flex;
  justify-content: center;
  align-content: center;
  height: 90px;
  margin-top: -10px;
  margin-left: 10px;
  margin-right: 10px;
}
h1 {
  color: #a1ecfb;
  align-self: flex-end;
  font-weight: 500;
  margin-bottom: 15px;
}
</style>
