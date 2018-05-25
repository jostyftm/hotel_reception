<template>
	<div class="">
		<button class="btn btn-outline-primary btn-sm" @click="createReservation">Crear Reservación</button>
	</div>
</template>

<script>
	export default{
		methods:{
			createReservation : function(){
				this.$emit("createReservation");
			}
		}
	}	
</script>