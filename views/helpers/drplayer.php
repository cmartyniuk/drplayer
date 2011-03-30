<?php  


class DrplayerHelper extends AppHelper { 

  var $helpers = array('Html');  

	static $idCounter = 0;
	
  function audio_playlist($paths = array(), $options = array()) {
    
    $defaults = array(
    	'artist' => false,
    	'style' => 'width:400px;',
    );
    
    $options = array_merge($defaults, $options);
    
		$this->Html->script('/drplayer/js/drplayer/drplayer.js', array('inline' => false));
		$this->Html->css('/drplayer/js/drplayer/drplayer.css', null, array('inline' => false));
 
 		$this->Html->scriptStart(array('inline' => false)); 

		$id = 'playlist' . (int)$this->idCounter++;
		
 		?>
 		
        $(document).ready(function() {
            $("#<?= $id ?>").playlist(
                {
                    playerurl: "<?= $this->Html->url('/drplayer/js/drplayer/swf/drplayer.swf') ?>"
                }
            );
        });
        
    <?php

 		$this->Html->scriptEnd();     

    $View =& ClassRegistry::getObject('view'); 

		App::import('Vendor', 'Drplayer.getID3', array('file' => 'getid3/getid3/getid3.php'));
		
		$getID3 = new getID3();
		
		$playlist_content = '';
		
    foreach ($paths as $path) {
    
	    $fileInfo = $getID3->analyze(Configure::read('App.www_root') . $path); 
	    
     	$playlist_content .= $View->element('drplayer/audio_item', array(
	  		'path' => $this->Html->url($path),
	  		'title' => basename($path), 
	  		'artist' => $options['artist'],
	  		'duration' => $fileInfo['playtime_string'],
	  		'style' => $options['style'],
	  		'plugin' => 'drplayer',
			));
		
    }
  
		echo $View->element('drplayer/audio_playlist', array(
  		'id' => $id,
  		'playlist_content' => $playlist_content,
		));  
  
  }
   
   
}