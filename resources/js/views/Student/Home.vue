<template>
	<div class="container-fluid pb-5">
		<h1 class="mb-5 mt-5 text-uppercase fw-bold">Dashboard</h1>
		<div class="col-12" v-if="user">
			<b-alert v-if="verified" show variant="success"
				>Your account registration progress is {{Math.round((percentage.progress / percentage.total) * 100)}}%. Your Account verified. You can request your Alumni ID
				<router-link class="text-decoration-none" :to="{ path: `id-request` }"
					>here</router-link
				>.</b-alert
			>
			<b-alert v-else show variant="warning"
				>Your Account is not fully verified for ID Request. Your account registration progress is {{ Math.round((percentage.progress / percentage.total) * 100) }}%. Please fill all
				necessary information by clicking
				<router-link
					class="text-decoration-none"
					:to="{ path: `id-request/${user[0].id}` }"
					>here</router-link>.</b-alert
			>
			<div class="progress">
				<div
					class="progress-bar"
					role="progressbar"
					:style="`width: ${Math.round((percentage.progress / percentage.total) * 100)}%`"
					:aria-valuenow="Math.round((percentage.progress / percentage.total) * 100)"
					:aria-valuemin="0"
					:aria-valuemax="100"
				>
					{{ `${Math.round((percentage.progress / percentage.total) * 100)}%` }}
				</div>
			</div>
		</div>
		<div class="row">
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
						<div v-if="event.length">
							<h2 class="mb-2">{{ event.name }}</h2>
							<h6 v-if="event.category" class="mb-2 text-muted">
								{{ event.category.category }}
							</h6>
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
			percentage: {
				progress: 0,
				total: 0,
			},
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
			formData.append(
				"student_number",
				this.user[0]?.student.student_basic_info.student_number
			);

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
				reader.readAsDataURL(this.image);
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
		setAccountRegistrationProgress(student) {
			let percentage = {
				progress: 0,
				total: 0,
			};
			if (student) {
				for (const [key, value] of Object.entries(student)) {
					if (key == "id_image" || key == "tor_file" || key == "signature") {
						if (value != "NO DATA" && value != null) {
							percentage.progress++;
						}
						percentage.total++;
					}
				}

                for (const [key, value] of Object.entries(student?.student_basic_info)) {
					if (key != "deleted_at" || key != "created_at" || key != "id" || key != 'updated_at' || key != 'middle_name' || key != 'suffix') {
						if (value != "NO DATA" && value != null) {
							percentage.progress++;
						}
						percentage.total++;
					}
				}

                for (const [key, value] of Object.entries(student?.student_education_info)) {
					if (key != "deleted_at" || key != "created_at" || key != "id" || key != 'updated_at') {
						if (value != "NO DATA" && value != null) {
							percentage.progress++;
						}
						percentage.total++;
					}
				}
			}
			this.percentage = { ...percentage };
		},
	},
	async mounted() {
		let response = await this.$store.dispatch(
			"STUDENT_ID_REQUEST/FETCH_STUDENT_ACCOUNT",
			this.user[0]?.id
		);
		this.previewImage = `http://localhost:8000${this.user[0]?.student?.id_image}`;
		this.verified = this.setVerified(response.data) ?? true;
		this.setAccountRegistrationProgress(response.data);
		this.latestEvent();
	},
};
</script>

<style>
.img-fluid {
	cursor: pointer;
}
</style>