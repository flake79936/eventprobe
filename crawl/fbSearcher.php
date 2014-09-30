<?php  
class facebookSearcher{
    protected    $_access_token; 
    protected    $_query; 
    protected    $_type; 
    protected    $_limit; 
    protected    $_nextPage; 
    protected    $_previousPage; 
     
    public function setAccessToken($value) { 
        $this->_access_token = $value; return $this; 
    } 
    public function setQuery($value) { 
        $this->_query = $value; return $this; 
    } 
    public function setLimit($value) { 
        $this->_limit = $value; return $this; 
    } 
    public function setType($value) { 
        $this->_type = $value; return $this; 
    } 
     
    // Build Graph Qurey 
    protected function buildQueryUrl(){ 
        //Validate 
        if(empty($this->_query)) throw new Exception("Query Not Set"); 
         
        //Build URL 
        $graphURL = "https://graph.facebook.com/search?q=".urlencode($this->_query); 
        if(isset($this->_type)) $graphURL .= "&type={$this->_type}"; 
        if(isset($this->_limit)) $graphURL .= "&limit={$this->_limit}"; 
        $graphURL .= "&access_token=".$this->_access_token; 
        return $graphURL; 
    } 
     
    /** 
     *  
     * Fetch Query Results 
     * @return Object 
     */ 
    public function fetchResults(){
        $result = json_decode(file_get_contents_curl( $this->buildQueryUrl() )); 
        //Load Previous and Next Pages 
         
        return $result; 
    }    
}

function file_get_contents_curl($url) {
    $ch = curl_init();
	
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
?>