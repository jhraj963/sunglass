<?php 
	
	/*************
	 * @package  		 IMS
	 ***************/		
	
	get_header();
	
	?>

 

    <!--=========== BEGAIN BLOG SECTION ================-->
    <section id="blog" class="blog_archive">
      <div class="container">
        <div class="row">        
		
          <div class="col-sm-12">
            <!-- BEGAIN BLOG CONTENT -->
            <div class="blogarchive_content">        
                <!-- BEGAIN SINGLE BLOG -->
				
				<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>

					<?php the_content();?>
					
				<?php endwhile; ?>

				<?php else : ?>
					<h3 style="text-align:center;margin:100px auto;font-weight:bold;font-size:30px;line-height:35px;"><?php _e('Sorry! Nothing Found', 'singlepro'); ?></h3>
				<?php endif; ?>					
            </div>
			
			
           
		  
          </div>
		  
        </div>
      </div>
    </section>
    <!--=========== END BLOG SECTION ================-->

	<?php get_footer();?>

	