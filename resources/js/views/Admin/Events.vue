<template>
  <div class="container-fluid">
    <div class="row p-5">
      <div class="col-12">
        <h1 class="text-uppercase fw-bold">
          Event Management
        </h1>
      </div>
      <div class="col-12 mt-3 shadow-sm p-3 bg-light">
        <div class="mb-5 mt-2">
          <button
            class="btn btn-success mx-2"
            @click="resetInput"
            v-b-modal.modal-add
          >
            <i class="bi bi-plus"></i> Add Event
          </button>
          <button class="btn btn-success">
            <i class="bi bi-journal-text"></i> View all events
          </button>
        </div>
        <div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col" class="text-center">Content</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
                <div v-if="loading" class="mt-2 float-center mx-auto">
                    <span>Loading Data...</span>
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
			  </div>
              <tr v-else v-for="(event, index) in events" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ event.name }}</td>
                <td>{{ event.category.category }}</td>
                <td class="text-center">
                  <button @click="$router.push({ path: `event/${event.slug}` })" style="width: 100px" class="btn btn-success mx-2">
                    <i class="bi bi-eye-fill"></i> View
                  </button>
                </td>
                <td class="text-center">
                  <button
                    class="btn btn-primary"
                    @click.prevent="
                      id = event.id;
                      eventInfo = { ...event };
                      $bvModal.show('modal-update');
                    "
                  >
                    <i class="bi bi-pencil-square"></i> Edit</button
                  ><button
                    style="width: 100px"
                    class="btn btn-danger mx-2"
                    @click.prevent="
                      id = event.id;
                      $bvModal.show('modal-delete');
                    "
                  >
                    <i class="bi bi-trash3-fill"></i> Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>

          <p><strong>Total Entries: </strong> {{ events.length }}</p>

          <b-modal
            id="modal-add"
            size="lg"
            centered
            @cancel="resetInput()"
            @ok.prevent="storeEvent"
            title="Add Event"
            ok-title="Add Event"
          >
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input
                      type="text"
                      v-model="eventInfo.name"
                      class="form-control"
                      id="event-name"
                      placeholder="Event Name"
                    />
                    <label for="event-name">Event Name</label>
                  </div>
                  <div class="mb-3">
                    <label for="category">Category</label>
                    <select
                      v-model="eventInfo.category_id"
                      id="category"
                      class="form-select"
                      aria-label=".form-select-lg example"
                    >
                      <option :value="null">-- Select an option --</option>
                      <option
                        :value="category.id"
                        v-for="category in categories"
                        :key="category.id"
                      >
                        {{ category.category }}
                      </option>
                    </select>
                  </div>
                  <div>
                    <vue-editor v-model="eventInfo.content" />
                  </div>
                </div>
              </div>
            </div>
          </b-modal>

          <b-modal
            id="modal-update"
            size="lg"
            centered
            title="Update Event"
            @cancel="
              id = null;
              resetInput();
            "
            ok-title="Update Event"
            @ok="updateEvent"
            ok-variant="warning"
          >
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input
                      type="text"
                      class="form-control"
                      v-model="eventInfo.name"
                      id="event-name"
                      placeholder="Event Name"
                    />
                    <label for="event-name">Event Name</label>
                  </div>
                  <div class="mb-3">
                    <select
                      class="form-select"
                      aria-label=".form-select-lg example"
                      v-model="eventInfo.category_id"
                    >
                      <option :value="null">-- Select an option --</option>
                      <option
                        :value="category.id"
                        v-for="category in categories"
                        :key="category.id"
                      >
                        {{ category.category }}
                      </option>
                    </select>
                  </div>
                  <div>
                    <vue-editor v-model="eventInfo.content" />
                  </div>
                </div>
              </div>
            </div>
          </b-modal>

          <b-modal
            id="modal-delete"
            title="Delete Event"
            ok-variant="danger"
            ok-title="Delete"
            @ok="deleteEvent"
            @cancel="id = null"
          >
            <div class="container-fluid">
              <div class="row">
                <p class="text-center">
                  Are you sure you want to continue this action? <br />
                  Click "Cancel" button to cancel the action
                </p>
              </div>
            </div>
          </b-modal>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
  components: { VueEditor },
  data() {
    return {
      sampletext: "sample text that the length is greater than 5 kape kape",
      id: null,
      eventInfo: {
        name: "",
        content: "",
        category_id: null,
      },
      loading: false
    };
  },
  computed: {
    categories() {
      return this.$store.getters["ADMIN_CATEGORIES/GET_CATEGORIES"];
    },
    events() {
      return this.$store.getters["ADMIN_EVENT/GET_EVENTS"];
    },
  },
  methods: {
    async storeEvent() {
      
      const response = await this.$store.dispatch(
        "ADMIN_EVENT/STORE_EVENT",
        this.eventInfo
      );

      if (response.status == 200) {
        this.$bvModal.hide("modal-add");
        this.$toast.success(response.data.message);
        await this.$store.dispatch("ADMIN_EVENT/FETCH_EVENTS");
      }
      if (response.status == 500) {
        this.$toast.error(response.data.error);
      }
    },
    async updateEvent() {
      const response = await this.$store.dispatch("ADMIN_EVENT/UPDATE_EVENT", {
        id: this.id,
        data: this.eventInfo,
      });

      if (response.status == 200) {
        this.$bvModal.hide("modal-update");
        this.$toast.success(response.data.message);
        await this.$store.dispatch("ADMIN_EVENT/FETCH_EVENTS");
      }
    },
    async deleteEvent() {
      const response = await this.$store.dispatch(
        "ADMIN_EVENT/DELETE_EVENT",
        this.id
      );

      if (response.status == 200) {
        this.$bvModal.hide("modal-update");
        this.$toast.success(response.data.message);
        await this.$store.dispatch("ADMIN_EVENT/FETCH_EVENTS");
      }
    },
    resetInput() {
      this.eventInfo = {
        name: "",
        content: "",
        category_id: null,
      };
    },
    setLoading() {
        this.loading = !this.loading
    }
  },
  async mounted() {
      this.setLoading()
    await this.$store.dispatch("ADMIN_CATEGORIES/FETCH_CATEGORIES");
    await this.$store.dispatch("ADMIN_EVENT/FETCH_EVENTS");
      this.setLoading()

  },
};
</script>