<?php
/* -----------------------------------------------------------------------------------------
   VamShop - http://vamshop.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2014 VamSoft Ltd.
   License - http://vamshop.com/license.html
   ---------------------------------------------------------------------------------------*/

function default_template_discount_list()
{
    $template = '            
            {foreach from=$discounts item=discount}
                {if $discount@first} <div class="inner"> {/if}            
                      <div> <b>{lang}при заказе от {/lang} {$discount.quantity} - {product_price price=$discount.price} </b> </div>
                {if $discount@last} </div> {/if}
            {/foreach}
    ';
    return $template;
}


function smarty_function_discount_list($params)
{    
    global $content;   
    $discounts = null;    
    App::uses('SmartyComponent', 'Controller/Component');
    $Smarty =& new SmartyComponent(new ComponentCollection());
    
    App::uses('OrderBaseComponent', 'Controller/Component');
    $OrderBase =& new OrderBaseComponent(new ComponentCollection());

    if (isset($params['product_id'])) //Для каталога
    { 
        $discounts = $OrderBase->get_price_product($params['product_id']);
    }
    else //Для карточки товара
    {   
        $discounts = $OrderBase->get_price_product($content['Content']['id']);
    }
    
    $assignments = array();
    $assignments = array('discounts' => $discounts['ContentProductPrice']);
    $display_template = $Smarty->load_template($params, 'discount_list');
    $Smarty->display($display_template, $assignments);
}

function smarty_help_function_discount_list() 
{
    ?>
    <h3><?php echo __('What does this tag do?') ?></h3>
    <p><?php echo __('Displays discountes list.') ?></p>
    <h3><?php echo __('How do I use it?') ?></h3>
    <p><?php echo __('Just insert the tag into your template/page like:') ?> <code>{discount_list}</code></p>
    <h3><?php echo __('What parameters does it take?') ?></h3>
    <ul>
        <li><em><?php echo __('(template)') ?></em> - <?php echo __('Overrides the default template.') ?></li>
    	<li><em><?php echo __('(product_id)') ?></em> - <?php echo __('Product ID.') ?></li>
      </ul>
    <?php
}

function smarty_about_function_discount_list() 
{
}
?>
