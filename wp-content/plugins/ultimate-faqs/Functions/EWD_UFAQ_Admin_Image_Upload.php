<?php	
function Prepare_Thumbs_Up_Image() {
	/* Double check that everything worked correctly in moving the file, return blank to erase the custom image or return the link */
	if (isset($_POST['Thumbs_Up_Image']) and ($_POST['Thumbs_Up_Image'] == "http://" or $_POST['Thumbs_Up_Image'] == "")) {
		return;
	}
	else {
		return isset($_POST['Thumbs_Up_Image']) ? $_POST['Thumbs_Up_Image'] : '';
	}
}
function Prepare_Thumbs_Down_Image() {
	/* Double check that everything worked correctly in moving the file, return blank to erase the custom image or return the link */
	if (isset($_POST['Thumbs_Down_Image']) and ($_POST['Thumbs_Down_Image'] == "http://" or $_POST['Thumbs_Down_Image'] == "")) {
		return;
	}
	else {
		return isset($_POST['Thumbs_Down_Image']) ? $_POST['Thumbs_Down_Image'] : '';
	}
}

