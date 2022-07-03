<template>
    <div>
        <div class="row">
            <div class="col">
                <h1>Student Event</h1>
                <p class="text-muted">All events will be shown here.</p>
            </div>
            <div class="col">
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
        <div class="col-12 mt-5">
            <div
                v-for="(event, index) in events"
                :key="index"
                class="col-12 p-3 bg-light shadow-lg rounded"
            >
                <div class="p-4">
                    <div v-if="event">
                        <h2 class="mb-2">{{ event.name }}</h2>
                        <h6 class="mb-2 text-muted">
                            {{ event.category.category }}
                        </h6>
                        <div class="mb-2" v-html="event.content"></div>
                        <button
                            class="btn btn-primary rounded"
                            @click="
                                $router.push({ path: `event/${event.slug}` })
                            "
                        >
                            View More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return { search: "" };
    },
    computed: {
        events() {
            return this.$store.getters["STUDENT_EVENT/GET_EVENTS"];
        },

        // filteredEvents() {
        //     return this.events.filter((data) => {
        //         return data.name.toLowerCase().includes(this.search);
        //     });
        // },
    },
    methods: {
        async getData() {
            await this.$store.dispatch(
                "STUDENT_EVENT/FETCH_EVENTS",
                this.search
            );
        },
    },
    async mounted() {
        this.getData();
    },
};
</script>

<style>
</style>
