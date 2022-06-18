<template>
	<div class="container-fluid vh-100 pt-5">
		<div class="row d-flex justify-content-center">
			<div class="col-8 bg-light p-5 shadow">
                 <div v-if="loading" class="col-12 d-flex justify-content-center align-items-center mt-2 text-center mx-auto">
                    <span class="mr-2">Loading Data...</span>
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
			  </div>
              <div v-else>
                  	<div class="mt-2 mb-3">
                        <h3>{{ event.name }}</h3>
                        <h6 class="text-muted">
                            {{ new Date(event.created_at ? event.created_at : '').toLocaleString("en-US") }}
                        </h6>
                    </div>
                    <div >
                        <span v-html="event.content"></span>
                    </div>
              </div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ["slug"],
	data() {
		return {
            loading: false
        };
	},
	computed: {
		event() {
			return this.$store.getters["ADMIN_EVENT/GET_EVENT"];
		},
	},
    methods: {
        setLoading() {
            this.loading = !this.loading
        }
    },
	async mounted() {
        this.setLoading()
		await this.$store.dispatch("ADMIN_EVENT/FETCH_EVENT", this.slug);
        this.setLoading()
	},
};
</script>

<style>
</style>