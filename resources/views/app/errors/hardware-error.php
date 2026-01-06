<?php
$title = 'محدودیت دسترسی کامپیوتر'; ?>
<style>
	* {
		padding: 0;
		margin: 0;
	}
	body {
		background-color: #222334;
		height: 100vh !important;
	}
	.w200 {
		width: 200px;
	}
	.box-container {
		height: 100vh;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.cont{
		background-color: #171722ff;
		width: 500px;
		height: 300px;
		text-align: center;
		border-radius: 20px;
		color: whitesmoke;
		border: 1px solid #7e7e7e85;
	}
	.err-title{
		margin: 50px 0 20px 0;
	}
</style>
<div class="box-container">
	<div class="cont">

		<div class="center">
			<img src="<?= asset('public/assets/img/warning.svg') ?>" class="w200" alt="warning">
		</div>
		<h2 class="err-title">این کامپیوتر مجاز به استفاده از برنامه نمی‌باشد</h2>
		<div>لطفاً با پشتیبانی تماس بگیرید</div>
		<div>0799192027</div>
	</div>
</div>
</div>
<!-- content end -->