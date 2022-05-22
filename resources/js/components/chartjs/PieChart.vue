<template>
	<div class="p-5">
		<canvas width="350" height="350" id="pie-chart"></canvas>
	</div>
</template>

<script>
import Chart from "chart.js";
export default {
	name: "PieChart",
	data() {
		return {
			pieChartData: {
				type: "pie",
				data: {
					labels: [
						"Employed",
						"Looking for a Job",
						"Futher Study",
					],
					datasets: [
						{
							data: this.$store.getters["ADMIN_DASHBOARD/GET_PIE_CHART_DATA"],
							backgroundColor: ["#f38b4a", "#ff8397", "#6970d5"],
						},
					],
				},
				options: {
					responsive: true,
					hoverOffset: 4,
                    cutout: 40
				},
			},
		};
	},
	mounted() {
		const ctx = document.getElementById("pie-chart");
		new Chart(ctx, this.pieChartData);
	},
};
</script>
<style scoped>
.red {
	background: rgb(red, rgb(12, 142, 234), blue);
}
</style>
