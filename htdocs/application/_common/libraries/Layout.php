<?php

class Layout {

    var $layout;
    var $title;
    var $javascripts = array();
    var $stylesheets = array();
    var $metas = array();
    var $http_metas = array();
    var $links = array();
    
    var $data = array();

    var $enabled = true;
    
    /**
     * Controller
     *
     * @return Layout
     */
    function Layout()
    {
        $CI =& get_instance();
        
        $this->template = $CI->config->item('default_layout');

        $this->title = $CI->config->item('default_title');

        $this->set_javascripts($CI->config->item('javascripts'));
        $this->set_stylesheets($CI->config->item('stylesheets'));

        $this->set_metas($CI->config->item('metas'));
        
        if ($CI->config->item('keywords'))
        {
            $this->set_meta('keywords', $CI->config->item('keywords'));
        }
        if ($CI->config->item('description'))
        {
            $this->set_meta('description', $CI->config->item('description'));
        }
        
        $this->set_http_metas($CI->config->item('metas'));

        $this->set_links($CI->config->item('links'));
        
        $this->set('current_tab',0);
    }
    
    /**
     * Enable/disable layouts. If arguments isn't passed then returns the current state.
     *
     * @param boolean $flag
     * @return null
     */
    function enabled($flag = null)
    {
        if ($flag !== null)
        {
            $this->enabled = (bool) $flag;
        }
        else
        {
            return $this->enabled;
        }
    }

    /**
     * Set a layout template name
     *
     * @param string $template template name
     */
    function set_layout($template)
    {
        $this->template = $template;
    }

    /**
     * Returns a layout template name  
     * 
     * @return string
     */
    function get_layout()
    {
        return $this->template;
    }
    
    /**
     * Sets the current tab
     *
     * @param string the tab name
     */
     function set_tab($tab)
     {
	     // This array maps the names of tabs to their position in the layout
	     $tab_positions = array(
	     	'home'=>0,
	     	'films'=>1,
	     	'best_practices'=>2,
	     	'news'=>3,
	     	'placements'=>4,
	     	'help'=>5
	     );
	     
	     if(isset($tab_positions[$tab]))
	    	$this->set('current_tab',$tab_positions[$tab]);
     }
    
    /**
     * Assigns a variable for a layout template
     * 
     * @param string $name
     * @param mix $value
     *
     */
    function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Returns value of a variable for a layout template
     * 
     * @param string $name
     * @return mix
     */
    function get($name)
    {
        return $this->data[$name];
    }

    /**
     * Returns all variables for a layout template in an associative array
     * 
     * @return array
     */
    function getAll()
    {
        return $this->data;
    }

    /**
     * Sets content of the <title> tag
     * 
     * @param string $title
     */
    function set_title($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns content of the <title> tag  
     * 
     * @return string
     */
    function get_title()
    {
        return $this->title;
    }
    
    /**
     * Sets JavaScripts. The $javascripts param must be an array of file names without paths and extensions
     *
     * @param array $javascripts
     */
    function set_javascripts($javascripts)
    {
        $javascripts = empty($javascripts) ? array() : (array) $javascripts;
        $this->javascripts = $javascripts;
    }

    /**
     * Sets JavaScripts. The $javascripts param must be an array of file names
     * or a string contains a file name (in case if we need to set only one script).
     * File names must be without paths and extensions. 
     *
     * @param array $javascripts
     */
    function add_javascripts($javascripts)
    {
        $javascripts = (array) $javascripts;
        $this->javascripts = array_merge($this->javascripts, $javascripts);
    }
		
		/**
		 * Adds a Javascript file to the output header.
		 *
		 * @param string $script The path to the script ot add, without paths and extensions.
		 */
		function add_javascript($script)
		{
			$this->add_javascripts($script);
		}

    /**
     * Removes all JS scripts
     *
     */
    function clean_javascripts()
    {
        $this->javascripts = array();
    }
    
    /**
     * Returns names of JavaScripts.
     *
     * @return array
     */
    function get_javascripts()
    {
        return $this->javascripts;
    }

    /**
     * Sets stylesheets. The $stylesheets param must be an array of file names
     * or a string contains a file name (in case if we need to set only one script).
     * File names must be without paths and extensions.
     * If we need to set media attribute with a value different from 'all',
     * then it can be defined after the file name separated with '|'.
     * For example: array('style', 'print_style|print', 'screen_style|screen')
     *
     * @param array $stylesheets
     */
    function set_stylesheets($stylesheets)
    {
        $this->clean_stylesheets();
        $this->add_stylesheets($stylesheets);
    }

    /**
     * Adds stylesheets without removing existing values.
     * The $stylesheets param must be an array of file names
     * or a string contains a file name (in case if we need to set only one script).
     * File names must be without paths and extensions.
     * If we need to set media attribute with a value different from 'all',
     * then it can be defined after the file name separated with '|'.
     * For example: array('style', 'print_style|print', 'screen_style|screen')
     *
     * @param array $stylesheets
     */
    function add_stylesheets($stylesheets)
    {
        $stylesheets = empty($stylesheets) ? array() : (array) $stylesheets;

        foreach ($stylesheets as $item)
        {
            $parts = explode('|', $item);
            $file_name = $parts[0];
            $media = isset($parts[1]) ? $parts[1] : null;

            $this->add_stylesheet($file_name, $media);
        }
    }

    /**
     * Adds a stylesheet
     *
     * @param string $file_name
     * @param string $media
     */
    function add_stylesheet($file_name, $media = 'all')
    {
        $this->stylesheets[] = array(
            'file_name' => $file_name,
            'media' => $media,
        );
    }
	
 /**
     * Removes a stylesheet
     *
     * @param string $file_name
     * @param string $media
     */
    function remove_stylesheet($file_name)
    {
		if(isset($this->stylesheets) && is_array($this->stylesheets))
		{
			foreach($this->stylesheets as $key => $style)
			{
				if($style['file_name'] == $file_name)
				{
					unset($this->stylesheets[$key]);
				}
			}
			/*
			echo "<pre>";
			print_r($this->stylesheets);
			echo "</pre>";
			*/
		}
    }

    /**
     * Removes all stylesheets
     *
     */
    function clean_stylesheets()
    {
        $this->stylesheets = array();
    }
    
    /**
     * Returns all stylesheets
     *
     * @return array
     */
    function get_stylesheets()
    {
        return $this->stylesheets;
    }

    /**
     * Sets keywords
     *
     * @param string $keywords
     */
    function set_keywords($keywords)
    {
        $this->metas['keywords'] = $keywords;
    }

    /**
     * Adds keywords without removing existing values.
     *
     * @param string $keywords
     * @param string $sprt
     */
    function add_keywords($keywords, $sprt = ' ')
    {
        $this->metas['keywords'] = (isset($this->metas['keywords']) ? ($this->metas['keywords'] . $sprt) : '') . $keywords;
    }

    /**
     * Removes all keywords
     *
     */
    function clean_keywords()
    {
        if (isset($this->metas['keywords']))
        {
            unset($this->metas['keywords']);
        }
    }
    
    /**
     * Returns keywords
     *
     */
    function get_keywords()
    {
        return isset($this->metas['keywords']) ? $this->metas['keywords'] : null; 
    }

    /**
     * Set all meta tags. The $metas param must be an associative array of name => content pairs
     * For example: array('robots' => 'INDEX, FOLLOW', 'title' => 'Project title') 
     *
     * @param array $metas
     */
    function set_metas($metas)
    {
        $metas = empty($metas) ? array() : (array) $metas;
        $this->metas = $metas;
    }

    /**
     * Set single meta tag.  
     * 
     * @param string $name
     * @param string $content
     */
    function set_meta($name, $content)
    {
        $this->metas[$name] = $content;
    }

    /**
     * Append a given $content to existing one of meta tag $name  
     * 
     * @param string $name
     * @param string $content
     */
    function add_meta($name, $content, $sprt = ' ')
    {
        $this->metas[$name] = (isset($this->metas[$name]) ? $this->metas[$name] : '') . $sprt . $content;
    }

    /**
     * Removes all meta tags
     * 
     */
    function clean_metas($name = null)
    {
        if ($name !== null)
        {
            unset($this->metas[$name]);  
        }
        else
        {
            $this->metas = array();
        }
    }

    /**
     * Returns all meta tags
     *
     * @param unknown_type $name
     * @return unknown
     */
    function get_metas($name = null)
    {
        if ($name !== null)
        {
            return isset($this->metas[$name]) ? $this->metas[$name] : null; 
        }

        return $this->metas; 
    }

    /**
     * Set all http-equiv meta tags. The $metas param must be an associative array of name => content pairs
     * For example: array('robots' => 'INDEX, FOLLOW', 'title' => 'Project title') 
     *
     * @param array $metas
     */
    function set_http_metas($metas)
    {
        $metas = empty($metas) ? array() : (array) $metas;
        $this->http_metas = $metas;
    }

    /**
     * Set single meta http-equiv tag.  
     * 
     * @param string $name
     * @param string $content
     */
    function set_http_meta($name, $content)
    {
        $this->http_metas[$name] = $content;
    }

    /**
     * Append a given $content to existing one of meta http-equiv tag $name  
     * 
     * @param string $name
     * @param string $content
     */
    function add_http_meta($name, $content, $sprt = ', ')
    {
        $this->metas[$name] = (isset($this->metas[$name]) ? $this->metas[$name] : '') . $sprt . $content;
    }
        
    /**
     * Removes all meta http-equiv tags  
     * 
     */
    function clean_http_metas($name = null)
    {
        if ($name !== null)
        {
            unset($this->http_metas[$name]);  
        }
        else
        {
            $this->http_metas = array();
        }
    }

    /**
     * Returns all meta http-equiv tags  
     * 
     */
    function get_http_metas($name = null)
    {
        if ($name !== null)
        {
            return isset($this->http_metas[$name]) ? $this->http_metas[$name] : null; 
        }

        return $this->http_metas;
    }

    /**
     * Set all <link> tags. The $links param must be an array of associative arrays with attributes
     * for links (arrtibute_name => arrtibute_value pairs).
     *
     * @param array $links
     */
    function set_links($links)
    {
        $links = empty($links) ? array() : (array) $links;
        
        $this->links = $links;
    }

    /**
     * Add a <link> tag. Takes associative array of arrtibute_name => arrtibute_value pairs 
     *
     * @param array $attr
     */
    function add_link($attr)
    {
        $this->links[] = $attr;
    }

    /**
     * Removes all <link> tags
     *
     */
    function clean_links()
    {
        $this->links = array();
    }

    /**
     * Returns all links
     *
     * @return array
     */    
    function get_links()
    {
        return $this->links;
    }
    
    /**
     * Method for placing in display_override hook.
     * 
     * Example:
     * <pre> 
     * $hook['display_override'][] = array(
     *     'class'    => 'Layout',
     *     'function' => 'execute',
     *     'filename' => 'Layout.php',
     *     'filepath' => 'libraries',
     *     'params'   => array()
     * );
     * </pre>
     */
    function execute($incontent='')
    {
        $CI =& get_instance();
        
        if (!isset($CI->layout) || !$CI->layout->enabled())
        {
            // skip layout output
            $CI->output->_display();
            return;
        }
        
        // layout instance in the current controller
        $layout = $CI->layout;

        $content = $CI->output->get_output();
        $CI->output->set_output('');
        
        $data = $layout->getAll();
        $data['content'] = $content;
        
        if(!empty($incontent))
        	$data['content'] = $incontent;
        
        $CI->load->view($layout->get_layout(), $data);
        $CI->output->_display();
    }

}

?>