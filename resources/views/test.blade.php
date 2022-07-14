<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown dropdown-notifications">
						<a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
							<i data-count="0" class="glyphicon glyphicon-bell notification-icon" id="co"></i>
						</a>
						<div class="dropdown-container">
							<div class="dropdown-toolbar">
								<div class="dropdown-toolbar-actions">
										<a href="#">Mark all as read</a>
								</div>
								<h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
							</div>
							<ul class="dropdown-menu">
							</ul>
							<div class="dropdown-footer text-center">
								<a href="#">View All</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
<script type="text/javascript">
		var notificationsWrapper   = $('.dropdown-notifications');
		var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
		var notificationsCountElem = notificationsToggle.find('i[data-count]');
		var notificationsCount     = parseInt(notificationsCountElem.data('count'));
		var notifications          = notificationsWrapper.find('ul.dropdown-menu');

		// Enable pusher logging - don't include this in production
		Pusher.logToConsole = true;

		var pusher = new Pusher('cdd83fa5348e5bc3e9e7', {
			cluster: 'ap1',
			// forceTLS: true
			encrypted: true
		});

		// Subscribe to the channel we specified in our Laravel Event
		var channel = pusher.subscribe('my-channel');

		// Bind a function to a Event (the full Laravel class)
		channel.bind('form-submit', function(data) {
			var existingNotifications = notifications.html();
			var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
			var newNotificationHtml = `
				<li class="notification active">
					<div class="media">
						<div class="media-left">
							<div class="media-object">
								<img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
							</div>
						</div>
						<div class="media-body">
							<strong class="notification-title">`+data.name+`</strong>
							<p class="notification-desc">`+data.comment1+`</p>
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
			$('#name').text();
		});
</script>