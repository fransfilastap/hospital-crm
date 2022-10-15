                        <div  id="detail" class="modal hide fade">
                           <div class="modal-header"><h5><b>Teruskan SMS</b></h5></div>
                           <div class="modal-body">
                              <div class="span12">
                                <form id="replyForm" action="<?php echo site_url("admin/smsgateaway/reply"); ?>" method="post" class="form-vertical">
                                      <input type="text" name="phone_number" value=""/>
                                      <div class="control-group">
                                        <label class="control-label">Isi Pesan :</label>
                                        <div class="controls">
                                           <textarea class="span12  m-wrap" rows="6" name="balasan" id="jawaban"><?php echo $sms[0]->TextDecoded; ?></textarea>
                                        </div>
                                     </div>
                                </form>
                              </div>

                           </div>
                           <div class="modal-footer">
                              <button type="submit" name="submit" id="submit" class="btn blue">Kirim</button>
                              <a href="#" class="btn" data-dismiss="modal">Tutup</a>
                           </div>
                        </div>
                      </div>