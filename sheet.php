<?php
require_once "class.php";
require_once "detail.php";


class Sheet{
    private $totalheight; // taille de chaque image +++
    private $name; // -s
    private $path; // chemin out 
    private $source; // source de l'image vide
    private $maxwidth;

    public function getTotalheight (){
        return $this->totalheight;
    }
    public function getName(){
        return $this->name;
    }
    public function getMaxwidth(){
        return $this->maxwidth;
    }
    public function getPath(){
        return $this->path;
    }
    public function getSource(){
        return $this->source;
    }

    public function setTotalheight($Total_){
        $this->Totalheight = $Total_;
    }
    public function setName($Name_){
        $this->Name = $Name_;
    }
    public function setmaxwidth($maxwidth_){
        $this->maxwidth = $maxwidth_;
    }
    public function setPath($Path_){
        $this->Path = $Path_;
    }
    public function setSource($Source_){
        $this->Source = $Source_;
    }
    public function __construct($tab, $Myscan){
        
        $height_max = 0;
        $width_max = 0;

    foreach($tab as $spriteimg){  //$tab = a notre $tableau stocker dans class.php

        $var = $spriteimg->getheight(); // nouvelle variable "$var" qui est égal à notre hauteur de notre image
       if ($var > $height_max){  // si $var est plus grand que la hauteur max de toute nos image alors stock la hauteur max
        $height_max = $var;  // la hauteur max est donc egal a notre $var (il faut bien la sotcker et la garder en valeur)
       }
       $varH = $spriteimg->getwidth();       // pareil que $var 
    
        $width_max += $varH;  // largeur max est égale à $var ++ 
    }

        echo "  ". $width_max . "     " . $height_max   . PHP_EOL;
        $this->setTotalheight($height_max);
        $this->setmaxwidth($width_max);
       
// CREATION DE NIOTRE IMAGE VIDE AVEC HAUTEUR ET LARGEUR MAX

        $width = 0;
        $height = 0;
        $img = imagecreatetruecolor($width_max, $height_max);
        //$back = imagecolorallocatealpha($img, 255, 255, 255);
        imagefill($img, 0, 0, 0xfd6c9e);
        //imagealphablending($img, false);
       // imagesavealpha($img, true);
       
       foreach ($tab as $objet) {
            $taillex = $objet->getwidth();
            $tailley = $objet->getheight();
            $imageress = $objet->getressource();
            
            imagecopy($img, $imageress, $width, 0, 0, 0, $taillex, $tailley);
            $width += $taillex;
    
      
        }
//SPRITE
        $namesheet = $Myscan->getimagename();
        $opensheet= fopen($namesheet,"w");
        imagepng($img, $opensheet);
        fclose($opensheet);
        imagedestroy($img);
// CSS
        $csssheet = $Myscan->getstylename();
        $opencss = fopen($csssheet, "w");

        $i=0;
        foreach ($tab as $count){
        $content = "PNG$i{". PHP_EOL. "    height:". $count->getheight().";"."  ". PHP_EOL. "    width:". $count->getwidth(). ";"."  ".PHP_EOL. "}".PHP_EOL;


        fwrite($opencss, $content);
       $i++;

    }
    
 fclose($opencss);

    }
}
    
    

