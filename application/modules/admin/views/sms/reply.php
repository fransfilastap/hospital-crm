                        <div  id="detail" class="modal hide fade">
                           <div class="modal-header"><h5><b>Balas SMS</b></h5></div>
                           <div class="modal-body">
                              <div class="span12">
                                <h3><?php echo $sms[0]->SenderNumber; ?></h3>
                                <blockquote>
                                  <p><?php echo $sms[0]->TextDecoded; ?></p>
                                </blockquote>
                                <form method="post" class="form-vertical">
                                      <input type="hidden" name="no_telp" id="no_telp" value="<?php  echo $sms[0]->SenderNumber; ?>" />
                                      <div class="control-group">
                                        <label class="control-label">Balasan :</label>
                                        <div class="controls">
                                           <textarea class="span12  m-wrap" rows="6" name="isi_sms" id="isi_sms"></textarea>
                                        </div>
                                     </div>
                              </div>
                              <div id="loadingDiv" class="hide">
                                <img src="<?php echo site_url("assets/loading.gif") ?>" />
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="submit" name="submit" id="submitX" class="btn blue">Kirimkan</button>
                            </form>
                              <a href="#" class="btn reply-done" data-dismiss="modal">Tutup</a>
                           </div>
                        </div>
                      </div>