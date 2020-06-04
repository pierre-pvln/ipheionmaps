<?php 
/**
 * @package     mod_ipheiongraphs
 * @author      Pierre Veelen, www.pvln.nl
 * @copyright   Copyright (C) 2020 Pierre Veelen. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 *
 * default.php  Used to output the data to html page. Therefore a lot of html code is included.  
 *
 */

defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addScript('https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js');
$document->addStyleSheet('https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css');
?>

<!-- Get the module class suffix-->
<div class="<?php echo $params->get("moduleclass_sfx");?>">

	<!-- Get the text to be displayed before the module-->
	<div> <?php echo $params->get("pretext");?> </div>

	<!-- <div id='map-polygon' style='width: 100%; height: 600px;'></div> -->
	<div id=<?php echo "'".$module->title."'" ?> style='width: 100%; height: 600px;'></div>

	    <script>
		mapboxgl.accessToken = <?php echo '"'.$params->get("mapbox_accesstoken").'"' ?>;

		<!-- generate javascript to create map -->`

		<!-- define var that holds map info -->
		<!-- replace space and minus in module title with underscore) -->
		var <?php echo str_replace("-", "_", str_replace(" ", "_", $module->title)) ?>;
		<?php echo str_replace("-", "_", str_replace(" ", "_", $module->title)) ?> = new mapboxgl.Map({

		<!-- set container name same as div -->
		container: <?php echo "'".$module->title."'" ?>,

		style: "mapbox://styles/mapbox/streets-v11",
		center: [<?php echo $params->get("window_longitude") ?>, <?php echo $params->get("window_latitude") ?>],

		<!-- set zoom level based on module settings -->
		zoom: <?php echo $params->get("window_zoom") ?>,
		}),

        <!-- now generate map -->
		<?php echo str_replace("-", "_", str_replace(" ", "_", $module->title)) ?>.on("load", function () {
			<?php echo str_replace("-", "_", str_replace(" ", "_", $module->title)) ?>.addSource(<?php echo "'".str_replace("-", "_", str_replace(" ", "_", $module->title))."_polygon'" ?>, {
				type: 'geojson',
				data: <?php echo "'".$params->get("polygon_data_url")."'" ?>
			});
			<?php echo str_replace("-", "_", str_replace(" ", "_", $module->title)) ?>.addLayer({
				'id': <?php echo "'".str_replace("-", "_", str_replace(" ", "_", $module->title))."_polygon'" ?>,
				'type': 'fill',
				'source': <?php echo "'".str_replace("-", "_", str_replace(" ", "_", $module->title))."_polygon'" ?>,
				'layout': {},
				'paint': {'fill-color': '#088',  'fill-opacity': 0.8}
				});
		})
		</script>
		
	<!-- Get the text to be displayed after the module-->	
	<div><?php echo $params->get("posttext");?></div>

</div>
