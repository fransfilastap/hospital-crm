	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">Formulir Pendaftaran Kunjungan Poliklinik</h3>
				  </div>
				  <div class="panel-body">
					<div class="well">
						<h5>Penting Untuk Dibaca Sebelum Melanjutkan!</h5>
						<p>Petunjuk.</p>
					</div>
					<form id="ekonsultasi_form" method="post" action="<?php echo site_url("site/visit_poliklinik/submit") ?>" class="form-horizontal" role="form">
					  <div class="form-group">
					    <label for="id_pasien" class="col-sm-2 control-label">ID Pasien</label>
					    <div class="col-sm-5">
					      <input type="text" name="id_pasien" class="form-control" id="id_pasien" placeholder="Nama Anda">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="email_penanya" class="col-sm-2 control-label">Poliklinik</label>
					    <div class="col-sm-5">
					      <select name="id_poliklinik">
					      	<?php foreach ($poliklinik as $key => $poli) { ?>
					      	<option class="form-control" value="<?php echo $poli->id_poliklinik ?>"><?php echo $poli->nama_poliklinik; ?></option>
					      	<?php } ?>
					      </select>
					    </div>
					  </div>
					  <div class="form-group">
		   		        <div id="response" class="hide">
					  		<img src="<?php echo site_url("assets/loading.gif") ?>" />
					  	</div>
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" name="submit" class="btn btn-default">Daftar</button>
					    </div>
					  </div>
					</form>
				  </div>
				</div>
			</div>
			<div class="col-lg-4">
				<aside class="right-sidebar">
				<div class="widget">
					<div class="panel panel-primary">
					  <div class="panel-heading"><b>Pertanyaan Konsultasi Terbaru</b></div>
					  <div class="panel-body">
						<div class="list-group">
							<?php foreach ($last_asks as $key => $ask) { ?>
							<a href="<?php echo site_url("site/ekonsultasi/read/".$ask->id) ?>" class="list-group-item">
							    <h5 class="list-group-item-heading"><?php echo $ask->title; ?></h5>
							    <?php
		                            $words = explode(" ",$ask->content);
		                            $sentences =  implode(" ",array_splice($words,0,20));  
		                        ?>
							    <p class="list-group-item-text"><?php echo $sentences ?></p>
							</a>
							<?php } ?>
						</div>
					  </div>
					  <div class="panel-footer"><a href="<?php echo site_url("ekonsultasi/list") ?>"><b>Lihat Lebih Banyak...</b></a></div>
					</div>
				</div>
				</aside>
			</div>
		</div>
	</div>
	</section>
	  <script type="text/javascript">

		$("#ekonsultasi_form").submit(function(evt){

			evt.preventDefault();
			
			$("#response").removeClass("hide");

			var formObject = $(this);
			var formData   = formObject.serializeArray();
			var formAction = formObject.attr("action");

			$.post(formAction, formData, function(data){
				
			},"json").success(function(data){

				$("#response").html(data.message);
				$("#id_pasien").val("");

			}).fail(function(data){
				$("#response").html(data.message);
			});


		});
	</script>