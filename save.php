<?php
require('LoremIpsum.class.php');
$generator = new LoremIpsumGenerator();
$layout = explode(',',$_POST['layout']);
$elements = array();
$element_count = 0;
foreach ($layout as $element) {
	preg_match('/\d+_(.*)/',$element,$type);
	if(!empty($type[1])) {
		$elements[$element_count]['id'] = $type[1];
		$elements[$element_count]['class'] = $type[1];
		switch ($type[1]) {
			case 'span1':
			$elements[$element_count]['content'] =  '1';
			break;
			case 'span2':
			$elements[$element_count]['content'] = $generator->getContent(10, 'html', false);
			break;
			case 'span4':
			$elements[$element_count]['content'] = '<blockquote class="pull-right">'. $generator->getContent(50, 'plain', false) .'</blockquote>';
			break;
			case 'span6':
			$elements[$element_count]['content'] = $generator->getContent(100, 'html', false);
			break;
			case 'span8':
			$elements[$element_count]['content'] = $generator->getContent(200, 'html', false);
			break;
			case 'span12':
			$elements[$element_count]['content'] = $generator->getContent(500, 'html', false);
			break;
			default:
			if(preg_match('/\d+x\d+/', $type[1])) {
				$color = dechex(rand(0,4095));
				$elements[$element_count]['content'] = '<img alt="" class="thumbnail" src="http://placehold.it/'. $type[1] .'/'.$color.'/fff/&text='.$color.'">';
			}
			break;
			
		}
		$element_count++;
	}

}
echo json_encode($elements);

?>