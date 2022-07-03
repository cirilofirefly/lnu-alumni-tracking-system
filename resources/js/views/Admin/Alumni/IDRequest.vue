<template>
    <div class="container-fluid">
        <div class="row p-5">
            <div class="col-12">
                <h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
                    Alumni ID Request
                </h1>
            </div>
            <div class="col-12 mt-3 shadow p-3 bg-light">
                <div class="row">
                    <div class="col-5 me-5">
                        <h5 class="mb-2">Select Status</h5>
                        <select
                            v-model="requestType"
                            @change="fetchIDRequest"
                            class="form-select"
                            aria-label="Default select example"
                        >
                            <option disabled>Select Status</option>
                            <option selected :value="2">Pending</option>
                            <option :value="1">Approved</option>
                            <option :value="0">Disapproved</option>
                        </select>
                    </div>
                    <div class="col-5 mt-4 ms-5">
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search"
                                aria-label="Search"
                                aria-describedby="search"
                                v-model="search"
                            />
                            <!-- <div class="input-group-append">
                                <button
                                    @click.prevent="getData"
                                    class="btn btn-outline-secondary"
                                    type="button"
                                >
                                    <i class="bi bi-search"></i>
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>

                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">ID Info</th>
                            <th scope="col" class="text-center">Status</th>
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
                        <tr
                            v-else
                            v-for="alumni in alumnae"
                            :key="alumni.id"
                        >
                            <th scope="row">{{ alumni.id }}</th>
                            <td>
                                {{
                                    `${
                                        alumni.student.student_basic_info
                                            .first_name
                                    } ${
                                        alumni.student.student_basic_info
                                            .middle_name == null
                                            ? ""
                                            : alumni.student.student_basic_info
                                                  .middle_name
                                    } ${
                                        alumni.student.student_basic_info
                                            .last_name
                                    }`
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
                                <span
                                    :class="
                                        alumni.status === 2
                                            ? 'bg-primary'
                                            : alumni.status === 1
                                            ? 'bg-success text-light'
                                            : 'bg-danger text-light'
                                    "
                                    class="mt-2 p-1 rounded"
                                >
                                    {{
                                        alumni.status === 2
                                            ? "Pending"
                                            : alumni.status == 0
                                            ? "Disapproved"
                                            : "Approved"
                                    }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button
                                    v-if="alumni.status == 1"
                                    @click="
                                        $router.push({
                                            path: `id-printable/${alumni.id}`,
                                        })
                                    "
                                    class="btn btn-primary"
                                >
                                    Preview
                                </button>
                                <button
                                    v-if="alumni.status == 2"
                                    class="btn btn-success"
                                    @click.prevent="id = alumni.id"
                                    v-b-modal.modal-approve
                                >
                                    Approve
                                </button>
                                <button
                                    v-if="alumni.status == 2"
                                    class="btn btn-danger"
                                    @click.prevent="id = alumni.id"
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
                        @ok.prevent="approveAlumniIDRequest"
                        ok-variant="success"
                        ok-title="Approve"
                    >
                        <p class="my-4">
                            Are you sure you want to continue this action?
                            <br />
                            Click "Cancel" button to cancel the action
                        </p>
                    </b-modal>
                    <b-modal
                        id="modal-disapprove"
                        title="Disapprove Alumni"
                        @ok.prevent="disapproveAlumniIDRequest"
                        ok-variant="danger"
                        ok-title="Dispprove"
                    >
                        <p class="my-4">
                            Are you sure you want to continue this action?
                            <br />
                            Click "Cancel" button to cancel the action
                        </p>
                    </b-modal>

                    <b-modal
                        ok-only
                        ok-title="Close"
                        id="modal-info"
                        title="Alumni ID Information"
                    >
                        <div v-if="alumni" class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <label for="student_number"
                                        >Student Number</label
                                    >
                                    <input
                                        disabled
                                        id="student_number"
                                        type="text"
                                        class="form-control"
                                        v-model="
                                            alumni.alumni_info.student_number
                                        "
                                    />
                                </div>
                                <div class="col-12">
                                    <label for="full_name">Full Name</label>
                                    <input
                                        disabled
                                        id="full_name"
                                        type="text"
                                        class="form-control"
                                        v-model="alumni.alumni_info.full_name"
                                    />
                                </div>
                                <div class="col-12">
                                    <label for="batch">Batch</label>
                                    <input
                                        disabled
                                        id="batch"
                                        type="text"
                                        class="form-control"
                                        v-model="alumni.alumni_info.batch"
                                    />
                                </div>
                                <div class="col-12">
                                    <label for="course">Course</label>
                                    <input
                                        disabled
                                        id="course"
                                        type="text"
                                        class="form-control"
                                        v-model="alumni.alumni_info.course"
                                    />
                                </div>
                                <div class="col-12">
                                    <label for="address">Address</label>
                                    <input
                                        disabled
                                        id="address"
                                        type="text"
                                        class="form-control"
                                        v-model="alumni.alumni_info.address"
                                    />
                                </div>
                                <div class="col-12">
                                    <label for="email">Email</label>
                                    <input
                                        disabled
                                        id="email"
                                        type="text"
                                        class="form-control"
                                        v-model="alumni.alumni_info.email"
                                    />
                                </div>
                                <div class="col-12">
                                    <label for="mobile_no">Mobile No.</label>
                                    <input
                                        disabled
                                        id="mobile_no"
                                        type="text"
                                        class="form-control"
                                        v-model="alumni.alumni_info.mobile_no"
                                    />
                                </div>
                                <div class="col-12">
                                    <label for="telephone_no"
                                        >Telephone No.</label
                                    >
                                    <input
                                        disabled
                                        id="telephone_no"
                                        type="text"
                                        class="form-control"
                                        v-model="
                                            alumni.alumni_info.telephone_no
                                        "
                                    />
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
            requestType: 2,
            search: "",
        };
    },
    filters: {
        setDate(date) {
            return moment(date).format("LL");
        },
    },
    computed: {
        alumnae() {
            return this.$store.getters[
                "ADMIN_ID_MANAGEMENT/GET_STUDENT_ID_REQUESTS"
            ];
        },

        // filteredAlumnae() {
        //     return this.alumnae.filter((data) => {
        //         return (
        //             data.student.student_basic_info.first_name
        //                 .toLowerCase()
        //                 .includes(this.search) ||
        //             data.student.student_basic_info.middle_name
        //                 .toLowerCase()
        //                 .includes(this.search) ||
        //             data.student.student_basic_info.last_name
        //                 .toLowerCase()
        //                 .includes(this.search)
        //         );
        //     });
        // },
    },
    methods: {
        async approveAlumniIDRequest() {
            const response = await this.$store.dispatch(
                "ADMIN_ID_MANAGEMENT/APPROVE_ID_REQUEST",
                this.id
            );
            if (response.status == 200) {
                this.$toast.success(response.data.message);
                this.$bvModal.hide("modal-approve");
                await this.$store.dispatch(
                    "ADMIN_ID_MANAGEMENT/FETCH_STUDENT_ID_REQUESTS"
                );
            }
            if (response.status == 404) {
                this.$toast.error(response.data.message);
            }
        },
        async disapproveAlumniIDRequest() {
            const response = await this.$store.dispatch(
                "ADMIN_ID_MANAGEMENT/DISAPPROVE_ID_REQUEST",
                this.id
            );

            if (response.status == 200) {
                this.$toast.success(response.data.message);
                this.$bvModal.hide("modal-disapprove");
                await this.$store.dispatch(
                    "ADMIN_ID_MANAGEMENT/FETCH_STUDENT_ID_REQUESTS"
                );
            }
        },
        showInfo(alumni) {
            this.alumni = { ...alumni };
            this.$bvModal.show("modal-info");
        },
        setLoading() {
            this.loading = !this.loading;
        },
        async fetchIDRequest() {
            await this.$store.dispatch(
                "ADMIN_ID_MANAGEMENT/FETCH_STUDENT_ID_REQUESTS",
                this.requestType
            );
        },

        async getData() {
            var data = {
                requestType: this.requestType,
                search: this.search,
            };
            await this.$store.dispatch(
                "ADMIN_ID_MANAGEMENT/FETCH_STUDENT_ID_REQUESTS",
                data
            );
        },
    },
    async mounted() {
        this.setLoading();
        this.fetchIDRequest();
        this.setLoading();
    },
};
</script>
