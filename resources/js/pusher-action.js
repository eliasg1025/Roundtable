let notificationsWrapper   = $('.dropdown-notifications');
let notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
let notificationsCountElem = notificationsToggle.find('i[data-count]');
let notificationsCount     = parseInt(notificationsCountElem.data('count'));
let notifications = notificationsWrapper.find('ul#notification-list');


Pusher.logToConsole = true;

let pusher = new Pusher('4bcc98f6c9321c69044d', {
	cluster: 'us2',
	forceTLS: true
});

let channel = pusher.subscribe('test-channel');

channel.bind('test-event', function(data) {
	let existingNotifications = notifications.html();
	let avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
	let newNotificationHtml = `
	  <li class="notification active">
	      <div class="media">
	        <div class="media-left">
	          <div class="media-object">
	            <img src="https://api.adorable.io/avatars/71/${avatar}.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
	          </div>
	        </div>
	        <div class="media-body">
	          <strong class="notification-title">${data.message}</strong>
	          <!--p class="notification-desc">Extra description can go here</p-->
	          <div class="notification-meta">
	            <small class="timestamp">about a minute ago</small>
	          </div>
	        </div>
	      </div>
	  </li>
	`;
	notifications.html(newNotificationHtml + existingNotifications);

	notificationsCount += 1;
	notificationsCountElem.attr('data-count', notificationsCount);
	notificationsWrapper.find('.notif-count').text(notificationsCount);
	notificationsWrapper.show();
});
