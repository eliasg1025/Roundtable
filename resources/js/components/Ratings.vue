<template>
    <div>

        <div
                class="p-3 mt-2"
                data-toggle="modal"
                data-target="#addModal"
                style="height: 100%; display: flex; align-items: center; justify-content: center;"
        >
            <button class="btn btn-add" style="width: 50%;">
                <i class="fas fa-plus"></i> Agregar Ratings
            </button>
        </div>

        <div
			class="modal fade"
		    id="addModal"
			tabindex="-1"
			role="dialog"
			aria-labelledby="addAvalibleModal"
			aria-hidden="true"
		>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addAvalibleModalLabel">
						Califica al usuario
							</h5>							
				    </div>
					<div class="modal-body p-4">
						<div class="row">
							<star-rating  :increment="0.5" text-class="custom-text"></star-rating>
						</div>
						<div >
							<button @click="EnviaCalif" class="btn btn-add" style="width: 50%;">
                				 Enviar calificación
            				</button>
						</div>
					</div>
			    </div>
        </div>
	</div>
    </div>
			<!-- Modal Add AvalibleTime -->	
</template>
<script>
export default {
	components:{

	},
		/*data(){
			return{

			};
		}
		mounted(){

		},*/
		methods:{
			enviaCalif(){
				
			}
		}
	};

</script>