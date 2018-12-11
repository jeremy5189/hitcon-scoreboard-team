<template>
  <div id="Chart">
    <div class="row">
      <div class="col-2 col-title">
        <h1>{{ title }}</h1>
      </div>
      <div class="col-8 col-center">
        <svg id="svgc">
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

let _c_data;
let _c_x;
let _c_y;
let _c_createPath;
let _c_svg;

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
  data() {
    return {
      //
    };
  },
  mounted() {
    const random = d3.randomNormal(50, 20);
    _c_data = Array.from({ length: 39 }, () => random()).concat(this.current_value);
    _c_x = d3.scaleLinear().domain([0, 40]).range([0, 1256]);
    _c_y = d3.scaleLinear().domain([0, 100]).range([125, 0]);

    _c_createPath = d3.line()
      .x((d, i) => _c_x(i))
      .y(d => _c_y(d));
    _c_svg = d3.select('#svgc')
      .append('g').append('path');

    _c_svg.datum(_c_data)
      .transition()
      .duration(1000)
      .ease(d3.easeLinear)
      .on('start', this.tick);
  },
  methods: {
    tick() {
      // Push a new data point onto the back.
      _c_data.push(this.current_value);

      // Redraw the line.
      _c_svg.attr('d', _c_createPath)
        .attr('transform', null);

      // Slide it to the left.
      d3.active(_c_svg.node())
        .attr('transform', `translate(${_c_x(-1)},0)`)
        .transition()
        .on('start', this.tick);

      // Pop the old data point off the front.
      _c_data.shift();
    },
  },
};
</script>

<style scoped>
#Chart {
  height: 125px;
}

#Chart svg {;
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
