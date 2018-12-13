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
        <h1>{{ this.displayed_value  }}</h1>
        <h3>{{ unit }}</h3>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import * as d3 from 'd3';

export default {
  name: 'Chart',
  props: {
    title: {
      type: String,
      default: '-',
    },
    col: {
      type: String,
      default: 'bandwidth',
    },
    current_value: {
      type: Number,
      default: 0,
    },
    displayed_value: {
      type: Number,
      default: 0,
    },
    unit: {
      type: String,
      default: '',
    },
  },
  computed: {
    ...mapState([
      'server',
    ]),
  },
  data() {
    return {
      domainMap: {
        BANDWIDTH: [0, 100],
        ENERGY: [0, 1.5],
        'WIFI CLIENT': [0, 50],
      },
      filterParamMap: {
        BANDWIDTH: {
          ratio: 0.000001, // bps to Mbps
          toFixed: 1,
          append: false,
        },
        ENERGY: {
          ratio: 0.01,
          toFixed: 3,
          append: true, // random a
        },
        'WIFI CLIENT': {
          ratio: 1,
          toFixed: 0,
          append: false,
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
    console.log(this.title, 'domain=', this.domainMap[this.title]);
    const random = d3.randomNormal(
      this.domainMap[this.title][1] / 2,
      this.domainMap[this.title][1] / 2,
    );

    this.stack = Array.from(
      { length: 100 },
      () => Math.max(0, Math.min(this.domainMap[this.title][1], parseInt(random(), Number))),
    ).concat(this.displayValue());

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
    calcDomain() {
      let lMin = Math.min(...this.stack), lMax = Math.max(...this.stack);
      let span = lMax - lMin;
      return [lMin-span*0.1, lMax+span*0.1];
    },
    displayValue() {
      let append = 0;

      if (this.filterParamMap[this.title].append) {
        append = Math.floor(Math.random() * 50) / (10 ** this.filterParamMap[this.title].toFixed);
      }
      this.displayed_value = (this.server[this.col] * this.filterParamMap[this.title].ratio + append)
        .toFixed(this.filterParamMap[this.title].toFixed);
      return this.displayed_value;
    },
    tick() {
      // Push a new data point onto the back.
      this.stack.push(this.displayValue());

      let x = d3.scaleLinear().domain([0, 100]).range([0, 1256]);
      let y = d3.scaleLinear().domain(this.calcDomain())
        .range([115, 0]);
      this.createPath = d3.line().x((d, i) => x(i)).y(d => y(d));

      // Redraw the line.
      this.path.attr('d', this.createPath)
        .attr('transform', null);

      // Slide it to the left.
      d3.active(this.path.node())
        .attr('transform', `translate(${x(-1)}, 0)`)
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
  display: inline-block;
}

.col-title h3 {
  color: #a1ecfb;
  font-size: 24px;
  align-self: center;
  font-weight: 400;
  text-align: center;
  margin-bottom: 0px;
  margin-left: 7px;
  display: inline-block;
}

.col-center {
  border-left: 2px solid #a1ecfb;
  border-right: 2px solid #a1ecfb;
  height: 125px;
}
h1 {
  font-size: 36px;
}
</style>
