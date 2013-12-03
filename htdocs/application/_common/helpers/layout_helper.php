<?php

function include_title()
{
    if (!($layout =& get_layout())) return;

	echo '<title>' . $layout->get_title() . '</title>';
}

function include_javascripts()
{
    if (!$layout =& get_layout()) return;
    $CI =& get_instance();
    
	foreach ($layout->get_javascripts() as $file_name)
    {
        echo '<script type="text/javascript" src="' . base_url() . $CI->config->item('js_dir') . '/' . $file_name . '.js"></script>' . "\n";
    }
}

function include_stylesheets()
{
    if (!$layout =& get_layout()) return;
    $CI =& get_instance();
    
    foreach ($layout->get_stylesheets() as $item)
    {
        echo '<link rel="stylesheet" type="text/css"  href="' . base_url() . $CI->config->item('css_dir') . '/' . $item['file_name'] . '.css" media="' . $item['media'] . '"/>' . "\n";
    }
}

function include_metas()
{
    if (!$layout =& get_layout()) return;

	foreach ($layout->get_metas() as $name => $meta_content)
    {
        echo '<meta name="' . $name . '" content="' . $meta_content . '" />' . "\n";
    }
    foreach ($layout->get_http_metas() as $name => $meta_content)
    {
        echo '<meta http-equiv="' . $name . '" content="' . $meta_content . '" />' . "\n";
    }
}

function include_links()
{
    if (!$layout =& get_layout()) return;

	foreach ($layout->get_links() as $arributes)
    {
        $link = '<link ';    	
        foreach ($attributes as $name => $value)
        {
            $link .= $name . '="' . $value . '" ';
        }
        $link .= '/>' . "\n";
         
        echo $link;
    }
}

function &get_layout()
{
    $CI =& get_instance();
        
    if (!isset($CI->layout))
    {
    	return false;
    }
    return $CI->layout;
}

?>