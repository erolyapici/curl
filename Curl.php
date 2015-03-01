<?php

/**
 * Created by PhpStorm.
 * User: eyapici
 * Date: 24/02/15
 * Time: 21:46
 */

class Curl {

    private $ch;
    private $timeout = 90;
    private $error;
    private $error_no;

    /**
     * @param $url
     */
    public function __construct($url){
        $this->ch = curl_init();
        $this->setUrl($url);
        $this->setTimeOut($this->timeout);
    }

    /**
     * @param $url
     */
    public function setUrl($url){
        curl_setopt($this->ch, CURLOPT_URL, $url);
    }

    /**
     * @param $data
     */
    public function setPost($data){
        curl_setopt($this->ch, CURLOPT_POST, count($data));
    }

    /**
     * @param $data
     */
    public function setPostFields($data){
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }

    /**
     * @param $method
     */
    public function setCustomRequest($method){
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
    }

    /**
     * @param $header
     */
    public function setHttpHeader(array$header){
        curl_setopt($this->ch, CURLOPT_HTTPHEADER,$header);
    }

    /**
     * @param boolean $val
     */
    public function setReturnTransfer($val){
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,$val);
    }
    /**
     * @param boolean $val
     */
    public function setSSLVerifypeer($val){
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER,$val);

    }
    /**
     * @param int $val
     */
    public function setTimeOut($val){
        curl_setopt($this->ch, CURLOPT_TIMEOUT,$val);

    }
    /**
     * @param int $val
     */
    public function setConnectTimeOut($val){
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT,$val);

    }

    /**
     * @return bool|mixed
     */
    public function getResponse(){
        if($this->ch != null){
            $jsonData = curl_exec($this->ch);
            if (false === $jsonData) {
                $this->setError(curl_error($this->ch));
                $this->setErrorNo(curl_errno($this->ch));
            }
            return $jsonData;
        }
        return false;
    }

    public function close(){
        curl_close($this->ch);
    }
    /**
     * @param $error
     */
    public function setError($error){
        $this->error = $error;
    }
    /**
     * @return mixed
     */
    public function getError(){
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getErrorNo(){
        return $this->error_no;
    }

    /**
     * @param $error_no
     */
    public function setErrorNo($error_no){
        $this->error_no = $error_no;
    }
}