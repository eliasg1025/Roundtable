<template>
	<div>Conferencia</div>
</template>

<script>
export default {
	mounted() {
		console.log(
			"agora sdk version: " +
				AgoraRTC.VERSION +
				" compatible: " +
				AgoraRTC.checkSystemRequirements()
		);
		var resolutions = [
			{
				name: "default",
				value: "default"
			},
			{
				name: "480p",
				value: "480p"
			},
			{
				name: "720p",
				value: "720p"
			},
			{
				name: "1080p",
				value: "1080p"
			}
		];
		let rtc = {
			client: null,
			joined: false,
			published: false,
			localStream: null,
			remoteStreams: [],
			params: {}
		};

		let option = {
			appID: "08c43035aef54e1fa740d90e157192d8",
			channel: "test",
			uid: null,
			token:
				"00608c43035aef54e1fa740d90e157192d8IAA0jHqKebmSrpQlpLbzWX8bRi+BOqk8dnff16JiNt1ZwAx+f9gAAAAAEADrarcACpzhXQEAAQAKnOFd"
		};

		// Create a client
		rtc.client = AgoraRTC.createClient({ mode: "rtc", codec: "h264" });

		// Initialize the client
		rtc.client.init(
			option.appID,
			function() {
				console.log("init success");
			},
			err => {
				console.error(err);
			}
		);

		// Join a channel
		rtc.client.join(
			option.token ? option.token : null,
			option.channel,
			option.uid ? +option.uid : null,
			function(uid) {
				console.log(
					"join channel: " + option.channel + " success, uid: " + uid
				);
				rtc.params.uid = uid;
			},
			function(err) {
				console.error("client join failed", err);
			}
		);
	}
};
</script>

<style></style>
