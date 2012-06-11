<?php 

function bc_display_filters() {
	$request = Zend_Controller_Front::getInstance()->getRequest(); 
	$requestArray = $request->getParams();
	$db = get_db();
	$displayArray = array();
	foreach ($requestArray as $key => $value) {
	    $filter = $key;
	    if($value != null) {
	    	$displayValue = null;
	    	switch ($key) {	    		
	    		case 'type':
	    			$filter = 'Item Type';
	    			$itemtype = $db->getTable('ItemType')->find($value);
	    			$displayValue = $itemtype->name;
	    			break;
	    		
	    	 	case 'collection':					
	    	    	$collection = $db->getTable('Collection')->find($value);
	    	    	$displayValue = $collection->name;
	    	    	break;

	    		case 'user':
	    	    	$user = $db->getTable('User')->find($value);
	    	    	$displayValue = $user->Entity->getName();
	    	    	break;

	    	    case 'public':
	    	    case 'featured':
	    	    	if($value==1) { 
	    	    		$displayValue = 'yes';
	    	    	} else {
	    	    		$displayValue = 'no';
	    	    	}
	    	    	break;
	    	    	
	    	    case 'search':
	    	    case 'tags':
	    	    case 'range':
	    	    	$displayValue = $value;
	    	    	break;
	    	}
			if ($displayValue) {
				$displayArray[$filter] = $displayValue;
			}
	    }
	}
  	if(array_key_exists('advanced', $requestArray)) {
	    $advancedArray = array();
	    foreach ($requestArray['advanced'] as $i => $row) {
	        if (!$row['element_id'] || !$row['type']) {
	        	continue;
	        }
	        $elementID = $row['element_id'];
	        $elementDb = $db->getTable('Element')->find($elementID);
	        $element = $elementDb->name;
	        $type = $row['type'];
	        $terms = $row['terms'];
	        $advancedValue = $element . ' ' . $type;
	        if ($terms) {
	        	$advancedValue .= ' "' . $terms . '"';
	        }
	    	$advancedArray[$i] = $advancedValue; 
	    	/* Advanced needs a separate array from $displayValue because it's 
	    	   possible for "Specific Fields" to have multiple values due to 
	    	   the ability to add fields. */
	    }
	} 
	if (!empty($displayArray) || !empty($advancedArray)) {
		$html = '<div class="filters">';
		$html .= '<ul id="filter-list">';
		foreach($displayArray as $name => $query) {
			$html .= '<li id="' . $name . '">' . ucfirst($name) . ': ' . $query . '</li>';
		}
		if(!empty($advancedArray)) {
			foreach($advancedArray as $j => $advanced) {
				$html .= '<li id="advanced">' . $advanced . '</li>';
			}
		}
		$html .= '</ul>';
		$html .= '</div>';
		echo $html;
	}
}

function bc_link_to_items_with_element_text($text = null, $props = array(), $action = 'browse', $elementId = null, $elementText = null) {
    $queryParams = array();
    $queryParams['advanced'][0]['element_id'] = $elementId;
    $queryParams['advanced'][0]['type'] = 'contains';
    $queryParams['advanced'][0]['terms'] = $elementText;

    if ($text === null) {
        $text = $elementText;
    }
    
    return link_to('items', $action, $text, $props, $queryParams);
    }

?>