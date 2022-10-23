/**
 * Include Card
 * this happens if the "card" shortcode appears in blog content: [card slug="123"]
 */
 function include_card($atts) {
    $slug = '';
    $a = shortcode_atts( array(
       'slug' => 'NULL',
      ), $atts );

     if($slug != 'NULL'){
       ob_start();
       //recipe is an external class outside of wordpress. 
       //recipe is instantiated with a unique id that will be in the post content: [card slug="123"]
       $recipe = new recipe($a['slug']);

       //bun calculation is a specific tool on the site that allows bread recipes to be adjusted according to how many rolls/buns desired
       $buncalc = false;
       if($recipe->dough_calc == 'Y'){
          $buncalc = true;
       }
       
       //check to make sure this recipe exists and has a name
       if($recipe->recipe_name){
        //this template is using a version of twitter bootstrap and uses those css classes for cards/rows/cols
       ?>
          <div class="card my-4">
            <div class="card-header container-fluid">
            <div class="row">
              <div class="col-md-9">
  
              <h5>
              <a href="<?php echo get_site_url(); ?>/recipes/r/<?php echo $recipe->recipe_url; ?>" >
                <?php echo $recipe->recipe_name; ?>
                </a>
              </h5>
              </div>
              <div class="col-md-3">
                <div class="float-right text-muted">
                  Recipe Card
                </div>
              </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                
              <div class="col-sm-3">
                <?php if($recipe->hasImage()){ ?>
                  <figure class="icon-overlay small icn-link main">
                  <a href="<?php echo get_site_url(); ?>/recipes/r/<?php echo $recipe->recipe_url; ?>" >
                    <img src="<?php echo get_site_url(); ?>/recipes/<?php echo $recipe->getImage('medium'); ?>" class="photo image" alt="<?php echo $recipe->recipe_name; ?>" title="<?php echo $recipe->recipe_name; ?>" />
                </a>
              </figure>
                <?php } ?>
                <?php if($recipe->total_time){ ?>
                  <?php //convertToHoursMins is a custom function that changes something like: 120 to display as: 2 hours ?>
                  <small class="text-muted"><i class="fa fa-clock-o"> </i> <?php echo convertToHoursMins($recipe->total_time); ?></small>
                <?php } ?>
                </div>
                <div class="col-sm-9">
                  <h5 class="card-title"><a href="<?php echo get_site_url(); ?>/recipes/r/<?php echo $recipe->recipe_url; ?>" ><?php echo $recipe->recipe_name; ?></a></h5>
                  <p class="card-text"><?php echo $recipe->recipe_excerpt; ?></p>
                  <a target="_blank" href="<?php echo get_site_url(); ?>/recipes/r/<?php echo $recipe->recipe_url; ?>" class="btn btn-primary">Get Recipe 
                  <?php //template also uses font awesome for icons ?>
                  <i class="fa fa-angle-double-right"> </i>
                  </a>
                </div>
              </div>
            </div>
            <?php if($buncalc){ ?>
              <div class="card-footer text-white bg-success ">
               <span>Try: </span> <a href="<?php echo get_site_url(); ?>/bun-calculator/<?php echo $recipe->recipe_url; ?>#recipe"><?php echo $recipe->recipe_name; ?> in our Bun Calculator <i class="fa fa-angle-double-right"> </i></a>
              </div>
            <?php } ?>
          </div>
       <?php 
       }
       return ob_get_clean();
     }
}
add_shortcode('card', 'include_card');
