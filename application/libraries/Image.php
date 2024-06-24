<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// ini_set("upload_max_filesize","100000M");
class Image
{

	public $default_width;
	public $default_icon = 90;
	public $default_icon_md = 360;

	public $array_path = array();

	public function __construct()
	{
		$this->default_width = 1280;

		$this->array_size[] = "";
		$this->array_size[] = $this->default_icon;
		$this->array_size[] = $this->default_icon_md;
	}

	//
	//	upload image
	// @param pathinfo		@text = path true for upload image
	// @param file			@text = file image name
	// @param optional		@array = [width = image width]
	//
	function uploadimage($path, $fileimage, $optional = [])
	{
		//=	 call database	=//
		$ci = &get_instance();
		$ci->load->database();
		//===================//

		$result['status'] = 0;
		$result['error'] = 0;

		if ($fileimage) {


			$file = $fileimage['tmp_name'];
			$file_name = $fileimage['name'];
			$source_properties = getimagesize($file);
			// $file_newname = time();
			$folderPath = $path;

			$explode_file = explode('/', $folderPath);
			// $image_name = end($explode_file);

			$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$image_type = $source_properties[2];

			$file_width = $source_properties[0];
			$file_height = $source_properties[1];

			if ($optional && $optional['width']) {
				$file_width = $optional['width'];
				$file_height = round($file_width * $source_properties[1] / $source_properties[0]);
			}

			// print_r($source_properties);
			switch ($image_type) {
				case IMAGETYPE_PNG:
				case 'image/png':
					$image_resource_id = imagecreatefrompng($file);
					$target_layer = $this->imageResize($image_resource_id, $file_width, $file_height);
					imagepng($target_layer, $folderPath);
					break;
				case IMAGETYPE_GIF:
				case 'image/gif':
					$image_resource_id = imagecreatefromgif($file);
					$target_layer = $this->imageResize($image_resource_id, $file_width, $file_height);
					imagegif($target_layer, $folderPath);
					break;
				case IMAGETYPE_JPEG:
				case 'image/jpeg':
				case 'image/pjpeg':
					$image_resource_id = imagecreatefromjpeg($file);
					$target_layer = $this->imageResize($image_resource_id, $file_width, $file_height);
					imagejpeg($target_layer, $folderPath);
					break;
				default:
					echo "Invalid Image type";
					exit;
					break;
			}
			// move_uploaded_file($file, $folderPath . $file_newname . "_origin." . $ext);

		}
	}

	function imageResize($imageResource, $width, $height)
	{
		$targetWidth = $width < $this->default_width ? $width : $this->default_width;
		$targetHeight = ($height / $width) * $targetWidth;
		// $target_layer = imagecreatetruecolor($targetWidth, $targetHeight);
		// imagecopyresampled($target_layer, $imageResource, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
		$imgResized  = imagescale($imageResource, $targetWidth, $targetHeight);


		// $result = $target_layer;
		$result = $imgResized;
		return $result;
	}

	// show details
	function size_as_kb($size = 0)
	{
		$megabyte = 1048576;
		if ($size < $megabyte) {
			$size_kb = round($size / 1024, 2);
			return "{$size_kb} KB";
		} else {
			$size_mb = round($size / $megabyte, 2);
			return "{$size_mb} MB";
		}
	}

	// size image
	function imgSize($img)
	{
		$targetWidth = $img[0] < $this->default_width ? $img[0] : $this->default_width;
		$targetHeight = ($img[1] / $img[0]) * $targetWidth;
		return [round($targetWidth, 2), round($targetHeight, 2)];
	}

	/**
	 * upload image
	 *
	 * @param array|null $file
	 * @param array|null $path
	 * @param integer $type = 1=1size, 2=2size
	 * @return void
	 */
	function upload_image(array $file = null, array $path = null, int $type = null)
	{
		# code...
		//=	 call database	=//
		$ci = &get_instance();
		$ci->load->database();
		//===================//

		if ($file) {

			$allowedFileType = array('jpg', 'png', 'jpeg', 'JPG', 'gif', 'GIF');
			// $uploadsDir = $path;

			$img_array = [];

			foreach ($file['name'] as $key => $val) {
				$array_width = [];
				//	check file for upload
				if ($file['name'][$key]) {
					// create array FILE
					$imagefile = array(
						'type'        => $file['type'][$key],
						'name'        => $file['name'][$key],
						'tmp_name'    => $file['tmp_name'][$key],
						'error'        => $file['error'][$key],
						'size'        => $file['size'][$key]
					);

					//
					// prevent duplicate key
					if($ci->session->userdata('user_code')){
						$auth = $ci->session->userdata('user_code');
					}else{
						$auth = mt_rand(1,100);
					}

					$new_image_name = time() . '-' . $key . '-' . $auth . '.' . explode("/", $file['type'][$key])[1];

					$img_array[] = $new_image_name;

					if ($path) {
						foreach ($path as $dir_path) {

							if (!file_exists($dir_path)) {
								mkdir($dir_path, 0777, true);
							}

							$targetPath = $dir_path . $new_image_name;
							$fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
							if (in_array($fileType, $allowedFileType)) {

								if ($type) {
									switch ($type) {
										case 1:
											$array_width[] = $this->default_icon;
											break;
										case 2:
											$array_width[] = $this->default_icon_md;
											break;
										case 3:
											$array_width[] = ""; // null = width original image
											break;
										case 12:
										case 21:
											$array_width[] = $this->default_icon;
											$array_width[] = $this->default_icon_md;
											break;
										case 13:
										case 31:
											$array_width[] = $this->default_icon;
											$array_width[] = "";
											break;

										case 23:
										case 32:
											$array_width[] = $this->default_icon_md;
											$array_width[] = "";
											break;
									}
								} else {
									$array_width = $this->array_size;
								}


								foreach ($array_width as $key => $width) {

									if ($width != $this->default_width) {

										$path_folder = $dir_path . "/" . $width . "/";

										if (!file_exists($path_folder)) {
											mkdir($path_folder, 0777, true);
										}

										$uploadPath = $path_folder . $new_image_name;
									} else {
										$uploadPath = $targetPath;
									}
									$optional = [
										'width' => $width,
									];
									$check_upload = $this->uploadimage($uploadPath, $imagefile, $optional);
								}
							} else {
								$text_formatfile = implode(',', $allowedFileType);
								$result = array(
									'error'     => 1,
									'txt'       => 'รองรับเฉพาะ ' . $text_formatfile
								);

								return $result;
								exit;
							}
							// sleep(1);
						}
					}
				}
				$result = array(
					'error' => 0,
					'txt'   => 'อัพโหลดรูปสำเร็จ',
					'data'  => $img_array,
				);
			}
		}

		return $result;
	}

	function delete_image(string $name = "",string $path = "")
	{
		if($name && $path){
			foreach ($this->array_size as $key => $width) {
				if($width){
					$path_image = $path."/".$width."/".$name;
				}else{
					$path_image = $path."/".$name;
				}

				if (file_exists($path_image)) {
					unlink($path_image);
				}
			}
		}
	}

}
