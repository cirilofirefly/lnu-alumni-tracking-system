<template>
	<div>
		<h1>Account Settings</h1>
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
	</div>
</template>

<script>
import axios from '../../axios'
export default {
    data() {
        return {
            changePassword: {
                oldPassword: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    computed: {
        user() {
			return this.$store.getters["STUDENT_AUTH/GET_STUDENT_USER"];
		},
    },
	methods: {
		async savePassword() {
            await axios.put(`auth/student/change-password?token=${localStorage.getItem('access_token')}`, this.changePassword)
                .then(response => {
                    this.$toast.success('Password saved')
                    this.$bvModal.hide('password-modal')
                })
                .catch(error => {
                    console.log(error)
                });
        },
	},
};
</script>

<style>
</style>