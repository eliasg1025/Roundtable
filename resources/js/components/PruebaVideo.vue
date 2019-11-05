<template>
    <section class="container">
        <div class="row">
            <div class="textoP col-sm-12" >
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore ipsam officia sunt consectetur nostrum reprehenderit deleniti perspiciatis maxime optio, asperiores
                    sapiente eius obcaecati veniam rem distinctio magni laborum, debitis reiciendis.
                </p>
            </div>
        <div class="videos col-sm-9">
            <video id="localVideo" class="my-video" autoplay muted playsinline >
                </video>
            <video class="user-video" > </video>
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
            <div class="cajaT col-sm-3" >
                <div class="tiempo">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius harum vitae nihil totam minus aliquam et nulla reiciendis a quisquam! Alias dolores facilis iure vero praesentium repellat ipsum beatae magni nulla dignissimos. Ex beatae iusto provident illum dicta quibusdam. Aperiam saepe cupiditate incidunt voluptatibus iure voluptate recusandae quibusdam adipisci in itaque rerum nostrum ea ab officiis ipsum dolore provident corrupti, voluptatum eligendi vel. Illo ab veniam quam fugiat doloribus eius in illum placeat? Officiis natus repudiandae non iste atque dignissimos eaque, praesentium quam voluptatibus inventore quasi alias ab voluptate hic nemo omnis ipsum fuga eligendi, excepturi ea a nisi at.</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { Stream } from 'stream';


export  default{
    //No olvidar que la videollamada se debe autoretomar la conversación
    //cuando se corte la conexión por problemas de red
    
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
  width: 100%;
  height: 380px;
  margin-top: 20px;
  border: 1px solid #9b9b93;
  position: relative;
  box-shadow: 1px 1px 11px #9e9e9e;
  
}
.textoP{
    margin-top: 20px;
    font-size: 18px;
    font-family: "trebuchet MS";
    background:radial-gradient(#bbc7f0 0%, #96b8f7 51%, #7a91fa 100%);
    border-radius: 7px;
}
.tiempo{
   margin-top: 20px;
   font-size: 16px;
   font-weight: 400;
   background: radial-gradient(#dde5fc 0%, #cddefc 51%, #a8e3fa 100%);
   padding-right: 15px;
   padding-left: 15px;
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
.user-video{
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    background: radial-gradient(#bcbec5 0%, #bcbcbc 51%, #9b9b93 100%);
}
/*.vi{
    width: 20px;
    margin: 17px;
}*/
.esta{
    margin-top:42%;
    width: 100%;
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
/*@media screen and(max-width: 1024px) {
   .videos{
    width: 100%;
    height: 380px;
   }
   

}*/
/*@media screen and (max-width: 1024px){
    .videos{
    /*flex: 0 0 100%;
    flex-grow: 0;
    flex-shrink: 0;
    flex-basis: 700px;
    max-width: 100%;*/
   /* width: 100%;
    margin: 10px 10px 15px 10px;
    }
    
    
}*/
@media (min-width: 1024px){
    .videos {
    flex: 0 0 75%;
    max-width: 100%;
    
    }
   

}


</style>