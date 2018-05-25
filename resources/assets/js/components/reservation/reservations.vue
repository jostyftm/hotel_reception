<template>
	<div class="col-md-12">
		<card class="card">
			<div class="" slot="title">
				<h4 class="float-left">Reservaciones</h4>
				<div class="float-right">
					<button-create-reservation @createReservation="changeStateModalCreateReservation"></button-create-reservation>
				</div>
			</div>
			
			<div slot="body">
				<div class="py-4" v-show="isLoading">
					<loader></loader>
				</div>
				<div class="alert alert-danger" role="alert" v-show="isAlertRoom">
					<p>
						Hay habitaciones que ya cumplieron el tiempo estimado
					</p>
				</div>
				<table class="table table-hover" v-show="!isLoading">
					<thead>
						<tr>
							<th>N°</th>
							<th>Cliente</th>
							<th>Habitación</th>
							<th>Estado</th>
							<th>Tipo</th>
							<th>Precio</th>
							<th>Fecha Entrada</th>
							<th>Fecha Salida</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="reservation in reservations" v-if="reservation.client">
							<td>{{ reservation.id }}</td>
							<td>
								{{ reservation.client.name }} {{ reservation.client.last_name }}
							</td>
							<td>
								{{ reservation.room.name }}
							</td>
							<td>
								<span :class="[classBadge, getClassState(reservation.state)]">
									{{ getStateReservation(reservation.state)}}
								</span>
							</td>
							<td>
								{{ reservation.room.type.type }}
							</td>
							<td>
								{{ reservation.room.type.price}}
							</td>
							<td>
								{{ reservation.created_at }}
							</td>
							<td>
								{{ reservation.date_exit}}
							</td>
							<td>
								<button class="btn btn-outline-primary btn-sm" @click="editReservation(reservation.id)">
									<i class="fa fa-edit"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</card>
		<modal-create-reservation :stateModalReservationCreate="isModalCreateReservationActive" @reservationCreated="getNewReservation" @closeModalReservationCreate="changeStateModalCreateReservation"></modal-create-reservation>
		<modal-edit-reservation :stateModalReservationEdit="isModalEditReservationActive" :reservation_id="reservation_selected" @reservationEdited="getNewReservation" @closeModalReservationEdit="changeStateModalEditReservation"></modal-edit-reservation>
	</div>
</template>

<script>
	
	Vue.component('buttonCreateReservation', require('./buttonCreateReservation'));
	Vue.component('modalCreateReservation', require('./modalCreateReservation'));
	Vue.component('modalEditReservation', require('./modalEditReservation'));

	export default {
		mounted(){
			this.getReservations();

			this.checkSatus();
			// setInterval(this.checkSatus(), 3000);
		},
		data(){
			return{
				reservations: {type:Array},
				reservation_selected: {type:Number},

				classBadge: {
					'badge':true, 
					'badge-pill':true,
				},
				classError: {
					'badge-danger': true
				},
				classSuccess:{
					'badge-success': true
				},
				classInfo:{
					'badge-info': true
				},
				classWarning:{
					'badge-warning': true
				},

				isLoading: false,
				isAlertRoom:false,

				isModalCreateReservationActive: false,
				isModalEditReservationActive: false,
			}
		},
		methods:{
			checkSatus : function(){
				let self = this;
				window.setInterval(function(){
					axios.get("/reservation/checkSatus").then(res => {
						
						if(res.data.state == true)
						{
							self.$data.isAlertRoom = true;
							console.log("verdadero");
						}else{
							self.$data.isAlertRoom = false;
							console.log("falso");
						}
						// console.log(res.data.state)
					}).catch(err => {
						console.log(err)
					});
				}, 5000)
			},
			getReservations: function(){

				this.isLoading = true;
				axios.get("/reservation/all").then(res =>{
					this.reservations = res.data;

					this.isLoading = false;
				}).catch(err =>{

				});
			},
			editReservation : function(id)
			{
				this.reservation_selected = id;
				this.changeStateModalEditReservation();
			},
			getNewReservation: function(){
				this.isModalCreateReservationActive = false;
				this.isModalEditReservationActive = false;
				
				this.getReservations();
			},
			changeStateModalCreateReservation : function(){
				this.isModalCreateReservationActive  = !this.isModalCreateReservationActive;
			},
			changeStateModalEditReservation : function(){
				this.isModalEditReservationActive = !this.isModalEditReservationActive;
			},
			getStateReservation: function(state){

				if(state == 'busy')
					return 'Ocupado'
				else if(state == 'no_busy')
					return 'Desocupado'
				else if(state == 'pending')
					return 'Separado'
				else if(state == 'canceled')
					return 'Cancelado'
				// return (state == 'busy') ? 'Ocupado' : 'Desocupado';
			},
			getClassState: function(state){
				if(state == 'busy')
					return this.classError
				else if(state == 'no_busy')
					return this.classSuccess
				else if(state == 'pending')
					return this.classInfo
				else if(state == 'canceled')
					return this.classWarning
				// return (state == 'busy') ? this.classError : this.classSuccess ;
			}
		},
		computed:{
			alertRoom : function(){
				return this.isAlertRoom;
			}
		},
		watch:{
			isAlertRoom: function(alert){
				console.log("samslals")
			}
		}
	}
</script>