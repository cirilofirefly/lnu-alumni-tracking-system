<template>
    <div class="container-fluid">
        <div class="row p-5">
            <div class="col-10">
                <h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
                    Alumni Request
                </h1>
            </div>

            <div class="col-12 mt-3 shadow p-3 bg-light">
                <div class="input-group mb-3" style="width: 50%; float: right">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search"
                        aria-label="Search"
                        aria-describedby="search"
                        v-model="search"
                    />
                    <div class="input-group-append">
                        <button
                            @click.prevent="getData"
                            class="btn btn-outline-secondary"
                            type="button"
                        >
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Info</th>
                            <th scope="col" class="text-center">ID Picture</th>
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
                        <tr v-else v-for="alumni in alumnae" :key="alumni.id">
                            <th scope="row">{{ alumni.id }}</th>
                            <td>
                                {{
                                    `${alumni.first_name} ${
                                        alumni.middle_name == null
                                            ? ""
                                            : alumni.middle_name
                                    } ${alumni.last_name}`
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
                                <a
                                    class="nav-link"
                                    target="_blank"
                                    :href="alumni.id_image"
                                    >View</a
                                >
                            </td>
                            <td class="text-center">
                                <button
                                    class="btn btn-success"
                                    @click.prevent="
                                        id = alumni.student_account_info_id
                                    "
                                    v-b-modal.modal-approve
                                >
                                    Approve
                                </button>
                                <button
                                    class="btn btn-danger"
                                    @click.prevent="
                                        id = alumni.student_account_info_id
                                    "
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
                        @ok.prevent="approveAlumni"
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
                        @ok.prevent="disapproveAlumni"
                        ok-variant="danger"
                        ok-title="Dispprove"
                    >
                        <p class="my-4">
                            Are you sure you want to continue this action?
                            <br />
                            Click "Cancel" button to cancel the action
                        </p>
                    </b-modal>

                    <b-modal ok-only ok-title="Close" id="modal-info" size="lg">
                        <div v-if="alumni" class="container-fluid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mt-4">
                                        <img
                                            :src="`http://localhost:8000${alumni.id_image}`"
                                            :alt="`${alumni.id_image}`"
                                            class="img-thumbnail"
                                        />
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="mt-2">
                                        <h3 class="my-3">
                                            {{ alumni.student_number }}
                                        </h3>
                                        <h6>
                                            Name:
                                            <strong
                                                >{{ alumni.last_name }}
                                                {{
                                                    `, ${alumni.first_name} ${
                                                        alumni.suffix == null
                                                            ? ""
                                                            : alumni.suffix
                                                    } ${
                                                        alumni.middle_name ==
                                                        null
                                                            ? ""
                                                            : alumni.middle_name
                                                    }`
                                                }}
                                            </strong>
                                        </h6>
                                        <h6>
                                            Email:
                                            <strong>{{ alumni.email }} </strong>
                                        </h6>
                                        <h6>
                                            Mobile Number:
                                            <strong
                                                >{{ alumni.mobile_number }}
                                            </strong>
                                        </h6>
                                        <h6>
                                            Telephone Number:
                                            <strong
                                                >{{ alumni.telephone_number }}
                                            </strong>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <h6>
                                        Birthday:
                                        <strong
                                            >{{ alumni.birthdate | setDate }}
                                        </strong>
                                    </h6>
                                    <h6>
                                        Birthplace:
                                        <strong
                                            >{{ alumni.birthplace }}
                                        </strong>
                                    </h6>
                                    <h6>
                                        Gender:
                                        <strong>{{ alumni.gender }} </strong>
                                    </h6>
                                    <h6>
                                        Religion:
                                        <strong>{{ alumni.religion }} </strong>
                                    </h6>
                                    <h6>
                                        Civil Status:
                                        <strong>
                                            {{ alumni.civil_status }}
                                        </strong>
                                    </h6>

                                    <h6>
                                        Current Address:
                                        <strong>
                                            {{ alumni.current_address }}
                                        </strong>
                                    </h6>
                                    <h6>
                                        Permanent Address:
                                        <strong>
                                            {{ alumni.permanent_address }}
                                        </strong>
                                    </h6>
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
import axios from "../../../axios";
export default {
    data() {
        return {
            id: null,
            alumni: null,
            loading: false,
            search: "",
            approvedData: "",
        };
    },
    filters: {
        setDate(date) {
            return moment(date).format("LL");
        },
    },
    computed: {
        alumnae() {
            return this.$store.getters["ALUMNAE_APPROVAL/GET_ALUMNAE"];
        },
    },
    methods: {
        async approveAlumni() {
            const response = await this.$store.dispatch(
                "ALUMNAE_APPROVAL/APPROVE_ALUMNI",
                this.id
            );
            if (response.status == 200) {
                this.$toast.success(response.data.message);
                this.$bvModal.hide("modal-approve");
                await this.$store.dispatch("ALUMNAE_APPROVAL/FETCH_ALUMNAE");
            }
            if (response.status == 404) {
                this.$toast.error(response.data.message);
            }
        },
        async disapproveAlumni() {
            const response = await this.$store.dispatch(
                "ALUMNAE_APPROVAL/DISAPPROVE_ALUMNI",
                this.id
            );

            if (response.status == 200) {
                this.$toast.success(response.data.message);
                this.$bvModal.hide("modal-disapprove");
                await this.$store.dispatch("ALUMNAE_APPROVAL/FETCH_ALUMNAE");
            }
        },
        showInfo(alumni) {
            this.alumni = { ...alumni };
            this.$bvModal.show("modal-info");
        },
        async getData() {
            await this.$store.dispatch(
                "ALUMNAE_APPROVAL/FETCH_ALUMNAE",
                this.search
            );
        },
        setLoading() {
            this.loading = !this.loading;
        },

        async getApprovedID() {
            await axios
                .get(
                    `admin/get-approved-ID?token=${localStorage.getItem(
                        "access_token"
                    )}`
                )
                .then((res) => {
                    this.approvedData = res.data;
                });
        },
    },
    async mounted() {
        this.setLoading();
        this.getData();
        this.setLoading();
        this.getApprovedID();
    },
};
</script>
