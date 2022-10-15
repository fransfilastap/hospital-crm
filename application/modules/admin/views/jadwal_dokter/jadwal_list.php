				<!-- END PAGE HEADER-->
         <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
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
                                 <th class="hidden-phone">Nama Dokter</th>
                                 <th class="hidden-phone">Hari Kerja</th>
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
        <script type="text/javascript">

          $(document).ready(function(){
            CRM_APP.fnBuildDTJadwal("<?php echo site_url('admin/jadwal_dokter/lists'); ?>");
          });

        </script>                                 