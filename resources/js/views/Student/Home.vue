<template>
	<div class="container-fluid pb-5">
		<div class="col-12">
			<b-alert v-if="verified" show variant="success"
				>Your Account verified. You can request your Alumni ID
				<router-link
					class="text-decoration-none"
					:to="{ path: `id-request` }"
					>here</router-link
				>.</b-alert
			>
			<b-alert v-else show variant="warning"
				>Your Account is not fully verified for ID Request. Please fill all
				necessary information by clicking
				<router-link
					class="text-decoration-none"
					:to="{ path: `id-request/${user[0].id}` }"
					>here</router-link
				>.</b-alert
			>
		</div>
		<h1 class="mb-2 text-uppercase fw-bold">Dashboard</h1>
		<div class="row">
			<div class="col-12 p-3">
				<div class="row bg-light shadow rounded pt-2 pb-5">
					<h3 class="text-uppercase fw-bold mt-4 ps-4 mb-4">
						Basic Information
					</h3>
					<div class="col-3">
						<div
							class="
								col-12
								d-flex
								justify-content-center
								align-items-center
								mb-2
							"
						>
							<img
								@click="$bvModal.show('update-image')"
								:src="previewImage"
								style="width: 200px; height: 200px"
								alt="Id Picture"
								class="img-fluid shadow"
							/>
						</div>
					</div>
					<div class="col-9">
						<div class="row">
							<div class="col-4">
								<h4 class="text-uppercase">
									<strong>{{
										`${user[0].student.student_basic_info.last_name},  ${
											user[0].student.student_basic_info.first_name
										} ${
											user[0].student.student_basic_info.suffix == null
												? ""
												: user[0].student.student_basic_info.suffix
										} ${
											user[0].student.student_basic_info.middle_name == null
												? ""
												: user[0].student.student_basic_info.middle_name
										} `
									}}</strong>
								</h4>
							</div>
							<div class="col-6">
								<h4>
									<strong class="bg-primary rounded text-light px-3 py-1">
										{{ user[0].student.student_basic_info.student_number }}
									</strong>
								</h4>
							</div>
							<div class="col-12 mb-3">
								<p class="text-muted">
									{{ user[0].student.student_basic_info.email }}
								</p>
							</div>
							<div class="col-6">
								<p>
									<span class="mt-5 fw-bold text-uppercase">
										Mobile Number
									</span>
									<br />
									{{ user[0].student.student_basic_info.mobile_number }}
								</p>
							</div>
							<div class="col-6 mb-2">
								<p>
									<span class="mt-5 fw-bold text-uppercase">
										Telephone Number
									</span>
									<br />
									{{ user[0].student.student_basic_info.telephone_number }}
								</p>
							</div>
							<div class="col-6">
								<p>
									<span class="mt-5 fw-bold text-uppercase"> Birthdate </span>
									<br />
									{{
										new Date(
											user[0].student.student_basic_info.birthdate
										).toLocaleString("en-US", {
											weekday: "long",
											year: "numeric",
											month: "long",
											day: "numeric",
										})
									}}
								</p>
							</div>
							<div class="col-6 mb-2">
								<p>
									<span class="mt-5 fw-bold text-uppercase"> Birthplace </span>
									<br />
									{{ user[0].student.student_basic_info.birthplace }}
								</p>
							</div>
							<div class="col-6">
								<p>
									<span class="mt-5 fw-bold text-uppercase">
										Current Address
									</span>
									<br />
									{{ user[0].student.student_basic_info.current_address }}
								</p>
							</div>
							<div class="col-6 mb-2">
								<p>
									<span class="mt-5 fw-bold text-uppercase">
										Permanent Address
									</span>
									<br />
									{{ user[0].student.student_basic_info.permanent_address }}
								</p>
							</div>
							<div class="col-6">
								<p>
									<span class="mt-5 fw-bold text-uppercase"> Religion </span>
									<br />
									{{ user[0].student.student_basic_info.religion }}
								</p>
							</div>
							<div class="col-6 mb-2">
								<p>
									<span class="mt-5 fw-bold text-uppercase"> Gender </span>
									<br />
									{{ user[0].student.student_basic_info.gender }}
								</p>
							</div>
							<div class="col-6">
								<p>
									<span class="mt-5 fw-bold text-uppercase">
										Civil Status
									</span>
									<br />
									{{ user[0].student.student_basic_info.civil_status }}
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 mt-5">
				<div class="col-12 p-3 bg-light shadow-lg rounded">
					<div class="d-flex justify-content-between align-items-center">
						<h3 class="pt-4 pb-2 ps-4 text-uppercase fw-bold">Latest Event</h3>
					</div>
					<div
						v-if="loading"
						class="d-flex justify-content-center align-items-center"
					>
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
					<div v-else class="p-4">
						<div v-if="event">
							<h2 class="mb-2">{{ event.name }}</h2>
							<h6 class="mb-2 text-muted">{{ event.category.category }}</h6>
							<div class="mb-2" v-html="event.content"></div>
							<button
								class="btn btn-primary rounded"
								@click="$router.push({ path: `event/${event.slug}` })"
							>
								Learn More
							</button>
						</div>
						<div v-else>
							<h5>No Latest Event</h5>
						</div>
					</div>
				</div>
			</div>

			<b-modal
				id="update-image"
				title="Update Your ID"
				ok-title="Save"
				@ok.prevent="uploadImage()"
				@cancel="revertImage()"
			>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input
								v-on:change="onFileChange($event)"
								type="file"
								id="imageFile"
								accept="image/png, image/jpeg"
							/>
						</div>
					</div>
				</div>
			</b-modal>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			loading: false,
			verified: true,
			event: {},
			userCheck: null,
			image: null,
			previewImage: null,
			oldImage: null,
		};
	},
	computed: {
		user() {
			return this.$store.getters["STUDENT_AUTH/GET_STUDENT_USER"];
		},
	},
	methods: {
		async latestEvent() {
			this.setLoading();
			const response = await this.$store.dispatch(
				"STUDENT_EVENT/FETCH_LATEST_EVENT"
			);
			if (response.status == 200) {
				this.event = { ...response.data };
				this.setLoading();
			}
		},
		async uploadImage() {
			let formData = new FormData();
			formData.append("image", this.image);
			formData.append("student_number", this.user[0]?.student.student_basic_info.student_number);

			const response = await this.$store.dispatch(
				"STUDENT_ID_REQUEST/UPLOAD_IMAGE",
				formData
			);

			if (response.status == 200) {
				this.$toast.success(response.data?.message ?? "");
				this.$bvModal.hide("update-image");
			}

			if (response.status == 422) {
				console.log(response.data);
			}
		},
		setLoading() {
			this.loading = !this.loading;
		},

		revertImage() {
			this.previewImage = this.oldImage;
		},

		onFileChange(e) {
			if (e.target?.files[0]) {
				this.image = e.target?.files[0] ?? "";
				this.oldImage = this.previewImage;
				let reader = new FileReader();
                reader.readAsDataURL(this.image)
				reader.onload = (e) => {
					this.previewImage = e.target.result;
				};
			}
		},
		setVerified(user) {
			if (user.student_education_info) {
				for (const [key, value] of Object.entries(
					user.student_education_info
				)) {
					if (
						value === null &&
						key !== "deleted_at" &&
						key !== "created_at" &&
						key !== "updated_at" &&
						key !== "id"
					) {
						return false;
					}
				}
			}
		},
	},
	async mounted() {
		let response = await this.$store.dispatch(
			"STUDENT_ID_REQUEST/FETCH_STUDENT_ACCOUNT",
			this.user[0].id
		);
		this.previewImage = `http://localhost:8000${this.user[0]?.student.id_image}`;
		this.verified = this.setVerified(response.data) ?? true;
		this.latestEvent();
	},
};
</script>

<style>
.img-fluid {
	cursor: pointer;
}
</style>