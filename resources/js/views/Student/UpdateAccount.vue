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
                    @click="cancelEdit"
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
            <div
                class="col-12 mb-2 mb-2"
                v-if="userAccount.student_account_info"
            >
                <h4 class="text-uppercase fw-bold">Account Information</h4>
                <div class="col-12">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="first-name">Username</label>
                                <input
                                    :disabled="isEditing"
                                    class="form-control"
                                    id="first-name"
                                    type="text"
                                    v-model="
                                        userAccount.student_account_info
                                            .username
                                    "
                                />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="edu-att"
                                    >Education Attainment</label
                                >
                                <select
                                    :disabled="isEditing"
                                    class="form-select"
                                    v-model="
                                        userAccount.student_account_info
                                            .educational_attainment
                                    "
                                    @change="
                                        setEducationalAttainmentKey(
                                            userAccount.student_account_info
                                                .educational_attainment
                                        )
                                    "
                                    aria-label="Default select example"
                                >
                                    <option :value="null">
                                        -- Select Option --
                                    </option>
                                    <option
                                        :value="attainment.name"
                                        v-for="(
                                            attainment, index
                                        ) in attainments"
                                        :key="index"
                                    >
                                        {{ attainment.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="edu-att">Year Graduate</label>
                                    <select
                                        :disabled="isEditing"
                                        class="form-select"
                                        v-model="
                                            userAccount.student_account_info
                                                .batch_id
                                        "
                                        aria-label="Default select example"
                                    >
                                        <option :value="null">
                                            -- Select Option --
                                        </option>
                                        <option
                                            v-for="batch in batches"
                                            :key="batch.id"
                                            :value="batch.id"
                                        >
                                            {{ batch.batch }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-2">
                            <div class="form-group">
                                <label for="edu-att">College</label>
                                <select
                                    class="form-select"
                                    :disabled="isEditing"
                                    v-model="
                                        userAccount.student_account_info.college
                                    "
                                    aria-label="Default select example"
                                >
                                    <option :value="null">
                                        -- Select Option --
                                    </option>
                                    <option
                                        :value="college.name"
                                        v-for="(college, index) in colleges"
                                        :key="index"
                                    >
                                        {{ college.name }}
                                    </option>
                                </select>
                                <input
                                    :disabled="isEditing"
                                    class="form-control mt-2"
                                    v-if="
                                        userAccount.student_account_info
                                            .college == 'Others'
                                    "
                                    v-model="college_others"
                                    type="text"
                                />
                            </div>
                        </div>
                        <div class="col-4 mb-2">
                            <div class="form-group">
                                <label for="edu-att">Program/Course</label>
                                <select
                                    class="form-select"
                                    :disabled="isEditing"
                                    v-model="
                                        userAccount.student_account_info.program
                                    "
                                    aria-label="Default select example"
                                >
                                    <option :value="null">
                                        -- Select Option --
                                    </option>
                                    <option
                                        :value="program.name"
                                        v-for="(program, index) in programs"
                                        :key="index"
                                    >
                                        {{ program.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="edu-att">Degree Level</label>
                                <select
                                    class="form-select"
                                    :disabled="isEditing"
                                    v-model="
                                        userAccount.student_account_info
                                            .degree_level
                                    "
                                    aria-label="Default select example"
                                >
                                    <option :value="null">
                                        -- Select Option --
                                    </option>
                                    <option
                                        v-for="(
                                            degree_level, index
                                        ) in degree_levels"
                                        :key="index"
                                        :value="degree_level.name"
                                    >
                                        {{ degree_level.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="edu-att"
                                    >Please let us know what you are going on to
                                    do:</label
                                >
                                <select
                                    class="form-select"
                                    :disabled="isEditing"
                                    v-model="
                                        userAccount.student_account_info
                                            .employment_status
                                    "
                                    aria-label="Default select example"
                                >
                                    <option :value="null">
                                        -- Select Option --
                                    </option>
                                    <option
                                        v-for="(
                                            employment_status, index
                                        ) in employement_statuses"
                                        :key="index"
                                        :value="employment_status.name"
                                    >
                                        {{ employment_status.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
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
                                    v-model="
                                        userAccount.student_basic_info
                                            .first_name
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info.last_name
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info
                                            .middle_name
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info.suffix
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info.email
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info
                                            .mobile_number
                                    "
                                />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="telephone-number"
                                    >Telephone Number</label
                                >
                                <input
                                    :disabled="isEditing"
                                    class="form-control"
                                    id="telephone-number"
                                    type="text"
                                    v-model="
                                        userAccount.student_basic_info
                                            .telephone_number
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info.gender
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info.birthdate
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info
                                            .birthplace
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info.religion
                                    "
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
                                    v-model="
                                        userAccount.student_basic_info
                                            .civil_status
                                    "
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2" v-if="userAccount.student_employee_info">
                <h4 class="text-uppercase fw-bold">Employee Information</h4>
                <div class="row mt-3">
                    <h6 class="text-uppercase fw-bold">Companies</h6>
                    <div
                        class="
                            col-12
                            d-flex
                            align-items-center
                            justify-content-end
                        "
                    >
                        <button
                            v-if="!isEditing"
                            @click="addCompany()"
                            class="btn btn-success"
                        >
                            <i class="bi bi-plus"></i> New Company
                        </button>
                    </div>
                    <table class="table mt-2">
                        <tbody>
                            <tr
                                v-for="(company, index) in companies"
                                :key="index"
                            >
                                <td>
                                    <div class="form-group">
                                        <label for="designation"
                                            >Company Name</label
                                        >
                                        <input
                                            :disabled="isEditing"
                                            class="form-control"
                                            id="designation"
                                            type="text"
                                            v-model="companies[index].company"
                                        />
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="designation"
                                            >Designation</label
                                        >
                                        <input
                                            :disabled="isEditing"
                                            class="form-control"
                                            id="designation"
                                            type="text"
                                            v-model="
                                                companies[index].designation
                                            "
                                        />
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="designation">Address</label>
                                        <input
                                            :disabled="isEditing"
                                            class="form-control"
                                            id="designation"
                                            type="text"
                                            v-model="companies[index].address"
                                        />
                                    </div>
                                </td>
                                <td>
                                    <button
                                        @click="removeCompany(index)"
                                        v-if="
                                            companies[0] !== companies[index] &&
                                            !isEditing
                                        "
                                        class="btn btn-danger mt-4"
                                    >
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row d-flex">
                    <div class="col-6 mt-3 border">
                        <div
                            class="
                                col-12
                                d-flex
                                align-items-center
                                justify-content-between
                                mt-3
                            "
                        >
                            <h6 class="text-uppercase fw-bold">
                                Seminar/Trainings
                            </h6>
                            <button
                                v-if="!isEditing"
                                @click="addSeminar()"
                                class="btn btn-success"
                            >
                                <i class="bi bi-plus"></i> New Seminar
                            </button>
                        </div>
                        <table class="table mt-2">
                            <tbody>
                                <tr
                                    v-for="(seminar, index) in seminars"
                                    :key="index"
                                >
                                    <td>
                                        <div class="form-group">
                                            <label for="designation"
                                                >Seminar</label
                                            >
                                            <input
                                                :disabled="isEditing"
                                                class="form-control"
                                                id="designation"
                                                type="text"
                                                v-model="
                                                    seminars[index].seminar
                                                "
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <button
                                            @click="removeSeminar(index)"
                                            v-if="
                                                seminars[0] !==
                                                    seminars[index] &&
                                                !isEditing
                                            "
                                            class="btn btn-danger mt-4"
                                        >
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 mt-3 border">
                        <div
                            class="
                                col-12
                                d-flex
                                align-items-center
                                justify-content-between
                                mt-3
                            "
                        >
                            <h6 class="text-uppercase fw-bold">Eligibility</h6>
                            <button
                                v-if="!isEditing"
                                @click="addElegibility()"
                                class="btn btn-success"
                            >
                                <i class="bi bi-plus"></i> New Elgibility
                            </button>
                        </div>
                        <table class="table mt-2">
                            <tbody>
                                <tr
                                    v-for="(
                                        elegibility, index
                                    ) in elegibilities"
                                    :key="index"
                                >
                                    <td>
                                        <div class="form-group">
                                            <label for="designation"
                                                >Eligibility</label
                                            >
                                            <input
                                                :disabled="isEditing"
                                                class="form-control"
                                                id="designation"
                                                type="text"
                                                v-model="
                                                    elegibilities[index]
                                                        .elegibilitiy
                                                "
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="designation"
                                                >Category</label
                                            >
                                            <input
                                                :disabled="isEditing"
                                                class="form-control"
                                                id="designation"
                                                type="text"
                                                v-model="
                                                    elegibilities[index]
                                                        .category
                                                "
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <button
                                            @click="removeElegibility(index)"
                                            v-if="
                                                elegibilities[0] !==
                                                    elegibilities[index] &&
                                                !isEditing
                                            "
                                            class="btn btn-danger mt-4"
                                        >
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--  <div class="row">
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
                -->
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
                                v-model="
                                    userAccount.student_education_info.elem
                                "
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
                                v-model="
                                    userAccount.student_education_info.elem_year
                                "
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
                                v-model="
                                    userAccount.student_education_info.jhs_year
                                "
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
                                v-model="
                                    userAccount.student_education_info.shs_year
                                "
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
                                v-model="
                                    userAccount.student_education_info
                                        .shs_strand
                                "
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
                                v-model="
                                    userAccount.student_education_info.gs_year
                                "
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
                                v-model="
                                    userAccount.student_education_info.gs_course
                                "
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
                                v-model="
                                    userAccount.student_education_info.pgs_year
                                "
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
                                v-model="
                                    userAccount.student_education_info
                                        .pgs_course
                                "
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
                                    v-on:change="onSignatureChange($event)"
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
import axios from "../../axios";
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
            attainmentKey: "",
            college_others: "",

            company_ids: [],
            companies: [],
            seminar_ids: [],
            seminars: [],
            elegibility_ids: [],
            elegibilities: [],

            attainments: [
                { name: "College Graduate", key: "bachelors" },
                { name: "Master's Graduate", key: "masters" },
                { name: "Doctorate Graduate", key: "doctorate" },
                { name: "ILS Graduate", key: "ils" },
            ],

            colleges: [
                { name: "College of Arts and Sciences" },
                { name: "College of Management and Entrepreneur" },
                { name: "College of Education" },
                { name: "Others" },
            ],

            employement_statuses: [
                { name: "Employed" },
                { name: "Not Employed" },
                { name: "Looking for a Job" },
                { name: "Futher Study" },
            ],

            degree_levels: [
                { name: "Elementary" },
                { name: "Bachelor's" },
                { name: "Master's" },
                { name: "Doctorate" },
            ],
        };
    },
    computed: {
        users() {
            return this.$store.getters["STUDENT_AUTH/GET_STUDENT_USER"];
        },
        user() {
            return this.$store.getters[
                "STUDENT_ID_REQUEST/GET_STUDENT_ACCOUNT"
            ];
        },
        batches() {
            return this.$store.getters["UTILS_BATCH/GET_BATCHES"];
        },

        programs() {
            let programs = [
                {
                    name: "Bachelor of Elementary Education Bachelor of Elementary Education",
                    key: "bachelors",
                },
                { name: "Bachelor of Secondary Education", key: "bachelors" },
                {
                    name: "Bachelor of Technology and Livelihood Education",
                    key: "bachelors",
                },
                {
                    name: "Bachelor of Arts in Political Science",
                    key: "bachelors",
                },
                { name: "Bachelor of Arts in Communication", key: "bachelors" },
                {
                    name: "Bachelor of Library and Information Science",
                    key: "bachelors",
                },
                {
                    name: "Bachelor of Science in Information Technology",
                    key: "bachelors",
                },
                {
                    name: "Bachelor of Arts in English Language",
                    key: "bachelors",
                },
                { name: "Bachelor of Science in Biology", key: "bachelors" },
                {
                    name: "Bachelor of Science in Entrepreneurship",
                    key: "bachelors",
                },
                {
                    name: "Bachelor of Science in Tourism Management",
                    key: "bachelors",
                },
                {
                    name: "Bachelor of Science in Hotel & Restaurant Management",
                    key: "bachelors",
                },
                {
                    name: "Master in Teaching Major in Filipino",
                    key: "masters",
                },
                {
                    name: "Master in Teaching Major in Mathematics",
                    key: "masters",
                },
                {
                    name: "Master in Teaching Major in Natural Science",
                    key: "masters",
                },
                { name: "Master in Teaching Major in Reading", key: "masters" },
                {
                    name: "Master in Teaching Major in Social Science",
                    key: "masters",
                },
                {
                    name: "Master in Education Major in Filipino",
                    key: "masters",
                },
                {
                    name: "Master in Education Major in Mathematics",
                    key: "masters",
                },
                {
                    name: "Master in Education Major in Natural Science",
                    key: "masters",
                },
                {
                    name: "Master in Education Major in Reading",
                    key: "masters",
                },
                {
                    name: "Master in Education Major in Social Science",
                    key: "masters",
                },
                {
                    name: "Master in Educational Administration",
                    key: "masters",
                },
                { name: "Master in Physical Education", key: "masters" },
                { name: "Master in English", key: "masters" },
                { name: "Master in Education", key: "masters" },
                { name: "Master in Biology", key: "masters" },
                { name: "Master in Social Work", key: "masters" },
                { name: "Master in Management", key: "masters" },
                { name: "MA in Pre-Elementary", key: "masters" },
                { name: "MA in Special Education", key: "masters" },
                { name: "MA in Teaching in Language Teaching", key: "masters" },
                { name: "MA in Math Education", key: "masters" },
                {
                    name: "Doctor of Arts in Language Teaching",
                    key: "doctorate",
                },
                {
                    name: "Doctor of Education in Educational Administration",
                    key: "doctorate",
                },
                {
                    name: "Doctor of Management in Human Resource Management",
                    key: "doctorate",
                },
                { name: "PhD in Social Science Research", key: "doctorate" },
            ];
            if (this.attainmentKey) {
                return programs.filter(
                    (program) => program.key === this.attainmentKey
                );
            }
            return programs;
        },
    },
    methods: {
        async getCompanies() {
            await axios
                .get(
                    `student/companies?token=${localStorage.getItem(
                        "access_token"
                    )}`
                )
                .then((response) => {
                    if (response.data.length === 0) {
                        this.companies = [];
                        this.addCompany();
                    } else {
                        this.companies = response.data;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async updateCompanies() {
            await axios
                .post(
                    `student/companies?token=${localStorage.getItem(
                        "access_token"
                    )}`,
                    { companies: this.companies, company_ids: this.company_ids }
                )
                .then((response) => {
                    this.getCompanies();
                    this.company_ids = [];
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addCompany() {
            this.companies.push({
                id: 0,
                student_id: 0,
                company: "",
                designation: "",
                address: "",
            });
        },
        removeCompany(index) {
            let company_id = this.companies[index].id;
            if (company_id != 0) {
                this.company_ids.push(company_id);
            }
            this.companies.splice(index, 1);
        },
        async getSeminars() {
            await axios
                .get(
                    `student/seminars?token=${localStorage.getItem(
                        "access_token"
                    )}`
                )
                .then((response) => {
                    if (response.data.length === 0) {
                        this.seminars = [];
                        this.addSeminar();
                    } else {
                        this.seminars = response.data;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async updateSeminars() {
            await axios
                .post(
                    `student/seminars?token=${localStorage.getItem(
                        "access_token"
                    )}`,
                    {
                        seminars: this.seminars,
                        seminar_ids: this.seminar_ids,
                    }
                )
                .then((response) => {
                    this.getSeminars();
                    this.seminar_ids = [];
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addSeminar() {
            this.seminars.push({
                id: 0,
                student_id: 0,
                seminar: "",
            });
        },
        removeSeminar(index) {
            let seminar_id = this.seminars[index].id;
            if (seminar_id != 0) {
                this.seminar_ids.push(seminar_id);
            }
            this.seminars.splice(index, 1);
        },
        async getElegibilities() {
            await axios
                .get(
                    `student/elegibilities?token=${localStorage.getItem(
                        "access_token"
                    )}`
                )
                .then((response) => {
                    if (response.data.length === 0) {
                        this.elegibilities = [];
                        this.addElegibility();
                    } else {
                        this.elegibilities = response.data;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async updateElegibilities() {
            await axios
                .post(
                    `student/elegibilities?token=${localStorage.getItem(
                        "access_token"
                    )}`,
                    {
                        elegibilities: this.elegibilities,
                        elegibility_ids: this.elegibility_ids,
                    }
                )
                .then((response) => {
                    this.getElegibilities();
                    this.elegibility_ids = [];
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addElegibility() {
            this.elegibilities.push({
                id: 0,
                student_id: 0,
                elegibilitiy: "",
                category: "",
            });
        },
        removeElegibility(index) {
            let elegibility_id = this.elegibilities[index].id;
            if (elegibility_id != 0) {
                this.elegibility_ids.push(elegibility_id);
            }
            this.elegibilities.splice(index, 1);
        },
        setEdit() {
            this.isEditing = !this.isEditing;
        },
        async cancelEdit() {
            this.isEditing = !this.isEditing;
            this.userAccount = { ...this.user };
            await this.getCompanies();
            await this.getSeminars();
            await this.getElegibilities();
        },
        async updateAccount() {
            if (this.userAccount.student_account_info.college == "Others") {
                this.userAccount.student_account_info.college =
                    this.college_others;
            }
            const response = await this.$store.dispatch(
                "STUDENT_ID_REQUEST/UPDATE_STUDENT_ACCOUNT",
                this.userAccount
            );
            if (response.status == 200) {
                var full_name =
                    this.users[0].student.student_basic_info.first_name +
                    " " +
                    this.users[0].student.student_basic_info.middle_name.charAt(
                        0
                    ) +
                    ". " +
                    this.users[0].student.student_basic_info.last_name;

                var data = {
                    student_id: this.id,
                    action:
                        full_name + " made a recent update to their account.",
                    notification_status: false,
                };

                await axios.post(`admin/notification`, data);
                await this.updateCompanies();
                await this.updateSeminars();
                await this.updateElegibilities();
                this.$toast.success(response.data.message ?? "Message");
                this.setEdit();
            }
        },
        async uploadImage() {
            let formData = new FormData();
            formData.append("image", this.image);
            formData.append(
                "student_number",
                this.userAccount.student_basic_info.student_number
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

        setEducationalAttainmentKey(educational_attainment) {
            this.attainmentKey = this.attainments.filter((attainment) => {
                return attainment.name === educational_attainment;
            })[0].key;
        },

        async uploadSignature() {
            let formData = new FormData();
            formData.append("signature", this.signature);
            formData.append(
                "student_number",
                this.userAccount.student_basic_info.student_number
            );
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
        await this.getCompanies();
        await this.getSeminars();
        await this.getElegibilities();
        await this.$store.dispatch("UTILS_BATCH/FETCH_BATCHES");
        await this.$store.dispatch(
            "STUDENT_ID_REQUEST/FETCH_STUDENT_ACCOUNT",
            this.id
        );
        this.userAccount = { ...this.user };
        if (
            this.colleges.filter(
                (college) =>
                    college.name === this.user.student_account_info.college
            ).length === 0
        ) {
            this.college_others = this.user.student_account_info.college;
            this.userAccount.student_account_info.college = "Others";
        }
        this.previewImage = `http://localhost:8000${this.userAccount?.id_image}`;
        this.previewSignature = `http://localhost:8000${this.userAccount?.signature}`;
    },
};
</script>

<style>
</style>
