<template>
	<div class="container-fluid">
		<div class="row p-5">
			<div class="col-12">
				<h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
					Alumni Request
				</h1>
			</div>
			<div class="col-12 mt-3 shadow p-3 bg-light">
				<table class="table table-striped mt-4">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col" class="text-center">Info</th>
							<th scope="col" class="text-center">
								ID Picture
							</th>
							<th scope="col" class="text-center">ID Picture</th>
							<th scope="col" class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<div v-if="loading" class="mt-2 float-center mx-auto">
                            <span>Loading Data...</span>
							<div class="spinner-border" role="status">
								<span class="sr-only"></span>
							</div>
						</div>
						<tr v-else v-for="alumni in alumnae" :key="alumni.id">
							<th scope="row">{{ alumni.id }}</th>
							<td>
								{{
									`${alumni.student_basic_info.first_name} ${
										alumni.student_basic_info.middle_name == null
											? ""
											: alumni.student_basic_info.middle_name
									} ${alumni.student_basic_info.last_name}`
								}}
							</td>
							<td class="text-center">
								<button
									class="btn btn-primary"
									@click.prevent="showInfo(alumni)"
								>
									Show
								</button>
							</td>
							<td class="text-center">
								<a class="nav-link" target="_blank" :href="alumni.id_image"
									>View</a
								>
							</td>
							<td class="text-center">
								<button
									class="btn btn-success"
									@click.prevent="id = alumni.student_account_info_id"
									v-b-modal.modal-approve
								>
									Approve
								</button>
								<button
									class="btn btn-danger"
									@click.prevent="id = alumni.student_account_info_id"
									v-b-modal.modal-disapprove
								>
									Decline
								</button>
							</td>
						</tr>
					</tbody>
				</table>
				<p><strong>Total Entries: </strong> {{ alumnae.length }}</p>
				<div>
					<b-modal
						id="modal-approve"
						title="Approve Alumni"
						@ok.prevent="approveAlumni"
						ok-variant="success"
						ok-title="Approve"
					>
						<p class="my-4">
							Are you sure you want to continue this action? <br />
							Click "Cancel" button to cancel the action
						</p>
					</b-modal>
					<b-modal
						id="modal-disapprove"
						title="Disapprove Alumni"
						@ok.prevent="disapproveAlumni"
						ok-variant="danger"
						ok-title="Dispprove"
					>
						<p class="my-4">
							Are you sure you want to continue this action? <br />
							Click "Cancel" button to cancel the action
						</p>
					</b-modal>

					<b-modal ok-only ok-title="Close" id="modal-info" size="lg">
						<div v-if="alumni" class="container-fluid">
							<div class="row">
								<div class="col-3">
									<div class="mt-4">
										<img
											:src="`http://localhost:8000${alumni.id_image}`"
											:alt="`${alumni.id_image}`"
											class="img-thumbnail"
										/>
									</div>
								</div>
								<div class="col-9">
									<div class="mt-2">
										<h3 class="my-3">
											{{ alumni.student_basic_info.student_number }}
										</h3>
										<h6>
											Name:
											<strong
												>{{ alumni.student_basic_info.last_name }}
												{{
													`, ${alumni.student_basic_info.first_name} ${
														alumni.student_basic_info.suffix == null
															? ""
															: alumni.student_basic_info.suffix
													} ${
														alumni.student_basic_info.middle_name == null
															? ""
															: alumni.student_basic_info.middle_name
													}`
												}}
											</strong>
										</h6>
										<h6>
											Email:
											<strong>{{ alumni.student_basic_info.email }} </strong>
										</h6>
										<h6>
											Mobile Number:
											<strong
												>{{ alumni.student_basic_info.mobile_number }}
											</strong>
										</h6>
										<h6>
											Telephone Number:
											<strong
												>{{ alumni.student_basic_info.telephone_number }}
											</strong>
										</h6>
									</div>
								</div>
								<div class="col-12 mt-3">
									<h6>
										Birthday:
										<strong
											>{{ alumni.student_basic_info.birthdate | setDate }}
										</strong>
									</h6>
									<h6>
										Birthplace:
										<strong>{{ alumni.student_basic_info.birthplace }} </strong>
									</h6>
									<h6>
										Gender:
										<strong>{{ alumni.student_basic_info.gender }} </strong>
									</h6>
									<h6>
										Religion:
										<strong>{{ alumni.student_basic_info.religion }} </strong>
									</h6>
									<h6>
										Civil Status:
										<strong>
											{{ alumni.student_basic_info.civil_status }}
										</strong>
									</h6>

									<h6>
										Current Address:
										<strong>
											{{ alumni.student_basic_info.current_address }}
										</strong>
									</h6>
									<h6>
										Permanent Address:
										<strong>
											{{ alumni.student_basic_info.permanent_address }}
										</strong>
									</h6>
								</div>
							</div>
						</div>
					</b-modal>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import moment from "moment";
export default {
	data() {
		return {
			id: null,
			alumni: null,
			loading: false,
		};
	},
	filters: {
		setDate(date) {
			return moment(date).format("LL");
		},
	},
	computed: {
		alumnae() {
			return this.$store.getters["ALUMNAE_APPROVAL/GET_ALUMNAE"];
		},
	},
	methods: {
		async approveAlumni() {
			const response = await this.$store.dispatch(
				"ALUMNAE_APPROVAL/APPROVE_ALUMNI",
				this.id
			);
			if (response.status == 200) {
				this.$toast.success(response.data.message);
				this.$bvModal.hide("modal-approve");
				await this.$store.dispatch("ALUMNAE_APPROVAL/FETCH_ALUMNAE");
			}
			if (response.status == 404) {
				this.$toast.error(response.data.message);
			}
		},
		async disapproveAlumni() {
			const response = await this.$store.dispatch(
				"ALUMNAE_APPROVAL/DISAPPROVE_ALUMNI",
				this.id
			);

			if (response.status == 200) {
				this.$toast.success(response.data.message);
				this.$bvModal.hide("modal-disapprove");
				await this.$store.dispatch("ALUMNAE_APPROVAL/FETCH_ALUMNAE");
			}
		},
		showInfo(alumni) {
			this.alumni = { ...alumni };
			this.$bvModal.show("modal-info");
		},
		setLoading() {
			this.loading = !this.loading;
		},
	},
	async mounted() {
		this.setLoading();
		await this.$store.dispatch("ALUMNAE_APPROVAL/FETCH_ALUMNAE");
		this.setLoading();
	},
};
</script>