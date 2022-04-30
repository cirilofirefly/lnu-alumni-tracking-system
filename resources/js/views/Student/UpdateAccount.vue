<template>
	<div class="container-fluid pb-5">
		<h1 class="text-uppercase fw-bold">My Account</h1>
		<div class="row mt-3 pb-5 pt-3 px-3 shadow rounded">
			<div class="col-12 mb-3 mt-2 text-end">
				<b-button
					v-if="isEditing"
					size="lg"
					class="px-5"
					variant="primary"
					@click="setEdit"
					>Edit</b-button
				>
				<b-button
					v-if="!isEditing"
					size="lg"
					class="px-4"
					variant="primary"
					@click="updateAccount"
					>Save</b-button
				>
				<b-button
					v-if="!isEditing"
					size="lg"
					class="px-3 mx-2"
					variant="secondary"
					@click="setEdit"
					>Cancel</b-button
				>
			</div>
			<div class="col-3 mb-5 d-flex">
				<div
					class="
						col-12
						d-flex
						flex-column
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
						class="img-fluid"
					/>
					<h4>ID Image</h4>
				</div>

				<div
					class="
						col-12
						d-flex
						flex-column
						justify-content-center
						align-items-center
						mb-2
					"
				>
					<img
						@click="$bvModal.show('update-signature')"
						:src="previewSignature"
						style="width: 200px; height: 200px"
						alt="Id Picture"
						class="img-fluid"
					/>
					<h4>Signature</h4>
				</div>
			</div>
			<div class="col-12 mb-2 mb-2" v-if="userAccount.student_basic_info">
				<h4 class="text-uppercase fw-bold">Basic Information</h4>
				<div class="col-12">
					<div class="row">
						<div class="col-3">
							<div class="form-group">
								<label for="first-name">First Name</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="first-name"
									type="text"
									v-model="userAccount.student_basic_info.first_name"
								/>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label for="last-name">Last Name</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="last-name"
									type="text"
									v-model="userAccount.student_basic_info.last_name"
								/>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label for="middle-name">Middle Name</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="middle-name"
									type="text"
									v-model="userAccount.student_basic_info.middle_name"
								/>
							</div>
						</div>
						<div class="col-3 mb-2">
							<div class="form-group">
								<label for="suffix">Suffix</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="suffix"
									type="text"
									v-model="userAccount.student_basic_info.suffix"
								/>
							</div>
						</div>
						<div class="col-4 mb-2">
							<div class="form-group">
								<label for="email">Email</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="email"
									type="text"
									v-model="userAccount.student_basic_info.email"
								/>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label for="mobile-number">Mobile Number</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="mobile-number"
									type="text"
									v-model="userAccount.student_basic_info.mobile_number"
								/>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label for="telephone-number">Telephone Number</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="telephone-number"
									type="text"
									v-model="userAccount.student_basic_info.telephone_number"
								/>
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<label for="gender">Gender</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="gender"
									type="text"
									v-model="userAccount.student_basic_info.gender"
								/>
							</div>
						</div>
						<div class="col-3 mb-2">
							<div class="form-group">
								<label for="birthdate">Birthdate</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="birthdate"
									type="date"
									v-model="userAccount.student_basic_info.birthdate"
								/>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label for="birthplace">Birthplace</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="birthplace"
									type="text"
									v-model="userAccount.student_basic_info.birthplace"
								/>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label for="religion">Religion</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="religion"
									type="text"
									v-model="userAccount.student_basic_info.religion"
								/>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label for="civil-status">Civil Status</label>
								<input
									:disabled="isEditing"
									class="form-control"
									id="civil-status"
									type="text"
									v-model="userAccount.student_basic_info.civil_status"
								/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 mb-2" v-if="userAccount.student_employee_info">
				<h4 class="text-uppercase fw-bold">Employee Information</h4>
				<div class="row">
					<div class="col-4">
						<div class="form-group">
							<label for="company">Company</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="company"
								type="text"
								v-model="userAccount.student_employee_info.company"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="designation">Designation</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="designation"
								type="text"
								v-model="userAccount.student_employee_info.designation"
							/>
						</div>
					</div>
					<div class="col-4 mb-2">
						<div class="form-group">
							<label for="address">Address</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="address"
								type="text"
								v-model="userAccount.student_employee_info.address"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="tel-no">Telephone Number</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="tel-no"
								type="text"
								v-model="userAccount.student_employee_info.tel_no"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="mobile-no">Mobile Number</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="mobile-no"
								type="text"
								v-model="userAccount.student_employee_info.mobile_no"
							/>
						</div>
					</div>
					<div class="col-4 mb-2">
						<div class="form-group">
							<label for="email">Email</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="email"
								type="text"
								v-model="userAccount.student_employee_info.email"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="sp-name">Spouse Name</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="sp-name"
								type="text"
								v-model="userAccount.student_employee_info.sp_name"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="sp-occupation">Spouse Occupation</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="sp-occupation"
								type="text"
								v-model="userAccount.student_employee_info.sp_occupation"
							/>
						</div>
					</div>
					<div class="col-4 mb-2">
						<div class="form-group">
							<label for="sp_mobile_no">Spouse Mobile Number</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="sp_mobile_no"
								type="text"
								v-model="userAccount.student_employee_info.sp_mobile_no"
							/>
						</div>
					</div>
					<div class="col-4 mb-2">
						<div class="form-group">
							<label for="sp-company">Spouse Company</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="sp-company"
								type="text"
								v-model="userAccount.student_employee_info.sp_company"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="sp-position">Spouse Position</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="sp-position"
								type="text"
								v-model="userAccount.student_employee_info.sp_position"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="sp-buss-address">Spouse Business Address</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="sp-buss-address"
								type="text"
								v-model="userAccount.student_employee_info.sp_buss_address"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="sp-fax-no">Spouse Fax Number</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="sp-fax-no"
								type="text"
								v-model="userAccount.student_employee_info.sp_fax_no"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="sp-email">Spouse Email</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="sp-email"
								type="text"
								v-model="userAccount.student_employee_info.sp_email"
							/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12" v-if="userAccount.student_education_info">
				<h4 class="text-uppercase fw-bold">Education Information</h4>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="elem">Elementary</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="elem"
								type="text"
								v-model="userAccount.student_education_info.elem"
							/>
						</div>
					</div>
					<div class="col-6 mb-2">
						<div class="form-group">
							<label for="elem_year">Year</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="elem_year"
								type="text"
								v-model="userAccount.student_education_info.elem_year"
							/>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="jhs">Junior High School</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="jhs"
								type="text"
								v-model="userAccount.student_education_info.jhs"
							/>
						</div>
					</div>
					<div class="col-6 mb-2">
						<div class="form-group">
							<label for="jhs-year">Year</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="jhs-year"
								type="text"
								v-model="userAccount.student_education_info.jhs_year"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="shs">Senior High School</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="shs"
								type="text"
								v-model="userAccount.student_education_info.shs"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="shs_year">Year</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="shs_year"
								type="text"
								v-model="userAccount.student_education_info.shs_year"
							/>
						</div>
					</div>
					<div class="col-4 mb-2">
						<div class="form-group">
							<label for="shs-strand">Strand</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="shs-strand"
								type="text"
								v-model="userAccount.student_education_info.shs_strand"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="gs">Graduate School</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="gs"
								type="text"
								v-model="userAccount.student_education_info.gs"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="gs_year">Year</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="gs_year"
								type="text"
								v-model="userAccount.student_education_info.gs_year"
							/>
						</div>
					</div>
					<div class="col-4 mb-2">
						<div class="form-group">
							<label for="gs_course">Course</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="gs_course"
								type="text"
								v-model="userAccount.student_education_info.gs_course"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="pgs">Post Graduate School</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="pgs"
								type="text"
								v-model="userAccount.student_education_info.pgs"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="pgs_year">Year</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="pgs_year"
								type="text"
								v-model="userAccount.student_education_info.pgs_year"
							/>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="pgs_course">Year</label>
							<input
								:disabled="isEditing"
								class="form-control"
								id="pgs_course"
								type="text"
								v-model="userAccount.student_education_info.pgs_course"
							/>
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

				<b-modal
					id="update-signature"
					title="Update Your Signature"
					ok-title="Save"
					@ok.prevent="uploadSignature()"
					@cancel="revertSignature()"
				>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input
									v-on:change="onSignatureChange
                                    ($event)"
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
	</div>
</template>

<script>
export default {
	props: ["id"],
	data() {
		return {
			userAccount: {},
			isEditing: true,
			previewImage: "",
			previewSignature: "",
			oldSignature: "",
			signature: "",
			oldImage: "",
			image: "",
		};
	},
	computed: {
		user() {
			return this.$store.getters["STUDENT_ID_REQUEST/GET_STUDENT_ACCOUNT"];
		},
	},
	methods: {
		setEdit() {
			this.isEditing = !this.isEditing;
		},
		async updateAccount() {
			const response = await this.$store.dispatch(
				"STUDENT_ID_REQUEST/UPDATE_STUDENT_ACCOUNT",
				this.userAccount
			);
			if (response.status == 200) {
				this.$toast.success(response.data.message ?? "Message");
				this.setEdit();
			}
		},
		async uploadImage() {
			let formData = new FormData();
			formData.append("image", this.image);
			formData.append("student_number", this.userAccount.student_basic_info.student_number);
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

        async uploadSignature() {
			let formData = new FormData();
			formData.append("signature", this.signature);
			formData.append("student_number", this.userAccount.student_basic_info.student_number);
			const response = await this.$store.dispatch(
				"STUDENT_ID_REQUEST/UPLOAD_SIGNATURE",
				formData
			);

			if (response.status == 200) {
				this.$toast.success(response.data?.message ?? "");
				this.$bvModal.hide("update-signature");
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

		revertSignature() {
			this.previewSignature = this.oldSignature;
		},
		onSignatureChange(e) {
			if (e.target?.files[0]) {
				this.signature = e.target?.files[0] ?? "";
				this.oldSignature = this.previewSignature;
				let reader = new FileReader();
				reader.readAsDataURL(this.signature);
				reader.onload = (e) => {
					this.previewSignature = e.target.result;
				};
			}
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
	},
	async mounted() {
		this.$store.dispatch("STUDENT_ID_REQUEST/FETCH_STUDENT_ACCOUNT", this.id);
		this.userAccount = { ...this.user };
		this.previewImage = `http://localhost:8000${this.userAccount?.id_image}`;
		this.previewSignature = `http://localhost:8000${this.userAccount?.signature}`;

	},
};
</script>

<style>
</style>