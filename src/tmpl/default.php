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

defined('_JEXEC') or die; ?>

<!-- Get the module class suffix-->
<div class="<?php echo $params->get("moduleclass_sfx");?>">

	<!-- Get the text to be displayed before the module-->
	<div> <?php echo $params->get("pretext");?> </div>

<!-- List the installed extensions -->	
<?php
	if (count($list)) 
		{
		if ($params->get("listtype") == "0" )
            /* Show all extensions */
			{
			$showlisttype="<b>".JText::_('MOD_IPHEIONGRAPHS_ALL_EXTENTIONS')."</b></br>";

            $showtabledata="";
			foreach ($list as $i => $item) :
				{
                /* manifest_cache is json decoded */ 
				$decode = json_decode($item->manifest_cache);
					
				$showtabledata = $showtabledata
				    ."<tr>"
					    ."<td><b>".$item->name."</b></td>"
						."<td>".$item->type."</td>"
						."<td>".$decode->version."</td>"
						."<td>".$decode->creationDate."</td>"
						."<td>".$decode->authorUrl."</td>"
					."</tr>";	
				}		
			endforeach;
			}
		elseif ($params->get("listtype") == "1" )
			/* show only the non-joomla.org extensions */ 
			{
			$showlisttype="<b>".JText::_('MOD_IPHEIONGRAPHS_NON_JOOMLA_EXTENTIONS')."</b></br>";

            $showtabledata="";
			foreach ($list as $i => $item) :
			    {
                /* manifest_cache is json decoded */ 
				$decode = json_decode($item->manifest_cache);
                
                if ( $decode->authorUrl != "www.joomla.org" ) 				
				   {		
    				$showtabledata = $showtabledata
	    			    ."<tr>"
		    			    ."<td><b>".$item->name."</b></td>"
			    			."<td>".$item->type."</td>"
				    		."<td>".$decode->version."</td>"
					    	."<td>".$decode->creationDate."</td>"
						    ."<td>".$decode->authorUrl."</td>"
					    ."</tr>";	
				   }						
				}		
			endforeach;
		    }	
		/* list the table */
        $showtablestart="<table>"
        	                ."<tr>"
						    ."<th>Extension Name</th>"
						    ."<th>Type</th>"
						    ."<th>Version</th>"
						    ."<th>Creation Date</th>"
						    ."<th>URL</th>"
						."</tr>";
		$showtableend="</table></br>";
		echo $showlisttype.$showtablestart.$showtabledata.$showtableend;
        }
	else /* no extensions found */
		{
		echo JText::_('MOD_IPHEIONGRAPHS_NO_EXTENSIONS');
		}	
?>
	<!-- Get the text to be displayed after the module-->	
	<div><?php echo $params->get("posttext");?></div>
</div>
