<template>
    <section>
        <div class="videos">
            <video v-show="videoUsu" class="my-video"></video>
            <video class="user-video"></video>
        </div>
        <div>
            <button v-on:click="empezar" id="start">Botón de inicio</button>
        </div>
    </section>
</template>

<script>

export  default{
    //No olvidar que la videollamada se debe autoretomar la conversación
    //cuando se corte la conexión por problemas de red
    data(){
        return{
           start:'',
        }
    },
    mounted(){
        this.start=$('#start');
    },
    methods:{
        empezar: function(){
          this.start.disabled=true
             navigator.mediaDevices.getUserMedia({video: true, audio: true})
             .then(gotStream)
                .catch(function(e) {
                    alert('getUserMedia() error: ' + e.name);
                })  

        },
        videoUsu:function() {
            localVideo.addEventListener('loadedmetadata', function() {
                trace('Local video videoWidth: ' + this.videoWidth +
                'px,  videoHeight: ' + this.videoHeight + 'px');
            });
        }
    },
}
</script>

<style>
.videos{
  width: 500px;
  height: 380px;
  margin: 30px auto;
  border: 1px solid #56ab2f;
  position: relative;
  box-shadow: 1px 1px 11px #9e9e9e;
}

.my-video{
    width: 130px;
    position: absolute;
    left: 10px;
    bottom: 10px;
    border: 2px solid #56ab2f;
    border-radius: 4px;
    z-index: 2;
}
.user-video{
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}
</style>