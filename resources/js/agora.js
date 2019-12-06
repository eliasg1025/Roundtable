import AgoraRTC from "./AgoraRTCSDK-2.9.0";
console.log(
	"agora sdk version: " +
		AgoraRTC.VERSION +
		" compatible: " +
		AgoraRTC.checkSystemRequirements()
);
let resolutions = [
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

function addView(id, show) {
	if (!$("#" + id)[0]) {
		$("<div/>", {
			id: "remote_video_panel_" + id,
			class: "video-view"
		}).appendTo("#video");

		$("<div/>", {
			id: "remote_video_" + id,
			class: "video-placeholder"
		}).appendTo("#remote_video_panel_" + id);

		$("<div/>", {
			id: "remote_video_info_" + id,
			class: "video-profile " + (show ? "" : "hide")
		}).appendTo("#remote_video_panel_" + id);

		$("<div/>", {
			id: "video_autoplay_" + id,
			class: "autoplay-fallback hide"
		}).appendTo("#remote_video_panel_" + id);
	}
}

function removeView(id) {
	if ($("#remote_video_panel_" + id)[0]) {
		$("#remote_video_panel_" + id).remove();
	}
}

function getDevices(next) {
	AgoraRTC.getDevices(function(items) {
		items
			.filter(function(item) {
				return ["audioinput", "videoinput"].indexOf(item.kind) !== -1;
			})
			.map(function(item) {
				return {
					name: item.label,
					value: item.deviceId,
					kind: item.kind
				};
			});
		var videos = [];
		var audios = [];
		for (var i = 0; i < items.length; i++) {
			var item = items[i];
			if ("videoinput" == item.kind) {
				var name = item.label;
				var value = item.deviceId;
				if (!name) {
					name = "camera-" + videos.length;
				}
				videos.push({
					name: name,
					value: value,
					kind: item.kind
				});
			}
			if ("audioinput" == item.kind) {
				var name = item.label;
				var value = item.deviceId;
				if (!name) {
					name = "microphone-" + audios.length;
				}
				audios.push({
					name: name,
					value: value,
					kind: item.kind
				});
			}
		}
		next({ videos: videos, audios: audios });
	});
}

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
	token: // token temporal -> dura 24 h
		"00608c43035aef54e1fa740d90e157192d8IADwmkyL2l/2BeiggObPWw0T/Rw1M+WPlZmXiCXp8GT4nwx+f9gAAAAAEAAjQkIN/oroXQEAAQD+iuhd"
};

function handleEvents(rtc) {
	// Occurs when an error message is reported and requires error handling.
	rtc.client.on("error", err => {
		console.log(err);
	});
	// Occurs when the peer user leaves the channel; for example, the peer user calls Client.leave.
	rtc.client.on("peer-leave", function(evt) {
		var id = evt.uid;
		console.log("id", evt);
		if (id != rtc.params.uid) {
			removeView(id);
		}
		//Toast.notice("peer leave");
		console.log("peer-leave", id);
	});
	// Occurs when the local stream is published.
	rtc.client.on("stream-published", function(evt) {
		//Toast.notice("stream published success");
		console.log("stream-published");
	});
	// Occurs when the remote stream is added.
	rtc.client.on("stream-added", function(evt) {
		var remoteStream = evt.stream;
		var id = remoteStream.getId();
		//Toast.info("stream-added uid: " + id);
		if (id !== rtc.params.uid) {
			rtc.client.subscribe(remoteStream, function(err) {
				console.log("stream subscribe failed", err);
			});
		}
		console.log("stream-added remote-uid: ", id);
	});
	// Occurs when a user subscribes to a remote stream.
	rtc.client.on("stream-subscribed", function(evt) {
		var remoteStream = evt.stream;
		var id = remoteStream.getId();
		rtc.remoteStreams.push(remoteStream);
		addView(id);
		remoteStream.play("remote_video_" + id);
		//Toast.info("stream-subscribed remote-uid: " + id);
		console.log("stream-subscribed remote-uid: ", id);
	});
	// Occurs when the remote stream is removed; for example, a peer user calls Client.unpublish.
	rtc.client.on("stream-removed", function(evt) {
		var remoteStream = evt.stream;
		var id = remoteStream.getId();
		//Toast.info("stream-removed uid: " + id);
		remoteStream.stop("remote_video_" + id);
		rtc.remoteStreams = rtc.remoteStreams.filter(function(stream) {
			return stream.getId() !== id;
		});
		removeView(id);
		console.log("stream-removed remote-uid: ", id);
	});
	rtc.client.on("onTokenPrivilegeWillExpire", function() {
		// After requesting a new token
		// rtc.client.renewToken(token);
		//Toast.info("onTokenPrivilegeWillExpire");
		console.log("onTokenPrivilegeWillExpire");
	});
	rtc.client.on("onTokenPrivilegeDidExpire", function() {
		// After requesting a new token
		// client.renewToken(token);
		//Toast.info("onTokenPrivilegeDidExpire");
		console.log("onTokenPrivilegeDidExpire");
	});
}

// Create a client
rtc.client = AgoraRTC.createClient({ mode: "rtc", codec: "h264" });

// Handle AgoraRTC client event
handleEvents(rtc);

// Initialize the client
rtc.client.init(
	option.appID,
	function() {
		console.log("init success");

		// Join a channel
		rtc.client.join(
			option.token ? option.token : null,
			option.channel,
			option.uid ? +option.uid : null,
			function(uid) {
				console.log(
					"join channel: " + option.channel + " success, uid: " + uid
				);
				rtc.joined = true;
				rtc.params.uid = uid;

				// create local stream
				rtc.localStream = AgoraRTC.createStream({
					streamID: rtc.params.uid,
					audio: true,
					video: true,
					screen: false,
					microphoneId: option.microphoneId,
					cameraId: option.cameraId
				});

				// init local stream
				rtc.localStream.init(
					function() {
						console.log("init local stream success");
						// play stream with html element id "local_stream"
						rtc.localStream.play("local_stream");

						// publish local stream
						publish(rtc);
					},
					function(err) {
						/*
						Toast.error(
							"stream init failed, please open console see more detail"
						);*/
						console.error("init local stream failed ", err);
					}
				);
			},
			function(err) {
				console.error("client join failed", err);
			}
		);
	},
	err => {
		console.error(err);
	}
);

function publish(rtc) {
	if (!rtc.client) {
		console.info("Please Join Room First");
		return;
	}
	if (rtc.published) {
		console.info("You're already published");
	}
	let oldState = rtc.published;

	// Publish localStream
	rtc.client.publish(rtc.localStream, err => {
		rtc.published = oldState;
		console.warn("Publish failed");
		console.error(err);
	});
	alert("PUBLISH");
	rtc.published = true;
}

function unpublish(rtc) {
	if (!rtc.client) {
		console.info("Please Join Room First");
		return;
	}
	if (!rtc.published) {
		console.info("Your didn't published");
	}
	let oldState = rtc.published;
	rtc.client.unpublish(rtc.localStream, err => {
		rtc.published = oldState;
		console.warn("Unpublish failed");
		console.error(err);
	});
	alert("UNPUBLISH");
	rtc.published = false;
}

function leave(rtc) {
	if (!rtc.client) {
		console.info("Please Join First!");
		return;
	}
	if (!rtc.joined) {
		console.info("You are not in channel");
		return;
	}

	rtc.client.leave(
		function() {
			// Stop stream
			rtc.localStream.stop();
			// Close stream
			rtc.localStream.close();

			while (rtc.remoteStreams.length > 0) {
				let stream = rtc.remoteStreams.shift();
				let id = stream.getId();
				stream.stop();
				removeView(id);
			}
			rtc.localStream = null;
			rtc.remoteStreams = [];
			rtc.client = null;
			console.log("client leaves channel success");
			rtc.published = false;
			rtc.joined = false;
			alert("leave success");
		},
		function(err) {
			console.log("channel leave failed");
			alert("leave success");
			console.error(err);
		}
	);
}

$(() => {
	getDevices(devices => {
		devices.audios.forEach(audio => {
			$("<option/>", {
				value: audio.value,
				text: audio.name
			}).appendTo("#microphoneId");
		});
		devices.videos.forEach(video => {
			$("<option/>", {
				value: video.value,
				text: video.name
			}).appendTo("#cameraId");
		});
		resolutions.forEach(resolution => {
			$("<option/>", {
				value: resolution.value,
				text: resolution.name
			}).appendTo("#cameraResolution");
		});
	});

	$("#join").on("click", function(e) {
		console.log("join");
		e.preventDefault();
		join(rtc, option);
	});

	$("#publish").on("click", function(e) {
		console.log("publish");
		e.preventDefault();
		publish(rtc);
	});

	$("#unpublish").on("click", function(e) {
		console.log("unpublish");
		e.preventDefault();
		unpublish(rtc);
	});

	$("#leave").on("click", function(e) {
		console.log("leave");
		e.preventDefault();
		leave(rtc);
	});
});
