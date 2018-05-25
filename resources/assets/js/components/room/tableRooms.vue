<template>
	<table class="table">
		<thead>
			<tr>
				<th>Habitación</th>
				<th>Tipo</th>
				<th>Estado</th>
				<th>Precio</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="room in rooms">
				<td>{{ room.name }}</td>
				<td>{{ room.type.type }}</td>
				<td> {{ getState(room.state) }} </td>
				<td>{{ room.type.price }}</td>
				<td>
					<button class="btn btn-outline-primary btn-sm" @click="roomEdit(room.id)">
						<i class="fa fa-edit"></i>
					</button>
					<button class="btn btn-outline-danger btn-sm">
						<i class="fa fa-trash"></i>
					</button>
					<button v-if="room.state != 'busy'" class="btn btn-outline-secondary btn-sm" title="Reservar habitación" @click="selectedRoom(room)">
						<i class="fa fa-calendar"></i>
					</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props:{
			rooms:{}
		},
		data(){
			return {
				roomSelected:{type:Object},
				isSelecteding: false,
			}
		},
		methods:{
			selectedRoom : function(room){
				// let url = "/room/"+id;

				// axios.get(url).then(res => {
				// 	this.roomSelected = res.data;
				this.$emit('roomSelctedReservation', room);
				// }).catch(err => {

				// });
			},
			roomEdit: function(id){
				// this.selectedRoom(id)
				this.$emit('roomSeelctedForEdit', id);
			},
			getState: function(s){
				let state = '';

				if(s == 'no_busy')
					state = "Disponible";
				else if(s == 'busy')
					state = "No Disponible";
				else if(s == 'pending')
					state = "Pendiente";
				else if(s == 'canceled')
					state = "Candelado";
				else if(s == 'cleaning')
					state = "Limpiando";

				return state;
				// return (state === 'no_busy') ? "Disponible" : "No Disponible" ;
			}
		},
		computed:{
			
		}
	}
</script>