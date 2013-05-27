<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

$this->Html->script(array(
	'jquery/plugins/jquery.zrssfeed.min.js',
), array('inline' => false));
?>
<?php echo $this->Html->scriptBlock('
$(document).ready(function () {
	$("#news").rssfeed("http://vamcart.com/modules/news/backendt.php?topicid=2", {
		header: false,
		date: false,
		content: false,
		limit: 1,
	});
});
', array('allowCache'=>false,'safe'=>false,'inline'=>false)); ?>
<?php
	echo $this->admin->ShowPageHeaderStart(__('Home',true), 'cus-house');

	echo '<div id="news"></div>';

			echo '<ul id="myTab" class="nav nav-tabs">';
			echo $this->admin->CreateTab('home',__('Menu',true), 'cus-chart-organisation');
			if($level == 1) {
			echo $this->admin->CreateTab('orders',__('Orders',true), 'cus-chart-bar');
			}			
			echo '</ul>';

	echo $this->admin->StartTabs();
	
	echo $this->admin->StartTabContent('home');

			// If we're on the top level then assign the rest of the elements as menu children
			if($level == 1)
			{
				$tmp_navigation = array();
			
				$navigation[1] = null; // Removes the home page from being displayed below
				
				foreach($navigation AS $tmp_nav)
				{
					if(!empty($tmp_nav))
						$tmp_navigation[$level]['children'][] = $tmp_nav;
				}
				$navigation = $tmp_navigation;
			
			}
			
			if(!empty($navigation[$level]['children']))
			{
				$level_navigation = $navigation[$level]['children'];
				foreach($level_navigation AS $nav)
				{
					echo '<div class="page_menu_item" class="">
							<p class="heading">' . $this->admin->MenuLink($nav, array('escape' => false)) . '</p>';
					if(!empty($nav['children']))
					{
						$sub_items = '';
						foreach($nav['children'] AS $child)
						{
							$sub_items .= $this->admin->MenuLink($child, array('escape' => false)) . ', ';
						}
						$sub_items = rtrim($sub_items, ', ');
						echo $sub_items;
					}
					echo '</div>';
				}
			}

		echo $this->admin->EndTabContent();

		if($level == 1) {
				
		echo $this->admin->StartTabContent('orders');

                echo $this->flashChart->begin(); 
                if(isset($result['day']['dat']))
                {
                    $this->flashChart->setData($result['day']['summ'],'{n}',false,'Sum_1','stat_day');		
                    $this->flashChart->setData($result['day']['cnt'],'{n}',false,'Count_1','stat_day');              
                } 
                else $this->flashChart->setData(array('0'),'{n}',false,'null','stat_day');
                if(isset($result['month']['dat']))
                {
                    $this->flashChart->setData($result['month']['summ'],'{n}',false,'Sum_2','stat_month');		
                    $this->flashChart->setData($result['month']['cnt'],'{n}',false,'Count_2','stat_month');
                }
                else $this->flashChart->setData(array('0'),'{n}',false,'null','stat_month'); 
                
                echo '<table class="contentTable"><tr><td><div id="stat_day">';
			
			$this->flashChart->setTitle(__('Sales statistics', true).': '.__('day', true),'{color:#000;font-size:18px;}');
			$this->flashChart->axis('x',array('labels' => $result['day']['dat']),array('vertical' => true));
                        $this->flashChart->axis('y',array('range' => array(0,max($result['day']['summ']),max($result['day']['summ'])/10), 'colour'=>'#0077cc'));
                        $this->flashChart->rightAxis(array('range' => array(0,max($result['day']['cnt']),max($result['day']['cnt'])/10), 'colour'=>'#ff9900'));
			if(isset($result['day']['dat']))
                        {
                            echo $this->flashChart->chart('line',array('colour'=>'#0077cc','width'=>'2','line_style' => 'solid-dot','set_key' => array(__('Sum', true),14)),'Sum_1','stat_day');
                            echo $this->flashChart->chart('line',array('colour'=>'#ff9900','width'=>'2','right' => 'true','set_key' => array(__('Amount', true),14)),'Count_1','stat_day');	
                        }
                        else echo $this->flashChart->chart('line',array('colour'=>'#0077cc','width'=>'2'),'null','stat_day');
			echo $this->flashChart->render('100%','300','stat_day','stat_day');
                        
                echo '</div></td><td><div id="stat_month">';                       
			
                        $this->flashChart->setTitle(__('Sales statistics', true).': '.__('month', true),'{color:#000;font-size:18px;}');
                        $this->flashChart->axis('x',array('labels' => $result['month']['dat']),array('vertical' => true));
                        $this->flashChart->axis('y',array('range' => array(0,max($result['month']['summ']),max($result['month']['summ'])/10), 'colour'=>'#0077cc'));
                        $this->flashChart->rightAxis(array('range' => array(0,max($result['month']['cnt']),max($result['month']['cnt'])/10), 'colour'=>'#ff9900'));
                        if(isset($result['month']['dat']))
                        {
                            echo $this->flashChart->chart('line',array('colour'=>'#0077cc','width'=>'2','line_style' => 'solid-dot','set_key' => array(__('Sum', true),14)),'Sum_2','stat_month');
                            echo $this->flashChart->chart('line',array('colour'=>'#ff9900','width'=>'2','right' => 'true','set_key' => array(__('Amount', true),14)),'Count_2','stat_month');	
                        } 
                        else echo $this->flashChart->chart('line',array('colour'=>'#0077cc','width'=>'2'),'null','stat_month');
			echo $this->flashChart->render('100%','300','stat_month','stat_month');
                echo '</div></td></tr></table>';
                
		echo $this->admin->EndTabContent();
		
		}
	echo $this->admin->EndTabs();
	
	echo $this->admin->ShowPageHeaderEnd();
	
?>