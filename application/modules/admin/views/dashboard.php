	<div id="dashboard">		
			<div class="row-fluid">
						<div class="span4 responsive" data-tablet="span6" data-desktop="span4">
							<div class="dashboard-stat blue">
								<div class="visual">
									<i class="icon-user"></i>
								</div>
								<div class="details">
									<div id="tot_pas" class="number">
										
									</div>
									<div class="desc">									
										Total Pasien
									</div>
								</div>
								<a class="more" href="<?php echo site_url('backoffice/pasiens')?>">
								Lihat pasien <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
						<div class="span4 responsive" data-tablet="span6" data-desktop="span4">
							<div class="dashboard-stat green">
								<div class="visual">
									<i class="icon-check"></i>
								</div>
								<div class="details">
									<div id="jum_kunj" class="number">
										
									</div>
									<div class="desc">Jumlah Kunjungan</div>
								</div>
								<a class="more" href="<?php echo site_url('backoffice/transaction')?>">
								Lihat Transaksi <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
						
						<div class="span4 responsive" data-tablet="span9" data-desktop="span4">
							<div class="dashboard-stat red">
								<div class="visual">
									<i class=" icon-thumbs-up"></i>
								</div>
								<div class="details">
									<div id="jum_krit" class="number"></div>
									<div class="desc">Kritik & Saran</div>
								</div>
								<a class="more" href="<?php echo site_url('backoffice/transaction/index/add')?>">
								Cairkan Bonus <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
					</div>
				<div class="clearfix"></div>
			 <div class="row-fluid">
			 			<div class="span12">
						<!-- BEGIN INTERACTIVE CHART PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Kunjungan Poliklinik</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="javascript:;" class="reload"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div id="kunjungan_statistics" class="chart"></div>
							</div>
						</div>
						<!-- END INTERACTIVE CHART PORTLET-->
						</div>
			 </div>	
	</div>