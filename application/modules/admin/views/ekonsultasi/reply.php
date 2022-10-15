                                <style type="text/css">
                            .detailModal{ width:900px; margin-left: -450px;}
                        </style>
                        <div  id="replyModal" class="modal hide fade detailModal">
                           <div class="modal-header"><h5><b>Jawab Konsultasi</b></h5></div>
                           <div class="modal-body">
                              <div class="span12">
                                <div class="well">
                                  <address>
                                    <strong>Penanya :</strong>
                                    <?php echo $ekonsultasi[0]->author; ?><br />
                                    <strong>Email :</strong>
                                    <i><?php echo $ekonsultasi[0]->email; ?></i><br />
                                    <strong>Pada :</strong> <?php echo $ekonsultasi[0]->timestamp ?>
                                  </address>
                                  <blockquote>
                                    <p><?php echo $ekonsultasi[0]->content; ?></p>
                                  </blockquote>
                                  </div>
                                  <form id="replyForm" action="<?php echo site_url("admin/ekonsultasi/reply"); ?>" method="post" class="form-vertical">
                                      <input type="hidden" name="id" id="id" value="<?php  echo $ekonsultasi[0]->id; ?>" />
                                      <div class="control-group">
                                        <label class="control-label">Jawaban Dokter :</label>
                                        <div class="controls">
                                           <textarea class="span12  m-wrap" rows="6" name="jawaban" id="jawaban"><?php echo $ekonsultasi[0]->Jawaban;  ?></textarea>
                                        </div>
                                     </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <a href="#" class="btn" data-dismiss="modal">Tutup</a>
                              <button type="submit" class="btn blue" id="submit">Simpan</button>
                            </form>
                           </div>
                        </div>
                      </div>