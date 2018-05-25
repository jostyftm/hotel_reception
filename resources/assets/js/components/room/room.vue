<template>
	<div class="card">
		<img class="card-img-top" :src="avatar" alt="Card image cap" :title="room.name">
		<div class="card-body">
	    	<p class="card-text">Habitación {{ room.name }}</p>
	  	</div>
	  	<div class="card-footer">
	  		<div class="button-actions">
	  			<a :href="`/room/${room.id}/edit`" class="btn btn-primary btn-sm" @click.prevent="editRoom">
	  				<i class="fa fa-edit"></i>
	  			</a>
	  			<a href="#" class="btn btn-danger btn-sm" @click.prevent="deleteRoom">
	  				<i class="fa fa-trash"></i>
	  			</a>
	  		</div>
	  	</div>
	</div>
</template>

<script>
	export default {
		mounted() {
			console.log(this.room.photos)
		},
		props:{
			room: {
				type: Object,
				required: true
			}
		},
		data(){
			return {
				
			}
		},
		methods:{
			editRoom:function(r){
				this.$emit('editRoom', this.room.id)
			},
			deleteRoom: function(){
				this.$emit('deleteRoom', this.room.id)
			},
			hasImage:function(){
				return (this.room.photos.length > 0);
			}

		},
		computed: {
			avatar:function(){

				let photo = String(this.room.photos[0].src);

				// console.log(photo.indexOf("loremflickr"));
				return (photo.indexOf("loremflickr") > 0) ? photo : "/images/rooms/"+photo;

				// return (this.room.photos != undefined) ? this.room.photos[0].src : "http://via.placeholder.com/200x200";
			}
		}
	}
</script>
