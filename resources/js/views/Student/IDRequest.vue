<template>
	<div>
		<div>
			<h1 class="mb-2 text-uppercase fw-bold">ID Management</h1>
		</div>
		<div
			class="row d-flex justify-content-between align-items-top px-3 mt-5"
		>
			<div class="d-flex align-items-center mb-2">
				<button v-b-modal.id-request class="btn btn-primary">
					Send ID Request
				</button>
				<p class="ms-2">
					You can update your information
					<router-link
						class="text-decoration-none"
						:to="{ path: `id-request/${user[0].id}` }"
						>here</router-link
					>.
				</p>
			</div>
			<div class="col-6 shadow p-3 mx-2 mt-2">
				<h3 class="text-muted mb-3">
					These Informations will reflect on your Alumni ID
				</h3>
				<div class="row">
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="student_number">Student Number</label>
							<input
								disabled
								v-model="id_info.student_number"
								class="form-control"
								id="student_number"
								type="text"
							/>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="full_name">Full Name</label>
							<input
								disabled
								v-model="id_info.full_name"
								class="form-control"
								id="full_name"
								type="text"
							/>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="address">Address</label>
							<input
								disabled
								v-model="id_info.address"
								class="form-control"
								id="address"
								type="text"
							/>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="batch">Batch</label>
							<input
								disabled
								v-model="id_info.batch"
								class="form-control"
								id="batch"
								type="text"
							/>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="course">Course</label>
							<input
								disabled
								v-model="id_info.course"
								class="form-control"
								id="course"
								type="text"
							/>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="date_of_birth">Date of Birth</label>
							<input
								disabled
								v-model="id_info.date_of_birth"
								class="form-control"
								id="date_of_birth"
								type="text"
							/>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="email">Email Address</label>
							<input
								disabled
								v-model="id_info.email_address"
								class="form-control"
								id="email"
								type="text"
							/>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="mobile_no">Mobile No</label>
							<input
								disabled
								v-model="id_info.mobile_no"
								class="form-control"
								id="mobile_no"
								type="text"
							/>
						</div>
					</div>
					<div class="col-12 mb-2">
						<div class="form-group">
							<label for="telephone_no">Telephone No</label>
							<input
								disabled
								v-model="id_info.telephone_no"
								class="form-control"
								id="telephone_no"
								type="text"
							/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-5 shadow p-3 px-4 pt-3 mx-2">
				<h3 class="mb-3">Request Log</h3>
				<div class="row px-4">
                    <div class="col-12 pl-2 border-top py-2" v-for="log in requestLogs" :key="log.id">
                        {{log.created_at | setDate}}
                    </div>                    
                </div>
			</div>

			<b-modal
				id="id-request"
				title="Request an ID"
				ok-variant="success"
				ok-title="Okay"
				centered
				@ok.prevent="sendIdRequest"
			>
				<div class="text-center">
					<p>Are you sure you want to continue this action?</p>
					<span
						>Note. You can cancel this action an check your information.</span
					>
				</div>
			</b-modal>
		</div>
	</div>
</template>

<script>
import moment from "moment";
export default {
	data() {
		return {
			id_info: {
				student_number: "",
				course: "",
				batch: "",
				full_name: "",
				address: "",
				date_of_birth: "",
				email_address: "",
				mobile_no: "",
				telephone_no: "",
				image: "",
				signature: "",
			},
		};
	},
	methods: {
		async sendIdRequest() {
			const response = await this.$store.dispatch(
				"STUDENT_ID_REQUEST/SEND_ID_REQUEST",
				this.id_info
			);
			if (response.status == 200) {
				this.$toast.success(response.data.message);
				this.$bvModal.hide("id-request");
			}
		},
		setIdInfo() {
			this.id_info = {
				student_number: this.user[0].student.student_basic_info.student_number,
				full_name: `${this.user[0].student.student_basic_info.first_name} ${
					this.user[0].student.student_basic_info.middle_name
						? this.user[0].student.student_basic_info.middle_name.charAt(0) +
						  "."
						: ""
				} ${this.user[0].student.student_basic_info.last_name}`,
				address: this.user[0].student.student_basic_info.current_address,
				batch: this.user[0].batch.batch,
				course: this.user[0].student.student_education_info.gs_course,
				date_of_birth: moment(
					this.user[0].student.student_basic_info.birthdate
				).format("LL"),
				email_address: this.user[0].student.student_basic_info.email,
				mobile_no: this.user[0].student.student_basic_info.mobile_number,
				telephone_no: this.user[0].student.student_basic_info.telephone_number,
				image: this.user[0].student.id_image,
				signature: this.user[0].student.signature,
			};
		},
	},
	computed: {
		user() {
			return this.$store.getters["STUDENT_AUTH/GET_STUDENT_USER"];
		},
        requestLogs() {
			return this.$store.getters["STUDENT_ID_REQUEST/GET_REQUEST_LOGS"];
		},
	},
    filters: {
        setDate(date) {
            return moment(date).format('LLL');
        }
    },
	async mounted() {
		this.setIdInfo();
        await this.$store.dispatch("STUDENT_ID_REQUEST/FETCH_REQUEST_LOGS", this.user[0].student.id)
	},
};
</script>

<style>
</style>