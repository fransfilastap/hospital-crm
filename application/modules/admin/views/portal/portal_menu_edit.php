                  <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Tambah Menu</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo site_url("admin/portal_menu/process_edit") ?>" class="form-horizontal" id="menu_form" />
                           <div>
                              <?php echo $notification; ?>
                           </div>
                           <input type="hidden" name="menu_id" value="<?php echo $pmenu_detail[0]->menu_id; ?>">
                            <div class="control-group">
                              <label class="control-label">Menu</label>
                              <div class="controls">
                                 <input type="text" class="span8 m-wrap" name="menu_name" id="menu_name" value="<?php echo $pmenu_detail[0]->menu_title; ?>" />
                                 <div id="notif_1"></div>
                                </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Induk Menu</label>
                              <div class="controls">
                                 <select class="span6 m-wrap" data-placeholder="Pilih induk menu" tabindex="1" name="menu_parent" id="menu_parent">
                                 <option value="0" />Pilih induk menu..
                                 <?php foreach ($portal_menu as $key => $pmenu) { ?>
                                    <option value="<?php echo $pmenu->menu_id; ?>" /><?php  echo $pmenu->menu_title; ?>
                                 <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Jenis Menu</label>
                              <div class="controls">
                                 <label class="radio">
                                 <input class="menu_type" id="halaman" type="radio" name="menu_type" value="halaman" />
                                 Halaman
                                 </label>
                                 <label class="radio">
                                 <input class="menu_type" id="kategori" type="radio" name="menu_type" value="kategori" />
                                 Kategori
                                 </label>  
                                 <label class="radio">
                                 <input class="menu_type" id="link" type="radio" name="menu_type" value="link" />
                                 Link
                                 </label> 
                                 <label class="radio">
                                 <input class="menu_type" id="mod" type="radio" name="menu_type" value="modul" />
                                 Modul
                                 </label>  
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Konten Menu</label>
                              <div class="controls">
                                  <input type="hidden" name="menu_content" id="menu_content" value=""/>
                                 <div id="#message"></div>
                                 <div id="konten_halaman">
                                       <table class="table table-striped table-bordered" id="sample_1">
                                          <thead>
                                             <tr>
                                                <th style="width:350px;" class="hidden-phone">Halaman</th>
                                                <th class="hidden-phone">Isi</th>
                                                <th>Aksi</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                          <?php foreach ($pages as $key => $page) { ?>
                                             <tr class="odd gradeX">
                                                <td class="hidden-phone"><?php echo $page->judul_halaman; ?></td>
                                                <td class="hidden-phone"><?php echo $page->isi_halaman; ?></td>
                                                <td>
                                                    <a class="pilih_halaman btn" href="#" data-id="<?php echo site_url("page/".$page->id_halaman) ?>">Pilih</a>
                                                </td>
                                             </tr>
                                          <?php } ?>
                                          </tbody>
                                       </table>
                                 </div>
                                 <div id="konten_kategori">
                                       <select id="kategori_pilih" class="span6 m-wrap" data-placeholder="Pilih induk menu" tabindex="1">
                                          <?php foreach ($categories as $key => $category) { ?>
                                             <option value="<?php echo site_url("category/".$category->id_category) ?>" /><?php  echo $category->category_name; ?>
                                          <?php } ?>
                                       </select>
                                 </div>
                                 <div id="konten_module">
                                       <select id="mod_selection" class="span6 m-wrap" data-placeholder="Pilih induk menu" tabindex="1">
                                           <option value="<?php echo site_url("blog") ?>" />Blog
                                           <option value="<?php echo site_url("site/visit_poliklinik") ?>" /> Kunjungan Poli
                                           <option value="<?php echo site_url("site/ekonsultasi") ?>" />E-Konsultasi
                                           <option value="<?php echo site_url("site/jadwal_dokter") ?>" />Jadwal Dokter
                                           <option value="<?php echo site_url("site/promosi") ?>" />Promosi
                                           <option value="<?php echo site_url("site/feedback") ?>" />Kritik & Saran
                                       </select>
                                 </div>
                                 <div id="konten_link">
                                    <input type="text" class="span8 m-wrap" id="menu_link" value="" placeholder="http:\\" />
                                    <div id="notif_2"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Visibilitas</label>
                              <div class="controls">
                                 <label class="radio">
                                 <input type="radio" name="menu_status" value="1" checked=""/>
                                 Tampil
                                 </label>
                                 <label class="radio">
                                 <input type="radio" name="menu_status" value="0" />
                                 Sembunyi
                                 </label>  
                              </div>
                           </div>
                           <div class="form-actions">
                              <button type="submit" class="btn blue">Simpan</button>
                              <a href="<?php echo site_url("admin/portal_menu"); ?>"  class="btn">Batal</a>
                           </div>
                                                   <div id="result">
                        </div>
                        </form>
                        <!-- END FORM-->           
                     </div>
                  </div>
                  </div>

                  <script type="text/javascript">

                  $(document).ready(function(){
                     
                     
                     
                     var parent        =  "<?php echo $pmenu_detail[0]->menu_parent; ?>";
                     var type          =  "<?php echo $pmenu_detail[0]->menu_type; ?>";
                     var value         =  "<?php echo $pmenu_detail[0]->menu_content; ?>";
                     var visibility    =  "<?php echo $pmenu_detail[0]->menu_status; ?>";

                     if( parent != 0 ){

                        $("#menu_parent option").each(function(){
                                  if( $(this).val() == parent ){
                                      $("#menu_parent").val( parent );
                                  }
                        });

                     }

                     CRM_APP.fnInitMenu("<?php echo site_url('admin/portal_menu'); ?>");

                     $(".menu_type").each( function(){
                        var current_val = type;
                        var this_val = $(this).val();
                        var diz = $(this);
                        

                        if( this_val == current_val ){
                              diz.prop("checked",true);
                                 
                              if( type == "halaman" ){
                                 $("#sample_1 > tbody  > tr").each(function(){
                                    var pilih_halaman = $(this).find(".pilih_halaman");
                                    if( pilih_halaman.attr("data-id") == value ){
                                       pilih_halaman.addClass("blue");
                                       $("#menu_content").val( pilih_halaman.attr("data-id") );
                                    }

                                 });
                              }
                              else if(type == "kategori"){
                                 $("#konten_link").hide();
                                 $("#konten_halaman").hide();
                                 $("#konten_module").hide();
                                 $("#konten_kategori").show();

                                 $("#kategori_pilih option").each(function(){
                                    if( $(this).val() == value ){
                                       $("#kategori_pilih").val( value );
                                       $("#menu_content").val( value );
                                    }
                                 });
                              }
                              else if( type == "link" ){
                                 $("#konten_link").show();
                                 $("#konten_halaman").hide();
                                 $("#konten_kategori").hide();
                                 $("#konten_module").hide();

                                 $("#menu_link").val( value );
                                 $("#menu_content").val( value );
                              }

                              else if( type == "modul" ){
                                 $("#konten_link").hide();
                                 $("#konten_halaman").hide();
                                 $("#konten_kategori").hide();
                                 $("#konten_module").show();

                                 $("#mod_selection option").each(function(){
                                    if( $(this).val() == value ){
                                       $("#mod_selection").val( value );
                                       $("#menu_content").val( value );
                                    }
                                 });
                              }
                        }

                     });
                     });
                  </script>