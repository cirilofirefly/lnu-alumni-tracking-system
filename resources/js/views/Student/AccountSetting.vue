<template>
	<div>
		<h1>Account Settings</h1>
		<div class="row">
			<div class="col-12 p-3">
				<div class="row bg-light shadow rounded pt-2 pb-5">
					<div class="my-2">
						<router-link
							class="btn btn-primary"
							:to="{ path: `id-request/${user[0].id}` }"
							>Update Account</router-link
						>
					</div>
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
			<div class="col">
				<button
					@click="$bvModal.show('password-modal')"
					class="btn btn-primary mt-5"
				>
					Change Password
				</button>
			</div>
		</div>

		<b-modal
			id="password-modal"
			title="Change Password"
			@ok.prevent="savePassword"
			ok-variant="success"
			ok-title="Save"
			centered
		>
			<div class="row">
				<div class="col-12">
					<div class="form-group my-2">
						<label for="current-password">Current Password</label>
						<input
							type="password"
							class="form-control"
							id="current-password"
							v-model="changePassword.oldPassword"
							placeholder="Enter current password"
						/>
					</div>
					<div class="form-group my-2">
						<label for="new-password">New Password</label>
						<input
							type="password"
							class="form-control"
							id="new-password"
							v-model="changePassword.password"
							placeholder="Enter new password"
						/>
					</div>
					<div class="form-group my-2">
						<label for="confirm-new-password">Confirm New Password</label>
						<input
							type="password"
							class="form-control"
							id="confirm-new-password"
							v-model="changePassword.password_confirmation"
							placeholder="Enter confirm new password"
						/>
					</div>
				</div>
			</div>
		</b-modal>

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
</template>

<script>
import axios from "../../axios";
export default {
	data() {
		return {
			changePassword: {
				oldPassword: "",
				password: "",
				password_confirmation: "",
			},
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
		async savePassword() {
			await axios
				.put(
					`auth/student/change-password?token=${localStorage.getItem(
						"access_token"
					)}`,
					this.changePassword
				)
				.then((response) => {
					this.$toast.success("Password saved");
					this.$bvModal.hide("password-modal");
				})
				.catch((error) => {
					console.log(error);
				});
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
	},
	async mounted() {
		let response = await this.$store.dispatch(
			"STUDENT_ID_REQUEST/FETCH_STUDENT_ACCOUNT",
			this.user[0]?.id
		);
		this.previewImage = `http://localhost:8000${this.user[0]?.student?.id_image}`;
	},
};
</script>

<style>
</style>