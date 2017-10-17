<?php 

$file = "comments.json";

if(isset($_GET['action'])){
	$a = $_GET['action'];
	if($a === 'getdata'){
		$contents = file_get_contents($file);
		//$contents = utf8_encode($contents);
		echo $contents;
		die();
	}
	if($a === 'addcomment'){
		if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['comment'])){
			$id = htmlspecialchars($_POST['id']);
			$name = htmlspecialchars($_POST['name']);
			$comment = htmlspecialchars($_POST['comment']);
			$commentid = time();
			$hidden = false;
			
			if($comment === ''){
				echo '{"status":"error","message":"Bitte einen Kommentar eingeben."}';
				die();
			}
			if($name === ''){
				echo '{"status":"error","message":"Bitte einen Namen eingeben."}';
				die();
			}
			
			$contents = file_get_contents($file);
			$data = json_decode($contents, true); 
			if(!array_key_exists($id, $data)){
				$data[$id] = Array();
			}
			$data[$id][$commentid] = Array();
			$data[$id][$commentid]['name'] = $name;
			$data[$id][$commentid]['comment'] = $comment;
			$data[$id][$commentid]['hidden'] = $hidden;
			
			file_put_contents($file, json_encode($data));
			
			echo '{"status":"ok","message":"Der Kommentar wurde gespeichert."}';
			die();
		}
		echo '{"status":"error","message":"Allgemeiner Anfragefehler."}';
		die();
	}
	if($a === 'removecomment'){
		if(!isset($_GET['id'])){
			echo '{"status":"error","message":"Allgemeiner Anfragefehler."}';
			die();
		}
		if(!isset($_GET['commentid'])){
			echo '{"status":"error","message":"Allgemeiner Anfragefehler."}';
			die();
		}
		$id = $_GET['id'];
		$commentid = intval($_GET['commentid']);
		
		$contents = file_get_contents($file);
		$data = json_decode($contents, true); 
		
		if(!array_key_exists($id, $data)){
			echo '{"status":"error","message":"Allgemeiner Anfragefehler.'.$id.'"}';
			die();
		}
		
		if(!array_key_exists($commentid, $data[$id])){
			echo '{"status":"error","message":"Allgemeiner Anfragefehler."}';
			die();
		}
		
		$data[$id][$commentid]['hidden'] = true;
		
		
		file_put_contents($file, json_encode($data));
			
		echo '{"status":"ok","message":"Der Kommentar wurde entfernt."}';
		die();
		
	}
}
echo '{"status":"error","message":"Allgemeiner Fehler (YOLO)"}';
die();

?>