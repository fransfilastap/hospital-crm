				<!-- END PAGE HEADER-->
             <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
				<style type="text/css">
               #networkModal{ width:1200px; margin-left: -600px;}
            </style>
            <div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue">
							<div class="portlet-title">
                        	<h4><i class="icon-reorder"></i>Pratinjau Publikasi</h4>

                     </div>
                     <div class="portlet-body form">
                        <div class="well well-large">
                              <h4><b><?php echo $promosi[0]->judul_promosi ?></b></h4>
                              <p><?php echo $promosi[0]->web_promosi; ?></p>
                           </div>
                           <form  id="form_promo_publish" action="<?php echo site_url("admin/promosi/publish") ?>" method="post" class="form-horizontal">
                              <input name="id_promosi" type="hidden" value="<?php echo $promosi[0]->id_promosi; ?>"/>
                              <div class="control-group">
                                 <label class="control-label">Berdasarkan Kunjungan Poli</label>
                                 <div class="controls">
                                    <label class="checkbox">
                                    <input type="checkbox" value="yes" name="pake_poli" /> Berdasarkan Kunjungan Poli
                                    </label>
                                 </div>
                              </div>
                              <div id="poliklinik" class="control-group">
                                 <div class="controls">
                                    <select  name="poliklinik[]" data-placeholder="Poliklinik yang dikunjungi" class="chosen span6" multiple="multiple" tabindex="15">
                                       <?php foreach ($polikliniks as $key => $poliklinik) { ?>
                                          <option value="<?php echo $poliklinik->id_poliklinik ?>" /><?php echo $poliklinik->nama_poliklinik ?>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="control-group">
                                 <label class="control-label">Berdasarkan Jenis Kelamin</label>
                                 <div class="controls">
                                    <select name="gender" class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1">
                                       <option value="A" />Semua
                                       <option value="L" />Laki-laki
                                       <option value="P" />Perempuan
                                    </select>
                                 </div>
                              </div> 
                           <div class="control-group">
                              <label class="control-label">Berdasarkan Umur</label>
                              <div class="controls">
                                 <label class="checkbox"> 
                                 <input type="checkbox" value="all" name="pake_umur" /> Custom
                                 </label>
                              </div>
                           </div>  
                           <div id="custom_umur" class="control-group hide">
                              <label class="control-label">Dari</label>
                              <div class="controls row-fluid">
                                 <input name="umur_1" type="text" class="span2 m-wrap" /> -
                                 <input name="umur_2" type="text" class="span2 m-wrap" />
                              </div>
                           </div>  
                           <div class="control-group" id="result">
                           </div>
                           <div class="form-actions">
                              <button type="submit" class="btn blue">Publikasikan</button>
                              <a href="<?php echo site_url("admin/promosi"); ?>" class="btn" >Batal</a>
                           </div>                      
                           </form>
                     </div>
						</div>
					</div>
				</div>
            <script type="text/javascript">
               $(document).ready(function(){
                  $("#poliklinik").fadeOut();
                  CRM_APP.snPromosi("<?php site_url('admin/promosi') ?>");
               });
               
            </script>