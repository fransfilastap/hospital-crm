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
                             <a href="<?php echo site_url("admin/kunjungan_poli/registrasi") ?>" class="icon-btn span2" data-toggle="modal">
                                <i class="icon-pencil"></i>
                                <div>Registrasi Ulang</div>
                             </a>
                          <!--<a href="#" class="icon-btn span2">
                            <i class="icon-bar-chart"></i>
                            <div>Laporan</div>
                          </a> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
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
                        <label class="control-label">Poliklinik :</label>
                            <div class="controls">
                                 <select name="poliklinik" id="poliklinik" class="span6 chosen" data-placeholder="Pilih Poliklinik..." tabindex="1">
                                    <?php foreach ($polikliniks as $key => $poliklinik) { ?>
                                    <option value="<?php echo $poliklinik->id_poliklinik ?>" /><?php echo $poliklinik->nama_poliklinik; ?>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                  </form>
						<div class="portlet box blue">
							<div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Daftar Kunjungan Poli </h4>
                        <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                              <a href="#portlet-config" data-toggle="modal" class="config"></a>
                              <a href="#" class="reload" id="refresh"></a>
                         </div>
                     </div>
                     <div class="portlet-body form">
                        <div class="row-fluid">
                            <div class="span12" id="message">
                            </div>
                            <div id="mod"></div>
                        </div>
                        <table class="table table-striped table-bordered" id="kunjungan_poli">
                           <thead>
                              <tr>
                                 <th>No. Urut</th>
                                 <th class="hidden-phone">Antrian</th>
                                 <th class="hidden-phone">Id. Pasien</th>
                                 <th class="hidden-phone">Nama Pasien</th>
                                 <th class="hidden-phone">Poli</th>
                                 <th class="hidden-phone">Kode Konfirmasi</th>
                                 <th class="hidden-phone">Confirmed</th>
                                 <th class="hidden-phone">Tanggal</th>
                                 <th class="hidden-phone">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
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
                     </div>
						</div>
					</div>
				</div>
        <script type="text/javascript">

          $(document).ready(function(){

              CRM_APP.fnBuildDatatable( "<?php echo site_url('admin/kunjungan_poli/lists')?>");
          
              $("#refresh").click(function(e){
                  e.preventDefault();
                  CRM_APP.fnRefreshTable();
              });

              $("#poliklinik").on("change",function(){;
                  CRM_APP.fnRefreshByPoli( this.value );
              });

              //delete kunjungan
              var id      = "";
              var link    = "";
                                           
              $(".delete").live("click",function(){
                id       = $(this).attr("data-id");
                link  = "<?php echo site_url('admin/kunjungan_poli/delete'); ?>"+"/"+id;

                $(".yes").attr("href",link);

                $(".yes").live("click",function(e){
                    e.preventDefault();

                    $.post(link, function(){
                        $("#removalModal").modal("hide");
                        CRM_APP.fnRefreshTable();
                    });
                });
              

              });


              $("#konfirmasi").live("click",function(evt){

                  evt.preventDefault();

                  var link  = "<?php echo site_url('admin/kunjungan_poli/konfirmasi') ?>";
                  var id    = $(this).data("id");
                  var modalOk = "<div  id='okmodal'class='modal hide fade'>"+
                           "<div class='modal-header'><h5><b>Konfimasi</b></h5></div>"+
                           "<div class='modal-body'>"+
                              "<div class='bigicn-only'>"+
                                  "<i class='icon-ok-circle'></i>"+
                              "</div>"+
                              "<h5>Antrian telah berhail dikonfirmasi</h5>"+
                           "</div>"+
                           "<div class='modal-footer'>"+
                              "<a href='#' class='btn blue' data-dismiss='modal'>Tutup</a>"+
                           "</div>"+
                        "</div>";

                  $.post(link,{"id":id},function(data){
                  },"json").success(function(data){
                      $("#mod").html(modalOk);
                      $("#okmodal").modal("show");
                      CRM_APP.fnRefreshTable();

                  }).fail(function(data){

                  }).done(function(data){

                  });

              });

              $("#selesai").live("click",function(evt){

                  evt.preventDefault();

                  var link  = "<?php echo site_url('admin/kunjungan_poli/done') ?>";
                  var id    = $(this).data("id");
                  var modalOk = "<div  id='okmodal'class='modal hide fade'>"+
                           "<div class='modal-header'><h5><b>Tandai Selesai</b></h5></div>"+
                           "<div class='modal-body'>"+
                              "<h5>Antrian telah ditandai selesai</h5>"+
                           "</div>"+
                           "<div class='modal-footer'>"+
                              "<a href='#' class='btn blue' data-dismiss='modal'>Tutup</a>"+
                           "</div>"+
                        "</div>";

                  $.post(link,{"id":id},function(data){
                  },"json").success(function(data){
                      $("#mod").html(modalOk);
                      $("#okmodal").modal("show");
                      CRM_APP.fnRefreshTable();

                  }).fail(function(data){

                  }).done(function(data){

                  });

              });

          });

        </script>                                 