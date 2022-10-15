				<div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue">
							<div class="portlet-title">
                        		<h4><i class="icon-reorder"></i>Ubah Password </h4>
                     		</div>
                     		<div class="portlet-body form">
                     			<div>
                                 <div class="well">
                                       <h5>Anda akan mengubah password Pengguna</h5>
                                 </div>
                              </div>
                     			<form class="form-horizontal" action="<?php echo site_url("admin/administrator_management/do_change_password") ?>" method="post">
                           			<input type="hidden" class="span6 m-wrap" name="pasien_id" value="<?php echo $admin_id ?>"/>
                                    <div class="control-group">
                              			<label class="control-label">Password Baru </label>
                              			<div class="controls">
                                 			<input type="password" class="span6 m-wrap" name="new_password"/>
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