	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
			<?php if( count( $blogs ) > 0 ) {?>
				<?php foreach ($blogs as $key => $blog) { ?>
				 <article>
				 	<div class="post-image">
						<div class="post-heading">
							<h3><a href="<?php echo site_url('blog/read/'.$blog->blog_id); ?>"><?php echo $blog->blog_title; ?></a></h3>
						</div>
						<?php
                            
                            if( strlen($blog->blog_feature_image) > 0 )
                            {
                                $thumb      =   site_url("upload/blog_cover")."/".$blog->blog_feature_image;
                                echo '<img src="'.$thumb.'" alt="" />';
                            }

                        ?>
					</div>
                        <?php
                                $words = explode(" ",$blog->blog_content);
                                $sentences =  implode(" ",array_splice($words,0,30));
                                
                        ?>
						<p><?php echo $sentences;  ?></p>
						<div class="bottom-article">
							<ul class="meta-post">
								<li><i class="icon-calendar"></i><a href="#"> <?php echo format_date($blog->blog_date); ?></a></li>
								<li><i class="icon-user"></i><a href="#"> <?php echo $blog->blog_author; ?></a></li>
								<li><i class="icon-folder-open"></i><a href="#"> <?php echo $blog->category_name; ?></a></li>
							</ul>
							<a href="<?php echo site_url('blog/read/'.$blog->blog_id); ?>" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
						</div>
				</article>

				<?php } ?>

                <div>
                        <?php echo $links; ?>
                </div>

                <?php }else{
                	echo "<h3>Konten tidak ditemukan</h3>";
                }


                 ?>
       
				<!--
				<div id="pagination">
					<span class="all">Page 1 of 3</span>
					<span class="current">1</span>
					<a href="#" class="inactive">2</a>
					<a href="#" class="inactive">3</a>
				</div>
			-->
			</div>
			<div class="col-lg-4">
				<aside class="right-sidebar">
				<div class="widget">
					<div class="panel panel-primary">
					  <div class="panel-heading">
					    <h3 class="panel-title">Kategori</h3>
					  </div>
					  <div class="panel-body">
					    <ul class="cat">
						<?php foreach ($categories as $key => $category) { ?>
							<li><i class="icon-angle-right"></i><a href="<?php echo site_url("category/".$category->id_category); ?>"><?php echo $category->category_name ?></a><span class="badge pull-right"> (<?php echo $category->total_post; ?>)</span></li>
						<?php } ?>
						</ul>
					  </div>
					</div>

				</div>
				<div class="widget">
				<div class="panel panel-primary">
				  <div class="panel-heading"><b>Posting Blog Terbaru</b></div>
				  <div class="panel-body">
					<div class="list-group">
						<?php foreach ($last_blogs as $key => $blog){ ?>
						<a href="<?php echo site_url("blog/read/".$blog->blog_id) ?>" class="list-group-item">
						    <h5 class="list-group-item-heading"><?php echo $blog->blog_title ?></h5>
						    <?php
	                            $words = explode(" ",$blog->blog_content);
	                            $sentences =  implode(" ",array_splice($words,0,20));  
	                        ?>
						    <p class="list-group-item-text"><?php echo $sentences ?></p>
						</a>
						<?php } ?>
					</div>
				  </div>
				  <div class="panel-footer"><a href="<?php echo site_url("blog") ?>"><b>Lihat Lebih Banyak...</b></a></div>
				</div>
				</div>
				</aside>
			</div>
		</div>
	</div>
	</section>