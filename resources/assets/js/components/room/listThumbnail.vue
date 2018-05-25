<template>
	<div class="list-thumbnail">
		<div class="d-flex flex-row">
			<div class="mx-auto">
				<div class="text-center">
					<label class="btn btn-outline-secondary btn-file" for="uploadImage">
					    <i class="fa fa-image fa-2x"></i>
					    <input type="file" id="uploadImage" @change="uploadImage" style="display: none;">
					</label>
				</div>
			</div>
			<div class="thumbnails d-flex flex-row">	
				<div class="" v-for="photo in photos">
					<thumbnail :thumbnail="photo"></thumbnail>
				</div>
			</div>
		</div>	
	</div>
</template>
<script>
	
	Vue.component('thumbnail', require('./thumbnail'));

	export default {
		props:{
			photos:{}
		},
		data(){
			return {
				image: ''
			}
		},
		methods:{
			uploadImage:function(e){
				var files = e.target.files || e.dataTransfer.files;
			    if (!files.length)
			        return;

			    this.createImage(files[0]);
			},
			createImage:function(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            upload:function(){
            	axios.post('/room/uploadPhoto',{image: this.image, room_id: this.room.id}).then(res => {
            		
                }).catch(err => {
                	// console.log(err)
                });
            }
		},
		watch:{
			image:function(val){
				this.upload()
			}
		}	
	}
</script>

<style lang="scss" scoped>
	.thumbnails {
		width: 900px;
	}
	.labelUpload{
		padding: 0.5rem 1rem;
	    font-size: 1.125rem;
	    line-height: 1.5;
	    border-radius: 0.3rem;
	}
</style>