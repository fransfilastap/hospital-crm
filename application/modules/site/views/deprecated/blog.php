 <div class="row" style="margin-top:10px;margin-bottom:10px;">
<div class="span9" style="min-height:225px">

    <?php foreach ($blogs as $key => $blog) { ?>
                    <div class="blog-post-wrapper row">
                        <div class="blog-img-wrap span3">
                        <?php
                            
                            $thumb = "";
                            
                            if( strlen($blog->blog_feature_image) > 0 )
                            {
                                $thumb      =   "/rajapulsa/upload/blog_cover/".$blog->blog_feature_image;
                            }
                            else
                            {
                                $thumb = site_url("assets/flatpad/img/thumb_big.png");
                            }


                        ?>
                            <img src="<?php echo $thumb; ?>" alt="MyPassion" />
                        </div>
                        <div class="span5">
                        <h1 class="blog-title"><a href="<?php echo site_url("post/".$blog->blog_id) ?>"><?php echo $blog->blog_title; ?></a></h1>
                       
                            <div style="float:left; margin:0px; padding: 0px;list-style-type: none;"><i class="icon-calendar"></i> <?php echo format_date($blog->blog_date); ?></div>
                            <div style="float:right; margin:0px; padding: 0px;list-style-type: none;"><a href="#"><i class="icon-user"></i> <?php echo $blog->blog_author;?></a></div>
                      <div style="clear:both;margin-top:15px; "></div><br>
                        <div class="post-text-long">
                            <?php
                                $words = explode(" ",$blog->blog_content);
                                $sentences =  implode(" ",array_splice($words,0,30));
                                echo $sentences;
                             ?><br>
                            <a class="my-btn" href="<?php echo site_url('post/'.$blog->blog_id); ?>">Read More <i class=" icon-circle-arrow-right"></i></a>
                        </div>
                        
                    </div></div> <hr>
                    <?php } ?>

                    <div>
                        <?php echo $links; ?>
                    </div>

</div>

<div class="span3 row" style="background:whiteSmoke; height:225px">

    <div class="span3" style="background:#333; height:200px; margin-left:0px">
    <center>
    <span class="btn  btn-primary" style="margin-top:60px "><i class="icon-user icon-white"></i> Bergabung Sekarang </span> <br>
<span class="btn" style="margin-top:10px "> Login pasien </span>
    </center>
</div>
    </div>

 </div>