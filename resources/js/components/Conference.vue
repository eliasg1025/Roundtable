<template>
	<section class="container video_conference_section">
		<div class="row">
			<div class="textoP col-sm-12">
				<p class="textoEdit">
					La videollamanda tendra una duración maxima de 30 minutos.
					No se olvide de calificar a la otra empresa al finalizar la
					llamanda (opcional)
				</p>
			</div>
			<div class="vi1 col-md-8">
				<div v-if="can_start">
					<iframe
						v-if="!expired"
						:src="
							`https://tokbox.com/embed/embed/ot-embed.js?embedId=503267cf-be36-4978-a8a2-bf187dd1d2b3&room=${room_code}&iframe=true`
						"
						scrolling="no"
						allow="microphone; camera"
						class="video_conference"
					></iframe>
					<div
						class="video_conference container text-center video-conference-placeholder"
						v-if="expired"
					>
						<h2>La videollamada ha expirado</h2>
					</div>
				</div>
				<div v-else>
					<div
						class="text-center jumbotron video_conference video-conference-placeholder"
					>
						<div class="video-conference-placeholder__item">
							<p class="h4">Disponible en:</p>
						</div>
						<div class="video-conference-placeholder__item">
							<span style="color: #88be2e; font-size: 60px;"
								><i class="fas fa-clock"></i
							></span>
						</div>
						<div class="video-conference-placeholder__item">
							<p class="h3">
								{{ countdown_days }} dias
								{{ countdown_hours }} horas
								{{ countdown_minutes }} minutos y
								{{ countdown_seconds }} segundos
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="tiempo1 col-md-4">
				<div class="card  tiempo" style="max-width: 100%">
					<div
						class="card-header"
						style="font-size:22px; font-family:'Nunito' sans-serif;"
					>
						<span class="deco">|</span> Tiempo total
					</div>
					<div class="cuerpoCard card-body">
						<div class="texto2 card-text" v-if="!can_start">
							<div class="reloj">
								<p id="minutos" class="minutos">20</p>
								<p>:</p>
								<p id="segundos" class="segundos">00</p>
							</div>
						</div>
						<div class="texto2 card-text" v-else>
							<countup-timer
								v-if="can_start"
								:expiration_date="expiration_date"
								:meeting_date="meeting.date"
								:meeting_id="meeting.id"
								@expired="expired = $event"
							>
							</countup-timer>
						</div>
					</div>
				</div>
			</div>
		</div>
		<Ratings :meeting="meeting"></Ratings>
	</section>
</template>

<script>
import CountupTimer from "./CountupTimer.vue";
import Ratings from "./Ratings.vue";
export default {
	components: {
		CountupTimer
	},
	props: ["meeting"],
	data() {
		return {
			can_start: false,
			countdown_date: "",
			countdown_days: "",
			countdown_hours: "",
			countdown_minutes: "",
			countdown_seconds: "",
			showCountdown: true,
			expired: false,
			room_code: ""
		};
	},
	computed: {
		expiration_date() {
			return new Date(
				new Date(this.meeting.date).getTime() +
					this.meeting.max_duration * 60 * 1000
			);
		}
	},
	mounted() {
		this.room_code = `${this.meeting.id}${this.meeting.sender_id}${this.meeting.receiver_id}`;

		let { date, timezone } = this.meeting;
		this.countdown_date = new Date(date).getTime();

		let interval = setInterval(() => {
			let distance = this.countdown_date - new Date().getTime();

			this.countdown_days = Math.floor(distance / (1000 * 60 * 60 * 24));
			this.countdown_hours = Math.floor(
				(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
			);
			this.countdown_minutes = Math.floor(
				(distance % (1000 * 60 * 60)) / (1000 * 60)
			);
			this.countdown_seconds = Math.floor(
				(distance % (1000 * 60)) / 1000
			);

			if (distance < 0) {
				clearInterval(interval);
				this.can_start = true;
			}
		}, 1000);
	}
};
</script>

<style lang="scss">
.video_conference_section {
	padding: 20px 0 150px 0;
}

.video_conference {
	width: 100%;
	height: 500px;
	border: 1px solid #ccc;
	border-radius: 5px;
}

.video-conference-placeholder {
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
}

.video-conference-placeholder__item {
	max-width: 100%;
}

.videos {
	/*width: 700px;
	height: 380px;*/

	/* width: 100%;s
	height: 380px;
	margin-top: 20px;
	border: 1px solid #9b9b93;
	position: relative;
	box-shadow: 1px 1px 11px #9e9e9e;*/
	flex: 0 0 100%;
	flex-grow: 0;
	flex-shrink: 0;
	flex-basis: 85%;
	max-width: 100%;
	height: 66%;
}
.vi1 {
	height: 400px;
}
.user-video {
	width: 100%;
	height: 380px;
	z-index: 1;
	position: relative;
	background: radial-gradient(#bcbec5 0%, #bcbcbc 51%, #9b9b93 100%);
}
/*.user-video{
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    background: radial-gradient(#bcbec5 0%, #bcbcbc 51%, #9b9b93 100%);
}*/
.textoP {
	width: 100%;
	margin: 35px 0px 25px 0px;
	font-size: 18px;
	font-family: "Nunito" sans-serif;
	background: radial-gradient(#e7e7e9 0%, #e8e8eb 51%, #e2e3e5 100%);
	border-radius: 0.23em;
}
.textoEdit {
	padding: 12px 20px 12px 20px;
	border: 1px solid transparent;
	font-family: "Nunito" sans-serif;
}

.textoT {
	padding: 12px 20px 12px 20px;
	border: 1px solid transparent;
}

/*.tiempo{
   margin: 20px 0px 25px 0px;
   
   font-size: 15px;
   font-weight: 400;
   background: radial-gradient(#dde5fc 0%, #cddefc 51%, #a8e3fa 100%);
   padding-right: 15px;
   padding-left: 15px;
    width: 100%;
    padding:12px 20px 12px 20px;
    font-size: 18px;
    font-family: 'Nunito' sans-serif;
    background:radial-gradient(#fcfdfd 0%, #d5e9f5 51%, #e7f5fc 100%);
    border-radius: 0.23em;

}*/
.tiempo1 {
	padding: 0px 0px 0px 0px;
}

.reloj {
	height: 1.5em;
	font-size: 4em;
	text-align: center;
	background-color: #e9ecef;
	border: 1px solid #ccc;
}
.reloj p {
	display: inline-block;
	line-height: 1em;
	font-size: 30px;
	align-content: center;
}
.my-video {
	/*165*/

	width: 165px;
	position: absolute;
	left: 75%;
	bottom: 75%;
	/*border: 2px solid #56ab2f;*/
	border-radius: 4px;
	z-index: 2;
	background: rgb(44, 44, 44);
}

.vi {
	width: 20px;
	margin: 17px;
}
.videos .esta {
	margin-top: 35%;
	margin-bottom: 0%;

	height: 22.5%;
	z-index: 2;
	position: relative;
	overflow: hidden;
}
.flecha {
	z-index: 4;
	position: relative;
	height: 25%;
}
.fle {
	margin-left: 48%;
	font-size: 1.5em;
	color: white;
	opacity: 0.1;
}
.caja1 {
	width: 100%;
	height: 100%;
	z-index: 3;
	position: absolute;
	transform: translate(0px, 56px);
	-ms-transform: translate(0%, 56px);
	-moz-transform: translate(0px, 56px);
	-webkit-transform: translate(0px, 56px);
	-o-transform: translate(0px, 56px);
	transition: all 500ms ease-in-out;
}

.caja1:hover {
	transform: translate(0%, 0%);
	-ms-transform: translate(0%, 0%);
	-moz-transform: translate(0%, 0%);
	-webkit-transform: translate(0%, 0%);
	-o-transform: translate(0%, 0%);
	transition: all 500ms ease-in-out;
}
.mover {
	margin-left: 35%;
}
.but1 {
	margin-left: 38%;
	border-radius: 35px;
	border: 0px;
	background-color: rgb(255, 255, 255);
	position: relative;
	z-index: 4;
}
.but2 {
	margin: 8px 5px 5px 5px;
	border-radius: 35px;
	border: 0px;
	background-color: rgb(255, 255, 255);
	position: relative;
	z-index: 4;
}
.but3 {
	margin: 8px 5px 5px 5px;
	border-radius: 35px;
	border: 0px;
	background-color: rgb(255, 255, 255);
	position: relative;
	z-index: 4;
}
.but4 {
	margin: 8px 5px 5px 5px;
	border-radius: 35px;
	border: 0px;
	background-color: rgb(185, 11, 46);
	position: relative;
	z-index: 4;
}
.deco {
	font-size: 1.5em;

	color: #88be2e;
}
.texto2 {
	text-align: center;
}
</style>
