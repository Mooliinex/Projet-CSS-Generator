<?php
require_once "class.php";
require_once "sheet.php";

class Sprite {
	private $height;
	private $width;
	private $x_offset;
	private $y_offset;
	private $path;
	private $ressource;


	public function getheight(){
        return $this->height;
    }
    public function getwidth(){
        return $this->width;
    }
    public function getx(){
        return $this->x;
    }
    public function gety(){
        return $this->y;
    }
    public function getpath(){
        return $this->path;
    }
	public function getressource(){
        return $this->ressource;
    }

    public function setheight($setHeigth){
        $this->height = $setHeigth;
    }
    public function setwidth($setWidth){
        $this->width = $setWidth;
    }
    public function setx($getX){
        $this->setx = $setX;
    }
    public function sety($setY){
        $this->sety = $setY;
    }
    public function setpath($setPath){
        $this->setpath = $setPath;
    }

	public function setressource($setRessource){
        $this->ressource = $setRessource;
    }

	public function __construct($path){

		$ressource = imagecreatefrompng($path);
		$width = imagesx($ressource);
		$height = imagesy($ressource);

	

		$this->setpath($path);
		$this->setressource($ressource);
		$this->setwidth($width);
		$this->setheight($height);

        echo $this->getressource() ."  " .  $this->getwidth() . "  ". $this->getheight() . PHP_EOL ;

	}
    
    }
