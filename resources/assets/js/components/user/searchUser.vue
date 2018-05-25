<template>
	<div>
		<div class="form-group">
			<label for="">N° de Identificación</label>
			<input type="text" class="form-control" @keyup.enter="searchUser" v-model="number_identification">
		</div>
		<loader v-show="isSearching"></loader>
		<table-user :users="users" v-if="users.length > 0 && !isSearching" @userSelctedReservation="sendUserReservation"></table-user>
		<div class="text-center" v-if="users.length == 0">
			<h4>No hay resultados</h4>
		</div>		
	</div>
</template>
<script>

	Vue.component('tableUser', require('./tableUsers'));

	export default {
		data(){
			return {
				users:{type:Array},
				userSelecetd:{type:Object},
				number_identification: '',
				isSearching:false,
			}
		},
		methods: {
			searchUser: function(){

				this.isSearching = true;

				let url = "/user/search?identification="+this.number_identification;

				axios.get(url).then(res =>{

					this.isSearching = false;
					this.users = res.data;
				}).catch(err => {

				});
			},
			sendUserReservation : function(user){
				this.userSelecetd = user;
				this.$emit("userReservation", this.userSelecetd);
			}
		}
	}
</script>