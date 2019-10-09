<script>
	$(document).ready(() => {
		
		  $(".fa").click(function () {
                liveModal = '#' + $(this).attr('data');
				openForm();
				//console.log("doe het button click");
            });

            $('#close').click(function () {
				closeForm();
				//console.log("doe het button close");
            });

            $(document).on('keydown', function (e) {
                if (e.keyCode == 27) {
                    closeForm();
                }
			});
	});
	
	async function openForm() {
			$('#form').fadeIn(300);
		}
	async function closeForm() {
			$('#form').fadeOut(300);
	}
</script>
<?php

/**
 * @package Joomla.Site
 * @subpackage mod_firstmodule
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;



if($params->get('visible_article')){
	$helper = new ModFrontendArticleEditorHelper();
	$doc = JFactory::getDocument();

	if(isset($_POST["title"]) && $_POST["text"]) {
		$values = [$_POST['title'], $_POST['text']];
		$helper->update(1, $values);
	}


	$doc->addScript('https://code.jquery.com/jquery-3.3.1.min.js');
	$plgURL = JURI::base() . 'modules/mod_tester';
	$doc->addStyleSheet($plgURL . '/css/main.css');

	$css = "
	.art_txt {
		font-size: " . $params->get('font') . "px;
		align-text: " . $params->get('postion') . ";
	}";
	$doc->addStyleDeclaration($css);

	$isManager = checkManager();

?>

<div>
	<div class="article">
		<?php
			$tag = $params->get('art_tag');
			$data = $helper->select();
			if( $params->get('visible_title')) {
				echo "<". $tag ." id='art_title ". $params->get('art_id') ."' class='art_txt". $params->get('art_id') ."'>" . $data->title . "</". $tag .">";
            }
            echo "<div class=\"message\" style=\"position: relative\">";
            echo "<". $tag ." id='art_text ". $params->get('art_id') ."' class='art_txt". $params->get('art_id') ."'>" . $data->text . "</". $tag .">";
            if ($isManager) {
                echo '<i class="fa fa-pencil" style="position:absolute; top:0px; right:1.5em; font-size:25px;" onclick="openForm()"></i>';
            }
			echo "</div>";
		?>

	</div>
	<?php

	if ($isManager) {
		?>
		<div class="article_editor_wrapper">
			<form class="" action="" method="post" id="form">
                <div class="tools">
                    <h5> Bewerk de tekst </h5> 
                    <div class="close" onclick="closeForm()"></div>
                </div>
                <div class="form">
                    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                    <input type="text" name="title" placeholder="Titel" value="<?php echo $data->title; ?>">
                    <textarea type="text" name="text" placeholder="Text"  id="article" rows="2"><?php echo $data->text; ?></textarea>
                    <button type="submit" name="button" id="button">Aanpassen</button>
                </div>
			</form>
		</div>
	<?php } ?>
</div>

<?php 
}

function checkManager()
{
	$user   = JFactory::getUser();
	$groups = $user->groups;

	if (in_array(6, $groups)) {
		return true;
	} elseif ($user->get('`1`')) {
		return true;
	} else {        
		return false;
    }
}

?>
