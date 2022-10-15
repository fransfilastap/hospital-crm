				<!-- END PAGE HEADER-->
            <div class="row-fluid">
					<div class="span12">
                  </div>
						<div class="portlet box blue">
							<div class="portlet-title">
                        		<h4><i class="icon-reorder"></i>History Transaksi </h4>
                     </div>
                     <div class="portlet-body form">
                        <table class="table table-striped table-bordered" id="sample_1">
                           <thead>
                              <tr>
                                 <th>Kode Transaksi</th>
                                 <th class="hidden-phone">Transaksi</th>
                                 <th class="hidden-phone">Besaran</th>
                                 <th class="hidden-phone">Waktu</th>
                                 <th class="hidden-phone">Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach ($transactions as $key => $transaction) { ?>
                                    
                              <tr class="odd gradeX">
                                 <td><b><?php echo $transaction->code; ?></b></td>
                                 <td class="hidden-phone"><?php echo $transaction->t_type; ?></td>
                                 <td class="center hidden-phone"><?php echo $transaction->amount; ?></td>
                                 <td class="center hidden-phone"><?php echo $transaction->t_time; ?></td>
                                 <td class="hidden-phone"><span class="label label-success"><?php echo $transaction->t_status; ?></span></td>
                              </tr>

                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
						</div>
					</div>
				</div>