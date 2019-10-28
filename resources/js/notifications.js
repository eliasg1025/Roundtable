let notifications_data = [];

axios.get('/profile/messages')
	.then(res => {
		notifications_data = res.data.data;


		let notificationsWrapper   = $('.dropdown-notifications');
		let notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
		let notificationsCountElem = notificationsToggle.find('i[data-count]');
		let notifications = notificationsWrapper.find('ul#notification-list');

		notifications_data.forEach(element => {
			let existingNotifications = notifications.html();
			let newNotificationHtml = `
				<li class="notification active">
					<div class="media">
					<div class="media-left mr-3">
						<div class="media-object">
						<img src="${element.type_message.picture}" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
						</div>
					</div>
					<div class="media-body">
						<strong class="notification-title">${element.message.message}</strong>
						<!--p class="notification-desc">${element.message.message}</p-->
						<div class="notification-meta">
						<small class="timestamp">${Moment(element.message.date, "YYYY-MM-DD hh:mm:ss").fromNow()}</small>
						</div>
					</div>
					</div>
				</li>
			`;
			notifications.html(existingNotifications + newNotificationHtml);
		});
		notificationsCountElem.attr('data-count', notifications_data.length);
		notificationsWrapper.find('.notif-count').text(notifications_data.length);
		notificationsWrapper.show();
	})
	.catch(err => {
		console.log(err.response);
	})
