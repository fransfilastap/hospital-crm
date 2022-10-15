            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box blue tabbable">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>
                           <span class="hidden-phone">Kirim Pesan</span>
                        </h4>
                     </div>
                     <div class="portlet-body form">
                        <div class="tabbable portlet-tabs">
                           <ul class="nav nav-tabs">
                              <li><a href="#portlet_tab2" data-toggle="tab">Group</a></li>
                              <li class="active"><a href="#portlet_tab1" data-toggle="tab">Manual</a></li>
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane active" id="portlet_tab1">
                                 <!-- BEGIN FORM-->
                                 <form id="form_sms" action="<?php echo site_url("admin/smsgateaway/proses_kirim") ?>" class="form-horizontal" method="post" />
                                 <div class="control-group">
                                    <label class="control-label">Nomor Penerima</label>
                                    <div class="controls">
                                       <div class="input-prepend">
                                          <div class="btn-group">
                                             <button class="btn dropdown-toggle" data-toggle="dropdown">
                                             Kontak
                                             <span class="caret"></span>
                                             </button>
                                             <ul class="dropdown-menu">
                                                <li><a href="#choose_contact" id="pilih_kontak" data-toggle="modal" >Pilih</a></li>
                                                <li><a href="#" id="clear_target" >Bersihkan</a></li>
                                             </ul>
                                          </div>
                                          <!-- /btn-group -->
                                          <input class="m-wrap medium" type="text" name="no_telp" id="no_telp" />
                                       </div>
                                    </div>
                                 </div>
                                    <div class="control-group">
                                       <label class="control-label">Pesan</label>
                                       <div class="controls">
                                          <textarea id="message" name="isi_sms" class="large m-wrap" rows="3"><?php if(isset($text)) echo $text; ?></textarea>
                                       </div>
                                    </div>
                                    <div id="loadingDiv1" class="hide">
                                        <img src="<?php echo site_url("assets/loading.gif") ?>" />
                                    </div>
                                    <div class="form-actions">
                                       <button type="submit" class="btn blue"><i class="icon-envelope"></i> Kirim</button>
                                      <a href="<?php echo site_url("admin/smsgateaway") ?>"class="btn">Cancel</a>
                                    </div>
                                 </form>
                                 <!-- END FORM-->  
                              </div>
                              <div class="tab-pane " id="portlet_tab2">
                                 <form id="form_sms_group" action="<?php echo site_url("admin/smsgateaway/proses_kirim_group") ?>" class="form-horizontal" /> 
                                    <div class="control-group">
                                       <label class="control-label">Pilih Group</label>
                                       <div class="controls">
                                          <select name="group" class="span12 chosen" data-placeholder="Pilih group" tabindex="1">
                                             <?php foreach($groups as $key => $group) { ?>
                                             <option value="<?php echo $group->ID; ?>" /><?php echo $group->Name; ?>
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Pesan</label>
                                       <div class="controls">
                                          <textarea id="message2" name="isi_sms" class="large m-wrap" rows="3"><?php if(isset($text)) echo $text; ?></textarea>
                                       </div>
                                    </div>
                                    <div id="loadingDiv2" class="hide"></div>
                                    <div class="form-actions">
                                       <button type="submit" class="btn blue"><i class="icon-envelope"></i> Kirim</button>
                                       <a href="<?php echo site_url("admin/smsgateaway/sent") ?>"class="btn">Cancel</a>
                                    </div>
                                 </form>
                                 <!-- END FORM-->  
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- END SAMPLE FORM PORTLET-->
               </div>
            </div>
            <!-- END PAGE CONTENT-->  
                     <div  id="choose_contact" class="modal hide fade">
                           <div class="modal-header"><h5><b>Pilih Nomor Penerima</b></h5></div>
                           <div class="modal-body">
                              <table class="table table-striped table-bordered" id="phonebook">
                                <thead>
                                  <tr>
                                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#phonebook .checkboxes" /></th>
                                    <th>Nama</th>
                                    <th class="hidden-phone">Nomor Handphone</th>
                                    <th class="hidden-phone">Group</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                 <?php foreach ( $contacts as $key => $contact ) { ?>
                                  <tr class="odd gradeX">
                                    <td><input type="checkbox" class="checkboxes" value="<?php echo $contact->Number ?>" /></td>
                                    <td><?php echo $contact->Name; ?></td>
                                    <td class="hidden-phone"><?php echo $contact->Number; ?></td>
                                    <td class="hidden-phone"><?php echo $contact->group_name; ?></td>
                                  </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                           </div>
                           <div class="modal-footer">
                              <button type="submit" id="pilih" name="submit" class="btn blue">Pilih</button>
                              <a href="#" id="tutup" class="btn" data-dismiss="modal">Tutup</a>
                           </div>
                        </div>
                      </div>  

                      <script type="text/javascript">

                           jQuery(document).ready(function(){

                               jQuery('#phonebook .group-checkable').change(function () {
                                    var set = jQuery(this).attr("data-set");
                                    var checked = jQuery(this).is(":checked");
                                    jQuery(set).each(function () {
                                        if (checked) {
                                            $(this).attr("checked", true);
                                        } else {
                                            $(this).attr("checked", false);
                                        }
                                    });
                                    jQuery.uniform.update(set);
                                });



                              $("#tutup").click(function(){

                                    uncheck_all();
                              });


                              $("#pilih").click(function(){

                                    var set = jQuery('#phonebook .group-checkable').attr("data-set");
                                    var all = jQuery('#phonebook .group-checkable');

                                    var phonebooks = "";

                                    jQuery(set).each(function () {
                                       if ( $(this).is(":checked") ) {
                                             
                                             phonebooks += $(this).val()+";";
                                         }
                                    });
                                    
                                    $("#no_telp").val( phonebooks );

                                    uncheck_all();

                                    $("#choose_contact").modal("hide");

                              });

                              $("#clear_target").click(function(){

                                    $("#no_telp").val("");

                              });


                              var uncheck_all = function(){

                                    var set = jQuery('#phonebook .group-checkable').attr("data-set");
                                    var all = jQuery('#phonebook .group-checkable');

                                    jQuery(set).each(function () {
                                       if ( $(this).is(":checked") ) {
                                             $(this).attr("checked", false);
                                         }
                                    });
                                    
                                    all.attr("checked",false);

                                    jQuery.uniform.update(all);
                                    jQuery.uniform.update(set);
                              }

                           });



                          $("#form_sms, #form_sms_group").submit(function(evt){

                            evt.preventDefault();

                            $("#loadingDiv1").show();



                            var formObject  =   $(this);
                            var formURL     =   formObject.attr("action");
                            var postData    =   formObject.serializeArray();


                            $.post(formURL, postData, function(data){

                                $("#loadingDiv1").html(data.message);

                            }, "json").success(function(){
                                  $("#no_telp").val("");
                                  $("#message, #message2").val("");
                                     
                            });

                          });
                           
                      </script> 