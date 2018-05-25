<template>
	<img :src="image" alt="" class="img-thumbnail" width="200px">
</template>

<script>
	export default {
		props:{
			thumbnail:{}
		},
		computed:{
			image:function(){

				if(this.thumbnail.src == 'undefined')
					return '';
				
				let path = this.thumbnail.src;

				if(path == 'undefined')
					return;

				return (path.indexOf("loremflickr") > 0) ? path : "/images/rooms/"+path ;
			}
		}
	}
</script>