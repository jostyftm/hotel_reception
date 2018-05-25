<template>
	<div class="">
		<!-- <loader v-show="isSearching"></loader> -->
		<card v-show="!isSearching">

			<div slot="body">
				<search-room @roomForEdit="selectedForEdit"></search-room>
				<!-- <div class="col-3 pb-2" v-for="room in rooms">
					<room-card :room="room" @editRoom="showRoom" @deleteRoom="changeStateModalConfirm"></room-card>
				</div> -->

				<modal-edit-room :stateModal="isModalActive" :room="selectedRoom" :roomTypes="roomTypes" @closeModal="changeStateModal" @submitAndClose="roomEdited"></modal-edit-room>

				<modal-confirm :stateModalConfirm="isModalConfirmActive" :title="tittleConfirm" :message="messageConfirm" @closeModalConfirm="changeStateModalConfirm" @submitModalConfirm="destryRoom"></modal-confirm>
			</div>
		</card>
	</div>
</template>

<script>
	
	// Vue.component('roomCard', require('./room.vue'));
	Vue.component('searchRoom', require('./searchRoom'));
	Vue.component('modalEditRoom', require('./modalEditRoom.vue'));
	Vue.component('modalConfirm', require('../shared/modalConfirm'));
	// Vue.component('loaderListRoom', require('../shared/loader'));
	
	export default {
		// components : {roomCard, roomEdit},
		created: function(){
			// console.log("montado el conponente");
			this.getRoomTypes();
			this.getRooms();
		},
		data(){
			return {
				rooms: {type:Object},
				roomTypes: {type:Array},
				selectedRoom: {
					type: Object
				},

				isSearching: false,
				isModalActive: false,
				isModalConfirmActive: false,
				
				tittleConfirm: 'Eliminar Habitación',
				messageConfirm: '¿ Esta seguro que desea eliminar esta habitación?',
			}
		},
		methods: {
			resetVariables:function(){
				this.rooms = null;
				this.selectedRoom = null;
				this.isModalActive = false;

				this.isModalConfirmActive = false;
			},
			selectedForEdit: function(id){
				this.setSelectedRoom(id);
				this.changeStateModal();
			},
			setSelectedRoom:function(id) {

				let request = 'room/'+id;
				
				axios.get(request).then(res => {
					
					this.selectedRoom = res.data;
					// console.log(this.selectedRoom);
				
				}).catch(err => {
					// console.log(err);
				});
			},
			getRoomTypes:function()
			{
				axios.get('/roomTypes/all').then(res => {
					this.roomTypes = res.data;

					// console.log(this.roomTypes);
				}).catch(err => {
					// console.log(err);
				});
			},
			getRooms: function(){

				this.resetVariables();

				this.isSearching = true;

				axios.get('/room/all').then(res => {
					this.rooms = res.data;

					this.isSearching = false;

				}).catch(err => {
					// console.log(err);
				});
			},
			showRoom:function(id){
				this.setSelectedRoom(id);
				this.isModalActive = true;
			},
			destryRoom:function(){
				let request = 'room/'+this.selectedRoom.id;

				axios.delete(request).then(res =>{
					// console.log(res);
					this.getRooms();
				}).chatch(err => {
					// console.log(err);
				});
			},
			roomEdited:function()
			{
				this.getRooms();
			},
			changeStateModal:function(){
				this.isModalActive = !this.isModalActive;
			},
			changeStateModalConfirm:function(id){

				if(id != null)
					this.setSelectedRoom(id)

				this.isModalConfirmActive = !this.isModalConfirmActive;
			}
		}
	}
</script>