<template> 
 <div id="wrapper" class="container"> 
	<modal v-if="stateModalReservationEdit" :width="90"> 
		<h3 slot="header" class="modal-title">
			Editar Reservación
		</h3>
		<div slot="body">
			<loader v-show="isSaving || isSearching"></loader>
			<div class="" v-show="!isSearching && !isSaving">
				<div class="d-flex flex-row align-items-center">
					<h3>
						{{ getUserFullName() }}
					</h3>
					<small class="text-muted"> 
						cc: ({{ getIdentificationUser() }})
					</small>
				</div>
				<div class="d-flex flex-row align-items-center">
					<h4>
						Habitación: {{ getRoomName() }}
					</h4>
					<small class="text-muted">
						(${{ getRoomPrice()  }})
					</small>
				</div>
				<div class="">
					<p>
						{{ getRoomDescription()  }}
					</p>
				</div>
				<div class="form-group" v-if="pendingForEvacuate()">
					<button class="btn btn-outline-info" @click="evacuateReservation">Desocupar</button>
				</div>
			</div>
		</div>
		<div slot="footer">
	   		<button type="button" class="btn btn-outline-info" @click="closeModal"> Cancelar </button>
		   	<button type="submit" class="btn btn-primary" @click.prevent="createReservation">
			 Actualizar
		   	</button>
	  	</div>
	</modal>
</div>
</template>
<script>

	Vue.component('modal', require('../shared/modal'));

	export default {
		mounted(){

		},
		props:{
			stateModalReservationEdit: false,
			reservation_id:0,
		},
		data(){
			return {
				reservation:{type:Object},
				
				showModal: false,
				isSaving: false,
				isSearching: false,
			}
		},
		methods: {
			resetVariable : function(){
				
			},
			openModal() { 
				this.stateModalReservationEdit = true; 
			},
			closeModal() {
			    this.stateModalReservationEdit = false;
			    this.$emit('closeModalReservationEdit');
			    
			    this.resetVariable();	
			},
			submitAndClose() {
				this.stateModalReservationEdit = false;
			   	this.$emit('reservationEdited', this.reservation);

			   	this.resetVariable();
			},
			getReservation:function(){

				this.isSearching = true;

				let url = "/reservation/"+this.reservation_id;
				
				axios.get(url)
				.then(res => {

					this.isSearching = false;		
					this.reservation = res.data;

				}).catch(err => {
					console.log(err);
				});
			},
			evacuateReservation : function(){

				this.isSaving = true;

				axios.post("/reservation/evacuate", {
					reservation_id: this.reservation.id,
					room_id: this.reservation.room_id
				})
				.then(res => {
					this.isSaving = false;
					this.submitAndClose();
					// console.log(res)
				})
				.catch(err => {

				});
			},
			pendingForEvacuate: function(){
				return (this.reservation.room != null && this.reservation.room.state === 'busy' && this.reservation.state == 'busy') ? true : false ;
			},
			getUserFullName:function(){
				return (this.reservation.client != null) ? this.reservation.client.name+" "+this.reservation.client.last_name : "";
			},
			getIdentificationUser: function(){
				return (this.reservation.client != null) ? this.reservation.client.identification_number : "";
			},
			getRoomName: function(){
				return (this.reservation.room != null) ? this.reservation.room.name : " ";
			},
			getRoomPrice: function(){
				return (this.reservation.room != null) ? this.reservation.room.type.price : " ";
			},
			getRoomDescription:function(){
				return (this.reservation.room != null) ? this.reservation.room.type.description : " ";
			}
		},
		computed: {
			
		},
		watch:{
			stateModalReservationEdit:function(state){
				if(state)
					this.getReservation()
			}
		}
	}
</script>