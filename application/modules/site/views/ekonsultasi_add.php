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
					<p>Konsultasi medis merupakan interaksi pasien-dokter yang berpusat kepada kepentingan pasien. Kami percaya, dalam konsultasi medis hubungan interpersonal pasien-dokter merupakan hal yang penting dan tidak boleh dihilangkan. Berdasarkan hal tersebut, maka informasi yang diberikan melalui forum konsultasi medis ini bertujuan untuk mendukung, bukan untuk menggantikan, hubungan antara pasien/pengunjung kami dengan dokternya. Variasi penyakit/individualisasi dari pasien satu ke pasien yang lainnya menyebabkan rekomendasi pada forum konsultasi medis ini bersifat umum, dan tidak dapat secara langsung diaplikasikan kepada setiap pasien. Pengunjung diharapkan dapat berkonsultasi langsung dengan seorang dokter, yang dapat dengan lebih baik menilai kondisi penyakit dengan pertemuan secara langsung.</p>
				</div>
				<form id="ekonsultasi_form" method="post" action="<?php echo site_url("site/ekonsultasi/save_ask") ?>" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label for="nama_penanya" class="col-sm-2 control-label">Nama</label>
				    <div class="col-sm-5">
				      <input type="text" name="nama" class="form-control" id="nama_penanya" placeholder="Nama Anda">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="email_penanya" class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-5">
				      <input type="email" name="email" class="form-control" id="email_penanya" placeholder="Email">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="topik" class="col-sm-2 control-label">Judul Topik</label>
				    <div class="col-sm-5">
				      <input type="text" name="topik" class="form-control" id="topik" placeholder="Judul Topik">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputAsk" class="col-sm-2 control-label">Pertanyaan</label>
				    <div class="col-sm-10">
				      <textarea class="form-control" rows="7" name="pertanyaan" id="inputAsk"></textarea>
				    </div>
				  </div>
				  <div class="form-group">
	   		        <div id="response" class="hide">
				  		<img src="<?php echo site_url("assets/loading.gif") ?>" />
				  	</div>
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" name="submit" class="btn btn-default">Submit</button>
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
					  <div class="panel-footer"><a href="<?php echo site_url("site/ekonsultasi/lists") ?>"><b>Lihat Lebih Banyak...</b></a></div>
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

			}).fail(function(data){
				$("#response").html(data.message);
			});


		});
	</script>