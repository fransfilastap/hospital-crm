	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
					<div class="panel panel-primary">
					  <div class="panel-heading"><b>Pertanyaan Konsultasi Terbaru</b></div>
					  <div class="panel-body">
						<div class="list-group">
							<?php foreach ($asks as $key => $ask) { ?>
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
					</div>

                <div>
                        <?php echo $links; ?>
                </div>
				<!--
				<div id="pagination">
					<span class="all">Page 1 of 3</span>
					<span class="current">1</span>
					<a href="#" class="inactive">2</a>
					<a href="#" class="inactive">3</a>
				</div>
			-->
			</div>
		</div>
	</div>
	</section>