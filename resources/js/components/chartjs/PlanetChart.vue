<template>
  <div class="col-12 p-5">
    <canvas width="1400" height="450" id="planet-chart"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js";
export default {
  name: "PlanetChart",
  data() {
    return {
      planetChartData: {
        type: "line",
        data: {
          labels:
            this.$store.getters["ADMIN_DASHBOARD/GET_ALUMNI_COUNT_BY_BATCH"]
              .labels,
          datasets: [
            {
              label: "Alumni",
              data: this.$store.getters[
                "ADMIN_DASHBOARD/GET_ALUMNI_COUNT_BY_BATCH"
              ].data,
              backgroundColor: "rgba(54,73,93,.5)",
              borderColor: "#36495d",
              borderWidth: 3,
            },
            {
              label: "Alumni ID",
              data: [],
              backgroundColor: "rgba(71, 183,132,.5)",
              borderColor: "#47b784",
              borderWidth: 3,
            },
          ],
        },
        options: {
          responsive: true,
          lineTension: 1,
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  padding: 25,
                },
              },
            ],
          },
        },
      },
    };
  },
  mounted() {
    const ctx = document.getElementById("planet-chart");
    new Chart(ctx, this.planetChartData);
  },
};
</script>
