        <!-- END PAGE HEADER-->
         <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
         <!-- <div class="row-fluid">
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
                                 <i class="icon-bar-chart"></i>
                                 <div>Laporan</div>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        -->
          <div class="row-fluid">
          <div class="span12">
                  <form action="#" class="form-vertical" />
                     <div class="control-group">
                        <label class="control-label">Range :</label>
                        <div class="controls">
                           <div id="form-date-range1" class="btn">
                              <i class="icon-calendar"></i>
                              &nbsp;<span></span> 
                              <b class="caret"></b>
                           </div>
                        </div>
                     </div>
                     <div class="control-group">
                        <label class="control-label">Jenis :</label>
                            <div class="controls">
                              <select name="jenis_feedback" id="jenis_feedback" class="span6 chosen" data-placeholder="Pilih Jenis Feedback..." tabindex="1">
                                  <option value="kritik" />Kritik
                                  <option value="saran" />Saran
                              </select>
                        </div>
                    </div>
                  </form>
            <div class="portlet box blue">
              <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Daftar Kritik & Saran </h4>
                        <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                              <a href="#portlet-config" data-toggle="modal" class="config"></a>
                              <a href="#" class="reload" id="refresh"></a>
                         </div>
                     </div>
                     <div class="portlet-body form">
                        <table class="table table-striped table-bordered" id="feedbacks">
                           <thead>
                              <tr>
                                
                                 <th class="hidden-phone">Jenis Feedback</th>
                                 <th class="hidden-phone">Perihal</th>
                                 <th class="hidden-phone">Isi</th>
                                 <th class="hidden-phone">Melalui</th>
                                 <th class="hidden-phone">Waktu</th>
                                 <th class="hidden-phone">Email</th>
                                 <th class="hidden-phone">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                          <div  id="removalModal"class="modal hide fade">
                           <div class="modal-header"><h5><b>Hapus Kritik & Saran</b></h5></div>
                           <div class="modal-body">
                              <h5>Apakah anda yakin ingin menghapus data kritik & saran ini?</h5>
                           </div>
                           <div class="modal-footer">
                              <a href="#" class="btn" data-dismiss="modal">Tidak</a>
                              <a href="#" class="btn blue yes">Ya</a>
                           </div>
                        </div>
                     </div>
            </div>
          </div>
        </div>
        <div id="response">
        </div>
        <script type="text/javascript">

          $(document).ready(function(){

              CRM_APP.initFeedback( "<?php echo site_url('admin/feedback/lists')?>");
          
              $("#refresh").click(function(e){
                  e.preventDefault();
                  CRM_APP.fnRefreshFeedback();
              });

              $("#jenis_feedback").on("change",function(){;
                  CRM_APP.fnRefreshFeedbackByJenis( this.value );
              });

              CRM_APP.fnViewFeedbackDetail("<?php echo site_url('admin/feedback/detail') ?>");
          });

        </script>                                 