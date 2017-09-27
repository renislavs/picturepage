<?php
/**
 * Description of Photo
 * @author MN
 * example from textbook, Doyle, 2010
 */
class Photo {
    private $caption;
    private $credit;
    private $id;
    private $imagedata;
    private $mimetype;
    private $story;
    private $tags;
    private $votes;

    function __construct($caption, $credit, $id, $imagedata, $mimetype, $story, $tags) {
        $this->caption = $caption;
        $this->credit = $credit;
        $this->id = $id;
        $this->imagedata = $imagedata;
        $this->mimetype = $mimetype;
        $this->story = $story;
        $this->tags = $tags;
        $this->votes = 0;
    }
    
    public function __toString() {
        $s = '';
        $s .= sprintf("<img src='getImage.php?id=%s />\n"
                        , $this->getid());
        return $s;
    }
 
    function getCaption() {
        return $this->caption;
    }

    function getVotes() {
        return $this->votes;
    }

    function setVotes($votes) {
        $this->votes = $votes;
    }

    function getCredit() {
        return $this->credit;
    }

    function getId() {
        return $this->id;
    }

    function getImagedata() {
        return $this->imagedata;
    }

    function getMimetype() {
        return $this->mimetype;
    }

    function getStory() {
        return $this->story;
    }

    function getTags() {
        return $this->tags;
    }

    function setCaption($caption) {
        $this->caption = $caption;
    }

    function setCredit($credit) {
        $this->credit = $credit;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setImagedata($imagedata) {
        $this->imagedata = $imagedata;
    }

    function setMimetype($mimetype) {
        $this->mimetype = $mimetype;
    }

    function setStory($story) {
        $this->story = $story;
    }

    function setTags($tags) {
        $this->tags = $tags;
    }
}