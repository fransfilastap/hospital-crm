    <!-- Blog -->
    <section class="blog-wrapper">
    	<div class="container">
        	<div class="row">
            	
                <div class="span8">
                	<div class="blog-single-wrap">
                    	<div class="blog-img-wrap">
                        	
                        <?php
                            
                            $thumb = "";
                            
                            if( strlen($post->blog_feature_image) > 0 )
                            {
                                $thumb      =   "/rajapulsa/upload/blog_cover/".$post->blog_feature_image;
                            }
                            else
                            {
                                $thumb = site_url("assets/flatpad/img/thumb_big.png");
                            }


                        ?>
                            <img src="<?php echo $thumb; ?>" alt="MyPassion" />
                        </div>
                        <h1 class="blog-title"><a href="<?php echo site_url("post/".$post->blog_id) ?>"><?php echo $post->blog_title;  ?></a></h1>
                        <ul class="blog-post-meta">
                            <li><i class="icon-clock"></i><?php echo format_date( $post->blog_date ); ?></li>
                            <li><a href="#"><i class="icon-heart"></i> 32</a></li>
                        </ul>
                        <div class="post-text-long">
                        	<?php echo $post->blog_content; ?>
                        </div>
                        <ul class="sharebox">
                            <li><a href="#"><span class="twitter">Tweet</span></a></li>
                            <li><a href="#"><span class="pinterest">Pin it</span></a></li>
                            <li><a href="#"><span class="facebook">Like</span></a></li>
                        </ul>
                        
                    </div>
                    
                </div>
                
                <!-- Sidebar -->
                <div class="span4">
                	<div class="widget-block">
                    	<h1 class="new-style-one">Categories<span></span></h1>
                        
                         <!-- Categories -->
                        <ul class="sidebar-categories">
                            <?php foreach ($categories as $category) { ?>
                            <li><h1 class="new-style-two"><a href="<?php echo site_url('category/'.$category->id_category); ?>"><?php echo $category->category_name;  ?></a></h1></li>
                            <?php } ?>
                        </ul>
                        <!-- /Categories -->
                        
                    </div>
                      
                    <div class="widget-block">
                    	<h1 class="new-style-one">Archives<span></span></h1>
                        <ul class="sidebar-categories">
                            <li><h1 class="new-style-two"><a href="#">October 2013 <span class="link-list">(25)</span></a></h1></li>
                            <li><h1 class="new-style-two"><a href="#">September 2013 <span class="link-list">(11)</span></a></h1></li>
                            <li><h1 class="new-style-two"><a href="#">August 2013 <span class="link-list">(21)</span></a></h1></li>
                            <li><h1 class="new-style-two"><a href="#">July 2013 <span class="link-list">(10)</span></a></h1></li>
                        </ul>
                    </div>
                    
                </div>
                <!-- /Sidebar -->
            </div>
        </div>
    </section>
    <!-- /Blog -->