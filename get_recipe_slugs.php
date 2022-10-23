/**
 * Get Recipe Slugs
 * this gets the recipes and links for each blog post used at the very top
 * it is called inside the template
 */

function get_recipe_slugs(){
  ob_start();
  global $post;

  //grabbing proper shortcode regex from wordpress
  $pattern = get_shortcode_regex();
  $matches = array();

  preg_match_all("/$pattern/s", $post->post_content, $matches); 
  $content = '';
  $count = 0;
  //$matches[3] is where the id will live. formatted like: slug="500"
  foreach($matches[3] as $value){
    //this ensures that if extra shortcodes are used in the future it will not grab those
    //using count to double check which index we're looking at in $matches[3] and look at the same index in $matches[2]
    if($matches[2][$count] == 'card' || $matches[2][$count] == 'recipe' || $matches[2][$count] == 'short'){
      //isolate the id
      $array = explode('"',$value);
      $id = $array[1];
      //this is an external class that lives outside of wordpress
      $recipe = new recipe($id);
      
      //ensure that this recipe exists and has a name
      if($recipe->recipe_name){
        //add commas to all but first and last
        if($count > 0){
          $content .= ', ';
        }
        $content .= '<a href="'.get_site_url().'/recipes/r/'.$recipe->recipe_url.'">'.$recipe->recipe_name.'</a>';
        $count++;
      }
    }
  }

  return $content;
}
