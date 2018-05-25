<template> 
 <div id="wrapper" class="container"> 
	<modal v-if="stateModalReservationCreate" :width="90"> 
		<h3 slot="header" class="modal-title">
			Registrar Usuario - {{subtitle}}
		</h3>
		<div slot="body">
			<loader v-show="isSaving"></loader>
			<search-user @userReservation="goToStep2" v-if="step == 1"></search-user>
			<search-room v-if="step == 2" @roomReservation="goToStep3"></search-room>
			<div class="" v-if="step == 3">
				<div class="d-flex flex-row align-items-center">
					<h3>{{ getUserFullName() }}</h3> <small class="text-muted"> cc: ({{ userSelected.identification_number }})</small>
				</div>
				<div class="d-flex flex-row align-items-center">
					<h4>
						Habitación: {{ roomSelected.name }}
					</h4>
					<small class="text-muted">
						(${{ roomSelected.type.price  }})
					</small>
				</div>
				<div class="">
					<p>
						{{ roomSelected.type.description  }}
					</p>
				</div>
			</div>
			<div class="text-center" v-if="step == 4">
				<h4>Reserva Creada con Exito!</h4>
				<button class="btn btn-primary btn-lg" @click="submitAndClose">Aceptar</button>
			</div>
		</div>
		<div slot="footer">
	   		<button type="button" class="btn btn-outline-info" @click="closeModal"> Cancelar </button>
		   	<button type="submit" class="btn btn-primary" v-if="step == 3 && !isSaving" @click.prevent="createReservation">
			 Crear
		   	</button>
	  	</div>
	</modal>
</div>
</template>
<script>

	Vue.component('searchUser', require('../user/searchUser'));
	Vue.component('searchRoom', require('../room/searchRoom'));
	Vue.component('modal', require('../shared/modal'));

	export default {
		props:{
			stateModalReservationCreate: false,
		},
		data(){
			return {
				reservation:{type:Object},
				userSelected:{type:Object},
				roomSelected:{type:Object},
				
				step:1,
				showModal: false,
				subtitle: '',
				isSaving: false,
			}
		},
		methods: {
			resetVariable : function(){
				this.step = 1;
			    this.userSelected = {};
			    this.roomSelected = {};
			},
			openModal() { 
				this.stateModalReservationCreate = true; 
			},
			closeModal() {
			    this.stateModalReservationCreate = false;
			    this.$emit('closeModalReservationCreate');
			    
			    this.resetVariable();	
			},
			submitAndClose() {
				this.stateModalReservationCreate = false;
			   	this.$emit('reservationCreated', this.reservation);

			   	this.resetVariable();
			},
			goToStep2 : function(user){

				this.userSelected = user;
				this.step = 2;
			},
			goToStep3 : function(room){
				this.roomSelected = room;
				this.step = 3;
			},
			createReservation:function(){

				this.isSaving = true;

				axios.post("/reservation", {
					room_id : this.roomSelected.id,
					client_id : this.userSelected.id
				})
				.then(res => {

					this.isSaving = false;
					this.step = 4;				
					this.reservation = res.data;
					// this.submitAndClose();
				}).catch(err => {
					console.log(err);
				});
			},
			getUserFullName:function(){
				return (this.userSelected != null) ? this.userSelected.name+" "+this.userSelected.last_name : "";
			},
			getRoomDescription:function(){
				return (this.roomSelected != null) ? this.roomSelected.type.description : " ";
			}
		},
		computed: {
			
		}
	}
</script>