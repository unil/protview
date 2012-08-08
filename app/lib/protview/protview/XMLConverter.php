<?php

class XMLConverter {
	private $encoding = 'UTF-8';
	private $xml_root_node = 'resultset';
	private $xml_default_node = 'item';
	
	public function write($data) {
		return $this->encode_xml($data);
	}
	
	
	private function encode_xml($data) {
		$result = $this->encode_xml_nodes($data);
		/*if ($this->xml_root_node) {
			$open_tag = $this->xml_root_node;
			$close_tag = array_shift(explode(' ', $this->xml_root_node));
			$xml = "<{$open_tag}>{$result}</{$close_tag}>";
		} else {
			$xml = $result;
		}*/
		$xml = $result;
		return "<?xml version=\"1.0\" encoding=\"{$this->encoding}\"?>\r\n{$xml}";
	}
	
	private function encode_xml_nodes($data) {
		if (!is_array($data)) return $data;
		$r = '';
		foreach ($data as $tag => $value) {
			// Extracts tag:
			$open_tag = $tag;
			$close_tag = array_shift(explode(' ', $tag));
			if (is_array($value)) $value = $this->encode_xml_nodes($value);
			else $value = "<![CDATA[{$value}]]>";
			if (is_numeric($tag)) $open_tag = $close_tag = $this->xml_default_node;
			$r .= "<{$open_tag}>{$value}</{$close_tag}>";
		}
		return $r;
	}
	
	private function encode_xmlrpc($data) {
		if (!function_exists('xmlrpc_encode')) throw new xException("XMLRPC encoding unavailable", 501);
		return xmlrpc_encode($data);
	}

	public function getEncoding()
	{
	    return $this->encoding;
	}

	public function setEncoding($encoding)
	{
	    $this->encoding = $encoding;
	}

	public function getXml_root_node()
	{
	    return $this->xml_root_node;
	}

	public function setXml_root_node($xml_root_node)
	{
	    $this->xml_root_node = $xml_root_node;
	}

	public function getXml_default_node()
	{
	    return $this->xml_default_node;
	}

	public function setXml_default_node($xml_default_node)
	{
	    $this->xml_default_node = $xml_default_node;
	}
}

?>