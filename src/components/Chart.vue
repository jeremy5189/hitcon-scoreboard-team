<template>
  <div id="Chart">
    <div class="row">
      <div class="col-2 col-title">
        <h1>{{ title }}</h1>
      </div>
      <div class="col-8 col-center">
        <svg ref="graph">
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
        <h1>{{ displayValue }}</h1>
        <h3>{{ unit }}</h3>
      </div>
    </div>
  </div>
</template>

<script>
import * as d3 from 'd3';

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
  computed: {
    displayValue() {
      return (this.current_value * this.filterParamMap[this.title].ratio)
        .toFixed(this.filterParamMap[this.title].toFixed);
    },
  },
  data() {
    return {
      domainMap: {
        BANDWIDTH: [0, 1000],
        ENERGY: [0, 100],
        'WIFI CLIENT': [0, 50],
      },
      filterParamMap: {
        BANDWIDTH: {
          ratio: 1,
          toFixed: 0,
        },
        ENERGY: {
          ratio: 0.1,
          toFixed: 2,
        },
        'WIFI CLIENT': {
          ratio: 1,
          toFixed: 0,
        },
      },
      stack: [],
      svg: null,
      main: null,
      path: null,
      x: null,
      y: null,
      createPath: null,
    };
  },
  mounted() {
    this.x = d3.scaleLinear().domain([0, 100]).range([0, 1256]);
    this.y = d3.scaleLinear().domain(this.domainMap[this.title]).range([115, 0]);
    console.log(this.title, 'domain=', this.domainMap);
    const random = d3.randomNormal(
      this.domainMap[this.title][1] / 2,
      this.domainMap[this.title][1] / 2,
    );

    this.stack = Array.from(
      { length: 100 },
      () => Math.max(0, Math.min(this.domainMap[this.title][1], parseInt(random(), Number))),
    ).concat(this.displayValue);

    this.svg = d3.select(this.$refs.graph);
    this.createPath = d3.line().x((d, i) => this.x(i)).y(d => this.y(d));
    this.main = this.svg.append('g');

    this.main.append('defs').append('clipPath')
      .attr('id', 'clip')
      .append('rect')
      .attr('width', 1256)
      .attr('height', 115);

    this.path = this.main.append('g')
      .attr('clip-path', 'url(#clip)')
      .append('path');

    this.path
      .datum(this.stack)
      .transition()
      .duration(1000)
      .ease(d3.easeLinear)
      .on('start', this.tick);

    this.path.attr('transform', 'translate(1000, 0)');
  },
  methods: {
    tick() {
      // Push a new data point onto the back.
      this.stack.push(this.displayValue);

      // Redraw the line.
      this.path.attr('d', this.createPath)
        .attr('transform', null);

      // Slide it to the left.
      d3.active(this.path.node())
        .attr('transform', `translate(${this.x(-1)}, 0)`)
        .transition()
        .on('start', this.tick);

      // Pop the old data point off the front.
      this.stack.shift();
    },
  },
};
</script>

<style scoped>
#Chart {
  height: 125px;
}
.col-center {
  display: flex;
  justify-content: center;
  align-items: center;
}
#Chart svg {
  width: 1256px;
  height: 115px;
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

.col-title h3 {
  color: #a1ecfb;
  align-self: center;
  font-weight: 400;
  text-align: center;
  margin-bottom: 0px;
  margin-left: 7px;
}

.col-center {
  border-left: 2px solid #a1ecfb;
  border-right: 2px solid #a1ecfb;
  height: 125px;
}
</style>
