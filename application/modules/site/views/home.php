	<!-- end header -->
	<section id="featured">
	<!-- start slider -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
	<!-- Slider -->
        <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img src="<?php echo base_url("themes/moderna/img/slides/1.jpg") ?>" alt="" />
                <div class="flex-caption">
                    <h3>Modern Design</h3> 
					<p>Duis fermentum auctor ligula ac malesuada. Mauris et metus odio, in pulvinar urna</p> 
					<a href="#" class="btn btn-theme">Learn More</a>
                </div>
              </li>
              <li>
                <img src="<?php echo base_url("themes/moderna/img/slides/2.jpg") ?>" alt="" />
                <div class="flex-caption">
                    <h3>Fully Responsive</h3> 
					<p>Sodales neque vitae justo sollicitudin aliquet sit amet diam curabitur sed fermentum.</p> 
					<a href="#" class="btn btn-theme">Learn More</a>
                </div>
              </li>
              <li>
                <img src="<?php echo base_url("themes/moderna/img/slides/3.jpg")?>" alt="" />
                <div class="flex-caption">
                    <h3>Clean & Fast</h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit donec mer lacinia.</p> 
					<a href="#" class="btn btn-theme">Learn More</a>
                </div>
              </li>
            </ul>
        </div>
	<!-- end slider -->
			</div>
		</div>
	</div>	
	</section>
	<div class="row">
			<div class="col-lg-12">
				<div class="solidline">
				</div>
			</div>
	</div>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="panel panel-primary">
				  <div class="panel-heading"><b>Posting Blog Terbaru</b></div>
				  <div class="panel-body">
					<div class="list-group">
						<?php foreach ($last_blogs as $key => $blog){ ?>
						<a href="<?php echo site_url("blog/read/".$blog->blog_id) ?>" class="list-group-item">
						    <h5 class="list-group-item-heading"><?php echo $blog->blog_title ?></h5>
						    <?php
	                            $words = explode(" ",$blog->blog_content);
	                            $sentences =  implode(" ",array_splice($words,0,5));  
	                        ?>
						    <!--<p class="list-group-item-text"><?php echo $sentences." [...]" ?></p> -->
						</a>
						<?php } ?>
					</div>
				  </div>
				  <div class="panel-footer"><a href="<?php echo site_url("blog") ?>"><b>Lihat Lebih Banyak...</b></a></div>
				</div>
			</div>
			<div class="col-lg-4">
					<div class="panel panel-primary">
					  <div class="panel-heading"><b>Pertanyaan Konsultasi Terbaru</b></div>
					  <div class="panel-body">
						<div class="list-group">
							<?php foreach ($last_asks as $key => $ask) { ?>
							<a href="<?php echo site_url("site/ekonsultasi/read/".$ask->id) ?>" class="list-group-item">
							    <h5 class="list-group-item-heading"><?php echo $ask->title; ?></h5>
							    <?php
		                            $words = explode(" ",$ask->content);
		                            $sentences =  implode(" ",array_splice($words,0,7));  
		                        ?>
							    <!-- <p class="list-group-item-text"><?php echo  $sentences." [...]" ?></p> -->
							</a>
							<?php } ?>
						</div>
					  </div>
					  <div class="panel-footer"><a href="<?php echo site_url("site/ekonsultasi/lists") ?>"><b>Lihat Lebih Banyak...</b></a></div>
					</div>
			</div>
			<div class="col-lg-4">
				<div class="panel panel-primary">
				  <div class="panel-heading"><b>Promosi Terbaru</b></div>
				  <div class="panel-body">
					<div class="list-group">
						<?php foreach ($promotion as $key => $promo) { ?>
						<a href="<?php echo site_url('site/read_promosi'.'/'.$promo->id_promosi); ?>" class="list-group-item">
						    <h5 class="list-group-item-heading"><?php echo $promo->judul_promosi; ?></h5>
                        <?php
                                $words = explode(" ",$promo->web_promosi);
                                $sentences =  implode(" ",array_splice($words,0,7));
                                
                        ?>
						    <!--<p class="list-group-item-text"><?php echo  $sentences." [...]" ?></p> -->
						</a>
						<?php } ?>
					</div>
				  </div>
				  <div class="panel-footer"><a href="<?php echo site_url('site/promosi'); ?>"><b>Lihat Lebih Banyak...</b></a></div>
				</div>
			</div>
		</div>
	</div>
	</section>