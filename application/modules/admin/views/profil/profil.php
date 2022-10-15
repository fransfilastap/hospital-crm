				<!-- END PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue">
							<div class="portlet-title">
                        		<h4><i class="icon-user"></i>Profil Anda </h4>
                           <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                           </div>
                     		</div>
                     		<div class="portlet-body form">
                     			<?php echo $notification; ?>
                     			<form class="form-horizontal" action="<?php echo site_url("admin/profil/update_profil") ?>" method="post">
                                    <input type="hidden" class="span6 m-wrap" name="id_pasien" value="<?php echo $profil[0]->admin_id ?>" readonly/>
                           			<div class="control-group">
                              			<label class="control-label">Nama</label>
                              			<div class="controls">
                                 			<input type="text" class="span6 m-wrap" name="nama" value="<?php echo $profil[0]->name; ?>"/>
                              			</div>
                           			</div>
                                    <div class="control-group">
                                       <label class="control-label">Username</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="username" value="<?php echo $profil[0]->username; ?>"/>
                                       </div>
                                    </div>
                                <div class="form-actions">
                              		<button type="submit" class="btn blue">Simpan</button>
                                 </div>
                     			</form>
                     		</div>
                     		<div>
                     		</div>
						</div>
					</div>
				</div>
            <div class="row-fluid">
               <div class="span12">
                  <div class="portlet box blue">
                     <div class="portlet-title">
                              <h4><i class="icon-reorder"></i>Ubah Password </h4>
                              <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                           </div>
                           </div>
                           <div class="portlet-body form">
                              <?php echo $change_password_notification; ?>
                              <form class="form-horizontal" action="<?php echo site_url("admin/profil/do_change_password") ?>" method="post">
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