<!-- BEGIN EXAMPLE TABLE PORTLET-->
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
											<a href="<?php echo site_url( 'admin/portal_menu/add' ) ?>" class="icon-btn span2">
											<i class="icon-pencil"></i>
											<div>Tambah</div>
											</a>
			                          </div>
			                      </div>
			                  </div>
			              </div>
			          </div>
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Daftar Menu</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th style="width:350px;" class="hidden-phone">Menu</th>
											<th class="hidden-phone">Menu Induk</th>
											<th class="hidden-phone">Tipe</th>
											<th class="hidden-phone">Order</th>
											<th class="hidden-phone">Visibilitas</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($portal_menu as $key => $menu) { ?>
										<tr class="odd gradeX">
											<td class="hidden-phone"><?php echo $menu->menu_title; ?></td>
											<td class="hidden-phone"><?php echo $menu->parent_title; ?></td>
											<td class="center hidden-phone"><?php echo $menu->menu_type; ?></td>
											<td class="center hidden-phone"><?php if($menu->menu_order != $menu->first_menu){ echo '<button class="btn blue order-up" data-id="'.$menu->menu_id.'"><i class="icon-arrow-up"></i></button>'; } ?>
																			<?php if($menu->menu_order != $menu->last_menu){ echo '<button class="btn green order-down" data-id="'.$menu->menu_id.'"><i class="icon-arrow-down"></i></button>'; } ?>
											</td>
											<td class="hidden-phone"><?php echo $menu->menu_status; ?></td>
											<td>
												<a href="<?php echo site_url('admin/portal_menu/edit/'.$menu->menu_id) ?>" class="btn icn-only">
													<i class="icon-pencil"></i>
												</a>
												<a href="#removalModal" class="btn red icn-only delete" data-id="<?php echo $menu->menu_id; ?>" data-toggle="modal">
													<i class="icon-remove icon-white"></i>
												</a>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<style type="text/css">
									#upload-modal{ width:1200px;  margin-left: -600px;}
								</style>
								<div  id="removalModal"class="modal hide fade">
									<div class="modal-header"><h5><b>Hapus Posting</b></h5></div>
									<div class="modal-body">
										<h5>Apakah anda yakin ingin menghapus menu item ini?</h5>
									</div>
									<div class="modal-footer">
										<a href="#" class="btn" data-dismiss="modal">Tidak</a>
										<a href="#" class="btn blue yes">Ya</a>
									</div>
								</div>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
							<script type="text/javascript">
								var id 		= "";
								var link 	= "";
								var base_url = "<?php echo site_url('admin/portal_menu') ?>";
													
								$(".delete").click(function()
								{
									id 		= $(this).attr("data-id");
									link 	= "<?php echo site_url('admin/portal_menu/delete'); ?>"+"/"+id;

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
                                                     window.location.href = base_url;
   		                                        }, 2000);
											
										});

									});
								});


								var orderLink = "<?php echo site_url('admin/portal_menu/update_order') ?>";

								$(".order-up").live("click",function(evt){

									evt.preventDefault();
									var link;
									link = orderLink+"/"+"up";


									$.post( link, {"id":$(this).data("id")}, function(data){
											  setTimeout(function() {
                                                     window.location.href = base_url;
   		                                        }, 100);
									} );

								});


								$(".order-down").live("click",function(evt){

									evt.preventDefault();
									var link;
									link = orderLink+"/"+"down";

									$.post( link, {"id":$(this).data("id")}, function(data){

											  setTimeout(function() {
                                                     window.location.href = base_url;
   		                                        }, 100);

									} );

								});

								
							</script>