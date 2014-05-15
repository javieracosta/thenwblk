<?php

/*
 * default template for displaying a single record
 *
 * each group with the "visible" attribute checked will display its fields in the order set 
 * in the manage database fields page.
 *
 * each group has three values you can use: 
 *    $group->name         a unique string suitable for classnames and such 
 *    $group->title        the group name to be displayed 
 *    $group->description  contains any extra text you want to add to each group
 *
 * each field has three values:
 *    $field->name         like $group->name it's good for precise control over your display using CSS selectors
 *    $field->title        makes a good display title for the field
 *    $field->form_element tells you what kind of data the field contains so you can display it accordingly.
 *    $field->value        is the value of the field
 *
 * the values should be processed through a function called "Products_Db::prep_field_for_display" 
 * that will convert the stored raw values into displayable strings using the form_element info 
 * to control how it alters the raw values. I left the function call in the template so you can process 
 * the values yourself if you want
 *
 * if there are specific fields you wish to exclude from display, you can include the "name" value of 
 * the field in the $exclude array like this: $exclude = array( 'city','state','country' ); or whatever 
 * you want. Leave it empty (like it is here) if you don't want to exclude any fields.
 *
 * this template is a simple demonstration of what is possible
 *
 * for those unfamiliar with PHP, just remember that something like <?php echo $group->name ?> just prints out 
 * the group name. You can move it around, but leave all the parts between the <> brackets as they are.
 *
 */


// define an array of fields to exclude here
$exclude = array();
?>



<div class="wrap-edit-product">
	
  <?php // display each data group
  foreach ( Products_Db::single_record_fields( $id, $exclude ) as $group ) :
  ?>

    <ul class="product-list">
    	<div id="product-info">
    		<div id="galleria">
  
	<?php // this prints out all the fields in the group
		foreach( $group->fields as $field ) : 
              
          $value = Products_Db::prep_field_for_display( $field->value, $field->form_element );
					
			$empty_class = empty( $value ) ? 'blank-field' : '';
			
			switch ($value)
			{
			case "Accessories":
			$category = $value;
			break;
			case "Tables":
			$category = $value;
			break;
			case "Casegoods":
			$category = $value;
			break;
			case "Seating":
			$category = $value;
			break;
			case "Shelving":
			$category = $value;
			break;
			case "Miscellaneous":
			$category = $value;
			break;
			case "Pendant":
			$category = $value;
			break;
			case "Floor":
			$category = $value;
			break;
			case "Lamps":
			$category = $value;
			break;
			case "Wall":
			$category = $value;
			break;
			case "Transport":
			$category = $value;
			break;
			case "Wear":
			$category = $value;
			break;
			case "Inform":
			$category = $value;
			break;
			case "Listen":
			$category = $value;
			break;
			case "Ingest":
			$category = $value;
			break;
			}	?>
      			
      	<?php if (strpos($field->name,"image_1") !== false) {
      		echo $value . '<noscript>' . $value . '</noscript>';	
      	} elseif (strpos($field->name,'image_') !== false) {	
			echo $value;
  		}; ?>
  		
  		<?php if (strpos($field->name,"designer") !== false) : ?>
  			</div> 
  			<div id="product-text">
		<?php endif ?>		
 		<?php if (strpos($field->name,"retail_price") !== false || strpos($field->name,"materials") !== false) echo '<div class="product-row">'; ?>	
 		<?php if (strpos($field->name,"designer") !== false) : ?>
  			<li class="<?php echo $field->name.' '.$empty_class?>"><a id="designer-product-name" href="http://thenwblk.com/agenda/profiles/<?php echo $value ?>"><?php echo $value ?></a></li>
		<?php endif ?>
 		
 		<?php if (strpos($field->name,"image_") === false && strpos($field->name,"designer") === false) : ?>	
 			<li class="<?php echo $field->name.' '.$empty_class?>"><?php echo $value ?></li>
 		<?php endif ?>
 		<?php if (strpos($field->name,"size") !== false) echo '</div>'; ?>
 		<?php
 			//Fetching variables to build various tables
 			switch ($field->name)
 			{
 				case "image_1":
 					$image_holder = $value;
 					$image_holder_url;
    				$doc = new DOMDocument();
   					$doc->loadHTML($image_holder);
  				  	$imageTags = $doc->getElementsByTagName('img');
					foreach($imageTags as $tag) {
        				$image_holder_url = $tag->getAttribute('src');
   					}
   					/*echo '<noscript> <?php $image_holder = $value;
 					$image_holder_url;
    				$doc = new DOMDocument();
   					$doc->loadHTML($image_holder);
  				  	$imageTags = $doc->getElementsByTagName("img");
					foreach($imageTags as $tag) {
        				$image_holder_url = $tag->getAttribute("src");
   					}; ?>';*/
 				break;
 				case "product_name":
 				$item_name = $value;
 				break;
 				case "display_category":
 				$display_category = $value;
 				$field_label = $field->name;
 				break;
 				case "designer":
 				$designer = $value;
 				break;
 				case "retail_price":
 				$retail_price = $value;
 				break;
 				case "materials":
 				$materials = $value;
 				break;
 				case "description":
 				$description = $value;
 				break;
 				case "size":
 				$size = $value;
 				break;
 				case "lead_time":
 				$lead_time = $value;
 				break;
 			} ?>	
  		
    <?php endforeach; // end of the fields loop ?>
    		<li class="inquiries">
    		  <form target="contactframe" action="/wp-content/themes/THENWBLK/contact/contactform.php" method="post">
    		  	<input type="submit" value="INQUIRIES" />
    		  	<input type="hidden" name="designer" value="<?php echo $designer; ?>" />
    		  	<input type="hidden" name="item_name" value="<?php echo $item_name; ?>" />
    		  </form>
    		  <iframe style="display:none;position:relative;left:-15%;margin-top:-70%;z-index:999;" id="contactframe" src="/wp-content/themes/THENWBLK/contact/contactform.php" frameborder='0' width='384' height='600' name="contactframe"></iframe>

    		</li>
    		
    		<li class="tearsheet">
    		  <form target="_blank" action="/wp-content/themes/THENWBLK/pdf.php" method="post">
    		  	<input type="submit" value="VIEW TEARSHEET" />
    		  	<input type="hidden" name="designer" value="<?php echo $designer; ?>" />
    		  	<input type="hidden" name="description" value="<?php echo htmlspecialchars($description, ENT_QUOTES); ?>" />
    		  	<input type="hidden" name="item_name" value="<?php echo $item_name; ?>" />
    		  	<input type="hidden" name="materials" value="<?php echo $materials; ?>" />
    		  	<input type="hidden" name="size" value='<?php echo $size; ?>' />
    		  	<input type="hidden" name="retail_price" value="<?php echo $retail_price; ?>" />
    		  	<input type="hidden" name="image_holder_url" value='<?php echo $image_holder_url; ?>' />
    		  	<input type="hidden" name="lead_time" value='<?php echo $lead_time; ?>' />
    		</form>
    		
			</li>
			</div>
  		
  				<div class="post-sharing">
					<ul>
					<li><fb:like data-href="<?php //Send Link URI grab
					$Path=$_SERVER['REQUEST_URI'];
					$URI= bloginfo('url').$Path; 
					echo $URI ?>" send="false" layout="button_count" width="450" show_faces="false" colorscheme="light" font="trebuchet ms"></fb:like></li>
		
					<li><a style="width:31%;" href="https://twitter.com/share" class="twitter-share-button" data-hashtags="THENWBLK" data-url="<?php //Send Link URI grab
					$Path=$_SERVER['REQUEST_URI'];
					$URI= bloginfo('url').$Path; 
					echo $URI ?>">Tweet</a></li>
	
					<li><a id="product-email" target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&su=PRODUCT | THENWBLK <?php echo $item_name;?>&body=<?php //Send Link URI grab
					$Path=$_SERVER['REQUEST_URI'];
					$URI= bloginfo('url').$Path; 
					echo $URI ?>
					">Send Link</a></li>
					
					<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image_holder_url ?>&description=<?php  
					echo bloginfo('url');?>/product" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
					</ul>		
				</div>
			  </div>
		  </div>
      </ul>
	    
	</div>
  
 	<?php endforeach; // end of the groups loop ?>
  
</div>

<!-- Product back/forth navigation -->
<a id="prevProduct" href="<?php echo get_previous_product($id,$display_category); ?>">&nbsp;</a>
<a id="nextProduct" href="<?php echo get_next_product($id,$display_category); ?>">&nbsp;</a>

<script type="text/javascript">

// load the photo gallery
    Galleria.run('#galleria');

//Set product page container to the full browser height
	$('#item-content, .galleria-stage, #galleria').css('height',(window.innerHeight-(window.innerWidth/10)));


//create text glow effects
	var jsCategory;
	jsCategory = "<?php echo $category ?>";
	
	switch (jsCategory) 
	{
	case 'Accessories':
		
		$('#menu-item-358').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Tables':
		$('#menu-item-385 a, a.menu-item-355').css('color','#fff');
		$('#menu-item-355 ul').css('display','block');
		$('#menu-item-355').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Casegoods':
		$('#menu-item-384 a, a.menu-item-355').css('color','#fff');
		$('#menu-item-355 ul').css('display','block');
		$('#menu-item-355').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Seating':
		$('#menu-item-383 a, a.menu-item-355').css('color','#fff');
		$('#menu-item-355 ul').css('display','block');
		$('#menu-item-355').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Shelving':
		$('#menu-item-382 a, a.menu-item-355').css('color','#fff');
		$('#menu-item-355 ul').css('display','block');
		$('#menu-item-355').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;	
	
	case 'Miscellaneous':
		$('#menu-item-381 a, a.menu-item-355').css('color','#fff');
		$('#menu-item-355 ul').css('display','block');
		$('#menu-item-355').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Pendant':
		$('#menu-item-426 a, a.menu-item-359').css('color','#fff');
		$('#menu-item-359 ul').css('display','block');
		$('#menu-item-359').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Floor':
		$('#menu-item-425 a, a.menu-item-359').css('color','#fff');
		$('#menu-item-359 ul').css('display','block');
		$('#menu-item-359').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Lamps':
		$('#menu-item-424 a, a.menu-item-359').css('color','#fff');
		$('#menu-item-359 ul').css('display','block');
		$('#menu-item-359').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Wall':
		$('#menu-item-423 a, a.menu-item-359').css('color','#fff');
		$('#menu-item-359 ul').css('display','block');
		$('#menu-item-359').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Transport':
		$('#menu-item-418 a, a.menu-item-357').css('color','#fff');
		$('#menu-item-357 ul').css('display','block');
		$('#menu-item-357').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Wear':
		$('#menu-item-422 a, a.menu-item-357').css('color','#fff');
		$('#menu-item-357 ul').css('display','block');
		$('#menu-item-357').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;
	
	case 'Inform':
		$('#menu-item-421 a, a.menu-item-357').css('color','#fff');
		$('#menu-item-357 ul').css('display','block');
		$('#menu-item-357').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;	
	
	case 'Ingest':
		$('#menu-item-420 a, a.menu-item-357').css('color','#fff');
		$('#menu-item-357 ul').css('display','block');
		$('#menu-item-357').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;	
	
	case 'Listen':
		$('#menu-item-419 a, a.menu-item-357').css('color','#fff');
		$('#menu-item-357 ul').css('display','block');
		$('#menu-item-357').addClass('current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor');
	break;		
}

//closes the contact iframe after submission
function closeIFrame(){
	$('#contactframe').hide('slow');
};
</script>

<!--Page navigation-->
<?php

function get_next_product($id,$display_category) {
	global $wpdb;
	$next_product = $wpdb->get_var("SELECT id FROM ".Products_Db::$products_table." WHERE display_category = '".$display_category."' AND id > ".$id." ORDER BY id ASC LIMIT 1");
	return bloginfo('url') . '/product/product/?pdb=' . $next_product;
}

function get_previous_product($id,$display_category) {
	global $wpdb;
	$previous_product = $wpdb->get_var("SELECT id FROM ".Products_Db::$products_table." WHERE display_category = '".$display_category."' AND id < ".$id." ORDER BY id DESC LIMIT 1");
	return bloginfo('url') . '/product/product/?pdb=' . $previous_product;
}

?>