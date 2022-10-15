	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				 <article>
				<h4><?php echo $ask->title; ?></h4>
				<span class="pullquote-left">
					<?php echo $ask->content; ?>
					</br>
			    	</br>
			    	</br>
					</br>
					<?php echo $ask->author; ?>, @<?php echo $ask->timestamp; ?>
				</span>
				</br>
			    </br>
			    </br>
				</br>
				<?php echo $ask->Jawaban; ?>
				<p></p>
				<p></p>
				<p><?php echo $ask->nama; ?></p>
				</article>
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