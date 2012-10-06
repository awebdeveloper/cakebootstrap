<?php

/*
  File: /app/controllers/components/image.php
 */

class ImagemagickComponent extends Object {

    function initialize($controller) {
        
    }

    function beforeRender($controller) {
        
    }

    function beforeRedirect($controller) {
        
    }

    function shutdown($controller) {
        
    }

    function startup($controller) {
        
    }

    var $rootpath;
    var $maximagesize = 2000000;
    var $allowedMime = array('jpeg' => 'image/jpeg', 'jpg' => 'image/jpg', 'gif' => 'image/gif', 'png' => 'image/png', 'pjpeg' => 'image/pjpeg', 'x-png' => 'image/x-png');

    /*
     * Uploads an image and its thumbnail into $locationiny and $location/small and $location/regular respectivley. This requires imagemagick and php-imagemagick libraries

     * In the controller, add the component to your components array
     * var $components = array("Image");

     * You could easily add more locations or remove locations you don't need */

    /**
     * Function to initialize the class variables.

     */
    function __construct() {

        $this->rootpath = WWW_ROOT . 'files/';
    }

    /**
     * Function to login.
     * @param string $originalImage  Uploadaed files full path
     * @param string $location  folder location to move the uploaded the file
     * @param string $name name of the image
     * @param array/boolean $small contains array('width' = integer,'height' = integer,'bestfit' = boolean)
     * @param array/boolean $tiny contains array('width' = integer,'height' = integer,'bestfit' = boolean)
     * @param boolean $moveregular wheather to movew the uploaded file or not
     * @return boolean
     */
    function createThumb($originalImage, $folder, $name, $thumbArray, $moveRegular) {
        $result = true;
        foreach ($thumbArray as $thumbs) {
            foreach ($thumbs as $key => $thumb) {
                if (is_array($thumb)) {
                    $folder_name = $folder . '/' . $thumb['name'];
                    if ($this->makeThumb($originalImage, $folder_name, $thumb['width'], $thumb['height'], $key, $thumb['bestfit'])) {
                        //return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * Function to login.
     * @param string $originalImage  path of the original file
     * @param string $newImage  path of the new file
     * @param integer $height new image height
     * @param integer $width new image width
     * @param boolean $bestfit if true will scale to exact diamentions else to approx
     * @return boolean
     */
    function makeThumb($originalImage, $newImage, $width, $height, $key, $bestfit) {
        $width = intval($width);
        $height = intval($height);

        $im = new Imagick();

        try {
            /* Read the image file */
            $im->readImage($originalImage);

            if ($key == 'image_medium' || $key == 'image_small' || $key == 'image_big') {
                $geo = $im->getImageGeometry();
                // crop the image
                if (($geo['width'] / $width) < ($geo['height'] / $height)) {
                    $im->cropImage($geo['width'], floor($height * $geo['width'] / $width), 0, (($geo['height'] - ($height * $geo['width'] / $width)) / 2));
                } else {
                    $im->cropImage(ceil($width * $geo['height'] / $height), $geo['height'], (($geo['width'] - ($width * $geo['height'] / $height)) / 2), 0);
                }
                // thumbnail the image
                $im->ThumbnailImage($width, $height, true);
            } else {

                /* Thumbnail the image ( width 100, preserve dimensions ) */
                $im->thumbnailImage($width, $height, $bestfit);
            }


            /* Write the thumbail to disk */
            $im->writeImage($newImage);

            /* Get the size of uploaded image */
            $size = getimagesize($newImage);

            /* Get the current height and widht  difference */
        } catch (ImagickException $e) {

            return false;
        }
        return true;
        /* Free resources associated to the Imagick object */
        $im->destroy();
    }

    function createFolder($newfolder) {
        if (chdir($this->rootpath)) {
            if (!file_exists($newfolder)) {
                if (mkdir($newfolder, 0777, true)) {
                    return true;
                }
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * Function to login.
     * @param array $file $_FILE['field_name'] has to be passed
     * @return boolean
     */
    function validate($file) {
        if ($file["error"] > 0) {
            if ($file["error"] == 1 || $file["error"] == 2)
                return array('status' => false, 'message' => 'Image sizes > 2 MB');
            else
                return array('status' => false, 'message' => 'Server Error: Try agin later');
        }
        if (!(($file["type"] == "image/jpeg") || ($file["type"] == "image/pjpeg")
                || ($file["type"] == "image/jpg") || ($file["type"] == "image/png"))) {
            return array('status' => false, 'message' => 'Invalid Format');
        } else if (($file["size"] > $this->maximagesize)) {
            return array('status' => false, 'message' => 'Image size  > 2 MB');
        } else {
            return array('status' => true, 'message' => '');
        }
    }

    /**
     * Function to Upload the Image/File.
     * @param  $modelName is the Model Name(ex ITEM, BANNER)
     * @param  $FILES is contain the uploaded file information tmpname, size etc 
     * @param  $overWriteImage is will contain the existing the file name if its there
     * @return boolean
     * @author Web Developer 
     */
    function normalUpload($modelName = 'Product', $FILES, $id = null, $overWriteImage = FALSE,$i) {

        if (!empty($FILES) && !empty($id)) {
          $tempFile = $FILES ['filename']['tmp_name'];
          $filetype=$FILES ['filename']['type'];
          $formats = array('png'=>'image/png','jpeg'=>'image/jpeg','jpg'=>'image/jpg','gif'=>'image/gif');
			if(in_array($filetype , $formats))
			{
				$formats = array_flip($formats);
			    $fileType=$formats [$filetype];
			}
  
            $targetPath = $this->rootpath . $modelName . '/' . $id.'/'.$i;

            $image_name = rand(500, 1500) . $modelName.'.'.$fileType;
            if (!empty($overWriteImage)) {
                $image_name = $overWriteImage;
            }

            $fileName = $image_name;

            $newfolder = $targetPath;
            if ($this->createFolderIfNot($newfolder)) {
                $newfolder = str_replace('//', '/', $newfolder . '/') . $fileName . 'image_original';
                if (copy($tempFile, $newfolder)) {
                    $thumb_create = array();
                    $thumb_create[] = array('image_large' => array('width' => 120, 'height' => 120, 'bestfit' => true, 'name' => 'large_'.$fileName ));
                    $thumb_create[] = array('image_big' => array('width' => 90, 'height' => 90, 'bestfit' => true, 'name' => 'big_'.$fileName  ));
                    $thumb_create[] = array('image_medium' => array('width' => 50, 'height' => 50, 'bestfit' => false, 'name' => 'medium_'.$fileName ));
                    $thumb_create[] = array('image_small' => array('width' => 32, 'height' => 32, 'bestfit' => false, 'name' => 'small_'.$fileName));
                    $this->createThumb($tempFile, $targetPath, $fileName . '_original', $thumb_create, true);
                    $type = substr($FILES['filename']['name'], strpos($FILES['filename']['name'], ".") + 1);
                
                    //$Attachment = $this->loadModel('Attachment');
					App::import('Model','Attachment');
					$this->Attachment = &new Attachment();
                    $this->Attachment->create();
                    $this->request->data['Attachment']['filename'] = $image_name;
                    $this->request->data['Attachment']['mimetype'] = $filetype;
                    $this->request->data['Attachment']['class'] = $modelName;
                    $this->request->data['Attachment']['foreign_id'] = $id;
                    $this->request->data['Attachment']['dir'] = $modelName.'/'.$id.'/'.$i;
                  
                    $this->Attachment->save($this->request->data['Attachment']);
                   return $image_name;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function createFolderIfNot($newfolder) {

        if (is_dir($newfolder)) {
            return true;
        }
        if (mkdir($newfolder, 0777, true)) {
            return true;
        }
        return false;
    }

    /*     * ********************************************
     *   @author Pankaj Kumar Jha
     *   PURPOSE: Upload the Banner Images inside the @page_id directory 
     *   and it will create thumb, original, and medium size image
     *   @param  $FILES is contain the uploaded file information tmpname, size etc 
     *   @param  $overWriteImage is will contain the existing the file name if its there
     *   @return boolean
     * ********************************************	 */

    function bannerUpload($modelName = 'pages', $FILES, $id = null, $overWriteImage = FALSE) {

        if (!empty($FILES) && !empty($id)) {
            $tempFile = $FILES['tmp_name'];

            $targetPath = $this->rootpath . $modelName . '/' . $id;

            $image_name = rand(500, 1500) . $modelName;
            if (!empty($overWriteImage)) {
                $image_name = $overWriteImage;
            }

            $fileName = $image_name;
            //$fileName ='image_original';
            //$fileName =rand(5, 15).$FILES['name'];
            $newfolder = $targetPath;
            if ($this->createFolderIfNot($newfolder)) {
                $newfolder = str_replace('//', '/', $newfolder . '/') . $fileName . 'image_original';
                if (copy($tempFile, $newfolder)) {
                    $thumb_create = array();
                    $thumb_create[] = array('image_medium' => array('width' => 50, 'height' => 50, 'bestfit' => false, 'name' => $fileName . 'image_medium'));
                    //$thumb_create[] = array('image_small' => array('width' => 32, 'height' => 32, 'bestfit' => false, 'name' => $fileName.'image_small'));
                    $this->createThumb($tempFile, $targetPath, $fileName . '_original', $thumb_create, true);
                    $type = substr($FILES['name'], strpos($FILES['name'], ".") + 1);
                    return $image_name;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*     * ********************************************
     *   @author Pankaj Kumar Jha
     *   PURPOSE: Upload the Banner Images inside the @page_id directory 
     *   and it will create thumb, original, and medium size image
     *   @param  $FILES is contain the uploaded file information tmpname, size etc 
     *   @param  $overWriteImage is will contain the existing the file name if its there
     *   @return boolean
     * ********************************************	 */

    function newsImageUpload($modelName = 'news', $FILES, $id = null, $overWriteImage = FALSE) {

        if (!empty($FILES) && !empty($id)) {
            $tempFile = $FILES['tmp_name'];
            $size = getimagesize($tempFile);
            $targetPath = $this->rootpath . $modelName . '/' . $id;

            $image_name = rand(500, 1500) . $modelName;
            if (!empty($overWriteImage)) {
                $image_name = $overWriteImage;
            }

            $fileName = $image_name;
            //$fileName ='image_original';
            //$fileName =rand(5, 15).$FILES['name'];
            $newfolder = $targetPath;
            if ($this->createFolderIfNot($newfolder)) {
                $newfolder = str_replace('//', '/', $newfolder . '/') . $fileName . 'image_original';
                if (copy($tempFile, $newfolder)) {
                    $thumb_create = array();
                    $thumb_create[] = array('image_large' => array('width' => 385, 'height' => 261, 'bestfit' => true, 'name' => $fileName . 'image_large'));
                    $thumb_create[] = array('image_medium' => array('width' => 214, 'height' => 139, 'bestfit' => false, 'name' => $fileName . 'image_medium'));
                    $thumb_create[] = array('image_small' => array('width' => 32, 'height' => 32, 'bestfit' => false, 'name' => $fileName . 'image_small'));
                    $this->createThumb($tempFile, $targetPath, $fileName . '_original', $thumb_create, true);
                    $type = substr($FILES['name'], strpos($FILES['name'], ".") + 1);
                    return $image_name;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    
        /**
     * Function to login.
     * @param array $file $_FILE['field_name'] has to be passed
     * @return boolean
     */
    function newsValidate($file) {
        $this->maximagesize="400";
        if ($file["error"] > 0) {
            if ($file["error"] == 1 || $file["error"] == 2)
                return array('status' => false, 'message' => 'Image sizes > 2 MB');
            else
                return array('status' => false, 'message' => 'Server Error: Try agin later');
        }
        if (!(($file["type"] == "image/jpeg") || ($file["type"] == "image/pjpeg")
                || ($file["type"] == "image/jpg") || ($file["type"] == "image/png"))) {
            return array('status' => false, 'message' => 'Invalid Format');
        } else if (($file["size"] > $this->maximagesize)) {
            return array('status' => false, 'message' => 'Image size  > 2 MB');
        } else {
            return array('status' => true, 'message' => '');
        }
    }

    

    /*     * ********************************************
     *   @author Pankaj Kumar Jha
     *   PURPOSE: List files inside the specified directory 
     *   and first delete listed files, after that directory
     *  
     *   array deleteDirectory (string dir)
     *
     *   This function will return an array
     *   that represents main folder's tree structure.
     *   Each folder has its own named array
     * 
     * Url should be '/var/www/murphy_deli/trunk/app/webroot/files/';
     * ********************************************	 */

    public function deleteDirectory($dir) {

        $files = array();
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir . '/' . $file)) {
                        $dir2 = $dir . '/' . $file;
                        $files[] = $this->deleteDirectory($dir2);
                    } else {
                        $files[] = $dir . '/' . $file;
                    }
                }
            }
            closedir($handle);
            foreach ($files as $val) {
                @unlink($val);
            }
        }
    }
    
    public function multipleUpload($modelName = null, $data =array(), $id = null)
    {
		for($i=1;$i<=count($data); $i++)
		{
			if(isset($data[$i]['filename']['error']) && ($data[$i]['filename']['error'] == 0))
			{
			  $fileUploaded = $this->normalUpload($modelName ,  $data[$i],  $id,FALSE,$i );
			}
		}
	   
	}

}

?>
