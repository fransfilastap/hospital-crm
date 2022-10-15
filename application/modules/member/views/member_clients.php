				<!-- END PAGE HEADER-->
				<style type="text/css">
               #networkModal{ width:1200px; margin-left: -600px;}
            </style>
            <div class="row-fluid">
					<div class="span12">
                  <div class="row-fluid">
                     <a href="#networkModal" class="icon-btn span2" data-toggle="modal">
                        <i class="icon-sitemap"></i>
                        <div>Lihat Pohon Bisnis</div>
                     </a>
                  </div>
                  <div  id="networkModal"class="modal hide fade">
                     <div class="modal-header"><h5><b>Pohon Bisnis</b></h5></div>
                     <div class="modal-body">
                           <style type="text/css">
      
                                 div.orgChart div.node {
                                       width: 70px;
                                       height: 100px;
                                       border-radius: 30px;
                                       -moz-border-radius : 30px;
                                       -webkit-border-radius : 30px;
                                       -o-border-radius : 30px;
                                       font-size: 1em;
                                       line-height: 1px;
                                   }
                                 div.orgChart div.node.empty{
                                    background-color: #fff;
                                 }
                                 
                           </style>
                           <div id="main"></div>
                           <div id="placement"></div>
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
                        		<h4><i class="icon-reorder"></i>Clients Anda </h4>
                     </div>
                     <div class="portlet-body form">
                        <table class="table table-striped table-bordered" id="sample_1">
                           <thead>
                              <tr>
                                 <th>Nama/Email</th>
                                 <th class="hidden-phone">Telepon</th>
                                 <th class="hidden-phone">Status</th>
                                 <th class="hidden-phone">Bank</th>
                                 <th class="hidden-phone">A/N</th>
                                 <th class="hidden-phone">No. Rekening</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach ($pasiens as $key => $pasien) { ?>
                                    
                              <tr class="odd gradeX">
                                 <td><?php echo mailto($pasien->pasien_email,$pasien->pasien_name); ?></td>
                                 <td class="hidden-phone"><?php echo $pasien->pasien_phone_number; ?></td>
                                 <td class="center hidden-phone"><?php echo $pasien->pasien_status; ?></td>
                                 <td class="hidden-phone"><span class="label label-success"><?php echo $pasien->pasien_bank; ?></span></td>
                                 <td class="hidden-phone"><span class="label label-success"><?php echo $pasien->pasien_atasnama; ?></span></td>
                                 <td class="hidden-phone"><span class="label label-success"><?php echo $pasien->pasien_rekening; ?></span></td>
                              </tr>

                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
						</div>
					</div>
				</div>
            <script type="text/javascript">

                  $('#networkModal').on('shown', function() {
                     $.ajax({
                                type: "GET",
                                url: "<?php echo site_url('pasien/affiliate_tree'); ?>",
                                dataType: 'html',
                                success: function(data, textStatus, jqXHR){
                                 $("#placement").html( data );
                                 $("#network").orgChart({container: $("#main")});
                                 $("#network").hide();
                                },
                                error: function(jqXHR, textStatus, errorThrown){
                                 $("#placement").html( textStatus );
                                }
                              });
                  $('#loadingDiv').hide().ajaxStart( function() {
                        $(this).show();  // show Loading Div
                     } ).ajaxStop ( function(){
                           $(this).hide(); // hide loading div
                  });
                     
                  });

            </script>