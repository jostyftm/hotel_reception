<template>
	<table class="table">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>N° Documento</th>
				<th>Correo electronico</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="user in users">
				<td>{{ user.name }}</td>
				<td>{{ user.last_name }}</td>
				<td>{{ user.identification_number }}</td>
				<td>{{ user.email }}</td>
				<td>
					<button class="btn btn-outline-primary btn-sm">
						<i class="fa fa-edit"></i>
					</button>
					<button class="btn btn-outline-danger btn-sm">
						<i class="fa fa-trash"></i>
					</button>
					<button class="btn btn-outline-secondary btn-sm" title="Reservar habitación" @click="selectedUser(user.id)">
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
			users:{}
		},
		data(){
			return {
				userSelected:{type:Object},
				isSelecteding: false,
			}
		},
		methods:{
			selectedUser : function(id){
				let url = "/user/"+id;

				axios.get(url).then(res => {
					this.userSelected = res.data;
					this.$emit('userSelctedReservation', this.userSelected);
				}).catch(err => {

				});
			}
		}
	}
</script>