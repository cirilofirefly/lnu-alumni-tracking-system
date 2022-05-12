<template>
	<div class="container-fluid">
		<div class="row p-5">
			<div class="col-12">
				<h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
					Alumni Batch
				</h1>
			</div>
			<div class="col-12 mt-3 shadow p-3 bg-light">
				<div class="mb-5 mt-2 d-flex justify-content-between pe-3">
					<div>
						<button class="btn btn-success mx-2" @click.prevent="storeBatch">
							<div
								style="width: 14px; height: 14px"
								class="spinner-border text-light"
								role="status"
								v-if="loading"
							></div>
							<i v-else class="bi bi-plus"></i> Add Batch Year
						</button>
					</div>
					<div>
						<div class="input-group mb-3">
							<input
								type="text"
								class="form-control"
								placeholder="Search"
								aria-label="Search"
								aria-describedby="search"
								v-model="search"
							/>
							<div class="input-group-append">
								<button
									@click.prevent="getData"
									class="btn btn-outline-secondary"
									type="button"
								>
									<i class="bi bi-search"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Year</th>
							</tr>
						</thead>
						<tbody>
							<div v-if="loading" class="mt-2 float-center mx-auto">
								<span>Loading Data...</span>
								<div class="spinner-border" role="status">
									<span class="sr-only"></span>
								</div>
							</div>
							<tr v-else v-for="(batch, index) in batches" :key="index">
								<th scope="row">{{ index + 1 }}</th>
								<td>{{ `${batch.batch} - ${batch.batch + 1}` }}</td>
								<td>
									<button
										class="btn btn-success"
										@click="$router.push({ path: `batch-alumni/${batch.id}` })"
									>
										View
									</button>
								</td>
								<td class="text-center">
									<button
										:disabled="!batch.allow_delete"
										class="btn btn-danger"
										@click="
											id = batch.id;
											$bvModal.show('modal-delete');
										"
									>
										<i class="bi bi-trash"></i>
										Delete
									</button>
								</td>
							</tr>
                            
                            <div v-if="batches.length == 0 " class="col-12">
                                <span>No data to show.</span>
                            </div>
						</tbody>
					</table>

					<b-modal
						id="modal-delete"
						title="Delete Batch"
						@ok.prevent="deleteBatch"
						ok-title="Delete Batch"
					>
						<p class="my-4">Are you sure you want to delete this batch?</p>
					</b-modal>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			id: null,
			loading: false,
			search: "",
		};
	},
	computed: {
		batches() {
			return this.$store.getters["ADMIN_BATCH/GET_BATCHES"];
		},
	},
	methods: {
		async storeBatch() {
			this.loading = !this.loading;
			const response = await this.$store.dispatch("ADMIN_BATCH/STORE_BATCH");
			if (response.status == 200) {
				this.$toast.success("New Batch Year added.");
				await this.$store.dispatch("ADMIN_BATCH/FETCH_BATCHES");
				this.loading = !this.loading;
			}
		},
		async deleteBatch() {
			const response = await this.$store.dispatch(
				"ADMIN_BATCH/DELETE_BATCH",
				this.id
			);
			console.log(response);

			if (response.status == 200) {
				this.$toast.success("Batch Year deleted.");
				this.$bvModal.hide("modal-delete");
				await this.$store.dispatch("ADMIN_BATCH/FETCH_BATCHES");
			}

			if (response.status == 400) {
				this.$toast.error(response.data.error);
			}
		},
		async getData() {
			await this.$store.dispatch("ADMIN_BATCH/FETCH_BATCHES", this.search);
		},
		setLoading() {
			this.loading = !this.loading;
		},
	},
	async mounted() {
		this.setLoading();
		this.getData();
		this.setLoading();
	},
};
</script>