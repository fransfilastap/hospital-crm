        <!-- END PAGE HEADER-->
         <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
            <div class="row-fluid">
          <div class="span12">
                  <!-- BEGIN TAB PORTLET-->   
                  <div class="portlet box blue tabbable">
                    <div class="portlet-title">
                      <h4><i class="icon-reorder"></i>Daftar Pertanyaan Konsultasi</h4>
                    </div>
                    <div class="portlet-body">
                      <div class="tabbable portlet-tabs">
                        <ul class="nav nav-tabs">
                          <li><a href="#sudah" data-toggle="tab" id="blm_dijawab">SUDAH DIJAWAB</a></li>
                          <li class="active"><a href="#belum" data-toggle="tab" id="sdh_dijawab">BELUM DIJAWAB</a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="belum">
                            <table class="table table-striped table-bordered" id="t_belum">
                               <thead>
                                  <tr>
                                     
                                     <th class="hidden-phone">Penanya</th>
                                     <th class="hidden-phone">Judul Topik</th>
                                     <th class="hidden-phone">Pertanyaan</th>
                                     <th class="hidden-phone">Email</th>
                                     <th class="hidden-phone">Waktu</th>
                                     <th class="hidden-phone">Tampilkan</th>
                                     <th class="hidden-phone">Aksi</th>
                                  </tr>
                               </thead>
                               <tbody>
                               </tbody>
                            </table>
                          </div>
                          <div class="tab-pane" id="sudah">
                            <table class="table table-striped table-bordered" id="t_sudah">
                               <thead>
                                  <tr>
                                     
                                     <th class="hidden-phone">Penanya</th>
                                     <th class="hidden-phone">Judul Topik</th>
                                     <th class="hidden-phone">Pertanyaan</th>
                                     <th class="hidden-phone">Email</th>
                                     <th class="hidden-phone">Waktu</th>
                                     <th class="hidden-phone">Tampilkan</th>
                                     <th class="hidden-phone">Aksi</th>
                                  </tr>
                               </thead>
                               <tbody>
                               </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END TAB PORTLET-->
          </div>
        </div>
        <div  id="removalModal"class="modal hide fade">
           <div class="modal-header"><h5><b>Hapus Promosi</b></h5></div>
           <div class="modal-body">
              <h5>Apakah anda yakin ingin menghapus data registrasi ini?</h5>
           </div>
           <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Tidak</a>
              <a href="#" class="btn blue yes">Ya</a>
           </div>
        </div>
        <div id="response">
        </div>
        <script type="text/javascript">

          $(document).ready(function(){

              var sSource = "<?php echo site_url('admin/ekonsultasi/lists'); ?>";
              var replyLink = "<?php echo site_url('admin/ekonsultasi/get'); ?>";
              var updateLink = "<?php echo site_url('admin/ekonsultasi/set_visibility'); ?>";
              var deleteLink = "<?php echo site_url('admin/ekonsultasi/delete'); ?>";
              //init table konsultasi belum dijawab
              CRM_APP.fnInitKonsultasi(sSource);

              //init reply
              CRM_APP.fnKonsultasiAct( updateLink, deleteLink);

                    
               
          });

        </script>                                 