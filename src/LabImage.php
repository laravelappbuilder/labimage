<?php
declare(strict_types=1);

namespace LABImage;
use Image;

class LabImage
{

  private $image_width;
  private $image_height;
  private $thumbnail_width;
  private $thumbnail_height;
  private $image_file;
  public $name;
  private $thumbnail;

  function __construct($image_file,int $image_width = 800, int $image_height = 600,bool $thumbnail = false,int $thumbnail_width = 300,int $thumbnail_height = 200)
  {
    $this->image_width = $image_width;
    $this->image_height = $image_height;
    $this->thumbnail_width = $thumbnail_width;
    $this->thumbnail_height = $thumbnail_height;
    $this->image_file = $image_file;
    $this->thumbnail = $thumbnail;
    $this->name = uniqid().'.'.$image_file->getClientOriginalExtension();
    $response = self::image($image_file);
    return $response;
  }

  public function image($image){
    Image::make($image)->resize($this->image_width,$this->image_height)->save(public_path($this->name));
    if ($this->thumbnail) {
      Image::make($image)->resize($this->thumbnail_width,$this->thumbnail_height)->save(public_path('thumbnails/'.$this->name));
    }
    return $this->name;
  }
}
