<template>
	<div class="container-fluid vh-100 pt-5">
		<div class="row d-flex justify-content-center">
			<div class="col-8 bg-light p-5 shadow">
				<div class="mt-2 mb-3">
					<h3>{{ event.name }}</h3>
					<h6 class="text-muted">
						{{
							`${new Date(event.created_at).toLocaleString("en-US", {
								weekday: "long",
								year: "numeric",
								month: "long",
								day: "numeric",
							})} ${new Date(event.created_at).toLocaleTimeString("en-US")}`
						}}
					</h6>
				</div>
				<div>
					<span v-html="event.content"></span>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ["slug"],
	data() {
		return {};
	},
	computed: {
		event() {
			return this.$store.getters["STUDENT_EVENT/GET_EVENT"];
		},
	},
	async mounted() {
		await this.$store.dispatch("STUDENT_EVENT/FETCH_EVENT", this.slug);
	},
};
</script>

<style>
</style>