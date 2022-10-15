                        <div  id="detail" class="modal hide fade">
                           <div class="modal-header"><h5><b>Baca SMS</b></h5></div>
                           <div class="modal-body">
                              <div class="span12">
                                <h3><?php echo $sms[0]->DestinationNumber; ?></h3>
                                <blockquote>
                                  <p><?php echo $sms[0]->TextDecoded; ?></p>
                                </blockquote>
                              </div>

                           </div>
                           <div class="modal-footer">
                              <a href="#" class="btn" data-dismiss="modal">Tutup</a>
                           </div>
                        </div>
                      </div>