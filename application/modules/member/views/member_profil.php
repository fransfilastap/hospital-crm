				<!-- END PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue">
							<div class="portlet-title">
                        		<h4><i class="icon-reorder"></i>Biodata Anda </h4>
                     		</div>
                     		<div class="portlet-body form">
                     			<?php echo $notification; ?>
                     			<form class="form-horizontal" action="<?php echo site_url("pasien/update_profil") ?>" method="post">
                                    <input type="hidden" class="span6 m-wrap" name="id_pasien" value="<?php echo $profile->pasien_id ?>" readonly/>
                           			<div class="control-group">
                              			<label class="control-label">No. Identitas Anda</label>
                              			<div class="controls">
                                 			<input type="text" class="span6 m-wrap" name="no_identitas" value="<?php echo $profile->pasien_nik; ?>"/>
                              			</div>
                           			</div>
                           			<div class="control-group">
                              			<label class="control-label">Nama Anda</label>
                              			<div class="controls">
                                 			<input type="text" class="span6 m-wrap" name="nama_pasien" value="<?php echo $profile->pasien_name; ?>"/>
                              			</div>
                           			</div>
                           			<div class="control-group">
                              			<label class="control-label">Tempat Lahir</label>
                              			<div class="controls">
                                 			<input type="text" class="span6 m-wrap" name="tempat_lahir" value="<?php echo $profile->pasien_tempat_lahir; ?>"/>
                              			</div>
                           			</div>
                           			<div class="control-group">
                              			<label class="control-label">Tanggal Lahir</label>
                              			<div class="controls">
                                 			<input class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="<?php echo $profile->pasien_tanggal_lahir ?>" name="tanggal_lahir" />
                              			</div>
                          			</div>
                           			<div class="control-group">
                              			<label class="control-label">Jenis Kelamin</label>
                              			<div class="controls">
                                 			<label class="radio line">
                                 				<input type="radio" name="sex" value="Laki-laki" class="sex"/>
                                 				Laki-Laki
                                 				</label>
                                 			<label class="radio line">
                                 				<input type="radio" name="sex" value="Perempuan" class="sex"/>
                                 				Perempuan
                                 			</label>   
                              			</div>
                           			</div>
                           			<div class="control-group">
                              			<label class="control-label">Alamat</label>
                              			<div class="controls">
                                 			<textarea class="span6 m-wrap" rows="3" name="alamat"><?php echo $profile->pasien_address; ?></textarea>
                              			</div>
                           			</div>
                                    <div class="control-group">
                                       <label class="control-label">Provinsi</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="provinsi" value="<?php echo $profile->pasien_province; ?>" />
                                       </div>
                                    </div>
                           			<div class="control-group">
                              			<label class="control-label">Kota</label>
                              			<div class="controls">
                                 			<input type="text" class="span6 m-wrap" name="kota" value="<?php echo $profile->pasien_city; ?>" />
                              			</div>
                           			</div>
                                    <div class="control-group">
                                       <label class="control-label">Kode Pos</label>
                                       <div class="controls">
                                          <input type="text" class="span2 m-wrap" name="kode_pos" value="<?php echo $profile->pasien_postal_code; ?>" />
                                       </div>
                                    </div>
                           			<div class="control-group">
                              			<label class="control-label">Nomor Telepon</label>
                              			<div class="controls">
                                 			<input type="text" class="span6 m-wrap" name="nomor_telepon" value="<?php echo $profile->pasien_phone_number; ?>" />
                              			</div>
                           			</div>                          			
                           			<div class="control-group">
                              			<label class="control-label">Email </label>
                              			<div class="controls">
                                 			<div class="input-prepend">
                                    			<span class="add-on">@</span><input class="m-wrap " type="text" placeholder="Alamat Email" name="email" value="<?php echo $profile->pasien_email; ?>"/>
                                 			</div>
                              			</div>
                           			</div>
                                    <div class="control-group">
                                       <label class="control-label">Username</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="username" value="<?php echo $profile->pasien_username; ?>" />
                                       </div>
                                    </div> 
                                    <div class="control-group">
                                       <label class="control-label">Bank</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="bank" value="<?php echo $profile->pasien_bank; ?>" />
                                       </div>
                                    </div> 
                                    <div class="control-group">
                                       <label class="control-label">No. Rekening</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="no_rekening" value="<?php echo $profile->pasien_rekening; ?>" />
                                       </div>
                                    </div> 
                                    <div class="control-group">
                                       <label class="control-label">Atas Nama</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="atas_nama" value="<?php echo $profile->pasien_atasnama; ?>" />
                                       </div>
                                    </div> 
                                    <div class="control-group">
                                       <label class="control-label">URL Web Replika</label>
                                       <div class="controls">
                                          <div class="input-prepend">
                                             <span class="add-on"><?php echo site_url("reg"); ?>/</span><input class="m-wrap " type="text" placeholder="referal" name="url_referal" value="<?php echo $profile->pasien_url; ?>"/>
                                          </div>
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

            <script type="text/javascript">
                        $(".sex").each( function(){
                              var current_val = "<?php echo $profile->pasien_sex; ?>";
                              var this_val = $(this).val();
                              var diz = $(this);
                              if( this_val == current_val )
                              {
                                 if( diz.prop("checked") == false ){
                                    diz.prop("checked",true);
                                 }

                              }

                           } );
            </script>