<style>
	.upload-container {
		padding: 15px;
		background: #e3e3e3;
		border-radius: 3px;
		display: block;
		max-width: 390px;
		margin: 0 auto 25px auto;
	}

	.file-upload-btn {
		border: 1px dashed #efefef;
		padding: 5px;
	}

	.notifyContent {
		display: block;
		color: #fff;
		max-width: 386px;
		padding: 5px 0;
		border-radius: 3px;
		margin: 10px 0;
	}

	.notifyContent p {
		margin: 0;
	}
</style>

<div>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<div align="center">
						<div id="notify" <?= (empty($notify) ? 'style="margin:5px 0;"' : '') ?>><?php echo $notify; ?></div>
						<div class="upload-container">
							<h4>Select files from your computer</h4>
							<?php echo form_open_multipart('uploadFile', array('id' => 'uploadFile')); ?>
							<div class="form-inline">
								<div class="form-group file-upload-btn">
									<input type="file" name="userfile" />
								</div>
								<button type="submit" name="submit" class="btn btn-sm btn-primary" id="js-upload-submit" style="margin-left:10px;">Upload file</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
