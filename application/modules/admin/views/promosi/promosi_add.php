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
                        <form method="POST" action="<?php echo site_url("admin/promosi/process_add") ?>" class="form-horizontal" id="menu_form" />
                           <div>
                              <?php echo @$notification; ?>
                           </div>
                            <div class="control-group">
                              <label class="control-label">Judul Promosi</label>
                              <div class="controls">
                                 <input type="text" class="span8 m-wrap" name="judul_promosi" id="judul_promosi"/>
                                 <div id="notif_1"></div>
                                </div>
                           </div>
                           <div class="control-group">                                
                              <label class="control-label">Sms Promosi</label>
                              <div class="controls">
                                 <textarea class="span6 m-wrap" rows="3" name="isi_promosi"></textarea>
                              </div>
                           </div>
                           <div class="control-group">                                
                              <label class="control-label">Isi Web</label>
                              <div class="controls">
                                 <textarea class="wysihtml5 span6 m-wrap" rows="3" name="web_promosi"></textarea>
                              </div>
                           </div>
                           <div class="form-actions">
                              <button type="submit" class="btn blue">Simpan</button>
                              <a href="<?php echo site_url("admin/promosi"); ?>"  class="btn">Batal</a>
                           </div>
                           <div id="result">
                        </div>
                        </form>
                        <!-- END FORM-->           
                     </div>
                  </div>
                  </div>
                  <script type="text/javascript">
                     //RajaPartnerMenu.init("<?php echo site_url('admin/portal_menu'); ?>");
                  </script>