<?php



class Document{
    public $dirr;
    public $filename;
    public $filepaths;
    public $createddate;
    public $query;
    public $beforequery;
    public $afterquery;
    private $datefilearray;
    private $linefound;
    private $dates;
    private $filebyline;
    
    public function __construct(){
        $this->dirr="";
        $this->filename="";
        $this->query="";
        $this->filebyline=[];
        $this->filepaths=[];
        $this->datefilearray=[[]];
        $this->linefound=0;
        $this->afterquery=0;
        $this->beforequery=0;
    }
    public function __construct($dirr,$filename){
        $this->dirr=$dirr;
        $this->filename=$filename;
        $this->query="";
        $this->filebyline=[];
        $this->datefilearray=[[]];
        $this->filepaths=$this->ScanDir($this->dirr);
        $this->linefound=0;
        $this->afterquery=0;
        $this->beforequery=0;
    }
    
    public function ScanDir($dirr){
        $this->dirr = $dirr;
        $files = scandir($this->dirr);
        $i=0;
        while($i < count($files)){
            $this->filepaths[$i] = $this->dirr.$files[$i];
        }
        return true;
    }
    
    public function GetLines(){
        $handle = fopen($this->dirr.$this->filename,'r');
        $i=0;
        while($buffer = fgets($handle)){
            $this->filebyline[$i]=$buffer;
            $i++;
        }
    }
    public function FindQuery($query){
        $i=0;
        $this->query = $query;
        while($i < count($this->filebyline)){
            if(strpos($this->filebyline[$i],$this->query) !== false){
                $this->linefound=$i;
                break;
            }
            else{
                $i++;
            }
        }
        if($this->linefound !== 0){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function ReturnAroundQuery($query,$beforequery,$afterquery){
        $output=[];
        if($this->query == ""){
            $this->FindQuery($query);
        }
        else{
            $i=0;
            $this->beforequery = $this->linefound - $beforequery;
            $this->afterquery = $this->linefound + $afterquery;
            while($this->beforequery <= $this->afterquery ){
                $output[$i] = $this->filebyline[$this->beforequery];
                $i++;
                $this->beforequery++;
                
            }
        }
        return $output;
    }
    
    public function SortFileByDate($dirr){
        $this->ScanDir($dirr);
        $this->GetLines();
        if($this->FindQuery("Date") == true or $this->FindQuery("date") == true){
            $datefilearray = array(array());
            $row=0;
            $col=0;
            for($i = 0; $i < count($this->filepaths); $i++ ){
                $datefilearray[0][$i] = $this->filepaths[$i];
            }
            for($i = 0; $i < count($this->filepaths); $i++ ){
                $datefilearray[1][$i] = new DateTime("F d Y H:i:s.", filemtime($this->filepaths[$i]));
            }
            $this->datefilearray=$datefilearray;
            if($this->QuickSortDate() == true){
                $this->filepaths = array_column($this->datefilearray,'0');
                return true;
            }
        }
        else{
            return false
        }
    }
    
    
    private function QuickSortDate(){
        $movecount=0;
        for($i=0;$i< count(array_column($this->datefilearray,'1'));$i++ ){
            $swap=$this->datefilearray[1][$i+1]->diff($this->datefilearray[1][$i]);
            $swap->format('%R%a');
            if($swap > 0 ){
                $temp=$this->datefilearray[1][$i];
                $tempfile=$this->datefilearray[0][$i];
                $this->datefilearray[1][$i]=$this->datefilearray->[1][$i+1];
                $this->datefilearray->[1][$i+1]=$temp;
                $this->datefilearray[0][$i]=$this->datefilearray->[0][$i+1];
                $this->datefilearray->[0][$i+1]=$tempfile;
                $movecount++;
                
            }
        }
        if($movecount>0){
            $this->QuickSortDate();
        }
        else{
            return true;
        }
    }
    
}




?>