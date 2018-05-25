<template>
	<div class="widget1 text-white d-flex flex-row" style="width: 30%">
		<div class="icon-widget p-3 py-auto">
			<slot name="icon"></slot>
		</div>
		<div class="text-widget p-3 text-center">
			<slot name="title"></slot>
			<slot name="value"></slot>
		</div>
	</div>
</template>

<script>
	export default {
		props:{
			bg:String
		},
		data: function(){
			return {
				danger:{type:String}
			}
		},
		methods:{
			// danger: function(){
			// 	return {'bg-danger' : true};	
			// }
		},
		computed: {
			getBg: function(){
				return {'bg-info' : true};
			},

		}
	}
</script>