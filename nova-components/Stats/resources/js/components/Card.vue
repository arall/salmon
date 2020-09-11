<template>
  <card class="px-6 py-4">
    <h3 class="flex mb-3 text-base text-80 font-bold">
      {{ card.title }}

      <span class="ml-auto font-semibold text-70 text-sm"
        >Total: {{ card.current }}</span
      >
    </h3>

    <div class="overflow-hidden overflow-y-auto max-h-90px">
      <ul class="list-reset">
        <li
          v-for="item in formattedItems"
          class="text-xs text-80 leading-normal"
        >
          <span
            class="inline-block rounded-full w-2 h-2 mr-2"
            :style="{
              backgroundColor: item.color,
            }"
          />{{ item.label }} ({{ item.value }} - {{ item.percentage }}%)
        </li>
      </ul>
    </div>

    <center>
        <div
          ref="chart"
          :class="chartClasses"
          style="
            width: 90px;
            height: 90px;
          "
        />
    </center>
  </card>
</template>

<script>
import Chartist from 'chartist'
import 'chartist/dist/chartist.min.css'

export default {
  name: 'PartitionMetric',

  props: ['card'],

  data: () => ({ chartist: null }),

  mounted() {
    this.chartist = new Chartist.Pie(
      this.$refs.chart,
      this.formattedChartData,
      {
        donut: true,
        donutWidth: 10,
        donutSolid: true,
        startAngle: 0,
        showLabel: false,
      }
    )

    this.chartist.on('draw', context => {
      if (context.type === 'slice') {
        context.element.attr({
          style: `fill: ${context.meta.color} !important`,
        })
      }
    })
  },

  methods: {
    renderChart() {
      this.chartist.update(this.formattedChartData)
    },
  },

  computed: {
    chartClasses() {
      return [
        'rounded-b-lg',
        'ct-chart',
        'mr-4',
      ]
    },

    formattedChartData() {
      return { series: [
          {
              value: this.card.current,
              name: 'Current',
              meta: {
                  color: this.card.color,
              }
          },
          {
              value: this.card.total - this.card.current,
              name: 'Total',
              meta: {
                  color: 'grey',
              }
          }
      ] }
    },

  },
}
</script>
