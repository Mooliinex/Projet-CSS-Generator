    <?php
    require_once "detail.php";
    require_once "sheet.php";

    class Script{
        
        private $recursive = false;
        private $ouputimage = false; 
        private $imagename = "sprite.png"; 
        private $style = false;
        private $stylename = "style.css"; 


        public function getrecursive(){
            return $this->recursive;
        }
        public function getoutputimage(){
            return $this->outputimage;
        }
        public function getimagename(){
            return $this->imagename;
        }
        public function getstyle(){
            return $this->style;
        }
        
        public function getstylename(){
            return $this->stylename;
        }

        public function setRecursive($recursiveParam){
            $this->recursive = $recursiveParam;
        }
        public function setoutputimage($imageParam){
            $this->outputimage = $imageParam;
        }
        public function setstyle($styleParam){
            $this->style = $styleParam;
        }
        public function setimagename($nameParam){
            $this->imagename = $nameParam;
            echo $this->imagenbame;
        }
        public function setstylename($stylenameParam){
            $this->stylename = $stylenameParam;
        }
    }

    function files($argv, $argc){
    $Myscan = new Script;
   
    for($i= 0; $i < $argc; $i++){

        if($argv[$i] == "-r" ||  $argv[$i] == "--recursive"){
            
            $Myscan->setRecursive(true);
        
        }

        if($argv[$i] == "-i" || $argv[$i] == "--output-image"){
        
            if(strlen($argv[$i + 1]) > 4){
            
                if((substr($argv[$i +1], -4, 4) == ".png" || substr($argv[$i +1], -4, 4) == ".PNG")){
                    
                    $Myscan->setimagename($argv[$i + 1]);
                    $Myscan->setoutputimage(true);
                    
                
                }
            }
        }
            
        if($argv[$i] == "-s" ||  $argv[$i] == "--output-style"){
            
            if(strlen($argv[$i + 1]) > 4){
                
                if (substr($argv[$i +1], -4, 4) == ".css" || substr($argv[$i +1], -4, 4) == ".CSS" ){

                    $Myscan->setstylename($argv[$i + 1]);
                    $Myscan->setStyle(true);
                    print_r ($Myscan);
                    
                }

            }
        }

    }
    return $Myscan;
    }
    function recursive($path, $rec){
        $tab = [];

        if (is_dir($path)){
            // ouvre le dossier
            $ressource = opendir($path);
            // lis chaque nom du dossier
            while ($file = readdir($ressource)){
                if($file == "." || $file == "..")
                    continue ;

            //si png
                else if (substr($file, -4, 4) == ".png" || substr ($file, -4, 4) == ".PNG"){
                    $tab[] = new Sprite("$path/$file");  //
                    
                }
            // si un dossier > recursive
                else if (is_dir("$path/$file") && $rec){
                    $out = recursive("$path/$file", $rec); // retourne la fonction
                  
                    foreach ($out as $value){
                        $tab[] = $value;
                    }
                }
            }
            closedir($ressource);
            return $tab;
        }
        
    return NULL;
    }

    $Myscan = files($argv, $argc); //class parametre
    $Tab_files = recursive($argv[$argc - 1 ], $Myscan->getrecursive(), $Myscan->getimagename()); // est égale a $tab[] 
        // get image ??
    if ($Tab_files == FALSE)
	    throw new Exception("ERROR: pas de dossier passé en argument.". PHP_EOL);
	

 
    $sheet = new Sheet($Tab_files, $Myscan); // passe Myscan et Tab_files à Class Sheet
