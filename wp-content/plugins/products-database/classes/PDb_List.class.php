<?php
/**
 * class for handling the listing of product records
 *
 * static class for managing a set of modules which together out put a listing of 
 * records in various configurations
 *
 * the general plan is that this class's initialization method is called in the
 * admin to generate the page. We also call this method with a shortcode
 * [pdb_list] which will initialize the class and pass in the parameters (if any)
 * to print the list to the website.
 *
 * Requires PHP Version 5.3 or greater
 * 
 * @category   
 * @package    WordPress
 * @author     Roland Barker <webdesign@xnau.com>
 * @copyright  2012 xnau webdesign
 * @license    GPL2
 * @version    Release: 1.3.7
 * @link       http://wordpress.org/extend/plugins/products-database/
 */
 
class PDb_List
{
	
	// holds the main query for building the list
	static $list_query;
	
	// translations strings for buttons
	static $i18n;
	
	// holds the pagination object
	static $pagination;
	
	static $mininav;

	// holds the number of list items to show per page
	static $page_list_limit;
	
	// the name of the list page variable
	static $list_page = 'listpage';
	
	// name of the list anchor element
	static $list_anchor = 'products-list';
	
	// the number of records after filtering
	static $num_records;
	
	// all the records are held in this array
	static $products;
	
	// true if the class is called from the admin
	static $backend;

	// holds the url of the registrations page
  static $registration_page_url;

	// holds the columns to display in the list
	static $display_columns;

	// holds th list of sortable columns
	static $sortables;

	// holds the parameters for a shortcode-called display of the list
	static $shortcode_params;
	
	// holds the settings for the list filtering and sorting
	static $filter;
	
	// holds plugin options array
	static $options;
	
	/**
	 * initializes and outputs the list for the backend or frontend
	 *
	 * @param array $atts display customization parameters
	 *                    from the shortcode
	 */
	public function initialize( $atts = '' ) {

		// are we showing the backend form or frontend?
		self::$backend = is_admin();
		
		// begin buffering the output of the plugin
		if ( ! self::$backend ) ob_start();
		
		self::_setup_i18n();
    
    self::$options = get_option( Products_Db::$products_db_options );

    // set the list limit value; this can be overridden by the shortcode atts later
    self::$page_list_limit = ( ! isset( $_POST['list_limit'] ) or ! is_numeric( $_POST['list_limit'] ) or $_POST['list_limit'] < 1 ) ? self::$options['list_limit'] : $_POST['list_limit'];
    
    self::$registration_page_url = get_bloginfo('url').'/'.( isset( self::$options['registration_page'] ) ? self::$options['registration_page'] : '' );

    self::$display_columns = Products_Db::get_list_display_columns( self::$backend ? 'admin_column' : 'display_column' );

    self::$sortables = Products_Db::get_sortables();

    // define the default settings for the shortcode
    $shortcode_defaults = array(
                                      'sort'        => 'false',
                                      'search'      => 'false',
                                      'list_limit'  => self::$page_list_limit,
                                      'class'       => 'products-database',
																			'filter'      => '',
																			'orderby'			=> 'date_updated',
																			'order'       => 'desc',
																			'fields'			=> 'product_name',
																			'display_count' => 'false',
                                      );

    self::$shortcode_params = shortcode_atts( $shortcode_defaults, $atts );
		
		// set up the basic values; sort values come from the shortcode
		$default_values = array(
														'where_clause' => 'none',
														'value'        => '',
														'operator'     => 'LIKE',
														'sortBy'       => self::$shortcode_params['orderby'],
														'ascdesc'      => self::$shortcode_params['order']
														);
		
		// merge the defaults with the $_REQUEST array so if there are any new values coming in, they're included
		self::$filter = shortcode_atts( $default_values, $_REQUEST );
		
		// allow for an arbitrary fields definition list in the shortcode
		if ( ! empty( self::$shortcode_params['fields'] ) ) {
			
			$raw_list = explode( ',', str_replace( array( "'",'"',' ',"\r" ), '', self::$shortcode_params['fields'] ) );
			
			if ( is_array( $raw_list ) ) :
			
				//clear the array
				self::$display_columns = array();
			
				foreach( $raw_list as $column ) {
					
					if ( Products_Db::is_column( $column ) ) {
				
						self::$display_columns[] = $column;
						
					}
					
				}
				
			endif;
			
		}
		
		//process the delete
		if( self::$backend && !empty($_POST)){
			self::_process_general();
		}
		
		
		// process any search/filter/sort terms and build the main query
		if( self::$backend ) {
			
			$submit = isset( $_POST['submit'] ) ? empty( $_POST['submit'] ) ? '' : $_POST['submit'] : '';
			self::_process_search( $submit );
			
		} else self::_shortcode_query();
		
		if ( WP_DEBUG ) error_log( __METHOD__.' list query= '.self::$list_query );
		
		// get the $wpdb object
		global $wpdb;
		
		// get the number of records returned
		$count = $wpdb->get_results( str_replace( 'SELECT * FROM', 'SELECT COUNT(*) FROM', self::$list_query ), ARRAY_A );
		self::$num_records = current( $count[0] );
		
		// set the pagination object
		self::$pagination = new Pagination( array(
																	'link'          => self::get_page_link( $_SERVER['REQUEST_URI'] ),
																	'page'          => isset( $_GET[ self::$list_page ] ) ? $_GET[ self::$list_page ] : '1',
																	'size'          => self::$shortcode_params['list_limit'],
																	'total_records' => self::$num_records,
																	'wrap_tag'      => '<div class="pagination"><label>'._x('Page', 'noun; page number indicator', Products_Db::PLUGIN_NAME ).':</label> ',
																	'wrap_tag_close'=> '</div>',
																	));
		
		// get the records for this page, adding the pagination limit clause
		self::$products = $wpdb->get_results( self::$list_query.' '.self::$pagination->getLimitSql(), ARRAY_A );
		
		// ok, setup finished, start outputting the form
		
		// add the top part of the page for the admin
		if ( self::$backend ) self::_admin_top();
		else self::_shortcode_top();
		
		// print the sorting/filtering forms
		self::_sort_filter_forms( self::_sort_filter_mode() );

    // add the delete and items-per-page controls for the backend
		if ( self::$backend ) self::_general_list_form_top();
		
		// print the main table
		self::_main_table();
		
		
		
		if ( self::$backend ) {
			
			// print the CSV export form
			self::_print_export_form();
			
			// print the plugin footer
			Products_Db::plugin_footer();
			
		} else {

      // close the shotcode container div
      echo '</div>';
      
      
      echo '</div>';
      
      // output the pagination controls
		self::$pagination->links();
	  	//self::$mininav->links();

    }
		
		// if called by a shortcode, return the buffer contents
		if ( ! self::$backend ) return ob_get_clean();
			
	}
	
	/**
	 * strips the page number out of the URI so it can be used as a link to other pages
	 *
	 * @param string $uri the incoming URI, usually $_SERVER['REQUEST_URI']
	 *
	 * @return string the re-constituted URI
	 */
	public function get_page_link( $uri ) {
	
		$URI_parts = explode( '?', $uri );
		
		if ( empty( $URI_parts[1] ) ) {
		
			$values = array();
		
		} else {
		
			parse_str( $URI_parts[1], $values );
			
			unset( $values[ self::$list_page ] );
			
		}
		
		return $URI_parts[0].'?'.http_build_query( array_merge( $values, self::$filter ) ).'&'.self::$list_page.'=%s#'.self::$list_anchor;
	
	}
	
	
	/**	
	 * processes all the general list actions: delete and  set items-per-page;
	 * these are only available in the admin
	 */
	private function _process_general() {
		
		global $wpdb;
		
		if ( isset( $_POST['action'] ) && $_POST['action']=='list_action' ) {
			
			switch ( $_POST['submit'] ) {
				
				case self::$i18n['delete_checked']:
			
					##deletion of attached files, so far we only have 5 image_fields
					foreach ($_POST['pid'] as $id) {
						$product = Products_Db::get_product($id);
						for($i=1;$i<=5;$i++){
							$path = ABSPATH . "/wp-content/uploads/products-database/"; 
							if(!empty($product["image_".$i])){
								$filename = basename($product["image_".$i]);
								$file_path = $path.$filename;
								if(file_exists($file_path)) 
									unlink($file_path);
							}
						}
					}

					$count = count( $_POST['pid'] );
			
					$pattern = $count > 1 ? 'IN ( '.trim( str_repeat( '%s,', $count ), ',' ).' )' : '= %s';
					$sql = "DELETE FROM ".Products_Db::$products_table." WHERE id ".$pattern;
					$wpdb->query( $wpdb->prepare( $sql, $_POST['pid'] ) );
					break;
					
				case self::$i18n['change']:
				
					Products_Db::$plugin_settings->update_option( 'list_limit', self::$page_list_limit );
					break;
					
				default:
				
			}
			
		}
		
	}
	
	/**
	 * precesses searches and sorts to build the listing query
	 */
	private function _process_search( $submit ) {

    // add this to the query to remove the default record
    $skip_default = ' `id` != '.Products_Db::$id_base_number;
		
		switch ( $submit ) {
		
			case self::$i18n['sort']:
			case self::$i18n['filter']:
      case self::$i18n['search']:
			
				self::$list_query = 'SELECT * FROM '.Products_Db::$products_table;
				
				$delimiter = array("'","'");

				switch (self::$filter['operator']){
					
					case 'LIKE':
						
						$operator = 'LIKE';
						$delimiter = array('"%','%"');
						break;
					
					case 'gt':
					
						$operator = '>';
						break;
						
					case 'lt':
					
						$operator = '<';
						break;
						
					default:
					
						$operator = self::$filter['operator'];
						
				}
				
				if ( self::$filter['where_clause'] != 'none' ) {
				
					// if the field searched is a "date" field, convert the search string to a date
					$field_atts = Products_Db::get_field_atts( self::$filter['where_clause'] );
					
					$value = self::$filter['value']; 
					
					if ( $field_atts->form_element == 'date') {
					
						$value = strtotime( self::$filter['value'] ); 
						if ( empty( $value ) ) {
							$value = time();
						}
						$delimiter = array( 'CAST(',' AS SIGNED)' );
						
					}
					
					if ( in_array( self::$filter['where_clause'], array( 'date_recorded','date_updated' ) ) ) {
					
						$delimiter = array( 'FROM_UNIXTIME(',')' );
						
					}
					
						self::$list_query .= ' WHERE `'.mysql_real_escape_string(self::$filter['where_clause']).'` '.mysql_real_escape_string($operator)." ".$delimiter[0].mysql_real_escape_string($value).$delimiter[1]." ";
						
						self::$list_query .= ' AND '.$skip_default;
					
				} else {
					
					self::$list_query .= ' WHERE '.$skip_default;
					
				}
				
				
				// add the sorting
				self::$list_query .= ' ORDER BY `'.mysql_real_escape_string(self::$filter['sortBy']).'` '.mysql_real_escape_string(self::$filter['ascdesc']);
		
				// go back to the first page to display the newly sorted/filtered list
				$_GET[ self::$list_page ] = 1;
				
				break;
				
			case self::$i18n['clear'] :
			
				self::$filter['value'] = '';
				self::$filter['where_clause'] = 'none';
		
				// go back to the first page
				$_GET[ self::$list_page ] = 1;
				
			default:
			
				self::$list_query = 'SELECT * FROM '.Products_Db::$products_table.' WHERE '.$skip_default.' ORDER BY `'.mysql_real_escape_string(self::$filter['sortBy']).'` '.mysql_real_escape_string(self::$filter['ascdesc']);
				
		}
		
	}
	
	/**
	 * processes shortcode filters and sorts to build the listing query
	 *
	 */
	private function _shortcode_query() {

    // add this to the query to remove the default record
    $skip_default = ' `id` != '.Products_Db::$id_base_number;
		
		// if we've got a valid orderby, use it. Check $_POST first, shortcode second
		$orderby = isset( self::$filter['sortBy'] ) ? self::$filter['sortBy'] : self::$shortcode_params['orderby'];
		$orderby = Products_Db::is_column( $orderby ) ? $orderby : current( self::$sortables );
		self::$filter['sortBy'] = $orderby;
			
		$order = isset( self::$filter['ascdesc'] ) ? strtoupper( self::$filter['ascdesc'] ) : strtoupper( self::$shortcode_params['order'] );
		$order = in_array( $order, array( 'ASC', 'DESC' ) ) ? $order : 'ASC';
		self::$filter['ascdesc'] = strtolower($order);
		
		self::$list_query = 'SELECT * FROM '.Products_Db::$products_table.' WHERE '.$skip_default.' ORDER BY `'.$orderby.'` '.$order;
		
		if  ( isset( $_POST['submit'] ) && $_POST['submit'] == self::$i18n['clear'] ) {
			
				self::$filter['value'] = '';
				self::$filter['where_clause'] = 'none';
				
				// go back to the first page
				$_GET[ self::$list_page ] = 1;
				
		}
		
		$where_clause = '';
				
		if ( isset( self::$shortcode_params['filter'] ) ) {
				
			$statements = explode( '&', html_entity_decode(self::$shortcode_params['filter']) );
			
			foreach ( $statements as $statement ) {
				
				$operator = preg_match( '#(\S+)(\>|\<|=|!|~)(\S+)#', str_replace(' ','', $statement ), $matches );
				
				if ( $operator === 0 ) continue;// no valid operator; skip to the next statement
				
				// get the parts
				list( $string, $column, $op_char, $target ) = $matches;
				
				if ( ! Products_Db::is_column( $column ) or ( ! empty( self::$filter['value'] ) && $column == self::$filter['where_clause'] ) ) {

          // not a valid column or was used in a user search query which overrides
          // the shortcode; skip to the next one
          continue;

        }
				
				$field_atts = Products_Db::get_field_atts( $column );
				
				$delimiter = array('"','"');
				
				// if we're dealing with a date element, the target value needs to be conditioned to
				// get a correct comparison
				if ( $field_atts->form_element == 'date' ) {
				
					$target = Products_Db::parse_date( $target );
					
					// if we don't get a valid date, skip this statement
					if ( false === $target ) continue;
					
					$delimiter = array( 'CAST(',' AS SIGNED)' );
					
				}
				
				// get the proper operator
				switch ( $op_char ) {
					
					case '~':
						$operator = 'LIKE';
						$delimiter = array('"%','%"');
						break;
					
					case '!':
						$operator = '!=';
						break;
						
					default:
						$operator = $op_char;
						
				}
				
				// build the where clause
				//$where_clause .= '`'.$column.'` '.$operator.' '.$delimiter[0].$target.$delimiter[1].' AND ';
				$where_clause .= sprintf( '`%s` %s %s%s%s AND ', $column, $operator, $delimiter[0], $target, $delimiter[1] );
				
			}// foreach $statements

			// add the user search
			if ( isset( self::$filter['value'] ) && ! empty( self::$filter['value'] ) && 'none' != self::$filter['where_clause'] ) {

        $pattern = self::$options['strict_search'] ? '`%s` = "%s" AND ' : '`%s` LIKE "%%%s%%" AND ';

        $where_clause .= sprintf( $pattern, self::$filter['where_clause'],self::$filter['value'] );

      }
			
			self::$list_query = 'SELECT * FROM '.Products_Db::$products_table.' WHERE '.$where_clause.$skip_default.' ORDER BY `'.$orderby.'` '.$order;
			
		}
		
	}
	
	/**
	 * top section for admin listing
	 */
	private function _admin_top() {
	?>
	<script type="text/javascript" language="javascript">
    var L10n = {"record":"<?php _e("Do you really want to delete the selected record?", Products_Db::PLUGIN_NAME )?>","records":"<?php _e("Do you really want to delete the selected records?", Products_Db::PLUGIN_NAME )?>"};
  
    function delete_confirm() {
			var plural = ( document.getElementById('select_count').value > 1 ) ? true : false;
      var x = window.confirm( plural ? L10n.records : L10n.record );
      if (x)
        return true
      else
        return false
    }
		
    check_state=false;
    function checkedAll (form_id) {
      var form = document.getElementById(form_id);
      if (check_state == false) {
               check_state = true
      } else {
               check_state = false;
							 armDelbutton(false);
      }
      for (var i =0; i < form.elements.length; i++) {
				if ( form.elements[i].type == 'checkbox' && form.elements[i].name != 'checkall' ) {
        	form.elements[i].checked = check_state;
					addSelects( check_state );
				}
      }
    }
		
		function addSelects( selected ) {
			var count_element = document.getElementById('select_count');
			var count = count_element.value;
			if ( selected === true ) count++;
			else {
				count--;
				document.getElementById('checkall').checked = false;
			}
			if ( count < 0 ) count = 0;
			armDelbutton(count > 0);
			count_element.value = count;
		}
		
		function armDelbutton( state ) {
			var delbutton = document.getElementById('delete_button');
			delbutton.setAttribute('class',state?'armed':'unarmed');
		}
			
		
		function checkEnter(e){
		 e = e || event;
		 return (e.keyCode || event.which || event.charCode || 0) !== 13;
		}
    
  </script>
  <div class="wrap">
    <h2><?php echo Products_Db::$plugin_title?></h2>
    <h3><?php printf( _n( 'List Products: %s record found, sorted by:', 'List Products: %s records found, sorted by:', self::$num_records ), self::$num_records )?> 
		<?php echo Products_Db::column_title( self::$filter['sortBy'] ) ?>.</h3>
    <?php
	}

	/**
	 * prints the top section of the output when called by a shortcode
	 */
  private function _shortcode_top() {
  
    // start with an anchor so pagination can target the list top

    printf('<a name="%1$s" id="%1$s" ></a>',self::$list_anchor);

    ?>
    <div class="<?php echo self::$shortcode_params['class'] ?>">
    <?php
    

  }
	 
	/**
	 * prints the sorting and filtering forms
	 *
	 * @param string $mode determines whether to print filter, sort, both or 
	 *                     none of the two functions
	 */
	private function _sort_filter_forms( $mode ) {
	
		if ( $mode == 'none' ) return;
		
		global $post;
	
	?>
	<div class="pdb-searchform">
	<form method="post" id="sort_filter_form" onKeyPress="return checkEnter(event)" <?php if ( ! self::$backend ) printf( 'action="%s" ',get_page_link( $post->ID ).'#'.self::$list_anchor ) ?>  >
    <input type="hidden" name="action" value="sort">
    
  	<?php if ( in_array( $mode, array( 'filter','both' ) ) ) : ?>
    
    <fieldset class="widefat">
    <?php if ( self::$backend ) : ?>
    <legend><?php _e('Show only records with', Products_Db::PLUGIN_NAME )?>:</legend>
    <?php else : ?>
    <legend><?php _e('Search', Products_Db::PLUGIN_NAME )?>:</legend>
    <?php endif ?>
    <?php
			//build the list of columns available for filtering
			$filter_columns = array( '('.__('show all', Products_Db::PLUGIN_NAME ).')' => 'none' );
			foreach ( Products_db::get_column_atts( self::$backend ? 'backend' : 'frontend_list' ) as $column ) {
				
				if ( in_array( $column->name, array( 'id','private_id' ) ) ) continue;
				
				$filter_columns[ $column->title ] = $column->name;
				
			}
			
			$element = array(
											 'type'		=> 'dropdown',
											 'name'		=> 'where_clause',
											 'value'	=>	self::$filter['where_clause'],
											 'options'	=> $filter_columns,
											 );
      FormElement::print_element( $element );
			?>
			<?php if ( self::$backend ) : ?>
       that
      <?php
       $element = array(
                        'type'     => 'dropdown',
                        'name'     => 'operator',
                        'value'    => self::$filter['operator'],
                        'options'  => array(
                                          __('is', Products_Db::PLUGIN_NAME )         => '=',
                                          __('is not', Products_Db::PLUGIN_NAME )     => '!=',
                                          __('contains', Products_Db::PLUGIN_NAME )   => 'LIKE',
                                          __('doesn&#39;t contain', Products_Db::PLUGIN_NAME )  => 'NOT LIKE',
                                          __('is greater than', Products_Db::PLUGIN_NAME )  => 'gt',
                                          __('is less than', Products_Db::PLUGIN_NAME )  => 'lt',
                                          ),
                        );
      FormElement::print_element( $element );
      ?>
      <?php else : ?>
      <input name="operator" type="hidden" value="LIKE" />
      <?php endif ?>
      <input id="product_search_term" type="text" name="value" value="<?php echo @self::$filter['value'] ?>">
      <input name="submit" type="submit" value="<?php echo self::$backend ? self::$i18n['filter'] : self::$i18n['search'] ?>">
      <input name="submit" type="submit" value="<?php echo self::$i18n['clear']?>">
    </fieldset>
    
    <?php endif;
		if ( in_array( $mode, array( 'sort','both' ) ) ) : ?>
    
    <fieldset class="widefat">
    <legend><?php _e('Sort by', Products_Db::PLUGIN_NAME )?>:</legend>
    	<?php
		
			$element = array(
											 'type'		=> 'dropdown',
											 'name'		=> 'sortBy',
											 'value'	=>	self::$filter['sortBy'],
											 'options'	=> self::$sortables,
											 );
      FormElement::print_element( $element );
			
			$element = array(
											 'type'		=> 'radio',
											 'name'		=> 'ascdesc',
											 'value'	=>	self::$filter['ascdesc'],
											 'options'	=> array(
											                    __('Ascending', Products_Db::PLUGIN_NAME )  => 'asc',
											                    __('Descending', Products_Db::PLUGIN_NAME ) => 'desc'
											                    ),
											 );
      FormElement::print_element( $element );
			
			?>
      <input name="submit" type="submit" value="<?php echo self::$i18n['sort'] ?>">
    </fieldset>
    <?php endif ?>
  </form>
  </div><?php
	}

	/**
	 * prints the general list form controls for the admin lising: deleting and items-per-page selector
	 */
	private function _general_list_form_top() { ?>

		<form id="list_form"  method="post"  onKeyPress="return checkEnter(event)" >
    	<?php FormElement::print_hidden_fields( array( 'action'=>'list_action' ) )?>
      <input type="hidden" id="select_count" value="0" />
      <div style="margin-top:10px">
  
        <input type="submit" name="submit" value="<?php echo self::$i18n['delete_checked'] ?>" onClick="return delete_confirm();" class="unarmed" id="delete_button" >
        <?php $list_limit = FormElement::get_element( array( 
																														'type'=>'text-line', 
																														'name'=>'list_limit', 
																														'value'=>self::$page_list_limit, 
																														'attributes'=>array( 
																																								'style'=>'width:2.2em',
																																								'maxLength'=>'2'
																																								) 
																														) 
																										 )?>
        <span style="padding-left:20px"><?php printf( __( 'Show %s items per page.', Products_Db::PLUGIN_NAME ),$list_limit )?>
        <?php FormElement::print_element( array( 'type'=>'submit', 'name'=>'submit','value'=>self::$i18n['change']) )?>
        </span>
      </div>

    <?php
  }

  /**
	 * prints the main body of the list, including headers
	 *
	 * @param string $mode dtermines the print mode: 'noheader' skips headers, (other choices to be determined)
	 */
  private function _main_table( $mode = '' ) { ?>


   	<?php if ( self::$shortcode_params['display_count'] == 'true' ) : ?>
   	<!--<caption><?php printf(__('Total Records Found',Products_Db::PLUGIN_NAME ).': %s',self::$num_records )?></caption>-->
    <?php endif ?>
      <?php
		// template for printing the registration page link in the admin
		$PID_pattern = '<td><a href="%2$s">%1$s</a></td>';
			
    // template for printing a header item
		$head_pattern = '<th class="%2$s" scope="col" align="left">%1$s</th>';
		
		//template for outputting a column
		$col_pattern = '<td>%s</td>';

    if ( count( self::$products ) > 0 ) :
			if ( $mode != 'noheader' ) :
      ?>
      
      <?php
			endif; // table header row

	    if ( self::$backend ) { 
      		$css = '
					<style>#hor-minimalist-b {
			    background: none repeat scroll 0 0 #FFFFFF;
			    border-collapse: collapse;
			    font-family: "Lucida Sans Unicode","Lucida Grande",Sans-Serif;
			    font-size: 12px;
			    margin: 20px;
			    text-align: left;
			    width: 480px;
			}

			#hor-minimalist-b th {
			    border-bottom: 2px solid #6678B1;
			    color: #003399;
			    font-size: 14px;
			    font-weight: normal;
			    padding: 10px 8px;
			}
			#hor-minimalist-b td {
			    border-bottom: 1px solid #CCCCCC;
			    color: #666699;
			    padding: 6px 8px;
			}
			</style>
			';
			echo "<table id='hor-minimalist-b'>";
			echo $css;
		}
      
      // print the table footer row if there is a long list
      if ( $mode != 'noheader' && count( self::$products ) > 10 ) :
      	if ( self::$backend ) : 
      ?>
        <div>
          <?php self::_print_header_row( $head_pattern ) ?>
      	</div>  
      <?php endif; ?>	
      	
      <?php
      endif; // table footer row ?>
      <?php

			// output the main list
      foreach ( self::$products as $value ) {

        if ( self::$backend ) :
             echo "<tr>";
	      	// print delete check
	    	echo "<td>"; 
        ?>
          <a style="width:10%;" href="admin.php?page=<?php echo Products_Db::PLUGIN_NAME ?>-edit_product&action=edit&id=<?php echo $value['id']?>"><?php _e( 'Edit', Products_Db::PLUGIN_NAME )?></a> |
          <input type="checkbox" name="pid[]" value="<?php echo $value['id']?>" onClick="addSelects( this.checked )">
        <?php echo "</td>"; ?>
        <?php endif; // delete check
        foreach ( self::$display_columns as $column ) {
					// get the form element value for the field
          $column_atts = Products_Db::get_field_atts( $column, '`form_element`,`default`' );

					// this is where we place form-element-specific text transformations for display
          switch ( $column_atts->form_element ) {

           case 'image-upload':

   //            $display_value.= self::$backend ? basename( $value[ $column ] ) : ( empty( $value[ $column ] ) ? '' : '<div class="item-tile" style="background-image: url(&#039;'.Products_Db::get_image_uri( $value[ $column ] ).'&#039;); 
   //          background-size: cover;
   //          -webkit-background-size: cover;
			// -moz-background-size: cover;
			// -o-background-size: cover;
			// background-size: cover;
			// background-position: center center;
			// background-repeat: no-repeat;"></div>' );
					 
			// if (isset( self::$options['single_record_link_field'] ) && $column == self::$options['single_record_link_field'] && ! empty( self::$options['single_record_page'] ) ) {
								
			// 	$page_link = get_page_link( self::$options['single_record_page'] );

   //              $display_value = Products_Db::make_link( $page_link, $display_value, '<a href="%1$s">%2$s</a>', array( 'pdb'=>$value['id'] ) );
								
			// }
				
				$display_value = "<div class='gallery-item'>";
				$display_value.="<a href='".get_bloginfo('wpurl')."/product/product/?pdb=".$value['id']."' class='no-lightbox' >";
				if(!empty($value[ $column ])){
					$rezided_image = image_resize( $_SERVER["DOCUMENT_ROOT"]."/wp-content/uploads/products-database/".basename($value[ $column ]) , 300, 300, true);
					
					## checking if the image actually exists	
					if(!($rezided_image instanceOf WP_ERROR))
				    	$display_value.="<img width='300' height='300' src='".Products_Db::get_image_uri( basename($rezided_image) )."' class='attachment-medium' >";
				    else
				    	$display_value.="<img src='http://placehold.it/300x300 />";
				} else {

					##searching for other images to use
					$product = Products_Db::get_product($value['id']);
					$image_to_display="<img src='http://placehold.it/300x300 />";
					for($i=2;$i<=5;$i++){
						
						if(!empty($product["image_".$i])){
							$rezided_image = image_resize( $_SERVER["DOCUMENT_ROOT"]."/wp-content/uploads/products-database/".basename($product["image_".$i]) , 300, 300, true);
							## checking if the image actually exists	
							if(!($rezided_image instanceOf WP_ERROR)){
						    	$image_to_display="<img width='300' height='300' src='".Products_Db::get_image_uri( basename($rezided_image) )."' class='attachment-medium' >";
								break;
							}
						}

					}
					$display_value.=$image_to_display;
				}
				$display_value.="</a>";
				$display_value.="</div>";			
			
              break;
							
					 case 'date':
							
							if ( ! empty( $value[ $column ] ) ) {
							
								$time = preg_match( '#^[0-9-]+$#', $value[ $column ] ) > 0 ? (int) $value[ $column ] : strtotime( $value[ $column ] );
								$display_value = date( get_option('date_format','r'), $time );
								
							} else $display_value = '';
							
							break;
							
					 case 'multi-select-other':
					 case 'multi-checkbox':
					 // multi selects are displayed as comma separated lists
					 
					 		$display_value = is_serialized( $value[ $column ] ) ? implode( ', ', unserialize( $value[ $column ] ) ) : $value[ $column ];
							break;
					 
					 case 'link':
					 
              if ( is_serialized( $value[ $column ] ) ) {

                $params = unserialize( $value[ $column ] );
								
								if ( count( $params ) < 2 ) $params[1] = $params[0];

              } else {

                // in case we got old unserialized data in there
                $params = array_fill( 0, 2, $value[ $column ] );

              }

              $display_value = Products_Db::make_link( $params[0], $params[1] );

              break;

           case 'textarea':

              if ( ! empty( $value[ $column ] ) ) $display_value = '<span class="textarea">' . $value[ $column ] . '</span>';
							else $display_value = '';
              break;

           case 'text-line':

              if (
                    isset( self::$options['single_record_link_field'] )
										&&
										$column == self::$options['single_record_link_field']
                    &&
                    ! empty( self::$options['single_record_page'] )
                  ) {
								
								$page_link = get_page_link( self::$options['single_record_page'] );

                $display_value = Products_Db::make_link( $page_link, $value[ $column ], '<a href="%1$s" >%2$s</a>', array( 'pdb'=>$value['id'] ) );
					 
              } elseif ( self::$options['make_links'] ) {
								
								$display_value = Products_Db::make_link( $value[ $column ] );
								
							} else {

               $display_value = NULL === $value[ $column ] ? $column_atts->default : esc_html($value[ $column ]);
							 
							}

							break;

           default:
					 
					 		$display_value = NULL === $value[ $column ] ? $column_atts->default : esc_html($value[ $column ]);

          }
          if(!empty($display_value)){
	          if ( $column == 'private_id' ){ 
	          	printf( 
					$PID_pattern, 
					$display_value, 
					Products_Db::get_record_link( $display_value ) 
					);
	          }
	          else {
	           printf( $col_pattern, $display_value );
	       }
	      		
      		}
        } ?>
     
    <?php  
      } 
      if ( self::$backend )
      	echo "</tr>";
      ?>
    

    <?php else : // if there are no records to show; do this
    	?>
      	<?php _e('No records found', Products_Db::PLUGIN_NAME )?></td>
      <?php
     endif; // products array
     ?>
     
		 <?php
		 if ( self::$backend ) : 
		 	echo "</table>";
		 ?></form><?php endif;
    }
		
		/**
		 * prints the CSV export form
		 */
		private function _print_export_form() { ?>
    
      <fieldset class="widefat">
      	<h3><?php _e('Export CSV', Products_Db::PLUGIN_NAME )?></h3>
        <form method="post">
          <input type="hidden" name="source" value="<?php echo Products_Db::PLUGIN_NAME ?>">
          <input type="hidden" name="action" value="output CSV" />
          <input type="hidden" name="CSV type" value="product list" />
          <input type="hidden" name="query" value="<?php echo rawurlencode( self::$list_query )?>" />
          <?php
          $date_string = str_replace( array( '/','#','.','\\'),'-',date( get_option( 'date_format' ) ) );
          $suggested_filename = Products_Db::PLUGIN_NAME.'-'.$date_string.'.csv';
          $namelength = round( strlen( $suggested_filename ) * 0.9 ) ;
          ?>
          <p>
					  <?php _e( 'File Name', Products_Db::PLUGIN_NAME  )?>:
            <input type="text" name="filename" value="<?php echo $suggested_filename?>" size="<?php echo $namelength ?>" />
            <input type="submit" name="submit" value="<?php _e( 'Download CSV for this list', Products_Db::PLUGIN_NAME  )?>" />
          </p>
          <p>
						<?php _e( 'This will download the whole list of products that match your search terms, and in the order specified by the sort. The export will include records on all list pages. The fields included in the export are defined in the "CSV" column on the Manage Database Fields page.', Products_Db::PLUGIN_NAME  )?>
          </p>
        </form>
      </fieldset>
  
  	<?php 
		}

    /**
     * prints a table header row
     */
    private function _print_header_row( $head_pattern ) {

      // print the "select all" header
      if ( self::$backend ) : ?>
      <th scope="col" style="width:6em">
        <?php /* translators: uses the check symbol in a phrase that means "check all" */ _e( '&#10004; all', Products_Db::PLUGIN_NAME )?>
        <input type="checkbox" onClick="checkedAll('list_form');" name="checkall" id="checkall" style="top: 2px; margin-left: 4px;">
      </th>
      <?php endif;// "select all" header

      // print the top header row
      foreach ( self::$display_columns as $column ) {
      printf (
              $head_pattern,
              htmlspecialchars( stripslashes( Products_Db::column_title( $column ) ),ENT_QUOTES,"UTF-8",false ),
							$column
              );
      }

    }

    /**
     * builds the sort-filter mode setting
     */
    private function _sort_filter_mode() {

      if ( self::$backend ) return 'both';

      $mode = self::$shortcode_params['sort'] == 'true' ? 'sort' : 'none';

      return self::$shortcode_params['search'] == 'true' ? ( $mode == 'sort' ? 'both' : 'filter' ) : $mode ;

    }		
		
		/**
		 * takes the $_POST array and constructs a filter statement to add to the list shortcode filter
		 */
		private function _make_filter_statement( $post ) {
			 
			 if ( ! Products_Db::is_column( $post['where_clause'] ) ) return '';
			 
			 self::$filter['where_clause'] = $post['where_clause'];
			 
			 
			 switch ( $post['operator'] ) {
				 
				 case 'LIKE':
				 
					$operator = '~';
					break;
					
				case 'NOT LIKE':
				case '!=':
				
					$operator = '!';
					break;
				
				case 'gt':
				
					$operator = '>';
					break;
					
				case 'lt':
				
					$operator = '<';
					break;
					
				default:
				
					$operator = '=';
					
			 }
			 
			self::$filter['operator'] = $operator;
			 
			if ( empty( $post['value'] ) ) return '';
			
			self::$filter['value'] = $post['value'];
			
			return self::$filter['where_clause'].self::$filter['operator'].self::$filter['value'];
			
		}
		
		
		/**
		 * sets up the internationalization strings
		 */
		private function _setup_i18n() {
		
			/* translators: the following 5 strings are used in logic matching, please test after translating in case special characters cause problems */
			self::$i18n = array(
				'delete_checked' => _x( 'Delete Checked', 'submit button label', Products_Db::PLUGIN_NAME ),
				'change' => _x( 'Change', 'submit button label', Products_Db::PLUGIN_NAME ),
				'sort' => _x( 'Sort', 'submit button label', Products_Db::PLUGIN_NAME ),
				'filter' => _x( 'Filter', 'submit button label', Products_Db::PLUGIN_NAME ),
				'clear' => _x( 'Clear', 'submit button label', Products_Db::PLUGIN_NAME ),
        'search' => _x( 'Search', 'search button label', Products_Db::PLUGIN_NAME ),
			);
		
		}
	
}// class ?>