# recipe-plugin
Sample code for recipe plugin

These are two examples of functions in a custom wordpress plugin. 

The project is incorporating an already existing custom recipe management system into wordpress. I built this RMS back in 2008. 

The existing recipe system has an object class called recipe that contains all of the typical data that you would expect in a recipe. Name, photo, instructions, cook time, etc. The class files are loaded when wordpress is loaded so a recipe can be called from within wordpress code. 

A recipe also has a wordpress id that maquerades as a custom post type in the database so that the jetpack plugin for commenting can be used on a recipe page outside of wordpress. 

When an admin is looking inside the Recipe Management System, they see recipes in a table by name. This table also has a "card" column with content like this: [card slug="123"] where 123 is the unique id of the recipe. This card tag can be copied and dropped into the proper place in a wordpress post. 

The code for example here lives inside of the main custom plugin file and each file is its own standalone function that deals with these recipes. 

get_recipe_slugs.php will scrape through the post content of a post and it will isoloate shortcodes to find the codes we want to have access to. This basically is used in the template at the top of a blog post and it will say something like "Recipes included in this post" with direct links to each recipe.

include_card.php is code that is called when a shortcode is present in post content. This is basically just the way to present a card in content that a reader will be able to see a brief glimpse at a recipe to decide if they want to click through. 
