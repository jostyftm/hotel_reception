<template>
	<!-- Loading animation container -->
	<div class="loading">
	    <!-- We make this div spin -->
	    <div class="spinner">
	        <!-- Mask of the quarter of circle -->
	        <div class="mask">
	            <!-- Inner masked circle -->
	            <div class="maskedCircle"></div>
	        </div>
	    </div>
	</div>
</template>
<script>
	export default{

	}
</script>

<style lang="scss">
	/* Animation keyframes - you need to add prefixes */
	@keyframes spin {
	    from { transform: rotate(0deg); }
	    to { transform: rotate(360deg); }
	}

	/* Loading animation container */
	.loading {
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    width: 28px;
	    height: 28px;
	    margin: -14px 0 0 -14px;
	}

	/* Spinning circle (inner circle) */
	.loading .maskedCircle {
	    width: 50px;
	    height: 50px;
	    border-radius: 50%;
	    border: 3px solid darkgray;
	}

	/* Spinning circle mask */
	.loading .mask {
	    width: 50px;
	    height: 20px;
	    overflow: hidden;
	}

	/* Spinner */
	.loading .spinner {
	    position: absolute;
	    left: 1px;
	    top: 1px;
	    width: 50px;
	    height: 50px;
	    animation: spin 1s infinite linear;
	}
</style>
