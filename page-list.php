<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
// echo 'dsadas';exit;
get_header();
global $current_user;
// echo '<pre>';
// print_r($wpdb);
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM wp_pp_culture_data', OBJECT );

//pagination

$results_per_page = 10;
$current = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
// echo $current;


$table = $wpdb->prefix."pp_culture_data";  
$rows = $wpdb->get_results("SELECT * FROM " . $table );
// print_r( $rows );exit;

if( !empty($wp_query->query_vars['s']) ):
 $args['add_args'] = array('s'=>get_query_var('s'));
endif;

$args = array(
  'base' => @add_query_arg('paged','%#%'),
  'format' => '',
  'total' => ceil(sizeof($rows)/$results_per_page),
  'current' => $current,
  'show_all' => false,
  'type' => 'plain',
  );

 
  $start = ($current - 1) * $results_per_page;
  $end = $start + $results_per_page;
  $end = (sizeof($rows) < $end) ? sizeof($rows) : $end;
  echo '<br />';
$cwd = wp_upload_dir();
// print_r($cwd);exit;
$img_path = $cwd['baseurl'];
?>
<div id="container">
<?php
 for($i=$start;$i < $end ;++$i ):
  $row = $rows[$i];
  // echo '<pre>';
  // print_r($row);
  $name = $row->name;
	$id	  = $row->id;
	$profile_pic = $row->profile_pic;
	$culture_category = $row->culture_category;
  echo "<div id=$id class='pinto popup'>$name<img src='$img_path/$profile_pic'><div class='info'><h2>$culture_category</h2></div></div>";
  
   
 endfor;

 ?>
 </div>
 
 <?php
  echo paginate_links($args);
 // pagination
// echo '<pre>';
// print_r($results);
// echo get_template_directory_uri();
// wp_register_script( 'custom-script', get_template_directory_uri() . '/js/main.js' );
// wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array ( 'jquery' ), 1.1, true);
 ?>
 <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js "></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/imagesloaded.pkgd.min.js "></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.pinto.js "></script>


<style>
	
#container {
  width: 100%;
  margin: auto;
}

#container > div {
  -webkit-box-shadow: 0 4px 15px -5px #555;
  box-shadow: 0 4px 15px -5px #555;
  background-color: #fff;
  width: 220px;
  padding: 2px;
  margin: 5px;
  border-radius: 12px;
}

#container > div img {
  padding: 0px;
  display: block;
  width: 100%;
}

.fancybox-close {
	display:none;
}
 .site-content {
	 float: left;
    width: 100%;
 }
.fancybox-wrap {
	width:  941px !important;
}
.fancybox-inner {
	width:  941px !important;
	
}
.info h2 {
	    font-size: 15px;
    font-weight: normal;
    font-family: fantasy;
}
#colophon {
	display:none;	
}
.site-content {
	width:100% !important;
}
</style>
<script>
$('#container').pinto();
$('#container').pinto({

// a class of items that will be layout
itemClass: "pinto", 

// a class of items that will be skipped and not layouted
itemSkipClass: "pinto-skip", 

// the width of one grid block in pixels
itemWidth: 220, 

// the width spacing between blocks in pixels
gapX: 10, 

// the height spacing between blocks in pixels
gapY: 10, 

// a blocks alignment ("left", "right", "center")
align: "left", 

// adjust the block width to create optimal layout based on container size
fitWidth: true, 

// up<a href="http://www.jqueryscript.net/time-clock/">date</a> layout after browser is resized
// autoResize: true, 

// time in milliseconds between browser resize and layout update
resizeDelay: 10, 

// fire after item layout complete
onItemLayout: function($item, column, position) {}, 
  
});
	//get image id

	var themepath = "<?php echo $theme_path = get_template_directory_uri().'/popup.php';?>";
	// alert(themepath);
	$('.popup').on('click', function(){
	var eng_id = $(this).attr('id');
	// alert(eng_id);
    $.fancybox({
        width: 800,
        height: 800,
        autoSize: false,
        href: themepath+'?eng_id='+eng_id,
        type: 'ajax'
    });
});



</script>

<?php// get_sidebar(); ?>
<?php //get_footer(); ?>
