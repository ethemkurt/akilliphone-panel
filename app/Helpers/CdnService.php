<?php
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
class CdnService{
    const FTP_SERVER = 'cdn-b.akilliphone.com';
    const FTP_USER = 'cdn';
    const FTP_PASS = 'a1z1sch2';
    public static function saveToCdn($base64File, $filename=false){
        $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
        if(empty($filename)) $filename = Str::uuid()->toString();
        $tmpFilePath = sys_get_temp_dir() . '/' . $filename ;
        file_put_contents($tmpFilePath, $fileData);
        $tmpFile = new File($tmpFilePath);
        $file = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );
        //$file->store('images');
        if(is_file($file->getPathname())){
            $cdnUrl = self::moveToCdn($file->getPathname(), $filename.'.'.$file->extension());
        } else {
            $cdnUrl = '';
        }
        return  $cdnUrl;
    }
    public static  function moveToCdn($fromfile, $tofile)
    {
        $conn_id = ftp_connect(self::FTP_SERVER) or die("could not connect to CDN");
        if (ftp_login($conn_id, self::FTP_USER, self::FTP_PASS))
        {
            // Yıllık ve Aylık Klasör
            @ftp_mkdir($conn_id, '/public_html/img/');
            @ftp_mkdir($conn_id, '/public_html/img/'.date('Y').'-'.date('m'));
            @ftp_mkdir($conn_id, '/public_html/img/'.date('Y').'-'.date('m').'/'.date('d'));
            //
            $topath = 'img/'.date('Y').'-'.date('m').'/'.date('d').'/'.$tofile;
            $sonuc = ftp_put($conn_id, '/public_html/'.$topath, $fromfile, FTP_BINARY);
            ftp_close($conn_id);
            return $topath;
        } else {
            return false;
        }
    }
}
