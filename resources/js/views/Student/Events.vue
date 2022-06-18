<template>
	<div>
		<h1>Student Event</h1>
        <p class="text-muted">All events will be shown here.</p>
		<div class="col-12 mt-5">
			<div  v-for="event in events" :key="event.id" class="col-12 p-3 bg-light shadow-lg rounded">
				<div class="p-4">
					<div v-if="event">
						<h2 class="mb-2">{{ event.name }}</h2>
						<h6 class="mb-2 text-muted">{{ event.category.category }}</h6>
						<div class="mb-2" v-html="event.content"></div>
						<button
							class="btn btn-primary rounded"
							@click="$router.push({ path: `event/${event.slug}` })"
						>
							View More
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {};
	},
	computed: {
		events() {
			return this.$store.getters["STUDENT_EVENT/GET_EVENTS"];
		},
	},
	async mounted() {
		await this.$store.dispatch("STUDENT_EVENT/FETCH_EVENTS");
	},
};
</script>

<style>
</style>