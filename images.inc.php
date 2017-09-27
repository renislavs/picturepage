<?php
//
// Author: Emma Vogensen
// Made on: 18-Sep-2017 @ 13:26:02
// Orgranisation: IBA
//
        
        error_reporting(E_ALL);
//define user friendly EOL for friendlier PHP output
if (!defined('EOL')) {
    define('EOL', '<br />' . PHP_EOL);
}

class Images {
    public $caption;
    public $story;
    public $tags;
    public $credit;
    
  
    public function getCaption() {
        return $this->caption;
    }
    
    public function setCaption( $caption ) {
        $this->caption = $caption;
    }
     public function getStory() {
        return $this->story;
    }
    
    public function setStory( $story ) {
        $this->story = $story;
    }
    
     public function getTags() {
        return $this->tags;
    }
    
    public function setTags( $tags ) {
        $this->tags = $tags;
    }
    
     public function getCredit() {
        return $this->credit;
    }
    
    public function setCredit( $credit ) {
        $this->credit = $credit;
    }
     
    public function __toString() {
        $s = '';
        $s .= sprintf("        <tr><td>%s</td>"
                . "<td>%s</td>"
                . "<td><img src='getImage.php'/></td>"
                . "<td>%s</td>"
                . "<td>%s</td></tr>\n"
                , $this->getCaption()
                , $this->getStory()
                , $this->getTags()
                , $this->getCredit());
        return $s;
    }
}

