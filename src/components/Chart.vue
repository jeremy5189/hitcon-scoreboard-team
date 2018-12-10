<template>
  <div id="Chart">
    <div class="row">
      <div class="col-2 col-title">
        <h1>{{ title }}</h1>
      </div>
      <div class="col-8 col-center"></div>
      <div class="col-2 col-title">
        <h1>{{ current_value }} {{ unit }}</h1>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Chart',
  props: {
    title: {
      type: String,
      default: '-',
    },
    current_value: {
      type: Number,
      default: 0,
    },
    unit: {
      type: String,
      default: '',
    },
  },
};
</script>

<style scoped>
#Chart {
  height: 125px;
}
.col-title {
  display: flex;
  justify-content: center;
  align-content: center;
}
.col-title h1 {
  color: #a1ecfb;
  align-self: center;
  font-weight: 500;
  text-align: center;
  margin-bottom: 0px;
}
.col-center {
  border-left: 2px solid #a1ecfb;
  border-right: 2px solid #a1ecfb;
  height: 125px;
}
</style>
