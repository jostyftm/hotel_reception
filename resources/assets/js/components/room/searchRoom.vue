<template>
		<div class="">
			<div class="form-group">
				<label for="">Tipo de Habitación</label>
				<input type="text" class="form-control" @keyup.enter="searchRoom" v-model="type">
			</div>
			<div class="p-5 mt-4" v-show="isSearching">
				<loader></loader>
			</div>
			<table-rooms :rooms="rooms" v-if="rooms.length > 0 && !isSearching" @roomSelctedReservation="sendRoomReservation" @roomSeelctedForEdit="sendForEdit"></table-rooms>
		</div>
</template>
<script>

	Vue.component('tableRooms', require('./tableRooms'));

	export default {
		mounted(){
			this.searchRoom();
		},
		data(){
			return {
				rooms:{type:Array},
				roomSelecetd:{type:Object},
				type: '',
				isSearching:false,
			}
		},
		methods: {
			searchRoom: function(){

				this.isSearching = true;

				let url = "/room/search?type="+this.type;

				axios.get(url).then(res =>{

					this.isSearching = false;
					this.rooms = res.data;
				}).catch(err => {

				});
			},
			sendRoomReservation : function(room){
				this.roomSelecetd = room;
				this.$emit("roomReservation", room);
			},
			sendForEdit: function(id){
				this.$emit("roomForEdit", id);
			}
		}
	}
</script>