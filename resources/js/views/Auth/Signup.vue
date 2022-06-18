<template>
	<div class="signup container-fluid p-0">
		<div class="row vh-100 p-0 m-0">
			<div class="col-12">
				<div class="navbar">
					<router-link to="/" class="nav-item me-5">
						<span>
							<i class="bi bi-house-fill"></i>
							HOME
						</span>
					</router-link>
				</div>
			</div>
			<div class="form bg-light rounded px-5">
				<div class="col">
					<div class="pt-5 pb-4">
						<h1>SIGN UP</h1>
						<h5 class="text-muted">
							Create an account and wait for admin confirmation
						</h5>
					</div>
					<!-- <div class="mb-2">
						<h1 class="mb-3">Education</h1>
						<div class="form-group mb-2 col-md-12">
							<label for="edu-att">Education Attainment</label>
							<select
								class="form-select"
								v-model="account.educational_attainment"
								aria-label="Default select example"
							>
								<option :value="null">-- Select Option --</option>
								<option
									:value="attainment.name"
									v-for="(attainment, index) in attainments"
									:key="index"
								>
									{{ attainment.name }}
								</option>
							</select>
						</div>
						<div class="form-group mb-2 col-md-12">
							<label for="edu-att">Year Graduate</label>
							<select
								class="form-select"
								v-model="account.batch_id"
								aria-label="Default select example"
							>
								<option :value="null">-- Select Option --</option>
								<option
									v-for="batch in batches"
									:key="batch.id"
									:value="batch.id"
								>
									{{ batch.batch }}
								</option>
							</select>
						</div>
						<div class="form-group mb-2 col-md-12">
							<label for="edu-att">College</label>
							<select
								class="form-select"
								v-model="account.college"
								aria-label="Default select example"
							>
								<option :value="null">-- Select Option --</option>
								<option
									:value="college.name"
									v-for="(college, index) in colleges"
									:key="index"
								>
									{{ college.name }}
								</option>
							</select>
						</div>
						<div class="form-group mb-2 col-md-12">
							<label for="edu-att">Program/Course</label>
							<select
								class="form-select"
								v-model="account.program"
								aria-label="Default select example"
							>
								<option :value="null">-- Select Option --</option>
								<option
									:value="program.name"
									v-for="(program, index) in programs"
									:key="index"
								>
									{{ program.name }}
								</option>
							</select>
						</div>
						<div class="form-group mb-2 col-md-12">
							<label for="edu-att">Degree Level</label>

							<select
								class="form-select"
								v-model="account.degree_level"
								aria-label="Default select example"
							>
								<option :value="null">-- Select Option --</option>
								<option
									v-for="(degree_level, index) in degree_levels"
									:key="index"
									:value="degree_level.name"
								>
									{{ degree_level.name }}
								</option>
							</select>
						</div>
					</div> -->
					<div class="mb-2">
						<h1 class="mb-3">Account Information</h1>
						<div class="form-group mb-3 col-md-12">
							<label for="username">Username</label>
							<input
								v-model="account.username"
								type="text"
								class="form-control"
								id="username"
								placeholder="Username"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="password">Password</label>
							<input
								v-model="account.password"
								type="password"
								class="form-control"
								id="password"
								placeholder="******"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="password_confirmation">Password Confirmation</label>
							<input
								v-model="account.password_confirmation"
								type="password"
								class="form-control"
								id="password_confirmation"
								placeholder="******"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="student-number">Student Number</label>
							<input
								v-model="account.student_number"
								type="text"
								class="form-control"
								id="student-number"
								placeholder="Student Number"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="email">Email</label>
							<input
								v-model="account.email"
								type="text"
								class="form-control"
								id="email"
								placeholder="sample@email.com"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="first_name">First Name</label>
							<input
								v-model="account.first_name"
								type="text"
								class="form-control"
								id="first_name"
								placeholder="First Name"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="middle_name">Middle Name</label>
							<input
								v-model="account.middle_name"
								type="text"
								class="form-control"
								id="middle_name"
								placeholder="Middle Name"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="last_name">Last Name</label>
							<input
								v-model="account.last_name"
								type="text"
								class="form-control"
								id="last_name"
								placeholder="Last Name"
							/>
						</div>
						<!--- <div class="form-group mb-3">
							<label for="suffix">Suffix</label>
							<input
								v-model="account.suffix"
								type="text"
								class="form-control"
								id="suffix"
								placeholder="Suffix"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="current_address">Current Address</label>
							<input
								v-model="account.current_address"
								type="text"
								class="form-control"
								id="current_address"
								placeholder="Current Address"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="permanent_address">Permanent Address</label>
							<input
								v-model="account.permanent_address"
								type="text"
								class="form-control"
								id="permanent_address"
								placeholder="Permanent Address"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="mobile_number">Mobile Number</label>
							<input
								v-model="account.mobile_number"
								type="text"
								class="form-control"
								id="mobile_number"
								placeholder="####-###-####"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="telephone_number">Telephone No.</label>
							<input
								v-model="account.telephone_number"
								type="text"
								class="form-control"
								id="telephone_number"
								placeholder="###-###-####"
							/>
						</div> -->
					</div>
					<div class="mb-2">
						<!-- <div class="form-group mb-3">
							<label for="birth_date">Birth Date</label>
							<input
								v-model="account.birthdate"
								type="date"
								class="form-control"
								id="birth_date"
								placeholder="Birth Date"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="birth_place">Birth Place</label>
							<input
								v-model="account.birthplace"
								type="text"
								class="form-control"
								id="birth_place"
								placeholder="Birth Place"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="middle_name">Gender</label>
							<select
								class="form-select"
								v-model="account.gender"
								aria-label="Default select example"
							>
								<option :value="null">-- Select Gender --</option>
								<option value="MALE">Male</option>
								<option value="FEMALE">Female</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label for="religion">Religion</label>
							<input
								v-model="account.religion"
								type="text"
								class="form-control"
								id="religion"
								placeholder="Religion"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="civil_status">Civil Status</label>
							<input
								v-model="account.civil_status"
								type="text"
								class="form-control"
								id="civil_status"
								placeholder="Civil Status"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="tor"
								>Transcript of Record (Note. Should be in .pdf format)</label
							>
							<input
								type="file"
								class="form-control"
								id="tor"
								accept=".pdf"
								@change="handlePDFFile($event)"
							/>
						</div>
						<div class="form-group mb-3">
							<label for="id-pic"
								>2x2 ID Picture (Note. Should be in an image in .png
								format)</label
							>
							<input
								type="file"
								class="form-control"
								id="id-pic"
								accept=".png"
								@change="handleImageFile($event)"
							/>
						</div> -->

						<div
							class="
								form-group
								col
								d-flex
								justify-content-between
								align-items-center
								mt-3
								mb-5
							"
						>
							<div class="">
								<h3>Consent and Disclaimer</h3>
								<p class="text-justify">
									Subject to the warranties restrictions, rights, privileges,
									securities and sanction provided under Repbublic Act No. 10173
									or Data Privacy Act of 2012, I hereby allwo The Alumni
									Association of Leyte Normal University, Inc., its officers and
									authorized agents to collect, process, utilize and store my
									personal data in consideration of my membership in the same
									association.
								</p>
								<div class="form-check">
									<input
										class="form-check-input"
										type="checkbox"
										value=""
										v-model="account.accept_term"
										id="accept-term"
									/>
									<label class="form-check-label" for="accept-term">
										Upon clicking sign up, I hereby give my consent for the
										processing release, and relation of personal Information.
									</label>
								</div>
							</div>
						</div>
						<div
							class="
								form-group
								col-md-12
								d-flex
								justify-content-between
								align-items-center
								pb-5
							"
						>
							<div>
								<button
									:disabled="isSubmitting"
									@click.prevent="signup"
									class="btn btn-lg btn-primary"
								>
									<i class="bi bi-box-arrow-right"></i> Sign up
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			account: {
				username: null,
				password: null,
				password_confirmation: null,
				student_number: null,
				email: null,
				first_name: null,
				middle_name: null,
				last_name: null,
				suffix: null,
				current_address: null,
				permanent_address: null,
				mobile_number: null,
				telephone_number: null,
				birthdate: null,
				birthplace: null,
				gender: null,
				religion: null,
				civil_status: null,
				image: null,
				pdf: null,
				alumni_type: null,
				accept_term: false,
				educational_attainment: null,
				batch_id: null,
				college: null,
				program: null,
				degree_level: null,
                employment_status: null
			},
			form_status: 0,
			isSubmitting: false,
		};
	},
	computed: {
		batches() {
			return this.$store.getters["UTILS_BATCH/GET_BATCHES"];
		},
	},
	methods: {
		async signup() {
			this.isSubmitting = !this.isSubmitting;
			let formData = new FormData();
			formData.append("username", this.account.username);
			formData.append("password", this.account.password);
			formData.append(
				"password_confirmation",
				this.account.password_confirmation
			);
			formData.append("student_number", this.account.student_number);
			formData.append("email", this.account.email);
			formData.append("first_name", this.account.first_name);
			formData.append("middle_name", this.account.middle_name);
			formData.append("last_name", this.account.last_name);
			formData.append("suffix", this.account.suffix);
			formData.append("current_address", this.account.current_address);
			formData.append("permanent_address", this.account.permanent_address);
			formData.append("mobile_number", this.account.mobile_number);
			formData.append("telephone_number", this.account.telephone_number);
			formData.append("birthdate", this.account.birthdate);
			formData.append("birthplace", this.account.birthplace);
			formData.append("gender", this.account.gender);
			formData.append("religion", this.account.religion);
			formData.append("civil_status", this.account.civil_status);
			formData.append("image", this.account.image);
			formData.append("pdf", this.account.pdf);
			formData.append(
				"educational_attainment",
				this.account.educational_attainment
			);
			formData.append("batch_id", this.account.batch_id);
			formData.append("college", this.account.college);
			formData.append("program", this.account.program);
			formData.append("degree_level", this.account.degree_level);
			formData.append("accept_term", this.account.accept_term);

			const response = await this.$store.dispatch(
				"STUDENT_AUTH/SIGNUP",
				formData
			);

			if (response.status == 200) {
				this.$router.push({ name: "signin" });
				this.$toast.success(response.data.message);
			}

			if (response.status == 422) {
				for (const [key, value] of Object.entries(response.data.errors)) {
					this.$toast.error(value[0]);
				}
			}
			this.isSubmitting = !this.isSubmitting;
		},
		handleImageFile(event) {
			this.account.image = event.target.files[0];
		},
		handlePDFFile(event) {
			this.account.pdf = event.target.files[0];
		},
	},
	async mounted() {
		await this.$store.dispatch("UTILS_BATCH/FETCH_BATCHES");
	},
};
</script>

<style>
</style>