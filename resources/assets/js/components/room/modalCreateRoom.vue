<template> 
 <div id="wrapper" class="container"> 
	<modal v-if="stateModalRoomCreate" :width="90"> 
		<h3 slot="header" class="modal-title">
			Crear Habitación
		</h3>
		<div slot="body">
			<loader v-show="isSaving"></loader>
			<form action="/room" method="post" id="formUpdateRoom" v-show="!isSaving">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Nombre</label>
								<input type="text" name="name" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Tipo</label>
								<select class="form-control" name="room_type_id">
									<option selected>- Seleccione un tipo -</option>
									<option v-for="type in roomTypes" :value="type.id" :key="type.id">{{ type.type }}</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Descripción</label>
								<textarea name="description" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div slot="footer" v-show="!isSaving">
	   		<button type="button" class="btn btn-outline-info" @click="closeModal"> Cancelar </button>
		   	<button type="submit" class="btn btn-primary" @click.prevent="createRoom">
			 Crear
		   	</button>
	  	</div>
	</modal>
</div>
</template>
<script>
	
	Vue.component('modal', require('../shared/modal'));

	export default {
		props:{
			stateModalRoomCreate: false,
			roomTypes:{}
		},
		data(){
			return {
				showModal: false,
				room:{
					name: '',
					room_type_id: 0,
					description: '',
				},
				
				isSaving: false,
			}
		},
		methods: {
			openModal() { 
				this.stateModalRoomCreate = true; 
			},
			closeModal() {
				 this.stateModalRoomCreate = false;
			     this.$emit('closeModalRoomCreate');
			},
			submitAndClose() {
				this.stateModalRoomCreate = false;
			   	this.$emit('roomCreated', this.room);
			},
			createRoom:function(){

				let form = $('#formUpdateRoom');

				this.isSaving = true;

				axios.post("/room", form.serialize())
				.then(res => {
					this.room = res.data;
					// this.submitAndClose();
					window.location.reload();

				}).catch(err => {
					console.log(err);
				});
			}
		}
	}
</script>