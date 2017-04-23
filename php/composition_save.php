<?php
include_once("root.php");

$compos_book_id = mysql_escape_string($_POST['compos_book_id']);
$composition = mysql_escape_string($_POST['composition']);
$composition_name = mysql_escape_string($_POST['composition_name']);
$member_id = mysql_escape_string($_POST['member_id']);
$line_new = mysql_escape_string($_POST['line_new']);
$index_new = mysql_escape_string($_POST['index_new']);
$index_edit = mysql_escape_string($_POST['index_edit']);
$parent_arr_new = $_POST['parent_arr_new'];
$node = $_POST['node'];
$node_edit = $_POST['node_edit'];
$this_id = $_POST['this_id'];
$point1_id = $_POST['point1_id'];
$point2_id = $_POST['point2_id'];
$arr_line_new=0;
$arr_index_new=0;
$arr_index_edit=0;



switch($composition){
	case "list":
		if(!$compos_book_id){
			$query="insert into compos_book( member_id, compos_book_name, composition_type ) values('$member_id','$composition_name','$composition')";
			$result = $mysqli->query($query);
			$compos_book_id=$mysqli->insert_id;
			echo $compos_book_id;
		}
		while($index_new>0){
		$query="insert into compos_list(member_id,media_anchor_id,media_image_id,compos_book_id) values('$member_id','".$node[$arr_index_new][0]."','".$node[$arr_index_new][1]."','$compos_book_id')";
		$result = $mysqli->query($query);

		$arr_index_new++;
		$index_new--;
		//echo $compos_book_id;
		}
		
		while($index_edit>0){
		$query="UPDATE compos_list SET media_anchor_id='".$node_edit[$arr_index_edit][1]."',media_image_id='".$node_edit[$arr_index_edit][2]."' WHERE compos_list_id=".$node_edit[$arr_index_edit][0]."";
		$result = $mysqli->query($query);
		//echo"$query";
		
		$arr_index_edit++;
		$index_edit--;
		//echo $compos_book_id;
		
		
		}
		
		
	break;
	case "sequence":
		if(!$compos_book_id){
			$query="insert into compos_book( member_id, compos_book_name, composition_type ) values('$member_id','$composition_name','$composition')";
			$result = $mysqli->query($query);
			$compos_book_id=$mysqli->insert_id;
			echo $compos_book_id;
		}
		while($index_new>0){
		$query="insert into compos_sequence(member_id,media_anchor_id,media_image_id,compos_book_id) values('$member_id','".$node[$arr_index_new][0]."','".$node[$arr_index_new][1]."','$compos_book_id')";
		$result = $mysqli->query($query);
		$arr_index_new++;
		$index_new--;
		//echo $compos_book_id;
		}
		
		while($index_edit>0){
		$query="UPDATE compos_sequence SET media_anchor_id='".$node_edit[$arr_index_edit][1]."',media_image_id='".$node_edit[$arr_index_edit][2]."' WHERE compos_sequence_id=".$node_edit[$arr_index_edit][0]."";
		$result = $mysqli->query($query);
		$arr_index_edit++;
		$index_edit--;
		//echo $compos_book_id;
		
		}
		
	break;
	case "hie":
		if(!$compos_book_id){
			$query="insert into compos_book( member_id, compos_book_name, composition_type ) values('$member_id','$composition_name','$composition')";
			$result = $mysqli->query($query);
			$compos_book_id=$mysqli->insert_id;
			echo $compos_book_id;
		}
		while($index_new>0){
		$query="insert into compos_hie(member_id,media_anchor_id,media_image_id,parent_id,compos_book_id) values('$member_id','".$node[$arr_index_new][0]."','".$node[$arr_index_new][1]."','".$parent_arr_new[$arr_index_new]."','$compos_book_id')";
		$result = $mysqli->query($query);
		$parent_id=$mysqli->insert_id;
		foreach($parent_arr_new as $key => $value){
			if($value == $this_id[$arr_index_new]){
				$parent_arr_new[$key]=$parent_id;
			}
		}
		$arr_index_new++;
		$index_new--;
		//echo $compos_book_id;
		}
		
		while($index_edit>0){
	
		$query="UPDATE compos_hie SET media_anchor_id='".$node_edit[$arr_index_edit][1]."',media_image_id='".$node_edit[$arr_index_edit][2]."' WHERE compos_hie_id=".$node_edit[$arr_index_edit][0]."";
		$result = $mysqli->query($query);
		$arr_index_edit++;
		$index_edit--;
		//echo $compos_book_id;
		
		}
	break;
	case "mesh":
		if(!$compos_book_id){
			$query="insert into compos_book( member_id, compos_book_name, composition_type ) values('$member_id','$composition_name','$composition')";
			$result = $mysqli->query($query);
			$compos_book_id=$mysqli->insert_id;
			echo $compos_book_id;
		}
		while($index_new>0){
		$query="insert into compos_mesh(member_id,media_anchor_id,media_image_id,x,y,compos_book_id) values('$member_id','".$node[$arr_index_new][0]."','".$node[$arr_index_new][1]."','".$node[$arr_index_new][2]."','".$node[$arr_index_new][3]."','$compos_book_id')";
		//$query="insert into compos_mesh(member_id,media_anchor_id,media_image_id,compos_book_id) values('$member_id','$descript_arr_new[$arr_index_new]','$image_arr_new[$arr_index_new]','$compos_book_id')";
		$result = $mysqli->query($query);
		$compos_mesh_id=$mysqli->insert_id;
		foreach($point1_id as $key => $value){
			if($value == $this_id[$arr_index_new]){
				$point1_id[$key]=$compos_mesh_id;
			}
		}
		foreach($point2_id as $key => $value){
			if($value == $this_id[$arr_index_new]){
				$point2_id[$key]=$compos_mesh_id;
			}
		}
		$arr_index_new++;
		$index_new--;
		//echo $compos_book_id;
		}
		
		while($index_edit>0){
	
		$query="UPDATE compos_mesh SET media_anchor_id='".$node_edit[$arr_index_edit][1]."',media_image_id='".$node_edit[$arr_index_edit][2]."',x='".$node_edit[$arr_index_edit][3]."',y='".$node_edit[$arr_index_edit][4]."' WHERE compos_mesh_id=".$node_edit[$arr_index_edit][0];
		
		$result = $mysqli->query($query);
		$arr_index_edit++;
		$index_edit--;
		//echo $compos_book_id;
		
		}

		while($line_new>0){
		$query="insert into compos_meshline(point1,point2,compos_book_id) values('$point1_id[$arr_line_new]','$point2_id[$arr_line_new]','$compos_book_id')";
		$result = $mysqli->query($query);
		$arr_line_new++;
		$line_new--;
		}
	break;



}
		
?>