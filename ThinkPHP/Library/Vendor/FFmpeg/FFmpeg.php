<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// 定义时区
ini_set('date.timezone','Asia/Shanghai');

class FFmpeg {
    // 定义配置项
    private $ffmpeg_path;

    // 构造函数
    public function __construct(){
       $this->ffmpeg_path=C('FFMPEG_PATH');
    }
    public function getTime($file){
       $vtime = exec("ffmpeg -i ".$file." 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");//总长度
       $ctime = date("Y-m-d H:i:s",filectime($file));//创建时间
       //$duration = explode(":",$time);
       // $duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);//转化为秒
       return array('vtime'=>$vtime,
       'ctime'=>$ctime
       );
    }
    public function getVideoInfo($file) {
       
      $command = sprintf($this->ffmpeg_path, $file);
       
      ob_start();
      passthru($command);
      $info = ob_get_contents();
      ob_end_clean();
       
      $data = array();
      if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $info, $match)) {
        $data['duration'] = $match[1]; //播放时间
        $arr_duration = explode(':', $match[1]);
        $data['seconds'] = $arr_duration[0] * 3600 + $arr_duration[1] * 60 + $arr_duration[2]; //转换播放时间为秒数
        $data['start'] = $match[2]; //开始时间 
        $data['bitrate'] = $match[3]; //码率(kb)
      }
      if (preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $info, $match)) {
        $data['vcodec'] = $match[1]; //视频编码格式
        $data['vformat'] = $match[2]; //视频格式
        $data['resolution'] = $match[3]; //视频分辨率
        $arr_resolution = explode('x', $match[3]);
        $data['width'] = $arr_resolution[0];
        $data['height'] = $arr_resolution[1];
      }
      if (preg_match("/Audio: (\w*), (\d*) Hz/", $info, $match)) {
        $data['acodec'] = $match[1]; //音频编码
        $data['asamplerate'] = $match[2]; //音频采样频率
      }
      if (isset($data['seconds']) && isset($data['start'])) {
        $data['play_time'] = $data['seconds'] + $data['start']; //实际播放时间
      }
      $data['size'] = filesize($file); //文件大小
      return $data;
    }
    public function video_length($file){
      $command = sprintf($this->ffmpeg_path, $file);
       
      ob_start();
      passthru($command);
      $info = ob_get_contents();
      ob_end_clean();
       
      $data = array();
      if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $info, $match)) {
        $data['duration'] = $match[1]; //播放时间
        $arr_duration = explode(':', $match[1]);
        $data['seconds'] = $arr_duration[0] * 3600 + $arr_duration[1] * 60 + $arr_duration[2]; //转换播放时间为秒数
        $data['start'] = $match[2]; //开始时间 
      }
      if (isset($data['seconds']) && isset($data['start'])) {
        $data['play_time'] = $this->Sec2Time($data['seconds'] + $data['start']); //实际播放时间
      }
      return $data['play_time'];
    }
    public function getVideoCover($file,$time,$name) {
       if(empty($time))$time = '1';//默认截取第一秒第一帧
       $strlen = strlen($file);
       // $videoCover = substr($file,0,$strlen-4);
       // $videoCoverName = $videoCover.'.jpg';//缩略图命名
       //exec("ffmpeg -i ".$file." -y -f mjpeg -ss ".$time." -t 0.001 -s 320x240 ".$name."",$out,$status);
       $str = "ffmpeg -i ".$file." -y -f mjpeg -ss 3 -t ".$time." -s 320x240 ".$name;
       //echo $str."</br>";
       $result = system($str);
    }
    public function Sec2Time($time){
    if(is_numeric($time)){
    $value = array(
      "hours" => 0,
      "minutes" => 0, 
      "seconds" => 0,
    );
    if($time >= 3600){
      $value['hours']=floor($time/3600);
      $time = ($time%3600);
    }
    if($time >= 60){
      $value["minutes"] = floor($time/60);
      $time = ($time%60);
    }
    $value["seconds"] = floor($time);
    //return (array) $value;
    $t=$value["hours"] .":". $value["minutes"] .":".$value["seconds"];
       return $t;
    }else{
       return '00:00:00';
    }
 }
}
