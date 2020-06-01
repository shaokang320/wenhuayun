<?php
namespace app\Http\Controllers\Enterprise;
use App\Http\Controllers\Enterprise\CommonController;
use Illuminate\Http\Request;

class UploadController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function upload_img(Request $request)
    {
        $files = $request->file('file');
        $extension = $files->extension();
        if (!imgmatch($extension))
        {
            throw new \Exception("文件不符合验证要求");
        }
        $mime = $files->getClientMimeType();
        if ((($mime == "image/gif")    || ($mime == "image/jpeg")    || ($mime == "image/pjpeg")    || ($mime == "image/x-png")    || ($mime == "image/png")) ) {
            $img_arr = uploadImage($files,'enterprise/editor/images','images');
            if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
                $protocol = "https://";
            } else {
                $protocol = "http://";
            }
            $response = new \StdClass;
            $response->link = $protocol.$_SERVER["HTTP_HOST"].'/'.$img_arr['path'];
            echo stripslashes(json_encode($response));
        }
    }
    public function upload_video()
    {
        try {

            $fieldname = "file";
            $fileRoute = "uploads/enterprise/editor/video/" . date("Y").'/'.date('m').'/'.date('Ymd');

            // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
            // 值如：/home/vagrant/Code/changan/public/uploads/video/201709/21/
            $upload_path = public_path() . '/' . $fileRoute;
            // Get filename.
            $filename = explode(".", $_FILES[$fieldname]["name"]);

            // Validate uploaded files.
            // Do not use $_FILES["file"]["type"] as it can be easily forged.
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            // Get temp file name.
            $tmpName = $_FILES[$fieldname]["tmp_name"];

            // Get mime type. You must include fileinfo PHP extension.
            $mimeType = finfo_file($finfo, $tmpName);

            // Get extension.
            $extension = end($filename);

            // Allowed extensions.
            $allowedExts = array("mp4", "webm", "ogg");

            // Allowed mime types.
            $allowedMimeTypes = array("video/mp4", "video/webm", "video/ogg");

            // Validate file.
            if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts)) {
                throw new \Exception("文件不符合验证要求");
            }
            if (!is_dir($upload_path)){
                mkdir($upload_path,'0755',true);
            }
            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;
            $fullNamePath = $upload_path .'/'. $name;
            // Check server protocol and load resources accordingly.
            if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
                $protocol = "https://";
            } else {
                $protocol = "http://";
            }
            // Save file in the uploads folder.
            move_uploaded_file($tmpName, $fullNamePath);

            // Generate response.
            $response = new \StdClass;
            $response->link = $protocol.$_SERVER["HTTP_HOST"].'/'.$fileRoute .'/'. $name;

            // Send response.
            echo stripslashes(json_encode($response));

        } catch (Exception $e) {
            // Send error response.
            echo $e->getMessage();
            http_response_code(404);
        }
    }
    public function upload_file()
    {
        try {
            // File Route.
            $fileRoute = "uploads/enterprise/editor/file/" . date("Y").'/'.date('m').'/'.date('Ymd');

            $fieldname = "file";
            $upload_path = public_path() . '/' . $fileRoute;
            // Get filename.
            $filename = explode(".", $_FILES[$fieldname]["name"]);

            // Validate uploaded files.
            // Do not use $_FILES["file"]["type"] as it can be easily forged.
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            // Get temp file name.
            $tmpName = $_FILES[$fieldname]["tmp_name"];
            // Get mime type. You must include fileinfo PHP extension.
            $mimeType = finfo_file($finfo, $tmpName);

            // Get extension.
            $extension = end($filename);

            // Allowed extensions.
            $allowedExts = array("txt", "pdf", "doc","json","html");

            // Allowed mime types.
            $allowedMimeTypes = array("text/plain", "application/msword", "application/x-pdf", "application/pdf", "application/json","text/html");

            // Validate file.
            if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts)) {
                throw new \Exception("文件不符合验证条件。");
            }

            if (!is_dir($upload_path)){
                mkdir($upload_path,'0755',true);
            }

            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;
            $fullNamePath = $upload_path . '/' . $name;

            // Check server protocol and load resources accordingly.
            if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
                $protocol = "https://";
            } else {
                $protocol = "http://";
            }

            // Save file in the uploads folder.
            move_uploaded_file($tmpName, $fullNamePath);

            // Generate response.
            $response = new \StdClass;
            $response->link = $protocol.$_SERVER["HTTP_HOST"].'/'.$fileRoute .'/'. $name;

            // Send response.
            echo stripslashes(json_encode($response));

        } catch (Exception $e) {
            // Send error response.
            echo $e->getMessage();
            http_response_code(404);
        }
    }
}
