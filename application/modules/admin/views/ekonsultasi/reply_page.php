        <!-- END PAGE HEADER-->
         <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
            <div class="row-fluid">
          <div class="span12">
                  <!-- BEGIN TAB PORTLET-->   
                  <div class="portlet box blue">
                    <div class="portlet-title">
                      <h4><i class="icon-reorder"></i>Jawab Pertanyaan Konsultasi</h4>
                    </div>
                    <div class="portlet-body">
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
                                           <textarea class="span12 wysihtml5 m-wrap" rows="30" name="jawaban" id="jawaban"><?php echo $ekonsultasi[0]->Jawaban;  ?></textarea>
                                        </div>
                                        <div id="message"></div>
                                     </div>
                                    <div class="form-actions">
                                       <button type="submit" class="btn blue"><i class="icon-ok"></i> Jawab</button>
                                       <a href="<?php echo site_url("admin/ekonsultasi") ?>" class="btn">Batal</a>
                                    </div>
                                  </form>
                    </div>
                  </div>
                  <!-- END TAB PORTLET-->
          </div>
        </div>
        <script type="text/javascript">

          $(document).ready(function(){
               CRM_APP.fnReplyKonsultasi();
          });

        </script>                                 