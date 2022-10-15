                  <script type="text/javascript" src="<?php echo site_url("assets/back/js/menu.js") ?>"></script>
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Tambah Promosi</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form method="POST" action="<?php echo site_url("admin/kunjungan_poli/proses_edit") ?>" class="form-horizontal" id="menu_form" />
                           <div>
                              <?php echo @$notification; ?>
                           </div>
                           <div class="control-group">
                              <input name="id_kunjungan" type="hidden" value="<?php echo $id_kunjungan; ?>" />
                              <label class="control-label">Nomor Urut Antrian</label>
                              <div class="controls">
                                 <input name="nomor_urut" id="nomor_urut" class="span6 m-wrap" type="text" placeholder="Nomor urut" value="<?php echo $nomor_urut; ?>" />
                                 <span class="help-inline">Nomor urut mungkin berbeda saat disimpan.</span>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Pasien</label>
                              <div class="controls">
                                 <input name="id_pasien" type="hidden" value="<?php echo $id_pasien; ?>" />
                                 <select name="pasien" id="pasien" class="span6 chosen" data-placeholder="Pilih Pasien..." tabindex="1">
                                    <option value="" />
                                    <?php foreach ($pasiens as $key => $pasien) { ?>
                                    <option value="<?php echo $pasien->id_pasien ?>" /><?php echo $pasien->id_pasien." :: ".$pasien->nama_pasien ?>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Poliklinik Tujuan</label>
                              <div class="controls">
                                 <select name="poliklinik" id="poliklinik" class="span6 chosen" data-placeholder="Pilih Poliklinik..." tabindex="1">
                                    <option value="" />
                                    <?php foreach ($polikliniks as $key => $poliklinik) { ?>
                                    <option value="<?php echo $poliklinik->id_poliklinik ?>" /><?php echo $poliklinik->nama_poliklinik; ?>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Tanggal Kunjungan</label>
                              <div class="controls">
                                 <input name="tanggal_kunjungan" class="m-wrap m-ctrl-medium" size="16" type="text" value="<?php echo $tanggal_kunjungan; ?>" id="tanggal_kunjungan" />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Kode Konfirmasi</label>
                              <div class="controls">
                                 <input name="kode_konfirmasi" class="span4 m-wrap" type="text" placeholder="Disabled input here..." value="<?php echo $kode_konfirmasi; ?>" />
                                 <span class="help-inline">Some hint here</span>
                              </div>
                           </div>
                           <div class="form-actions">
                              <button type="submit" class="btn blue">Simpan</button>
                              <a href="<?php echo site_url("admin/kunjungan_poli"); ?>"  class="btn">Batal</a>
                           </div>
                           <div id="result">
                        </div>
                        </form>
                        <!-- END FORM-->           
                     </div>
                  </div>
                  </div>
                  <script type="text/javascript">
                     $(document).ready(function(){

                           var nomor_urut =  "<?php echo $nomor_urut; ?>";
                           var id_poli    =  "<?php echo $id_poli; ?>";

                           $('#tanggal_kunjungan').datepicker({
                               dateFormat: 'yyyy-MM-dd'
                           });


                           $("#pasien").val("<?php echo $id_pasien; ?>");
                           $("#poliklinik").val( id_poli );



                           $('#poliklinik').on("change",function(){
                                 var val = this.value;

                                 if( val.localeCompare( id_poli ) != 0  ){
                                    
                                    $.ajax({        
                                                 url : "<?php echo site_url('admin/kunjungan_poli/getnourut') ?>",
                                                 type: "POST",
                                                 data : {"id_poli" : val},
                                                 dataType: 'json',
                                                 success:function(data, textStatus, jqXHR) 
                                                 {     
                                                     var result_type = "";

                                                     if( textStatus != "undefined" && textStatus == "success" )
                                                     {
                                                         $("#nomor_urut").val( data.no_urut );
                                                     }
                                                     else{
                                                         $("#nomor_urut").val( "1" );
                                                     }

                                                 },
                                                 error: function(jqXHR, textStatus, errorThrown) 
                                                 {
                                                     alert(jqXHR);   
                                                 }
                                     });  
                                 }
                                 else{
                                    $("#nomor_urut").val( nomor_urut );
                                 }
                           });


                           $("#tanggal_kunjungan").val(Date.today().toString("yyyy-MM-dd"));
                     });
                  </script>
