<?php

namespace Ephp\UtilityBundle\PhpWord;

class HtmlConverter {

    var $docFile = "";
    var $title = "";
    var $head = "";
    var $content = "";

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct($title = 'Untitled Document', $head = '', $content = '') {
        $this->title = $title;
        $this->docFile = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $title).'.doc';
        $this->head = $head;
        $this->content = $content;
    }

    /**
     * Set the document file name
     *
     * @param String $docfile 
     */
    public function setDocFileName($docfile) {
        $this->docFile = $docfile;
        if (!preg_match("/\.doc$/i", $this->docFile))
            $this->docFile.=".doc";
        return;
    }

    public function setTitle($title) {
        $this->title = $title;
        $this->docFile = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $title).'.doc';
    }

    /**
     * Create The MS Word Document from given HTML
     *
     * @param String $html :: URL Name like http://www.example.com
     * @param String $file :: Document File Name
     * @param Boolean $download :: Wheather to download the file or save the file
     * @return boolean 
     */
    public function createDocFromURL($url, $file, $download = false) {
        if (!preg_match("/^http:/", $url))
            $url = "http://" . $url;
        $html = @file_get_contents($url);
        return $this->createDoc($html, $file, $download);
    }

    /**
     * Create The MS Word Document from given HTML
     *
     * @param String $html :: HTML Content or HTML File Name like path/to/html/file.html
     * @param String $file :: Document File Name
     * @param Boolean $download :: Wheather to download the file or save the file
     * @return boolean 
     */
    public function createDoc($html) {
        if (is_file($html)) {
            $html = @file_get_contents($html);
        }

        $this->_parseHtml($html);

        return array(
            'title' => $this->title,
            'head' => $this->head,
            'content' => $this->content,
            'filename' => $this->docFile,
        );
    }

    /**
     * Parse the html and remove <head></head> part if present into html
     *
     * @param String $html
     * @return void
     * @access Private
     */
    public function _parseHtml($html) {
        $i = 0;
        $html = preg_replace('/<!DOCTYPE((.|\n)*?)>/ims', '', $html);
        $html = preg_replace('/<script((.|\n)*?)>((.|\n)*?)<\/script>/ims', '', $html);
        preg_match('/<head>[^\§]+<\/head>/ims', $html, $matches);
        $head = $matches[0];
        preg_match('/<title>[^\§]+<\/title>/ims', $head, $matches);
        $this->title = preg_replace('/<\/?title>/ims', '', $matches[0]);
        $head = preg_replace('/<title>[^\§]+<\/title>/ims', '', $head);
        $head = preg_replace('/<\/?head>/ims', '', $head);
        $head = preg_replace('/<!\-\-\[^\§]+\-\->/', '', $head);
        $html = preg_replace('/<head>[^\§]+<\/head>/ims', '', $html);
        $html = preg_replace('/[^<]+<html/ims', '<html', $html);
        $html = preg_replace('/<\/?html((.|\n)*?)>/ims', '', $html);
        $html = preg_replace('/<\/?body((.|\n)*?)>/ims', '', $html);
        $html = preg_replace('/<!\-\-\[^\§]+\-\->/', '', $html);
        $this->head = trim($head);
        $this->content = trim($html);
        return;
    }

    /**
     * Write the content int file
     *
     * @param String $file :: File name to be save
     * @param String $content :: Content to be write
     * @param [Optional] String $mode :: Write Mode
     * @return void
     * @access boolean True on success else false
     */
    public function write_file($file, $content, $mode = "w") {
        $fp = @fopen($file, $mode);
        if (!is_resource($fp))
            return false;
        fwrite($fp, $content);
        fclose($fp);
        return true;
    }

}
