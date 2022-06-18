<template>
	<div>
		<div>
			<h1>Batch {{ alumnae.batch }}</h1>
		</div>
		<div class="px-5 pb-5 pt-2 shadow mt-4">
			<table class="table table-striped mt-4 ">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
					</tr>
				</thead>
				<tbody>
					<div v-if="loading" class="mt-2 float-center mx-auto">
						<span>Loading Data...</span>
						<div class="spinner-border" role="status">
							<span class="sr-only"></span>
						</div>
					</div>
					<tr
						v-else
						v-for="alumni in alumnae.student_account_infos"
						:key="alumni.id"
					>
						<th scope="row">{{ alumni.id }}</th>
						<td>
							{{
								`${alumni.student.student_basic_info.first_name} ${
									alumni.student.student_basic_info.middle_name == null
										? ""
										: alumni.student.student_basic_info.middle_name
								} ${alumni.student.student_basic_info.last_name}`
							}}
						</td>
						<td class="text-center">
							<button class="btn btn-primary" @click.prevent="showInfo(alumni)">
								Show
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<b-modal ok-only ok-title="Close" id="modal-info" size="lg">
			<div v-if="alumni" class="container-fluid">
				<div class="row">
					<div class="col-3">
						<div class="mt-4">
							<img
								:src="`http://localhost:8000${alumni.student.id_image}`"
								:alt="`${alumni.id_image}`"
								class="img-thumbnail"
							/>
						</div>
					</div>
					<div class="col-9">
						<div class="mt-2">
							<h3 class="my-3">
								{{ alumni.student.student_basic_info.student_number }}
							</h3>
							<h6>
								Name:
								<strong
									>{{ alumni.student.student_basic_info.last_name }}
									{{
										`, ${alumni.student.student_basic_info.first_name} ${
											alumni.student.student_basic_info.suffix == null
												? ""
												: alumni.student.student_basic_info.suffix
										} ${
											alumni.student.student_basic_info.middle_name == null
												? ""
												: alumni.student.student_basic_info.middle_name
										}`
									}}
								</strong>
							</h6>
							<h6>
								Email:
								<strong>{{ alumni.student.student_basic_info.email }} </strong>
							</h6>
							<h6>
								Mobile Number:
								<strong
									>{{ alumni.student.student_basic_info.mobile_number }}
								</strong>
							</h6>
							<h6>
								Telephone Number:
								<strong
									>{{ alumni.student.student_basic_info.telephone_number }}
								</strong>
							</h6>
						</div>
					</div>
					<div class="col-12 mt-3">
						<h6>
							Birthday:
							<strong
								>{{ alumni.student.student_basic_info.birthdate | setDate }}
							</strong>
						</h6>
						<h6>
							Birthplace:
							<strong
								>{{ alumni.student.student_basic_info.birthplace }}
							</strong>
						</h6>
						<h6>
							Gender:
							<strong>{{ alumni.student.student_basic_info.gender }} </strong>
						</h6>
						<h6>
							Religion:
							<strong>{{ alumni.student.student_basic_info.religion }} </strong>
						</h6>
						<h6>
							Civil Status:
							<strong>
								{{ alumni.student.student_basic_info.civil_status }}
							</strong>
						</h6>

						<h6>
							Current Address:
							<strong>
								{{ alumni.student.student_basic_info.current_address }}
							</strong>
						</h6>
						<h6>
							Permanent Address:
							<strong>
								{{ alumni.student.student_basic_info.permanent_address }}
							</strong>
						</h6>
					</div>
				</div>
			</div>
		</b-modal>
	</div>
</template>

<script>
import moment from "moment";
export default {
	props: ["batch_id"],
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
			return this.$store.getters["ADMIN_BATCH/GET_STUDENTS"];
		},
	},
	methods: {
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
		await this.$store.dispatch(
			"ADMIN_BATCH/FETCH_STUDENTS_BY_BATCH",
			this.batch_id
		);
		this.setLoading();
	},
};
</script>

<style>
</style>