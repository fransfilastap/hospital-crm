				<!-- END PAGE HEADER-->
         
         <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
          <div class="row-fluid">
              <div class="span12">
                  <div class="portlet box green">
                      <div class="portlet-title">
                        <h4><i class="icon-order"></i>Menu</h4>
                        <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                              <a href="#portlet-config" data-toggle="modal" class="config"></a>
                              <a href="#" class="reload" id="refresh"></a>
                         </div>
                      </div>
                      <div class="portlet-body form">
                          <div class="row-fluid">
                              <a href="#tambahModal" class="icon-btn span2" data-toggle="modal">
                                 <i class="icon-pencil"></i>
                                 <div>Tambah Jadwal Dokter</div>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue">
							<div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Jadwal Dokter</h4>
                        <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                              <a href="#portlet-config" data-toggle="modal" class="config"></a>
                              <a href="#" class="reload" id="refresh"></a>
                         </div>
                     </div>
                     <div class="portlet-body form">
                        <table class="table table-striped table-bordered" id="jadwal_dokter">
                           <thead>
                              <tr>
                                 <th class="hidden-phone">Hari</th>
                                 <th class="hidden-phone">Jam Mulai</th>
                                 <th class="hidden-phone">Jam Selesai</th>
                                 <th class="hidden-phone">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                        <div  id="hapusModal"class="modal hide fade">
                           <div class="modal-header"><h5><b>Hapus Jadwal Dokter</b></h5></div>
                           <div class="modal-body">
                              <h5>Apakah anda yakin ingin jadwal ini?</h5>
                           </div>
                           <div class="modal-footer">
                              <a href="#" class="btn" data-dismiss="modal">Tidak</a>
                              <a href="#" class="btn blue yes">Ya</a>
                           </div>
                        </div>
                        <div  id="tambahModal"class="modal hide fade">
                           <div class="modal-header"><h5><b>Tambah Jadwal</b></h5></div>
                           <div class="modal-body">
                            <form method="POST" action="<?php echo site_url("admin/jadwal_dokter/simpan") ?>" class="form-horizontal" id="jadwal_add_form">
                               
                               <div class="control-group">
                                  <label class="control-label">Hari</label>
                                  <div class="controls">
                                    <input type="hidden" name="id_dokter" value="<?php echo $id_dokter; ?>">
                                     <select name="hari" class="span6" data-placeholder="Pilih Hari..." tabindex="1">
                                        <option value="" />
                                        <?php foreach ($list_hari as $key => $hari) { ?>
                                        <option value="<?php echo $hari->id_waktu_jadwal ?>" /><?php echo $hari->hari; ?>
                                        <?php } ?>
                                     </select>
                                  </div>
                               </div>
                                <div class="control-group">
                                  <label class="control-label">Jam Mulai :</label>
                                  <div class="controls">
                                     <div class="input-append bootstrap-timepicker-component">
                                        <input class="m-wrap m-ctrl-small timepicker-24" name="jam_mulai" type="text" />
                                        <span class="add-on"><i class="icon-time"></i></span>
                                     </div>
                                  </div>
                               </div>
                                <div class="control-group">
                                  <label class="control-label">Jam Akhir :</label>
                                  <div class="controls">
                                     <div class="input-append bootstrap-timepicker-component">
                                        <input class="m-wrap m-ctrl-small timepicker-24" name="jam_akhir" type="text" />
                                        <span class="add-on"><i class="icon-time"></i></span>
                                     </div>
                                  </div>
                               </div>
                            
                           </div>
                           <div class="modal-footer">
                              <div id="resultTambah" class="pull-left"></div>
                              <a href="#" class="btn" data-dismiss="modal">Batal</a>
                              <button type="submit" class="btn blue yes">Simpan</button>
                           </div>
                         </form>
                        </div>
                      </div>
                        <div  id="editModal"class="modal hide fade">
                           <div class="modal-header"><h5><b>Edit Jadwal</b></h5></div>
                           <div class="modal-body">
                            <form method="POST" action="<?php echo site_url("admin/jadwal_dokter/editnian") ?>" class="form-horizontal" id="jadwal_edit_form">
                               <div class="control-group">
                                  <input type="hidden" name="id_dokter_edit" value="<?php echo $id_dokter; ?>"/>
                                  <input type="hidden" name="id_waktu_current"/>
                                  <label class="control-label">Hari</label>
                                  <div class="controls">
                                     <select name="hari_edit" id="hari_edit" class="span6" data-placeholder="Pilih Hari..." tabindex="1">
                                        <option value="" />
                                        <?php foreach ($list_hari as $key => $hari) { ?>
                                        <option value="<?php echo $hari->id_waktu_jadwal ?>" /><?php echo $hari->hari; ?>
                                        <?php } ?>
                                     </select>
                                  </div>
                               </div>
                                <div class="control-group">
                                  <label class="control-label">Jam Mulai :</label>
                                  <div class="controls">
                                     <div class="input-append bootstrap-timepicker-component">
                                        <input class="m-wrap m-ctrl-small timepicker-24" id="jam_mulai_edit" name="jam_mulai" type="text" />
                                        <span class="add-on"><i class="icon-time"></i></span>
                                     </div>
                                  </div>
                               </div>
                                <div class="control-group">
                                  <label class="control-label">Jam Akhir :</label>
                                  <div class="controls">
                                     <div class="input-append bootstrap-timepicker-component">
                                        <input class="m-wrap m-ctrl-small timepicker-24" id="jam_akhir_edit" name="jam_akhir" type="text" />
                                        <span class="add-on"><i class="icon-time"></i></span>
                                     </div>
                                  </div>
                               </div>
                            
                           </div>
                           <div class="modal-footer">
                              <div id="resultEdit" class="pull-left"></div>
                              <a href="#" class="btn" data-dismiss="modal">Batal</a>
                              <button type="submit" class="btn blue yes">Simpan</button>
                           </div>
                         </form>
                        </div>
                     </div>
						</div>
					</div>
				</div>

        <script type="text/javascript">

          $(document).ready(function(){
            CRM_APP.fnBuildDTJadwalDokter("<?php echo $id_dokter; ?>","<?php echo site_url('admin/jadwal_dokter/lists_dokter'); ?>");
            CRM_APP.fnInitEditJadwalDokter("<?php echo site_url('admin/jadwal_dokter/get_jadwal') ?>");
            CRM_APP.iniDeleteJadwalDokter("<?php echo site_url('admin/jadwal_dokter/delete') ?>")
          });

        </script>                                 