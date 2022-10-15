	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title"><b>Daftar Promosi</b></h3>
				  </div>
				  <div class="panel-body">
					<div class="list-group">
						<?php foreach ($promotion as $key => $promo) { ?>
						    <a href="<?php echo site_url('site/read_promosi'.'/'.$promo->id_promosi); ?>" class="list-group-item">
							   <h4 class="list-group-item-heading"><?php echo $promo->judul_promosi; ?></h4>
							<?php
                                $words = explode(" ",$promo->web_promosi);
                                $sentences =  implode(" ",array_splice($words,0,30));
                                
                        	?>
							   <p class="list-group-item-text"><?php echo $sentences;  ?></p>
							</a>
						<?php } ?>
					</div>
				  </div>
				</div>
				
				<!-- <article>
				 	<div class="post-image">
						<div class="post-heading">
							<h3><a href=""></a></h3>
						</div>
					</div>
                        <?php
                                $words = explode(" ",$promo->web_promosi);
                                $sentences =  implode(" ",array_splice($words,0,30));
                                
                        ?>
						<p><?php echo $sentences;  ?></p>
						<div class="bottom-article">
							<a href="<?php echo site_url('site/read_promosi'.'/'.$promo->id_promosi); ?>" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
						</div>
				</article>
			-->

				

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