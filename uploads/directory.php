<?
switch($_GET['proc']){
	case 'list':
		$dirs = array_filter(glob('*'), 'is_dir');
		echo json_encode($dirs);
	break;
	case 'create':
		mkdir($_GET['directory_name'],766);
	break;
	case 'delete':
		foreach(scandir($_GET['directory_name']) as $file) {
			if ('.' === $file || '..' === $file) continue;
			if (is_dir($_GET['directory_name']."/".$file)) rmdir_recursive($_GET['directory_name']."/".$file);
			else unlink($_GET['directory_name']."/".$file);
		}
		rmdir($_GET['directory_name']);
	break;
}

?>