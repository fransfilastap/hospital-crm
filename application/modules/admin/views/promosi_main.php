				<!-- END PAGE HEADER-->
				<style type="text/css">
               #networkModal{ width:1200px; margin-left: -600px;}
            </style>
            <div class="row-fluid">
					<div class="span12">
                  <div class="row-fluid">
                     <a href="#registrasiModal" class="icon-btn span2" data-toggle="modal">
                        <i class="icon-pencil"></i>
                        <div>Tambah Promosi</div>
                     </a>
                  </div>
                  <div  id="registrasiModal"class="modal hide fade">
                     <div class="modal-header"><h5><b>Daftar</b></h5></div>
                     <div class="modal-body">

                     </div>
                     <div class="modal-footer">
                        <div id="loadingDiv" class="pull-left">
                           <img src="<?php echo site_url("assets/loading.gif") ?>">
                        </div>
                        <a href="#" class="btn" data-dismiss="modal">Tutup</a>
                     </div>
                  </div>
						<div class="portlet box blue">
							<div class="portlet-title">
                        		<h4><i class="icon-reorder"></i>Daftar Promosi </h4>
                     </div>
                     <div class="portlet-body form">
                        <table class="table table-striped table-bordered" id="sample_1">
                           <thead>
                              <tr>
                                 <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                 <th>No. Promosi</th>
                                 <th class="hidden-phone">Keterangan</th>
                                 <th class="hidden-phone">Jumlah Target</th>
                                 <th class="hidden-phone">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd gradeX">
                                 <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                 <td>shuxer</td>
                                 <td class="hidden-phone"><a href="mailto:shuxer@gmail.com">shuxer@gmail.com</a></td>
                                 <td class="hidden-phone">120</td>
                                 <td class="center hidden-phone">12 Jan 2012</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
						</div>
					</div>
				</div>
            <script type="text/javascript">
            </script>