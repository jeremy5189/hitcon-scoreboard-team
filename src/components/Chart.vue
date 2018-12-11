<template>
  <div id="Chart">
    <div class="row">
      <div class="col-2 col-title">
        <h1>{{ title }}</h1>
      </div>
      <div class="col-8 col-center">
        <svg>
          <svg:style>
            path {
              fill: none;
              stroke: #76BF8A;
              stroke-width: 3px;
            }
          </svg:style>
        </svg>
      </div>
      <div class="col-2 col-title">
        <h1>{{ current_value }} {{ unit }}</h1>
      </div>
    </div>
  </div>
</template>

<script>
import * as d3 from 'd3';

let that;
let data;
let x;
let y;
let createPath;
let svg;

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
  mounted() {
    that = this;
    const random = d3.randomNormal(50, 20);
    data = Array.from({ length: 39 }, () => random()).concat(this.current_value);
    x = d3.scaleLinear().domain([0, 40]).range([0, 1256]);
    y = d3.scaleLinear().domain([0, 100]).range([125, 0]);

    createPath = d3.line()
      .x((d, i) => x(i))
      .y(d => y(d));
    svg = d3.select('svg')
      .append('g').append('path');

    svg.datum(data)
      .transition()
      .duration(1000)
      .ease(d3.easeLinear)
      .on('start', tick);
  },
};

function tick() {
  // Push a new data point onto the back.
  data.push(that.current_value);

  // Redraw the line.
  svg.attr('d', createPath)
    .attr('transform', null);

  // Slide it to the left.
  d3.active(svg.node())
    .attr('transform', `translate(${x(-1)},0)`)
    .transition()
    .on('start', tick);

  // Pop the old data point off the front.
  data.shift();
}
</script>

<style scoped>
#Chart {
  height: 125px;
}

#Chart svg {
  width: 1256px;
  height: 100%;
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
