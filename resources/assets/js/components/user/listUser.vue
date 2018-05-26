<template>
	<card class="card">
		<div slot="title">
			<h3 class="float-left">Clientes</h3>
			<button class="float-right btn btn-outline-primary btn-sm" @click="changeStateModalUserCreate">Crear cliente</button>
		</div>
		
		<div slot="body">
			<div class="py-4" v-show="isLoading">
				<loader></loader>
			</div>
			<table-user :users="users" v-show="!isLoading"></table-user>

			<modal-create-user :stateModalUserCreate="isModalUserCreateActice" @userCreated="getUsers" @closeModal="changeStateModalUserCreate"></modal-create-user>
		</div>
	</card>
</template>

<script>
	
	Vue.component('modalCreateUser', require('./modalCreateUser'));
	Vue.component('tableUser', require('./tableUsers'));
	
	export default {
		mounted(){
			this.getUsers()
		},
		data(){
			return{
				users: {type:Array},
				isLoading: false,
				isModalUserCreateActice:false,
			}
		},
		methods:{
			getUsers: function(){

				this.isModalUserCreateActice = false;
				this.isLoading = true;

				axios.get("/user/all").then(res =>{
					this.users = res.data;

					this.isLoading = false;
				}).catch(err =>{

				});
			},
			closeModal: function(){
				this.isModalUserCreateActice = false;
			},
			changeStateModalUserCreate: function(){
				this.isModalUserCreateActice = !this.isModalUserCreateActice;
			}
		},
		watch:{
			isModalUserCreateActice: function(){
				console.log("cambio")
			}
		}
	}
</script>