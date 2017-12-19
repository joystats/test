<?
$target_file = $_POST['directory_name'].'/'. basename($_FILES["userPhoto"]["name"]);
$data=array();
switch($_POST['proc']){
	case 'upload':
		$data['success']=0;
		if(isset($_FILES["userPhoto"]["tmp_name"])) {
			if (move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $target_file)) {
				$data['success']=1;
			}
		}
		echo json_encode($data);
	break;
	case 'list':
		define('IMAGEPATH',$_POST['directory_name']);
		foreach(glob(IMAGEPATH.'/*.{jpg,JPG,jpeg,JPEG,png,PNG}',GLOB_BRACE) as $file){
			$image['name'] =  basename($file);
			array_push($data,$image);
		}
		echo json_encode($data);
	break;
}
?>