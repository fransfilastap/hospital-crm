				<div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue">
							<div class="portlet-title">
                        		<h4><i class="icon-reorder"></i>Ubah Password </h4>
                     		</div>
                     		<div class="portlet-body form">
                     			<?php echo $change_password_status; ?>
                     			<form class="form-horizontal" action="<?php echo site_url("pasien/do_change_password") ?>" method="post">
                     				<div class="control-group">
                              			<label class="control-label">Password Sekarang </label>
                              			<div class="controls">
                                 			<input type="password" class="span6 m-wrap" name="current_password"/>
                              			</div>
                           			</div>
                           			<div class="control-group">
                              			<label class="control-label">Password Baru </label>
                              			<div class="controls">
                                 			<input type="password" class="span6 m-wrap" name="new_password"/>
                              			</div>
                           			</div>
                           			<div class="control-group">
                              			<label class="control-label">Konfirmasi Password Baru </label>
                              			<div class="controls">
                                 			<input type="password" class="span6 m-wrap" name="conf_newpassword"/>
                              			</div>
                           			</div>
                                <div class="form-actions">
                              		<button type="submit" class="btn blue">Ubah Password</button>
                           		</div>
                     			</form>
                     		</div>
                     		<div>
                     		</div>
						</div>
					</div>
				</div>