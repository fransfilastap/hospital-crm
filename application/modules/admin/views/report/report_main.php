         <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
          <div class="row-fluid">
              <div class="span12">
                  <div class="portlet box green">
                      <div class="portlet-title">
                        <h4><i class="icon-bar-chart"></i>Pilih Laporan</h4>
                        <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                              <a href="#portlet-config" data-toggle="modal" class="config"></a>
                              <a href="#" class="reload" id="refresh"></a>
                         </div>
                      </div>
                      <div class="portlet-body form">
                          <div class="row-fluid">
                             <a href="<?php echo site_url('admin/report/kunjungan_poli') ?>" id="laporan_kunjungan" class="icon-btn span2" data-toggle="modal">
                                <i class="icon-group"></i>
                                <div>Rekapitulasi Kunj. Poli</div>
                             </a>
                             <a href="<?php echo site_url('admin/report/loyalitas') ?>" id="loyalitas" class="icon-btn span2" data-toggle="modal">
                                <i class="icon-heart"></i>
                                <div>Loyalitas</div>
                             </a>
                          <a href="<?php echo site_url("admin/report/print_feedback") ?>" id="laporan_feedback" class="icon-btn span2">
                            <i class=" icon-comment"></i>
                            <div>Kritik Saran</div>
                          </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>