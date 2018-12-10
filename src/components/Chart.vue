<template>
  <div id="Chart">
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10"></div>
      <div class="col-1"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Chart',
  props: {
    text: {
      type: String,
      default: '-',
    },
  },
};
</script>

<style scoped>
#Chart {
  height: 125px;
}
.col-10 {
  border-left: 2px solid #a1ecfb;
  border-right: 2px solid #a1ecfb;
  height: 125px;
}
</style>
