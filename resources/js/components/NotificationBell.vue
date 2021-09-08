<template>
	<a id="notificationDropdown" href="#" role="button" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i data-count="0" class="notification-icon fas fa-bell" style="font-size: 16px;"></i>
	</a>
</template>

<script>
    export default {
        name: "notification_bell",
        mounted() {
            let notifications_data = [];

            axios
                .get("/profile/messages")
                .then(res => {
                    notifications_data = res.data.data;

                    let notificationsWrapper = $(".dropdown-notifications");
                    let notificationsToggle = notificationsWrapper.find("a[data-toggle]");
                    let notificationsCountElem = notificationsToggle.find("i[data-count]");
                    let notifications = notificationsWrapper.find("ul#notification-list");

                    notifications_data.forEach(element => {
                        let existingNotifications = notifications.html();
                        let picture = element.message.customImage
                            ? element.message.customImage
                            : element.type_message.picture;
                        let newNotificationHtml = `
                            <li class="notification active">
                                <div class="media">
                                <div class="media-left mr-3">
                                    <div class="media-object">
                                    <img src="${picture}" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <strong class="notification-title">${element.message.message}</strong>
                                    <!--p class="notification-desc">${element.message.message}</p-->
                                    <div class="notification-meta">
                                    <small class="timestamp">${Moment(
                                        element.message.date,
                                        "YYYY-MM-DD hh:mm:ss"
                                    ).fromNow()}</small>
                                    </div>
                                </div>
                                </div>
                            </li>
                        `;
                        notifications.html(existingNotifications + newNotificationHtml);
                    });
                    notificationsCountElem.attr("data-count", notifications_data.length);
                    notificationsWrapper.find(".notif-count").text(notifications_data.length);
                    notificationsWrapper.show();
                })
                .catch(err => {
                    console.log(err.response);
                });
        }
    }
</script>

<style scoped>

</style>
