<template>
    <div class="container-fluid">
        <div class="row p-5">
            <div class="col-12 p-4">
                <h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
                    Notification
                </h1>
            </div>
        </div>
        <div class="container" style="margin-top: -5%">
            <div
                class="container"
                v-for="(notification, index) in notifications"
                :key="index"
            >
                <div
                    class="talk-bubble"
                    v-if="notification.notification_status == 0"
                    style="
                        margin-left: 10%;
                        margin-top: 10px;
                        display: inline-block;
                        width: 70%;
                        border: 2px solid;
                        padding: 10px;
                        border-radius: 25px;
                        border-color: black;
                        background-color: lightyellow;
                    "
                >
                    <div
                        class="talktext"
                        style="
                            padding: 1em;
                            text-align: left;
                            line-height: 1.5em;
                        "
                    >
                        {{ notification.action }}
                    </div>
                </div>
                <div
                    class="talk-bubble"
                    v-if="notification.notification_status == 1"
                    style="
                        margin-left: 10%;
                        margin-top: 10px;
                        display: inline-block;
                        width: 70%;
                        border: 2px solid;
                        padding: 10px;
                        border-radius: 25px;
                        border-color: black;
                        background-color: white;
                    "
                >
                    <div
                        class="talktext"
                        style="
                            padding: 1em;
                            text-align: left;
                            line-height: 1.5em;
                        "
                    >
                        {{ notification.action }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "../../axios";
export default {
    data() {
        return { notifications: "" };
    },

    async mounted() {
        await axios.get(`admin/get-notification`).then((res) => {
            this.notifications = res.data;
        });
    },
};
</script>

