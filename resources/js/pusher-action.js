Pusher.logToConsole = true;

let pusher = new Pusher("4bcc98f6c9321c69044d", {
	cluster: "us2",
	forceTLS: true
});

let channel = pusher.subscribe("notification-channel");

channel.bind("notification-event", function(data) {
	let notificationsWrapper = $(".dropdown-notifications");
	let notificationsToggle = notificationsWrapper.find("a[data-toggle]");
	let notificationsCountElem = notificationsToggle.find("i[data-count]");
	let notificationsCount = parseInt(notificationsCountElem.data("count"));
	let notifications = notificationsWrapper.find("ul#notification-list");
	let existingNotifications = notifications.html();

	console.log(data);

	let newNotificationHtml = `
	  <li class="notification active">
	      <div class="media">
	        <div class="media-left mr-3">
	          <div class="media-object">
	            <img src="${
					data.notification.picture
				}" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
	          </div>
	        </div>
	        <div class="media-body">
	          <strong class="notification-title">${
					data.notification.message
				}</strong>
	          <!--p class="notification-desc">Extra description can go here</p-->
	          <div class="notification-meta">
	            <small class="timestamp">${Moment(
					data.notification.date,
					"YYYY-MM-DD hh:mm:ss"
				).fromNow()}</small>
	          </div>
	        </div>
	      </div>
	  </li>
	`;
	notifications.html(newNotificationHtml + existingNotifications);

	notificationsCount++;
	notificationsCountElem.attr("data-count", notificationsCount);
	notificationsWrapper.find(".notif-count").text(notificationsCount);
	notificationsWrapper.show();
});
