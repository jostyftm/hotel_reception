<template> 
 <div id="wrapper" class="container"> 
	<modal v-if="stateModalConfirm" :width="90"> 
		<h3 slot="header" class="modal-title">
			{{ title }}
		</h3>
		<div slot="body">
			{{ message }}
		</div>
		<div slot="footer">
	   		<button type="button" class="btn btn-outline-info" @click="closeModal()"> Cancelar </button>
		   	<button type="submit" class="btn btn-primary" @click="submitAndClose">
			 Comfirmar
		   	</button>
	  	</div>
	</modal>
</div>
</template>
<script>
	
	Vue.component('modal', require('./modal'));

	export default {
		props:{
			stateModalConfirm: false,
			title: {
				type: String
			},
			message: {
				type: String
			},
		},
		methods: {
			openModal() { 
				this.stateModalConfirm = true; 
			},
			closeModal() {
			     this.stateModalConfirm = false;
			     this.$emit('closeModalConfirm');
			},
			submitAndClose() {
				this.stateModalConfirm = false;
			   this.$emit('submitModalConfirm');
			}
		}
	}
</script>