<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends DV_Controller {


	
	public function index()
	{
		$out = '';
		$xmlUrl = "http://localhost/Pati_dev/uploads/nokaut.xml"; // XML feed file/URL
$xmlStr = file_get_contents($xmlUrl);
$xmlObj = simplexml_load_string($xmlStr);
$arrXml = $this->objectsIntoArray($xmlObj);
$out .= '<div style="font-size:20px;">Cena produktu: ';
$out .= $arrXml['offers']['offer'][0]['price'];
$out .= '</div>';
echo $out;
			
	}
	
	function objectsIntoArray($arrObjData, $arrSkipIndices = array())
{
    $arrData = array();
   
    // if input is object, convert into array
    if (is_object($arrObjData)) {
        $arrObjData = get_object_vars($arrObjData);
    }
   
    if (is_array($arrObjData)) {
        foreach ($arrObjData as $index => $value) {
            if (is_object($value) || is_array($value)) {
                $value = $this->objectsIntoArray($value, $arrSkipIndices); // recursive call
            }
            if (in_array($index, $arrSkipIndices)) {
                continue;
            }
            $arrData[$index] = $value;
        }
    }
    return $arrData;
}

}

/* End of file start.php */
/* Location: ./modules/start/controllers/start.php */