<template> 
 <div id="wrapper" class="container"> 
	<modal v-if="stateModalUserCreate" :width="90"> 
		<h3 slot="header" class="modal-title">
			Registrar Usuario
		</h3>
		<div slot="body">
			<loader v-show="isSaving"></loader>
			<form action="/user" method="post" id="formCreateUser" v-show="!isSaving">
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
								<label for="">Apellido</label>
								<input type="text" name="last_name" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">N° de Identificación</label>
								<input type="text" name="identification_number" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div slot="footer" v-show="!isSaving">
	   		<button type="button" class="btn btn-outline-info" @click="closeModal"> Cancelar </button>
		   	<button type="submit" class="btn btn-primary" @click.prevent="createUser">
			 Crear
		   	</button>
	  	</div>
	</modal>
</div>
</template>
<script>
	
	Vue.component('modal', require('../shared/modal'));

	export default {
		props:['stateModalUserCreate'],
		data(){
			return {
				showModal: false,
				user:{type:Object},
				
				isSaving: false,
			}
		},
		methods: {
			openModal() { 
				this.stateModalUserCreate = true; 
			},
			closeModal() {
			     this.stateModalUserCreate = false;
			     this.$emit('closeModalUserCreate');
			},
			submitAndClose() {
				this.stateModalUserCreate = false;
			   this.$emit('userCreated', this.user);
			},
			createUser:function(){

				let form = $('#formCreateUser');

				this.isSaving = true;

				axios.post("/user", form.serialize())
				.then(res => {
					this.user = res.data;
					window.location.reload();

				}).catch(err => {
					console.log(err);
				});
			}
		}
	}
</script>