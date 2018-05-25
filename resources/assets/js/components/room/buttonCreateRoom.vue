<template>
	<div class="">
		<button href="" class="btn btn-primary" @click.prevent="changeStateModalFormCreate">
			Crear Habitación
		</button>

		<modal-create-room :stateModalRoomCreate="isModalCreateRoomActive" :roomTypes="roomTypes" @closeModalRoomCreate="changeStateModalFormCreate" @roomCreated="sendformEdit"></modal-create-room>

		<!-- <modal-edit-room :stateModal="isModalEditRoomActive" :room="room" :roomTypes="roomTypes"></modal-edit-room> -->
	</div>
</template>

<script>
	
	Vue.component('modalCreateRoom', require('./modalCreateRoom'));
	// Vue.component('modalEditRoom', require('./modalEditRoom.vue'));

	export default {
		mounted()
		{
			this.getRoomTypes();
		},
		data(){
			return {
				isModalCreateRoomActive: false,
				isModalEditRoomActive: false,
				room: {
					type:Object
				},
				roomTypes:{}
			}
		},
		methods:{
			getRoomTypes:function()
			{
				axios.get('/roomTypes/all').then(res => {
					this.roomTypes = res.data;

					// console.log(this.roomTypes);
				}).catch(err => {
					// console.log(err);
				});
			},
			showFormCreateRoom: function(){

			},
			changeStateModalFormCreate:function(){
				this.isModalCreateRoomActive = !this.isModalCreateRoomActive;
			},
			changeStateModalFormEdit:function(){
				this.isModalEditRoomActive = !this.isModalEditRoomActive;
			},
			sendformEdit:function(room){
				this.isModalEditRoomActive = !this.isModalEditRoomActive;
				// this.changeStateModalFormCreate();
				this.$emit('roomCreated', room);
			}
		},
		computed:{

		}
	}
</script>