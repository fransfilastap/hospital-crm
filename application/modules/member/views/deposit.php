                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Beli deposit pulsa</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo site_url("pasien/process_deposit") ?>" class="form-horizontal" id="deposit_form" />
                           <div>
                              <?php //echo $notification; ?>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Opsi</label>
                              <div class="controls">
                                 <label class="checkbox line">
                                 <input type="checkbox" value="4" name="transaction_type"/> Tukar dengan bonus cash
                                 </label>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Nominal Deposit </label>
                                 <div class="controls">
                                    <div class="input-prepend">
                                       <span class="add-on">Rp.</span><input class="m-wrap " type="text" placeholder="Nominal" name="nominal" />
                                    </div>
                                </div>
                           </div>
                           <div class="form-actions">
                              <div id="loadingDiv">
                                 <img src="<?php echo site_url("assets/loading.gif") ?>">
                              </div>
                              <button type="submit" class="btn blue">Withdraw</button>
                              <a href="<?php echo site_url("pasien/history"); ?>"  class="btn">Batal</a>
                           </div>
                        </form>
                        <!-- END FORM-->           
                     <div id="result">
                        </div>
                     </div>
                  </div>
                  </div>
                  <script type="text/javascript">

                     var formObject  =   $("#deposit_form");
                     var formURL  =   formObject.attr("action");
                     var base_url = "<?php echo site_url('pasien/deposit'); ?>";

                     formObject.submit( function(e){
                    
                        e.preventDefault();

                        var postData = formObject.serializeArray();

                        $.ajax(
                           {        

                                   url : formURL,
                                   type: "POST",
                                   data : postData,
                                   dataType : 'json',
                                   success:function(data, textStatus, jqXHR) 
                                   {
                                       var result_type = "";

                                       if( textStatus != "undefined" && textStatus == "success" )
                                       {
                                           result_type = "<div class='alert alert-success'>"+
                                                               "<button class='close' data-dismiss='alert'></button>"+
                                                               "<strong>"+data.message+"</strong>."+
                                                           "</div>";
                                       }
                                       else{
                                           result_type = "<div class='alert alert-error'>"+
                                                               "<button class='close' data-dismiss='alert'></button>"+
                                                               "<strong>"+data.message+"</strong>."+
                                                           "</div>";
                                       } 
                                       $("#result").html( result_type );

                                       $("#jumlah").val("");

                                      setTimeout(function() {
                                                window.location.href = base_url;
                                      }, 2000);

                                   },
                                   error: function(jqXHR, textStatus, errorThrown) 
                                   {
                                       var result_type = "<div class='alert alert-error'>"+
                                                               "<button class='close' data-dismiss='alert'></button>"+
                                                               "<strong>Gagal!</strong> gagal menghubungi server."+
                                                              "</div>";
                                       $("#result").html( result_type );      
                                   }
                           });

                  } );


                  $('#loadingDiv').hide().ajaxStart( function() {
                        $(this).show();  // show Loading Div
                     } ).ajaxStop ( function(){
                           $(this).hide(); // hide loading div
                        });
                  </script>