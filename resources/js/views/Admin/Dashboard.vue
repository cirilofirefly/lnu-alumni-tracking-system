<template>
	<div class="container-fluid">
		<div class="row g-0">
			<h1 class="fw-bold" style="">Dashboard</h1>
			<p>Welcome back, Here is your summary</p>
			<div class="row gy-2 gx-1">
				<div class="col-12 col-md-6 col-lg-6">
					<div class="card p-4 shadow-sm">
						<div class="d-flex justify-content-between">
							<div>
								<h1 class="fw-bold">{{ alumni_records_count }}</h1>
								<h5>Alumni Records</h5>
							</div>
							<div>
								<router-link
									:to="{ name: 'admin.alumni.records' }"
									class="btn btn-success"
									><i class="bi bi-eye-fill"></i>View</router-link
								>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-6">
					<div class="card p-4 shadow-sm">
						<div class="d-flex justify-content-between">
							<div>
								<h1 class="fw-bold">{{ alumni_application_count }}</h1>
								<h5>Alumni Application</h5>
							</div>
							<div>
								<router-link
									:to="{ name: 'admin.alumni.approval' }"
									class="btn btn-success"
									><i class="bi bi-eye-fill"></i>View</router-link
								>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-6">
					<div class="card p-4 shadow-sm">
						<div class="d-flex justify-content-between">
							<div>
								<h1 class="fw-bold">{{ alumni_id_records_count }}</h1>
								<h5>Alumni ID Records</h5>
							</div>
							<div>
								<router-link
									:to="{ name: 'admin.alumni.id-request' }"
									class="btn btn-success"
									><i class="bi bi-eye-fill"></i>View</router-link
								>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-6">
					<div class="card p-4 shadow-sm">
						<div class="d-flex justify-content-between">
							<div>
								<h1 class="fw-bold">{{ alumni_batch_count }}</h1>
								<h5>Alumni Batch</h5>
							</div>
							<div>
								<router-link
									:to="{ name: 'admin.alumni.batch' }"
									class="btn btn-success"
									><i class="bi bi-eye-fill"></i>View</router-link
								>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex mt-5">
				<div class="col-12 col-lg-12">
					<div class="bg-light card shadow-sm">
						<div class="pt-3 d-flex align-items-center ms-3 mt-3">
							<div class="ms-3">
								<h5>Filter by</h5>
							</div>
							<div class="ms-5 col-3">
								<div class="form-group d-flex align-items-center">
									<label for="edu-att" class="me-2">Program/Course:</label>
									<select
										class="form-select"
										aria-label="Default select example"
										v-model="filter.program"
										@change="
											getData();
											drawChart();
										"
									>
										<option :value="null">-- Select an Option --</option>
										<option
											:value="program.name"
											v-for="(program, index) in programs"
											:key="index"
										>
											{{ program.name }}
										</option>
									</select>
								</div>
							</div>
							<div class="ms-3 col-3">
								<div class="form-group d-flex align-items-center">
									<label for="edu-att" class="me-2">College:</label>
									<select
										class="form-select"
										aria-label="Default select example"
										@change="
											getData();
											drawChart();
										"
										v-model="filter.college"
									>
										<option :value="null">-- Select an Option --</option>
										<option
											:value="college.name"
											v-for="(college, index) in colleges"
											:key="index"
										>
											{{ college.name }}
										</option>
									</select>
								</div>
							</div>
							<div class="ms-3 col-3">
								<div class="form-group d-flex align-items-center">
									<label for="edu-att" class="me-2">Batch:</label>
									<select
										class="form-select"
										aria-label="Default select example"
										@change="
											getData();
											drawChart();
										"
										v-model="filter.batch"
									>
										<option :value="null">-- Select an Option --</option>
										<option
											:value="batch.id"
											v-for="(batch, index) in batches"
											:key="index"
										>
											{{ batch.batch }}
										</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-3">
							<div class="p-5" v-if="pieData">
								<canvas width="350" height="350" id="pie-chart"></canvas>
							</div>
						</div>
						<div class="col-12">
							<h5 class="ms-5">Overall Alumni Summary by Batch</h5>
							<planet-chart></planet-chart>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import PlanetChart from "../../components/chartjs/PlanetChart.vue";
import Chart from "chart.js";

export default {
	data() {
		return {
			filter: {
				batch: null,
				college: null,
				program: null,
			},

			colleges: [
				{ name: "College of Arts and Sciences" },
				{ name: "College of Management and Entrepreneur" },
				{ name: "College of Education" },
				{ name: "Others" },
			],
			programs: [
				{
					name: "Bachelor of Elementary Education Bachelor of Elementary Education",
					key: "bachelors",
				},
				{ name: "Bachelor of Secondary Education", key: "bachelors" },
				{
					name: "Bachelor of Technology and Livelihood Education",
					key: "bachelors",
				},
				{ name: "Bachelor of Arts in Political Science", key: "bachelors" },
				{ name: "Bachelor of Arts in Communication", key: "bachelors" },
				{
					name: "Bachelor of Library and Information Science",
					key: "bachelors",
				},
				{
					name: "Bachelor of Science in Information Technology",
					key: "bachelors",
				},
				{ name: "Bachelor of Arts in English Language", key: "bachelors" },
				{ name: "Bachelor of Science in Biology", key: "bachelors" },
				{ name: "Bachelor of Science in Entrepreneurship", key: "bachelors" },
				{ name: "Bachelor of Science in Tourism Management", key: "bachelors" },
				{
					name: "Bachelor of Science in Hotel & Restaurant Management",
					key: "bachelors",
				},
				{ name: "Master in Teaching Major in Filipino", key: "masters" },
				{ name: "Master in Teaching Major in Mathematics", key: "masters" },
				{ name: "Master in Teaching Major in Natural Science", key: "masters" },
				{ name: "Master in Teaching Major in Reading", key: "masters" },
				{ name: "Master in Teaching Major in Social Science", key: "masters" },
				{ name: "Master in Education Major in Filipino", key: "masters" },
				{ name: "Master in Education Major in Mathematics", key: "masters" },
				{
					name: "Master in Education Major in Natural Science",
					key: "masters",
				},
				{ name: "Master in Education Major in Reading", key: "masters" },
				{ name: "Master in Education Major in Social Science", key: "masters" },
				{ name: "Master in Educational Administration", key: "masters" },
				{ name: "Master in Physical Education", key: "masters" },
				{ name: "Master in English", key: "masters" },
				{ name: "Master in Education", key: "masters" },
				{ name: "Master in Biology", key: "masters" },
				{ name: "Master in Social Work", key: "masters" },
				{ name: "Master in Management", key: "masters" },
				{ name: "MA in Pre-Elementary", key: "masters" },
				{ name: "MA in Special Education", key: "masters" },
				{ name: "MA in Teaching in Language Teaching", key: "masters" },
				{ name: "MA in Math Education", key: "masters" },
				{ name: "Doctor of Arts in Language Teaching", key: "doctorate" },
				{
					name: "Doctor of Education in Educational Administration",
					key: "doctorate",
				},
				{
					name: "Doctor of Management in Human Resource Management",
					key: "doctorate",
				},
				{ name: "PhD in Social Science Research", key: "doctorate" },
			],
		};
	},
	components: {
		PlanetChart,
	},
	computed: {
		alumni_records_count() {
			return this.$store.getters["ADMIN_DASHBOARD/GET_ALUMNI_RECORD_COUNT"];
		},
		alumni_application_count() {
			return this.$store.getters[
				"ADMIN_DASHBOARD/GET_ALUMNI_APPLICATION_COUNT"
			];
		},
		alumni_batch_count() {
			return this.$store.getters["ADMIN_DASHBOARD/GET_BATCHES_COUNT"];
		},
		alumni_id_records_count() {
			return this.$store.getters["ADMIN_DASHBOARD/GET_ALUMNI_ID_RECORDS_COUNT"];
		},
		alumni_by_batch() {
			return [];
		},
		batches() {
			return this.$store.getters["UTILS_BATCH/GET_BATCHES"];
		},
		pieData() {
			return this.$store.getters["ADMIN_DASHBOARD/GET_PIE_CHART_DATA"];
		},
	},
	methods: {
		async getData() {
			await this.$store.dispatch(
				"ADMIN_DASHBOARD/TOTAL_ALUMNI_BY_BATCH",
				this.filter
			);
		},
		drawChart() {
			let chartData = {
				type: "pie",
				data: {
					labels: [
						"Employed",
						"Not Employed",
						"Looking for a Job",
						"Further Study",
					],
					datasets: [
						{
							data: this.pieData,
							backgroundColor: ["blue", "red", "yellow", "green"],
						},
					],
				},
				options: {
					responsive: true,
					hoverOffset: 4,
					cutout: 40,
				},
			};
			const ctx = document.getElementById("pie-chart");
			new Chart(ctx, chartData);
		},
	},
	async mounted() {
		await this.getData();
		await this.$store.dispatch("ADMIN_DASHBOARD/TOTAL_ALUMNI_RECORDS");
		await this.$store.dispatch("ADMIN_DASHBOARD/TOTAL_ALUMNI_APPLICATION");
		await this.$store.dispatch("ADMIN_DASHBOARD/TOTAL_BATCHES");
		await this.$store.dispatch("UTILS_BATCH/FETCH_BATCHES");
		this.drawChart();
	},
};
</script>

<style></style>
