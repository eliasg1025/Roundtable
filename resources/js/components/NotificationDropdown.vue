<template>
	<div class="dropdown-menu notification-menu-right" aria-labelledby="#notificationDropdown">
		<div class="dropdown-toolbar">
			<div class="dropdown-toolbar-actions" style="display: none;">
				<a href="#">Mark all as read</a>
			</div>
			<h5 class="dropdown-toolbar-title">Notificaciones (<span class="notif-count">0</span>)</h5>
		</div>
		<ul id="notification-list" class="scrollable-menu-lg"></ul>
		<div class="dropdown-footer text-center">
			<a href="#">Ver todo</a>
		</div>
	</div>
</template>

<script>
    export default {
        name: "notification_dropdown"
    }
</script>

<style scoped>

</style>
