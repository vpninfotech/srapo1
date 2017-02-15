<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Filestorage {


	/*==================================
	
	Function List :
	
	1. File Upload
	2. File Array Upload
	3. File Update
	4. File Array Update
	5. File Delete
	6. Rename File
	7. Upload Zip File
	8. Download Zip File
	9. Create Folder
	10.Download File
	
	  ================================*/
	public function __construct() 
	{
		$this->obj = & get_instance();
		$this->obj->load->library('zip');
		$this->obj->load->helper('download');
    }

	/*
	* Function Name : File Upload
	* Param1 : Location
	* Param2 : HTML File ControlName
	* Param3 : Extension
	* Param4 : Size Limit
	* Return : FileName
	*/
   
	function FileInsert($location, $controlname, $type, $size)
	{
		$return =array();
		$type=strtolower($type);
		if(isset($_FILES[$controlname]) && $_FILES[$controlname]['name'] != NULL)
        {
			$filename = $_FILES[$controlname]['name'];
			$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
			$filesize = $_FILES[$controlname]["size"];	
					
			if($type=='image')
			{
				if($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'gif')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In jpg,jpeg,png,gif Format';
					$return['status']=0;
					
				}
			}
			elseif($type=='pdf')
			{
				if($file_extension == 'pdf')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In PDF Format';
					$return['status']=0;	
				}
			}
			elseif($type=='excel')
			{
				if( $file_extension == 'xlsx' || $file_extension == 'xls')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
						
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In Excel Format Only allow .xlsx and .xls extension';
					$return['status']=0;
				}
			}
			elseif($type=='doc')
			{
				if( $file_extension == 'doc' || $file_extension == 'docx' || $file_extension == 'txt' || $file_extension == 'rtf')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']='File Must Be In doc,docx,txt,rtf Format'; 
					$return['status']=0;		
				}
			}
			else
			{
				$return['msg']='Not Allow other than image,pdf,excel,doc file..';
				$return['status']=0;	
			}

		}
        else
        {
            $return['msg']='';
			$return['status']=1;
        }
		return $return;
	}
	
	
	//======================================================================
	
	/*
	* Function Name : File Array Upload
	* Param1 : Location
	* Param2 : HTML File ControlName
	* Param3 : Extension
	* Param4 : Size Limit
	* Param5 : Array Key
	* Return : FileName
	*/
   
	function FileArrayInsert($location, $controlname, $type, $size, $key)
	{
		$type=strtolower($type);
		$return =array();
		if(isset($_FILES[$controlname]['name'][$key]) && $_FILES[$controlname]['name'][$key] != NULL)
        {
			$filename = $_FILES[$controlname]['name'][$key];
			$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
			$filesize = $_FILES[$controlname]["size"][$key];			
			if($type=='image')
			{
				if($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'gif')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
						$return['status']=1;
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In jpg,jpeg,png,gif Format';
					$return['status']=0;
					
				}
			}
			elseif($type=='pdf')
			{
				if($file_extension == 'pdf')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
						$return['status']=1;
					}
					else
					{
						
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In PDF Format';
					$return['status']=0;	
				}
			}
			elseif($type=='excel')
			{
				if( $file_extension == 'xlsx' || $file_extension == 'xls')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
						$return['status']=1;
						
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In Excel Format Only allow .xlsx and .xls extension';
					$return['status']=0;
				}
			}
			elseif($type=='doc')
			{
				if( $file_extension == 'doc' || $file_extension == 'docx' || $file_extension == 'txt' || $file_extension == 'rtf')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
						$return['status']=1;
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']='File Must Be In doc,docx,txt,rtf Format'; 
					$return['status']=0;		
				}
			}
			else
			{
				$return['msg']='Not Allow other than image,pdf,excel,doc file..';
				$return['status']=0;	
			}

		}
        else
        {
            $return['msg']='';
			$return['status']=1;
        }
		return $return;
	}
	
	
	//======================================================================
	
	
	/*
	* Function Name : File Update
	* Param1 : Location
	* Param2 : HTML File ControlName
	* Param3 : Extension
	* Param4 : Size Limit
	* Param5 : Old File Name
	* Return : FileName
	*/
   
	function FileUpdate($location, $controlname, $type, $size , $oldfile)
	{
		$type=strtolower($type);
		$return =array();
		if(isset($_FILES[$controlname]) && $_FILES[$controlname]['name'])
        {
			$filename = $_FILES[$controlname]['name'];
			$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
			$filesize = $_FILES[$controlname]["size"];		
			if($type=='image_pdf_doc')
			{
				if($file_extension == 'jpg' 
				|| $file_extension == 'jpeg' 
				|| $file_extension == 'png' 
				|| $file_extension == 'gif'
				|| $file_extension == 'pdf'
				|| $file_extension == 'doc'
				|| $file_extension == 'docx')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}	
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'Attachment file must be in Image, Word Document or in PDF format only.';
					$return['status']=0;
					
				}
			}
			elseif($type=='image')
			{
				if($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'gif')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}	
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In jpg,jpeg,png,gif Format';
					$return['status']=0;
					
				}
			}
			elseif($type=='pdf')
			{
				if($file_extension == 'pdf')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}	
					}
					else
					{
						
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In PDF Format';
					$return['status']=0;	
				}
			}
			elseif($type=='excel')
			{
				if( $file_extension == 'xlsx' || $file_extension == 'xls')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}	
						
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In Excel Format Only allow .xlsx and .xls extension';
					$return['status']=0;
				}
			}
			elseif($type=='doc')
			{
				if( $file_extension == 'doc' || $file_extension == 'docx' || $file_extension == 'txt' || $file_extension == 'rtf')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileUpload($location, $controlname);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}	
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']='File Must Be In doc,docx,txt,rtf Format'; 
					$return['status']=0;		
				}
			}
			else
			{
				$return['msg']='Other File Formats are not allowed.';
				$return['status']=0;	
			}

		}
        else
        {
            $return['msg']=$oldfile;
			$return['status']=1;	 
        }
		return $return;
	}
	
	
	//======================================================================
	
	
	/*
	* Function Name : File Array Update
	* Param1 : Location
	* Param2 : HTML File ControlName
	* Param3 : Extension
	* Param4 : Size Limit
	* Param5 : Old File Name
	* Param6 : Image Array Key
	* Return : FileName
	*/
   
	function FileArrayUpdate($location, $controlname, $type, $size , $oldfile, $key)
	{
		$type=strtolower($type);
		$return =array();
		if(isset($_FILES[$controlname]['name'][$key]) && $_FILES[$controlname]['name'][$key])
        {
			$filename = $_FILES[$controlname]['name'][$key];
			$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
			$filesize = $_FILES[$controlname]["size"][$key];			
			if($type=='image')
			{
				if($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'gif')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In jpg,jpeg,png,gif Format';
					$return['status']=0;
					
				}
			}
			elseif($type=='pdf')
			{
				if($file_extension == 'pdf')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In PDF Format';
					$return['status']=0;	
				}
			}
			elseif($type=='excel')
			{
				if( $file_extension == 'xlsx' || $file_extension == 'xls')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}
						
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					$return['msg']= 'File Must Be In Excel Format Only allow .xlsx and .xls extension';
					$return['status']=0;
				}
			}
			elseif($type=='doc')
			{
				if( $file_extension == 'doc' || $file_extension == 'docx' || $file_extension == 'txt' || $file_extension == 'rtf')
				{
					if ($filesize <= $size) 
					{
						$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
						$return['status']=1;
						if(isset($oldfile) && $oldfile != NULL)
						{
							$this->DeleteImage($location,$oldfile);	
						}
					}
					else
					{
						$size=$size/1024;
						$return['msg']= 'File must be smaller then  '.$size.' KB';
						$return['status']=0;
					}
				}
				else
				{
					
					$return['msg']='File Must Be In doc,docx,txt,rtf Format'; 
					$return['status']=0;		
				}
			}
			else
			{
				$return['msg']='Not Allow other than image,pdf,excel,doc file..';
				$return['status']=0;	
			}

		}
        else
        {
            $return['msg']=$oldfile;
			$return['status']=1;	
        }
		return $return;
	}
	
	//======================================================================
	
	
	/*
	* Function Name : File Delete
	* Param1 : Location
	* Param2 : OLD Image Name
	*/
	
	public function DeleteImage($location,$oldfile)
    {		
		if($oldfile)
		{

			if(file_exists(FCPATH.$location.$oldfile)) 
			{
				unlink(FCPATH.$location.$oldfile);		
			}
		}

    }
	/*
	* Function Name : File Delete
	* Param1 : Location
	* Param2 : OLD Image Name
	*/
	
	public function DeleteImageTickets($location,$oldfile)
    {		
		if($oldfile)
		{

			if(file_exists(Ticket_DOC.$location.$oldfile)) 
			{
				unlink(Ticket_DOC.$location.$oldfile);		
			}
		}
		
    }
	
	//======================================================================
	
	
	/*
	* Function Name : File Upload
	* Param1 : Location
	* Param2 : HTML File ControlName
	* Return : FileName
	*/

	function FileUpload($location, $controlname)
	{
		if ( ! file_exists(FCPATH.$location))
		{
			$create = mkdir(FCPATH.$location,0777,TRUE);
			if ( ! $create)
				return '';
		}
        
		$newFileName=  $this->RenameImage($_FILES[$controlname]['name']);
		if(move_uploaded_file(realpath($_FILES[$controlname]['tmp_name']),$location.$newFileName))
		{

			return $newFileName;

		}
		else
		{
			return '';
		}     
	}
	
	
	//======================================================================
	
	
	/*
	* Function Name : File Array Upload
	* Param1 : Location
	* Param2 : HTML File ControlName
	* Param3 : Data Array key
	* Return : FileName
	*/

	function FileArrayUpload($location, $controlname, $key)
	{
		if ( ! file_exists(FCPATH.$location))
		{
			$create = mkdir(FCPATH.$location,0777,TRUE);
			if ( ! $create)
				return '';
		}
        
		$newFileName=  $this->RenameImage($_FILES[$controlname]['name'][$key]);
		if(move_uploaded_file(realpath($_FILES[$controlname]['tmp_name'][$key]),$location.$newFileName))
		{

			return $newFileName;

		}
		else
		{
			return '';
		}     
	}
	
	
	//======================================================================
	
	
	/*
	* Function Name : Rename Image
	* Param1 : FileName
	* Return : FileName
	*/
	public function RenameImage($imageName)
    {
        $randString = md5(time().$imageName);
        $fileName =$imageName;
        $splitName = explode(".", $fileName);
        $fileExt = end($splitName);
        return strtolower($randString.'.'.$fileExt);
    }
   
   
   //======================================================================
	
	
	/*
	* Function Name : Upload Zip File
	* Param1 : FileName
	*/
	public function UploadZip($location, $controlname)
    {
		$filename = $_FILES[$controlname]["name"];
		$source = $_FILES[$controlname]["tmp_name"];
		$type = $_FILES[$controlname]["type"];
		$name = explode(".", $filename);
		$target_path = $location.$filename;  // change this to the correct site path
		if(move_uploaded_file($source, $target_path)) 
		{
			$zip = new ZipArchive();
			$x = $zip->open($target_path);
			if ($x === true) 
			{
				$zip->extractTo($location); // change this to the correct site path
				$zip->close();
				unlink($target_path);
				return 'Zip File Extracted Successfully';
			}
			return 'Zip File Not Extracted Successfully';
		}
		else 
		{	
			return 'Zip File Not Uploaded Successfully';
		}
    }
	
	
	//======================================================================
	
	/*
	* Function Name : Download Zip File
	* Param1 : FileName
	*/
	public function DownloadZip($location, $dataArray)
    {
		set_time_limit(0);
		foreach($dataArray as $row)
        {
            $name = $row;
			$data = file_get_contents($location.$row);
			$this->obj->zip->add_data($name, $data);
			
        }
        $this->obj->zip->archive($location.'/my_backup.zip'); 
		$this->obj->zip->download('my_backup.zip');
    }
	
	
	//======================================================================
	
	/*
	* Function Name : Create Folder
	* Param1 : Location
	* Param2 : Folder Name
	*/
	
	public function CreateFolder($location, $FolderName)
    {
        $finalpath=FCPATH.$location;
        if ( ! file_exists($finalpath.$FolderName))
        {
            $create = mkdir($finalpath.$FolderName,0777,TRUE);
            if ( ! $create)
            return '';
        }
        
    }
	
	
	//======================================================================
	
	/*
	* Function Name : Download PDF File
	* Param1 : Location
	* Param2 : Data Array
	*/
	
	
	function DownloadFile($location, $data)
	{
		$filename=$data['Src'];
		$path    =   file_get_contents($location.$filename);
		$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
		$name    =   $data['Title'].".".$file_extension;
		force_download($name, $path);  
	}
	
	
	
	//=====================For All Types Of multiple file Insert =======================
	
	/*
	* Function Name : File Array Upload
	* Param1 : Location
	* Param2 : HTML File ControlName
	* Param3 : Size Limit
	* Param4 : Array Key
	* Return : FileName
	*/
   
	function FileArrayInsert_NoType($location, $controlname, $size, $key)
	{
		$return =array();
		if(isset($_FILES[$controlname]['name'][$key]) && $_FILES[$controlname]['name'][$key] != NULL)
        {
			$filename = $_FILES[$controlname]['name'][$key];
			$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
			$filesize = $_FILES[$controlname]["size"][$key];
			// $return['filesize']=$filesize;			
			// $return['valid_filesize']=$size;
			// return $return;
			if ($filesize <= $size) 
			{
				$return['msg']= $this->FileArrayUpload($location, $controlname,$key);
				$return['status']=1;
			}
			else
			{
				$size=$size/1024;
				$return['msg']= 'File must be smaller then  '.$size.' KB';
				$return['status']=0;
			}
		}
        else
        {
            $return['msg']='';
			$return['status']=1;
        }
		return $return;
	}
	//=====================For All Types Of multiple file Insert =======================
	
	/*
	* Function Name : File Array Upload
	* Param1 : Location
	* Param2 : HTML File ControlName
	* Param3 : Size Limit
	* Param4 : Array Key
	* Return : FileName
	*/
   
	function FileInsert_NoType($location, $controlname,$size)
	{
		$return =array();
		if(isset($_FILES[$controlname]['name']) && $_FILES[$controlname]['name'] != NULL)
        {
			$filename = $_FILES[$controlname]['name'];
			$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
			$filesize = $_FILES[$controlname]["size"];
			// $return['filesize']=$filesize;			
			// $return['valid_filesize']=$size;
			// return $return;
			if ($filesize <= $size) 
			{
				$return['msg']= $this->FileUpload($location, $controlname);
				$return['status']=1;
			}
			else
			{
				$size=$size/1024;
				$return['msg']= 'File must be smaller then  '.$size.' KB';
				$return['status']=0;
			}
		}
        else
        {
            $return['msg']='';
			$return['status']=1;
        }
		return $return;
	}
	
	//=====================For Crop Images =======================
	
	/*
	* Function Name : Crop Image Upload
	* Param1 : Location 
	* Param2 : New Image Name
	* Param3 : Image Post Data
	* Param4 : Old Image
	* Return : Bolean
	*/
	
	function crop_image_upload($path,$name,$data,$oldimg='')
	{
		if($oldimg != NULL)
		{
			$this->DeleteImage($path,$oldimg);	
		}
		$encodedData = str_replace(' ','+',$data);
		$decodedData = base64_decode($encodedData);
		$uri = substr($data,strpos($encodedData,",")+1);	
		return file_put_contents(FCPATH.$path.$name, base64_decode($uri));	
		
	}
	/*
	* Function Name : CheckFileExtension
	* Param1 : controlname
	* Param2 : Extension
	* Param3 : Size Limit
	* Return : void
	*/
   
	function CheckFileExtension($controlname, $type)
	{
		$return =array();
		$type=strtolower($type);
		if(isset($_FILES[$controlname]) && $_FILES[$controlname]['name'] != NULL)
        {
			$filename = $_FILES[$controlname]['name'];
			$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
			$filesize = $_FILES[$controlname]["size"];	
			
			if($type=='image_pdf_doc')
			{
				if($file_extension == 'jpg' 
				|| $file_extension == 'jpeg' 
				|| $file_extension == 'png' 
				|| $file_extension == 'gif'
				|| $file_extension == 'pdf'
				|| $file_extension == 'doc'
				|| $file_extension == 'docx')
				{
					return true;
				}
				else
				{
					return false;
				}
			}

		}
	}

}