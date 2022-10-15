				<!-- END PAGE HEADER-->
         <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
          <div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue">
							<div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Pesan Terkirim</h4>
                        <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                              <a href="#portlet-config" data-toggle="modal" class="config"></a>
                              <a href="#" class="reload" id="refresh"></a>
                         </div>
                     </div>
                     <div class="portlet-body form">
                                <div class="row-fluid">
            <div class="span12">
              <div id="response"></div>
            </div>
         </div>
                        <table class="table table-striped table-bordered" id="sentitems">
                           <thead>
                              <tr>
                                
                                 <th class="hidden-phone">Waktu</th>
                                 <th class="hidden-phone">Nomor Penerima</th>
                                 <th class="hidden-phone">Nama Penerima</th>
                                 <th class="hidden-phone">Pesan</th>
                                 <th class="hidden-phone">Status</th>
                                 <th class="hidden-phone">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                                                <div  id="removalModal"class="modal hide fade">
                           <div class="modal-header"><h5><b>Hapus Pesan Terkirim</b></h5></div>
                           <div class="modal-body">
                              <h5>Apakah anda yakin ingin menghapus pesan ini?</h5>
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
              CRM_APP.smsGateaway( "<?php echo site_url('admin/smsgateaway/sentitems_list') ?>", "#sentitems" );
              CRM_APP.replySMS("<?php echo site_url('admin/smsgateaway/get_sent') ?>");

              var id      = "";
              var link    = "";
                                           
              $(".delete").live("click",function(){
                id       = $(this).attr("data-id");
                link  = "<?php echo site_url('admin/smsgateaway/sent_delete'); ?>"+"/"+id;

                $(".yes").attr("href",link);

                $(".yes").live("click",function(e){
                    e.preventDefault();

                    $.post(link, function(data){
                        $("#removalModal").modal("hide");
                        CRM_APP.fnRefreshTable();
                    },"json").fail(function(data){
                      var respns = "<div class='alert alert-error'>"+
                  "<button class='close' data-dismiss='alert'></button>"+
                  "<strong>Error!</strong> Pesan gagal dihapus."+
                "</div>";

                      $("#response").html(respns);
                    }).success(function(data){

                      var respns = "<div class='alert alert-success'>"+
                  "<button class='close' data-dismiss='alert'></button>"+
                  "<strong>Berhasil!</strong> Pesan telah dihapus."+
                "</div>";

                      $("#response").html(respns);
                    });
                }).done(function(){
                  App.scrollTo($('#response'));
                });
              });

          });

        </script>                                 