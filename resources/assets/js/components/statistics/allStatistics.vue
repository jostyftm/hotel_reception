<template>
	<div class="widgets1 d-flex -flex-row justify-content-between">
		<widget1 :class="{ bgDanger: true }">
			<i class="fa fa-clock fa-3x" slot="icon"></i>
			<h5 slot="title">Habitaciones Pasadas de Hora</h5>
			<h4 slot="value">{{ getTotalReserveTooLate() }}</h4>
		</widget1>
		<widget1 :class="{ bgWarning: true}">
			<i class="fa fa-door-closed fa-3x" slot="icon"></i>
			<h5 slot="title">Habitaciones Ocupadas</h5>
			<h4 slot="value">{{ getTotalBusy() }}</h4>
		</widget1>
		<widget1 :class="{ bgSuccess: true }">
			<i class="fa fa-door-open fa-3x" slot="icon"></i>
			<h5 slot="title">Habitaciones Disponibles</h5>
			<h4 slot="value">{{ getTotalNoBusy() }}</h4>
		</widget1>
	</div>
</template>
<script>

	Vue.component('widget1', require("../shared/widget1"));

	export default {
		mounted(){
			this.getReserveByState("busy");
			this.getReserveByState("no_busy");
			this.getReserveTooLate();
		},
		data: function(){
			return {

				reserveBusy: {type:Array},
				reserveNoBusy: {type:Array},
				reserveTooLate: {type:Array},
			}
		},
		methods:{
			getReservations: function(state){
				// window.setInterval(this.getReserveByState, 5000, state);
			},
			getReserveByState: function(state){

				let url = "/reservation/getReserveBySate?state="+state;
				axios.get(url).then(res => {
					if(state == "busy")
						this.reserveBusy = res.data
					else if(state == 'no_busy')
						this.reserveNoBusy = res.data
				}).catch(err => {

				});
			},
			getReserveTooLate : function(){
				axios.get("/reservation/checkSatus").then(res => {
					if(res.data.state == true)
					{
						this.reserveTooLate = res.data.data;
					}
				}).catch(err => {
					console.log(err)
				});
			},
			getTotalBusy: function(){
				return this.reserveBusy.length;
			},
			getTotalNoBusy: function(){
				return this.reserveNoBusy.length;	
			},
			getTotalReserveTooLate: function(){
				return this.reserveTooLate.length;
			}
		},
		watch: {
			
		}
	}
</script>