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
        <h1>{{ displayed_value }}</h1>
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
    unit: {
      type: String,
      default: '',
    },
  },
  computed: {
    ...mapState([
      'server',
      'prevBandwidth',
    ]),
  },
  data() {
    return {
      domainMap: {
        bandwidth: [0, 20],
        energy: [0, 8],
        wifi: [0, 10],
      },
      filterParamMap: {
        bandwidth: {
          ratio: 0.000001, // bps to Mbps
          toFixed: 1,
          append: false,
        },
        energy: {
          ratio: 0.1,
          toFixed: 2,
          append: true, // random a
        },
        wifi: {
          ratio: 1,
          toFixed: 0,
          append: false,
        },
      },
      stack: [],
      svg: null,
      main: null,
      path: null,
      createPath: null,
      displayed_value: null,
    };
  },
  mounted() {
    // Init
    this.displayed_value = this.displayValue(this.server[this.col]);

    const x = d3.scaleLinear().domain([0, 100]).range([0, 1256]);
    const y = d3.scaleLinear().domain(this.domainMap[this.col]).range([10, 0]);
    /* const random = d3.randomNormal(
      this.domainMap[this.col][1] / 3,
      this.domainMap[this.col][1] / 50,
    ); */

    this.stack = Array.from(
      { length: 100 },
      () => (0), // Math.max(0, Math.min(this.domainMap[this.col][1], random())),
    ).concat(this.displayValue(this.server[this.col]));

    this.svg = d3.select(this.$refs.graph);
    this.createPath = d3.line().x((d, i) => x(i)).y(d => y(d));
    this.main = this.svg.append('g');

    this.main.append('defs').append('clipPath')
      .attr('id', 'clip')
      .append('rect')
      .attr('width', 1256)
      .attr('height', 110);

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
    updateDisplayedValue() {
      if (this.server[this.col] <= 0 && this.col === 'bandwidth') {
        console.log('omitting bandwidth value!', this.server[this.col]);
      } else {
        console.log('updateDisplayedValue', this.server[this.col]);
        this.displayed_value = this.displayValue(this.server[this.col]);
      }
    },
    calcDomain(title) {
      const lMin = Math.min(...this.stack);
      const lMax = Math.max(...this.stack, this.domainMap[title][1]);
      const span = lMax - lMin;
      let go = [];

      if (span > 0) {
        go = [0, lMax + span * 0.1];
      } else {
        go = [0, lMax + 5];
      }

      console.log(this.col, 'domain=', go[0], go[1]);
      return go;
    },
    displayValue(val) {
      let append = 0;
      if (this.filterParamMap[this.col].append) {
        append = Math.floor((Math.random() - 0.5) * 20)
          / (10 ** this.filterParamMap[this.col].toFixed);
      }
      return (val * this.filterParamMap[this.col].ratio + append)
        .toFixed(this.filterParamMap[this.col].toFixed);
    },
    tick() {
      // Push a new data point onto the back.
      this.stack.push(this.displayValue(this.server[this.col]));

      const x = d3.scaleLinear().domain([0, 100]).range([0, 1256]);
      const y = d3.scaleLinear().domain(this.calcDomain(this.col))
        .range([(this.col === 'wifi') ? 103 : 108, 0]);
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
  height: 110px;
}

.col-title {
  display: flex;
  justify-content: center;
  align-content: center;
  padding-right: 3px;
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
  font-size: 32px;
  align-self: center;
  font-weight: 400;
  text-align: center;
  margin-bottom: -2px;
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
