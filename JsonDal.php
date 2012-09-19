<?php

namespace com;

class JsonDal {
	
	/**************************************************************
	 *
	*    ʹ���ض�function������������Ԫ��������
	*    @param    string    &$array        Ҫ������ַ���
	*    @param    string    $function    Ҫִ�еĺ���
	*    @return boolean    $apply_to_keys_also        �Ƿ�ҲӦ�õ�key��
	*    @access public
	*
	*************************************************************/
	function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
	{
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$this->arrayRecursive($array[$key], $function, $apply_to_keys_also);
			} else {
				$array[$key] = $function($value);
			}
	
			if ($apply_to_keys_also && is_string($key)) {
				$new_key = $function($key);
				if ($new_key != $key) {
					$array[$new_key] = $array[$key];
					unset($array[$key]);
				}
			}
		}
	}
	
	/**************************************************************
	 *
	*    ������ת��ΪJSON�ַ������������ģ�
	*    @param    array    $array        Ҫת��������
	*    @return string        ת���õ���json�ַ���
	*    @access public
	*
	*************************************************************/
	function JSON($array) {
		$this->arrayRecursive($array, 'urlencode', true);
		$json = json_encode($array);
		return urldecode($json);
	}
}

?>