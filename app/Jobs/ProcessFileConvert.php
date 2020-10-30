<?php

namespace App\Jobs;

use App\File as Files;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Streaming\Format\X264;
use Streaming\Representation;

class ProcessFileConvert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $post;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(0);
       $files = Files::where([
           'status'=>Files::Status_New
       ])->get();
      foreach ($files as $file)
      {
          file_put_contents(public_path('upload/logs/'.$file->id.'.txt'), date('Y-m-d H:i:s ').'start Processing ', FILE_APPEND);
          $file->status = Files::Status_Converting;
          $file->save();

         
              $file_path = public_path().'\\'.str_replace('/', '\\', $file->url);
              $converted_path = 'mvideo/'.$file->id.'/'.str_replace('.mp4', '.m3u8', basename($file->url));

              $config = [
                  'ffmpeg.binaries'  => 'C:\xampp1\htdocs\mp4stream\bin\ffmpeg.exe',
                  'ffprobe.binaries' => 'C:\xampp1\htdocs\mp4stream\bin\ffprobe.exe',
                  'timeout'          => 2*3600, // The timeout for the underlying process
                  'ffmpeg.threads'   => 10,   // The number of threads that FFmpeg should use
              ];

              $log = new Logger('file_'.$file->id);
              $log->pushHandler(new StreamHandler(public_path('upload/logs/'.$file->id.'.log')));

              $ffmpeg = \Streaming\FFMpeg::create($config, $log);


              $video = $ffmpeg->open($file_path);
              $r_360p  = (new Representation())->setKiloBitrate(276)->setResize(640, 360);
              $r_480p  = (new Representation)->setKiloBitrate(750)->setResize(854, 480);
              $r_720p  = (new Representation)->setKiloBitrate(2048)->setResize(1280, 720);
              $format = new X264();
              $format->on('progress', function ($video, $format, $percentage) use ($file){
                  $file->percentage = $percentage;
                  $file->save();
                  echo sprintf("\rTranscoding...(%s%%) [%s%s]", $percentage, str_repeat('#', $percentage), str_repeat('-', (100 - $percentage)));
              });
              $video->hls()
                  ->setFormat($format)
                  ->x264()
                  ->addRepresentations([$r_360p,$r_480p,$r_720p])
                  ->save();
              file_put_contents(public_path('upload/logs/'.$file->id.'.txt'), date('Y-m-d H:i:s ').'Processing SuccessFull', FILE_APPEND);
              $file->status = Files::Status_Converted;
              $file->converted_path = $converted_path;
              $file->save();
              
              
       


      }


    }
}
