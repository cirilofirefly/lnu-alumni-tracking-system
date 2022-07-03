<template>
    <div class="container-fluid vh-100">
        <div class="row d-flex justify-content-center rounded">
            <div class="col-8 bg-light p-5 shadow">
                <div class="mt-2 mb-3">
                    <h3>{{ event.name }}</h3>
                    <h6 class="text-muted">
                        {{
                            `${new Date(event.created_at).toLocaleString(
                                "en-US",
                                {
                                    weekday: "long",
                                    year: "numeric",
                                    month: "long",
                                    day: "numeric",
                                }
                            )} ${new Date(event.created_at).toLocaleTimeString(
                                "en-US"
                            )}`
                        }}
                    </h6>
                </div>
                <div
                    class="contents img-fluid col-6"
                    v-html="event.content"
                ></div>
            </div>
            <div class="col-8 p-5 shadow">
                <div id="comment-container" class="mt-2 mb-5">
                    <div
                        v-for="comment in event.comments"
                        :key="comment.id"
                        class="
                            d-flex
                            justify-content-start
                            align-items-stretch
                            my-2
                        "
                        style="cursor: pointer"
                        @click.prevent="showDelete(comment)"
                    >
                        <div class="col-1 my-auto img-container">
                            <img
                                width="70"
                                height="70"
                                :src="setImagePath(comment)"
                                class="
                                    img-fluid
                                    shadow
                                    rounded-circle
                                    align-baseline
                                "
                            />
                        </div>
                        <div class="col-11 mt-2 pe-5">
                            <p class="ps-3 text-justify">
                                {{ comment.comment }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="pt-4 d-flex align-items-center">
                    <div class="col-11">
                        <input
                            v-model="event_comment.comment"
                            placeholder="Write a comment..."
                            type="text"
                            class="form-control rounded-pill"
                        />
                    </div>
                    <div>
                        <button
                            class="btn btn-primary rounded-circle mx-2"
                            @click="postComment()"
                            :disabled="isSubmitting"
                        >
                            <box-icon
                                class="icon mt-1"
                                name="send"
                                color="#ffffff"
                            ></box-icon>
                        </button>
                    </div>
                </div>

                <b-modal
                    id="delete-comment"
                    title="Delete Comment"
                    @ok.prevent="deleteComment()"
                    ok-title="Delete"
                    :ok-disabled="isSubmitting"
                >
                    <p class="my-4 text-center">
                        Are you sure you want to delete this comment?
                    </p>
                    <div class="col-12 shadow p-3">
                        <p class="text-justify">{{ comment.comment }}</p>
                    </div>
                </b-modal>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import axios from "../../axios";
export default {
    props: ["slug"],
    components: {
        VueEditor,
    },
    data() {
        return {
            comment_id: 0,
            event_id: 0,
            comments: [
                {
                    id: 1,
                    user: "qweqweqwe",
                    comment:
                        "qweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqweqwe",
                },
                { id: 2, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 3, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 4, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 5, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 6, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 7, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 8, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 9, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 10, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 11, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
                { id: 12, user: "qweqweqwe", comment: "qweqweqweqweqweqweqwe" },
            ],
            isSubmitting: false,
            event_comment: { comment: "", event_id: 0, student_id: 0 },
            comment: {},
        };
    },
    computed: {
        event() {
            return this.$store.getters["STUDENT_EVENT/GET_EVENT"];
        },
        user() {
            return this.$store.getters["STUDENT_AUTH/GET_STUDENT_USER"];
        },
    },

    methods: {
        async postComment() {
            this.isSubmitting = !this.isSubmitting;
            this.event_comment.event_id = this.event.id;
            const response = await this.$store.dispatch(
                "STUDENT_EVENT/POST_COMMENT",
                this.event_comment
            );
            if (response.status == 200) {
                var full_name =
                    this.user[0].student.student_basic_info.first_name +
                    " " +
                    this.user[0].student.student_basic_info.middle_name.charAt(
                        0
                    ) +
                    ". " +
                    this.user[0].student.student_basic_info.last_name;

                var data = {
                    student_id: this.user[0].student.id,
                    action: full_name + " posted a comment on an event.",
                    notification_status: false,
                };

                await axios.post(`admin/notification`, data);
                this.isSubmitting = !this.isSubmitting;
                this.event.comments.push({ ...this.event_comment });
                this.event_comment.comment = "";
                this.scrollDown();
            }
        },

        async deleteComment() {
            this.isSubmitting = !this.isSubmitting;
            let data = {
                comment_id: this.comment_id,
                event_id: this.event_id,
            };
            const response = await this.$store.dispatch(
                "STUDENT_EVENT/DELETE_COMMENT",
                data
            );
            if (response.status == 200) {
                this.isSubmitting = !this.isSubmitting;
                if (this.event?.comments) {
                    await this.$store.dispatch(
                        "STUDENT_EVENT/FETCH_EVENT",
                        this.slug
                    );
                    await this.$bvModal.hide("delete-comment");
                    this.scrollDown();
                }
            }
        },
        showDelete(comment) {
            console.log(comment);
            this.comment = { ...comment };
            if (comment?.student) {
                if (this.user[0]?.student.id == comment.student.id) {
                    this.comment_id = comment.id;
                    this.event_id = comment.event_id;
                    this.$bvModal.show("delete-comment");
                }
            }
        },
        setImagePath(comment) {
            return comment?.student?.id_image
                ? `http://localhost:8000${comment.student?.id_image}`
                : `http://localhost:8000${this.user[0]?.student.id_image}`;
        },
        scrollDown() {
            var element = document.getElementById("comment-container");
            if (element) {
                element.scrollTop = element.scrollHeight;
            }
        },
    },
    async mounted() {
        await this.$store.dispatch("STUDENT_EVENT/FETCH_EVENT", this.slug);
        this.scrollDown();
    },
};
</script>

<style>
img,
svg {
    vertical-align: middle;
    width: 100% !important;
}
#comment-container {
    height: 40vh;
    overflow-y: scroll !important;
    scroll-behavior: smooth;
}

.img-container {
    height: 100%;
    display: flex;
    justify-content: flex-start;
}
.user-comment {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex-direction: column;
    height: fit-content;
}

.user-comment div p {
    font-size: 16px;
    white-space: nowrap;
}
</style>
