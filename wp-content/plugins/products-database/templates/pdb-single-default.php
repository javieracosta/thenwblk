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

$categories = array("Accessories","Tables","Casegoods","Seating","Shelving","Miscellaneous","Pendant","Floor",
	"Lamps","Wall","Transport","Wear","Inform","Ingest","Listen");

$redirection_categories = array(
	"Accessories" => "/accessories",
	"Tables" => "/furniture-2/tables",
	"Casegoods"=>"/furniture-2/casegoods",
	"Seating"=>"/furniture-2/seating",
	"Shelving"=>"/furniture-2/shelving",
	"Miscellaneous"=>"/furniture-2/miscellaneous",
	"Pendant"=>"/lighting/pendant",
	"Floor"=>"/lighting/floor",
	"Lamps"=>"/lighting/lamps",
	"Wall",
	"Transport"=>"/utility/transport",
	"Wear"=>"/utility/wear",
	"Inform","Ingest","Listen");


if(isset($_POST["delete_product"])){
	global $wpdb;
	$product = Products_Db::get_product($id);

	##deletion of attached files, so far we only have 5 image_fields
	for($i=1;$i<=5;$i++){
		$path = ABSPATH . "/wp-content/uploads/products-database/"; 
		if(!empty($product["image_".$i])){
			$filename = basename($product["image_".$i]);
			$file_path = $path.$filename;
			if(file_exists($file_path)) 
				unlink($file_path);
		}
	}
	$myrows = $wpdb->get_results( "DELETE FROM wp_products_database WHERE id = $id" );
	if(isset($redirection_categories[$_POST["current_category"]])){
		echo "<script>window.location.href='".get_bloginfo('url') . '/product'.$redirection_categories[$_POST["current_category"]]."';</script>";
		exit;
	} else {
		echo "<script>window.location.href='".get_bloginfo('url') . "/product';</script>";
		exit;
	}

}
$product = Products_Db::get_product($id);
$show_placeholder = true;
for($i=1;$i<=5;$i++){
	if(!empty($product["image_".$i])){
		$show_placeholder = false;
		break;
	}

}
?>



<div class="wrap-edit-product">
	
  <?php // display each data group
  foreach ( Products_Db::single_record_fields( $id, $exclude ) as $group ) :
    	//echo var_dump($group->fields);
  	?>

  <ul class="product-list">
  	<div id="product-info">
  		<div id="galleria">
	<?php // this prints out all the fields in the group
	foreach( $group->fields as $field ) :     
		$value = Products_Db::prep_field_for_display( $field->value, $field->form_element );
			//echo var_dump($value);		
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
		if(!$show_placeholder)
			echo $value . '<noscript>' . $value . '</noscript>';
		else{
			$placeholder = "<img src='http://placehold.it/450x300'>";
			echo  $placeholder . '<noscript>' . $placeholder . '</noscript>';
		}		
	} elseif (strpos($field->name,'image_') !== false) {	
		echo $value;
	}; ?>

	<?php if (strpos($field->name,"designer") !== false) : ?>
</div> 
<div id="product-text-container">
	<div id="product-text">
	<?php endif ?>		
	<?php if (strpos($field->name,"retail_price") !== false || strpos($field->name,"materials") !== false) echo '<div class="product-row">'; ?>	
	<?php if (strpos($field->name,"designer") !== false) : ?>
	<?php $designerUrl = urlencode( preg_replace( '/\s+/', '-', str_replace( array( '&', 'and' ) , '', strtolower( $value ) ) ) ); ?>
	<li class="<?php echo $field->name.' '.$empty_class?>"><a id="designer-product-name" href="<?php echo bloginfo('url') . '/agenda/profiles/'. $designerUrl ?>"><?php echo $value ?></a></li>
	<script>
		console.log( <?php echo json_encode( $group ); ?> );
	</script>
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
			        	<li class="inquiries hide-on-iphone hide-on-ipad">
			        		<form target="contactframe" action="/wp-content/themes/THENWBLK/contact/contactform.php" method="post">
			        			<input type="submit" value="INQUIRIES" />
			        			<input type="hidden" name="designer" value="<?php echo $designer; ?>" />
			        			<input type="hidden" name="item_name" value="<?php echo $item_name; ?>" />
			        		</form>
			        		<iframe style="display:none;position:relative;left:-15%;margin-top:-70%;z-index:999;" id="contactframe" src="/wp-content/themes/THENWBLK/contact/contactform.php" frameborder='0' width='384' height='600' name="contactframe"></iframe>

			        	</li>
			        	<li class="inquiries show-on-iphone show-on-ipad">			    		 
			        		<a href="mailto:whats@thenwblk.com">inquiries</a>
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
			        			<input type="hidden" name="image_holder_url" value='<?php if(!empty($image_holder_url)) echo $image_holder_url; else echo 'http://placehold.it/450x300' ?>' />
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
					
					<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php if(!empty($image_holder_url)) echo $image_holder_url; else echo 'http://placehold.it/450x300' ?>&description=<?php  
					echo bloginfo('url');?>/product" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
				</ul>		
			</div>
		</div>

	</div>
</div>
</ul>

</div>

<?php endforeach; // end of the groups loop ?>

</div>

<!-- Product back/forth navigation -->
<a id="prevProduct" href="<?php echo get_previous_product($id,$display_category, $categories); ?>">&nbsp;</a>
<a id="nextProduct" href="<?php echo get_next_product($id,$display_category, $categories); ?>">&nbsp;</a>
<style>
/*.galleria-thumbnails-container {
    position: absolute;
    top: 70%;
    left: 30px;
    right: 0px;
    bottom: 0px;
    }*/
/*.galleria-thumbnails-container img {
    max-width: 100% !important;
    height: auto !important;

}
*/
/*#galleria{position:absolute;top:25%;bottom:0;left:0;right:20%; margin-right: 20px; height:auto;}
body .galleria-stage{top:0;left:55%;right:0;bottom:0}
.galleria-thumbnails-container{top:80%;left:25%;right:0;bottom:0}*/
</style>
<script type="text/javascript">
// load the photo gallery
//Galleria.loadTheme('http://aino.github.com/galleria/1.2.8/themes/classic/galleria.classic.min.js');
Galleria.configure({
	responsive: true,
});
Galleria.run('#galleria');
$(document).ready(function () {
	jQuery(window).resize(function($){
		if (typeof(windowHeight) == "undefined"){
			windowHeight = window.innerHeight-(window.innerWidth/10);
		} else if(windowHeight >= window.innerHeight-(window.innerWidth/10)) {
			windowHeight = window.innerHeight-(window.innerWidth/10);
			if ((windowHeight/$("#product-text").height()) > 1.5) {
				$("#galleria").height(windowHeight);
				$('#product-text-container').css('margin-top','0px');
				setTimeout(function(){Galleria.get(0).resize({'height': windowHeight})},1);
			} else {
				$('#item-content, #galleria, galleria-stage').css('min-height','440px');
				$('.galleria-thumbnails-container').css('bottom','0');	 		
				setTimeout(function(){Galleria.get(0).resize({'height': '440px'})},1);
			}  
			if (($("#product-text").width()) < 220) {
				$('#galleria, galleria-stage').css('min-width','615px');
				$('#product-text').css('min-width','220px');
				$('body, #page').css('min-width','730px');
				setTimeout(function(){Galleria.get(0).resize({'width': '615px'})},1);
			}
		} else if(windowHeight < window.innerHeight-(window.innerWidth/10)) {
			windowHeight = window.innerHeight-(window.innerWidth/10);
			$('#product-text').css('width','none');
			$("#item-content, #galleria, .galleria-stage").height(windowHeight);
			setTimeout(function(){Galleria.get(0).resize({'height': windowHeight})},1);
		}
		//Set product page container to the full browser height
		jQuery('#item-content, #galleria, galleria-stage').css('height',(window.innerHeight-(window.innerWidth/10)));
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

	});
	jQuery(window).resize();
});
//closes the contact iframe after submission
function closeIFrame(){
	$('#contactframe').hide('slow');
};
</script>

<!--Page navigation-->
<?php
function get_next_product($id,$display_category, $categories) {
	global $wpdb;
	$next_product = $wpdb->get_var("SELECT id FROM ".Products_Db::$products_table." WHERE display_category LIKE '%".$display_category."%' AND id > ".$id." ORDER BY id ASC LIMIT 1");
	if(empty($next_product)){
		$index = array_search($display_category, $categories);
		for($i=$index;$i<count($categories);$i++){
			if(($i+1)==count($categories))
				$next_category = $categories[0];
			else	
				$next_category = $categories[$i+1];	
			$next_product = $wpdb->get_var("SELECT id FROM ".Products_Db::$products_table." WHERE display_category LIKE '%".$next_category."%' ORDER BY id ASC LIMIT 1");
			if(!empty($next_product))
				break;
		}
	}
	return bloginfo('url') . '/product/product/?pdb=' . $next_product;
}

function get_previous_product($id,$display_category, $categories) {
	global $wpdb;
	$previous_product = $wpdb->get_var("SELECT id FROM ".Products_Db::$products_table." WHERE display_category LIKE '%".$display_category."%' AND id < ".$id." ORDER BY id DESC LIMIT 1");
	if(empty($previous_product)){
		$index = array_search($display_category, $categories);
		for($i=$index;$i<count($categories);$i--){
			if($i==0)
				$previous_category = $categories[count($categories)-1];
			else	
				$previous_category = $categories[$i-1];
			$previous_product = $wpdb->get_var("SELECT id FROM ".Products_Db::$products_table." WHERE display_category LIKE '%".$previous_category."%' ORDER BY id DESC LIMIT 1");
			if(!empty($previous_product))
				break;
		}
	}
	return bloginfo('url') . '/product/product/?pdb=' . $previous_product;
}

?>
