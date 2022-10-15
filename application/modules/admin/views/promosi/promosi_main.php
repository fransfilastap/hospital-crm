				<!-- END PAGE HEADER-->
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
                              <a href="<?php echo site_url("admin/promosi/add") ?>" class="icon-btn span2" data-toggle="modal">
                                 <i class="icon-pencil"></i>
                                 <div>Tambah Promosi</div>
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
                        	<h4><i class="icon-reorder"></i>Daftar Promosi </h4>
                     </div>
                     <div class="portlet-body form">
                        <table class="table table-striped table-bordered" id="sample_1">
                           <thead>
                              <tr>
                                
                                 <th>No. Promosi</th>
                                 <th class="hidden-phone">Tagline</th>
                                 <th class="hidden-phone">Versi Web</th>
                                 <th class="hidden-phone">Detil</th>
                                 <th class="hidden-phone">Tanggal Promosi</th>
                                 <th class="hidden-phone">Status</th>
                                 <th class="hidden-phone">Jumlah Target</th>
                                 <th class="hidden-phone">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                                 foreach ($promos as $key => $promo) {
                              ?>
                              <tr class="odd gradeX">
                                 <td><?php echo $promo['id_prom'] ?></td>
                                 <td class="hidden-phone"><?php echo $promo['judul_promosi']; ?></td>
                                 <td class="hidden-phone"><?php echo $promo['sms_promosi']; ?></td>
                                 <td class="hidden-phone"><?php echo $promo['web_promosi']; ?></td>
                                 <td class="hidden-phone"><?php echo $promo['tgl_promosi']; ?></td>
                                 <td class="hidden-phone"><?php echo $promo['isSebar']; ?></td>
                                 <td class="hidden-phone"><?php echo $promo['jumlah_target']; ?></td>
                                 <td class="center hidden-phone">
                                    <div class="btn-group">
                                       <a class="btn green" href="#" data-toggle="dropdown">
                                       <i class="icon-wrench"></i> Aksi
                                       <i class="icon-angle-down"></i>
                                       </a>
                                       <ul class="dropdown-menu">
                                          <li><a href="<?php echo site_url('admin/promosi/edit/'.$promo['id_prom']); ?>"><i class="icon-trash"></i> Edit</a></li>
                                          <li><a href="#removalModal" class="delete" data-id="<?php echo $promo['id_prom']; ?>" data-toggle="modal"><i class="icon-remove"></i> Delete</a></li>
                                          <li class="divider"></li>
                                          <li><a href="<?php echo site_url('admin/promosi/publish_preview/'.$promo['id_prom']); ?>"><i class="icon-envelope"></i> Sebar Promosi</a></li>
                                       </ul>
                                    </div>
                                 </td>
                              </tr>
                              <?php
                                 }
                              ?>
                           </tbody>
                        </table>
                        <div  id="removalModal"class="modal hide fade">
                           <div class="modal-header"><h5><b>Hapus Promosi</b></h5></div>
                           <div class="modal-body">
                              <h5>Apakah anda yakin ingin promosi ini?</h5>
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
                        var id      = "";
                        var link    = "";
                        var base_url = "<?php echo site_url('admin/promosi') ?>";
                                       
                        $(".delete").click(function()
                        {
                           id       = $(this).attr("data-id");
                           link  = "<?php echo site_url('admin/promosi/delete'); ?>"+"/"+id;

                           $(".yes").attr("href",link);

                           $(".yes").click( function(e){
                              e.preventDefault();

                              $.ajax({
                                type: "GET",
                                url: link,
                                data: null
                              }).done(function(){
                                 $("#removalModal").modal("hide");
                                 setTimeout(function() {
                                             window.location.href = base_url ;
                                       }, 1000);
                              });

                           });
                        });

                     </script>