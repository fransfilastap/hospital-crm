                        <style type="text/css">
                            .detailModal{ width:900px; margin-left: -450px;}
                        </style>
                        <div  id="detail" class="modal hide fade detailModal">
                           <div class="modal-header"><h5><b>Detail Kritik</b></h5></div>
                           <div class="modal-body">
                              <div class="span6">
                                <h3><?php echo $feedback[0]->perihal; ?></h3>
                                <blockquote>
                                  <p><?php echo $feedback[0]->isi; ?></p>
                                </blockquote>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <a href="#" class="btn" data-dismiss="modal">Tutup</a>
                           </div>
                        </div>
                      </div>