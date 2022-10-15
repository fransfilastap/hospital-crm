				<div id="dashboard">
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row-fluid">
					<!-- BEGIN NEWS PORTLET-->
						<div class="span12">
							<div class="portlet">
								<div class="portlet-title">
									<h4><i class="icon-list-alt"></i>Pengumuman</h4>
									<div class="tools">
										<a href="javascript:;" class="collapse"></a>
									</div>
								</div>
								<div class="portlet-body">
									<?php foreach ($announcements as $announcement) { ?>
									<div class="well">
										<h4><?php echo $announcement->ann_title; ?></h4>
										<div><?php echo $announcement->ann_content; ?></div>
									</div>
									<?php }  ?>
								</div>
							</div>
						</div>
						<!-- END NEWS PORTLET-->
                        <div class="row-fluid">
                  <div class="span3 responsive" data-tablet="span3" data-desktop="span3">
                     <div class="dashboard-stat blue">
                        <div class="visual">
                           <i class="icon-money"></i>
                        </div>
                        <div class="details">
                           <div class="number">
                              <?php echo "Rp. ".formatWithSuffix($bonus->deposit);?>
                           </div>
                           <div class="desc">                           
                             Bonus Deposit
                           </div>
                        </div>
                        <a class="more" href="<?php echo site_url('pasien/bonus')?>">
                        Withdraw <i class="m-icon-swapright m-icon-white"></i>
                        </a>                 
                     </div>
                  </div>
                  <div class="span3 responsive" data-tablet="span3" data-desktop="span3">
                     <div class="dashboard-stat green">
                        <div class="visual">
                           <i class="icon-money"></i>
                        </div>
                        <div class="details">
                           <div class="number">
                              <?php echo "Rp. ".formatWithSuffix($bonus->bonus); ?>
                           </div>
                           <div class="desc">Bonus Cash</div>
                        </div>
                        <a class="more" href="<?php echo site_url('pasien/bonus')?>">
                        Withdraw <i class="m-icon-swapright m-icon-white"></i>
                        </a>                 
                     </div>
                  </div>
                  <div class="span3 responsive" data-tablet="span3" data-desktop="span3">
                     <div class="dashboard-stat yellow">
                        <div class="visual">
                           <i class="icon-group"></i>
                        </div>
                        <div class="details">
                           <div class="number">
                              <?php echo $pasangan; ?>
                           </div>
                           <div class="desc">Jumlah Pasangan</div>
                        </div>
                        <a class="more popovers" data-trigger="hover" data-content="<?php echo 'Kiri : '.$pasangan_detail['left'].' | Kanan : '.$pasangan_detail['right'] ?>" data-original-title="Detil Pasangan" href="<?php echo site_url('pasien/clients')?>">
                        Detil <i class="m-icon-swapright m-icon-white"></i>
                        </a>                 
                     </div>
                  </div>
                  <div class="span3 responsive" data-tablet="span3" data-desktop="span3">
                     <div class="dashboard-stat purple">
                        <div class="visual">
                           <i class="icon-trophy"></i>
                        </div>
                        <div class="details">
                           <div class="number">
                              <?php echo "Top Star"; ?>
                           </div>
                           <div class="desc">Award</div>
                        </div>
                        <a class="more" href="<?php echo site_url('pasien/clients')?>">
                        Detil <i class="m-icon-swapright m-icon-white"></i>
                        </a>                 
                     </div>
                  </div>
               </div>
					</div>
					<!-- END DASHBOARD STATS -->
					<div class="clearfix"></div>
				</div>