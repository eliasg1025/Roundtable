<template>
    <section class="container">
        <div class="row">
            <div class="textoP col-sm-12" >
               <p class="textoEdit">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore ipsam officia sunt consectetur nostrum reprehenderit deleniti perspiciatis maxime optio, asperiores
                    sapiente eius obcaecati veniam rem distinctio magni laborum, debitis reiciendis.
                </p>
               
            </div>
        <div class="vi1 col-sm-8" >
            <div class="videos">
           <!-- <video id="localVideo" class="my-video" autoplay muted playsinline >
                </video>-->
            <video class="user-video" > 
                
            </video>
            <div class="esta">
            
            <div class="caja1" >
                <div class="flecha"><span class="fle fas fa-chevron-down"></span></div>
                <div class="mover">
                <button class="but2"><span class="vi fas fa-microphone-alt"></span></button>
                <button class="but4"><span class="vi fas fa-phone"></span></button>
                <button v-on:click="probar" class="but3"><span class="vi fas fa-video"></span></button>
                <button class="but1"><span class="vi fas fa-expand"></span></button>
                 </div>
                 </div>
            </div>
            </div>
            </div>
            <div class="tiempo1 col-sm-4">
            <div class="card  tiempo" style="max-width: 100%">
                <div class="card-header" style="font-size:22px; font-family:'Nunito' sans-serif;"><span class="deco">|</span> Tiempo total</div>
                <div class="cuerpoCard card-body">
                <div class="texto2 card-text">
                    <div class="reloj">
                        <p id="minutos" class="minutos">20</p>
                        <p>:</p>
                        <p id="segundos" class="segundos">36</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</template>

<script>
import { Stream } from 'stream';


export  default{
      
    data(){
        return{
           start:'',
           localVideo:'',
        }
    },
    mounted(){
        this.start=$('#start');
        this.localVideo=$('#localVideo');
    },
    methods:{
        
        gotStream(Stream) {
              this.trace('Received local stream');
              /*this.localVideo.srcObject = stream;*/
            try {
                this.localVideo.srcObject = stream;
                localStream = stream;
                this.localVideo=('loadedmetadata', function() {
                 this.trace('Local video videoWidth: ' + this.videoWidth +
                'px,  videoHeight: ' + this.videoHeight + 'px');
                 });
            } catch (error) {
                this.src = window.URL.createObjectURL(stream);
            }
              
             /*callButton.disabled = false;*/
        },
        empezar: function(){
            this.trace('Requesting local stream');
            navigator.mediaDevices.getUserMedia({video: true, audio: true})
               .then(this.gotStream)
                .catch(function(e) {
                    alert('getUserMedia() error: ' + e.name);
                })
                
              
        },
        probar: function () {
         console.log("Hola mundo1");   
        },
        trace(arg) {
            var now = (window.performance.now() / 1000).toFixed(3);
            console.log(now + ': ', arg);
        }
    },
}
</script>

<style>
.videos{
  /*width: 700px;
  height: 380px;*/
 
 /* width: 100%;
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
.vi1{
   height: 400px; 
}
.user-video{
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
.textoP{
    width: 100%;
    margin: 35px 0px 25px 0px;
    font-size: 18px;
    font-family: 'Nunito' sans-serif;
    background:radial-gradient(#e7e7e9 0%, #e8e8eb 51%, #e2e3e5 100%);
    border-radius: 0.23em;
    
}
.textoEdit{
    padding:12px 20px 12px 20px;
    border: 1px solid transparent;
    font-family: 'Nunito' sans-serif;
    
}

.textoT{
   padding:12px 20px 12px 20px;
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
.tiempo1{
    padding:0px 0px 0px 0px;
}

.reloj{
    font-family: Arial, Helvetica, sans-serif;
    width: 80%;
    height: 1.5em;
    font-size: 4em;
    text-align: center;
    background: rgba(0, 0, 0, .2);
    
}
.reloj p{
    display: inline-block;
    line-height: 1em;
    font-size: 30px;
    color: white;
    margin: 0px 0px 0px 0px;
    align-content: center;

}
.my-video{
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

.vi{
    width: 20px;
    margin: 17px;
}
.videos .esta{
    margin-top:35%;
    margin-bottom: 0%;
    
    height: 22.5%;
    z-index: 2;
    position: relative;
    overflow: hidden;    
}
.flecha{
    z-index: 4;
    position: relative;
    height: 25%;
    
}
.fle{
    margin-left: 48%;
    font-size: 1.5em;
    color:white;
    opacity: 0.1;
}
.caja1{
    width: 100%;
    height: 100%;
    z-index: 3;
    position: absolute;
    transform:translate(0px,56px);
    -ms-transform:translate(0%,56px); 
    -moz-transform:translate(0px,56px); 
    -webkit-transform:translate(0px,56px); 
    -o-transform:translate(0px,56px);
    transition: all 500ms ease-in-out; 
   }

.caja1:hover{
    transform:translate(0%,0%);
   -ms-transform:translate(0%,0%); 
   -moz-transform:translate(0%,0%); 
   -webkit-transform:translate(0%,0%);
   -o-transform:translate(0%,0%); 
   transition: all 500ms ease-in-out; 
   
}
.mover{
    margin-left: 35%;
}
.but1{
    margin-left: 38%;
    border-radius: 35px;
    border: 0px;   
    background-color: rgb(255, 255, 255); 
    position: relative;
    z-index: 4;    
}
.but2{
    margin: 8px 5px 5px 5px;
    border-radius: 35px;
    border: 0px;  
    background-color:rgb(255, 255, 255);     
     position: relative;
    z-index: 4;
}
.but3{
    margin: 8px 5px 5px 5px;
    border-radius: 35px;
    border: 0px; 
     background-color: rgb(255, 255, 255); 
    position: relative;
    z-index: 4;
}
.but4{
    margin: 8px 5px 5px 5px;
    border-radius: 35px;
    border: 0px; 
    background-color: rgb(185, 11, 46);  
    position: relative;
    z-index: 4;
}
.deco{
    font-size: 1.5em;

    color: #88be2e;
}
.texto2{
     text-align: center;
}

</style>