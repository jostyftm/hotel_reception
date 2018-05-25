<template> 
 <div id="wrapper" class="container"> 
	<modal v-if="stateModal" :width="90"> 
		<h3 slot="header" class="modal-title">
			Editar Habitación
		</h3>
		<div slot="body">
			<div class="py-4 py-auto" v-show="isEditing">
				<loader></loader>
			</div>
			<form action="/room" method="post" id="formUpdateRoom" v-show="!isEditing">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Nombre</label>
								<input type="text" name="name" class="form-control" :value="room.name">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Tipo</label>
								<select class="form-control" name="room_type_id">
									<option value="">- Seleccione un tipo -</option>
									<option v-for="type in roomTypes" :value="type.id" :selected="room.room_type_id === type.id">{{ type.type }}</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Descripción</label>
								<textarea name="description" class="form-control">{{ room.description }}</textarea>
							</div>
						</div>
					</div>
				</div>
			</form>
			<list-thumbnail :photos="room.photos"></list-thumbnail>
		</div>
		<div slot="footer" v-show="!isEditing">
	   		<button type="button" class="btn btn-outline-info" @click="closeModal()"> Cancelar </button>
		   	<button type="submit" class="btn btn-primary" @click.prevent="updateRoom">
			 Actualizar
		   	</button>
	  	</div>
	</modal>
</div>
</template>
<script>
	
	Vue.component('modal', require('../shared/modal'));
	Vue.component('listThumbnail', require('./listThumbnail'));

	export default {
		props:{
			stateModal: false,
			room: {
				name: '',
				room_type_id: 0,
				description: '',
			},
			roomTypes:{},
			isEditing: false,
		},
		data(){
			return {
				showModal: false,
			}
		},
		methods: {
			closeModal() {
			     this.$emit('closeModal');
			},
			submitAndClose() {
			   this.$emit('submitAndClose');
			},
			updateRoom: async function(){

				let form = $('#formUpdateRoom'),
					url = "/room/"+this.room.id;

				this.isEditing = true;

				let response = await axios.put(url, form.serialize())
				.then(res => {
					console.log(res);
				}).catch(err => {
					console.log(err);
				});

				this.isEditing = false;
				this.submitAndClose();
			}
		},
		computed:{
			
		}
	}
</script>