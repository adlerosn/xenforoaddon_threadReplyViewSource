<?php

class threadReplyViewSource_admincpStatic {
	public static function render_AdminCP_CustomLinksAdder(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit){
		$t = $preparedOption['option_value'];
		
		$choices = array();
		foreach($t as $entry){
			$choices[] = array(
				'0' => is_string($entry) ? $entry : ''
			);
		}

		$editLink = $view->createTemplateObject('option_list_option_editlink', array(
			'preparedOption' => $preparedOption,
			'canEditOptionDefinition' => $canEdit
		));

		return $view->createTemplateObject('kiror_option_template_custom_bbcode_sourceview', array(
			'fieldPrefix' => $fieldPrefix,
			'listedFieldName' => $fieldPrefix . '_listed[]',
			'preparedOption' => $preparedOption,
			'formatParams' => $preparedOption['formatParams'],
			'editLink' => $editLink,

			'choices' => $choices,
			'nextCounter' => count($choices)
		));
	}
	
	public static function verifier_AdminCP_CustomLinksAdder(array &$links, XenForo_DataWriter $dw, $fieldName){
		$output = array();

		foreach ($links AS $candidate){
			if (!isset($candidate)          ||
				!isset($candidate[0])       ||
				strlen($candidate[0])<=0    ){
				continue;
			}
			if ($candidate[0] && !in_array($candidate[0],$output)){
				$output[] = $candidate[0];
			}
		}

		$links = $output;

		return true;
	}
}
