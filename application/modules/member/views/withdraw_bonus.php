                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Withdraw Bonus Anda</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <div class="row-fluid">
                  <div class="span4 responsive" data-tablet="span6" data-desktop="span4">
                     <div class="dashboard-stat blue">
                        <div class="visual">
                           <i class="icon-user"></i>
                        </div>
                        <div class="details">
                           <div class="number">
                              <?php echo "Rp. ".formatWithSuffix($bonus->deposit);?>
                           </div>
                           <div class="desc">                           
                             Bonus Deposit
                           </div>
                        </div>
                        <a class="more" href="<?php echo site_url('pasien/bonus')?>">
                        Withdraw <i class="m-icon-swapright m-icon-white"></i>
                        </a>                 
                     </div>
                  </div>
                  <div class="span4 responsive" data-tablet="span6" data-desktop="span4">
                     <div class="dashboard-stat green">
                        <div class="visual">
                           <i class="icon-check"></i>
                        </div>
                        <div class="details">
                           <div class="number">
                              <?php echo "Rp. ".formatWithSuffix($bonus->bonus) ?>
                           </div>
                           <div class="desc">Bonus Cash</div>
                        </div>
                        <a class="more" href="<?php echo site_url('pasien/bonus')?>">
                        Withdraw <i class="m-icon-swapright m-icon-white"></i>
                        </a>                 
                     </div>
                  </div>
               </div>
                        <form action="<?php echo site_url("pasien/process_withdraw") ?>" class="form-horizontal" id="withdraw_form" />
                           <div>
                              <?php //echo $notification; ?>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Pilihan Withdraw</label>
                              <div class="controls">
                                 <label class="radio">
                                 <input class="bonus_type" id="halaman" type="radio" name="bonus_type" value="6"/>
                                 Cash
                                 </label>
                                 <label class="radio">
                                 <input class="bonus_type" id="kategori" type="radio" name="bonus_type" value="5" />
                                 Deposit
                                 </label>    
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Nominal </label>
                                 <div class="controls">
                                    <div class="input-prepend">
                                       <span class="add-on">Rp.</span><input class="m-wrap " type="text" placeholder="Nominal" name="jumlah" id="jumlah" />
                                    </div>
                                </div>
                           </div>
                           <div class="form-actions">
                              <div id="loadingDiv">
                                 <img src="<?php echo site_url("assets/loading.gif") ?>">
                              </div>
                              <button type="submit" class="btn blue">Withdraw</button>
                              <a href="<?php echo site_url("pasien/bonus"); ?>"  class="btn">Batal</a>
                           </div>
                        </form>
                        <!-- END FORM-->           
                     <div id="result">
                        </div>
                     </div>
                  </div>
                  </div>
                  <script type="text/javascript">

                     var formObject  =   $("#withdraw_form");
                     var formURL  =   formObject.attr("action");
                     var base_url = "<?php echo site_url('pasien/bonus'); ?>";

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
