<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 *
 * @download from  http://www.joelsays.com/downloads/jquery-pagination.zip
 */
class Ajax_pagination{

	var $base_url			= ''; // The page we are linking to
	var $total_rows  		= ''; // Total number of items (database results)
	var $per_page	 		= 10; // Max number of items you want shown per page
	var $num_links			=  2; // Number of "digit" links to show before/after the currently viewed page
	var $cur_page	 		=  0; // The current page being viewed
	var $first_link   		= '&lsaquo; First';
	var $next_link			= '&gt;';
	var $prev_link			= '&lt;';
	var $last_link			= 'Last &rsaquo;';
	var $uri_segment		= 3;
	var $full_tag_open		= '<div class="pagination">';
	var $full_tag_close		= '</div>';
	var $first_tag_open		= '';
	var $first_tag_close            = '&nbsp;';
	var $last_tag_open		= '&nbsp;';
	var $last_tag_close		= '';
	var $cur_tag_open		= '&nbsp;<b>';
	var $cur_tag_close		= '</b>';
	var $next_tag_open		= '&nbsp;';
	var $next_tag_close		= '&nbsp;';
	var $prev_tag_open		= '&nbsp;';
	var $prev_tag_close		= '';
	var $num_tag_open		= '&nbsp;';
	var $num_tag_close		= '';
	
	// Added By Tohin
	var $js_rebind 			= '';
	var $div                = '';
	var $postVar            = '';
        var $additional_param	= '';
    
        // Added by Sean
        var $anchor_class		= '';
        var $show_count      = true;

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	function CI_Pagination($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);		
		}
		
		log_message('debug', "Pagination Class Initialized");
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}		
		}
		
		// Apply class tag using anchor_class variable, if set.
		if ($this->anchor_class != '')
		{
			$this->anchor_class = 'class="' . $this->anchor_class . '" ';
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */	
	function create_links($tabela=null) 
	{
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
		   return '';
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
        //    $info = 'Showing : ' . $this->total_rows;
	//		return $info;
                    return '';
		}

		// Determine the current page number.		
		$CI =& get_instance();	
		if ($CI->uri->segment($this->uri_segment) != 0)
		{
			$this->cur_page = $CI->uri->segment($this->uri_segment);
			
			// Prep the current page - no funny business!
			$this->cur_page = (int) $this->cur_page;
		}

		$this->num_links = (int)$this->num_links;
		
		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}
				
		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = 0;
		}
		
		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}
		
		$uri_page_number = $this->cur_page;
		$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Add a trailing slash to the base URL if needed
		$this->base_url = rtrim($this->base_url, '/') .'/';

  		// And here we go...
		$output = '';

      // SHOWING LINKS
      if ($this->show_count)
      {
         $curr_offset = $CI->uri->segment($this->uri_segment);
         $info = '<div>De ' . number_format(( $curr_offset + 1 + ($this->per_page * ($this->cur_page - 1))),0,',','.') . ' até ' ;

         $atual = ($this->per_page * ($this->cur_page));
         
         if( $atual > $this->total_rows )
             $info .= number_format($this->total_rows,0,',','.');
         else
            $info .= $atual ;

         $info .= ' de ' . number_format($this->total_rows,0,',','.') . '</div>';
         
         $info = $this->first_tag_open 
                        . $this->getAJAXlink( '' , $info, $tabela)
                        . $this->first_tag_close;         

         $output .= $info;
      }

		// Render the "First" link
		if  ($this->cur_page > $this->num_links)
		{
			$output .= $this->first_tag_open 
					. $this->getAJAXlink( '' , $this->first_link, $tabela)
					. $this->first_tag_close; 
		}

		// Render the "previous" link
		if  ($this->cur_page != 1)
		{
			$i = $uri_page_number - $this->per_page;
			if ($i == 0) $i = '';
			$output .= $this->prev_tag_open 
					. $this->getAJAXlink( $i, $this->prev_link, $tabela )
					. $this->prev_tag_close;
		}

		// Write the digit links
		for ($loop = $start -1; $loop <= $end; $loop++)
		{
			$i = ($loop * $this->per_page) - $this->per_page;
					
			if ($i >= 0)
			{
				if ($this->cur_page == $loop)
				{
					$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
				}
				else
				{
					$n = ($i == 0) ? '' : $i;
					$output .= $this->num_tag_open
						. $this->getAJAXlink( $n, $loop, $tabela )
						. $this->num_tag_close;
				}
			}
		}

		// Render the "next" link
		if ($this->cur_page < $num_pages)
		{
			$output .= $this->next_tag_open 
				. $this->getAJAXlink( $this->cur_page * $this->per_page , $this->next_link, $tabela )
				. $this->next_tag_close;
		}

		// Render the "Last" link
		if (($this->cur_page + $this->num_links) < $num_pages)
		{
			$i = (($num_pages * $this->per_page) - $this->per_page);
			$output .= $this->last_tag_open . $this->getAJAXlink( $i, $this->last_link, $tabela) . $this->last_tag_close;
		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;
		
		return $output;		
	}

	function getAJAXlink( $count, $text ,$tabela) {

      //  if( $count == '')
       //     return '<a href="javascript:void(0)">'. $text .'</a>';
                
        
        $pageCount = $count?$count:0;
        $this->additional_param = "{'page' : $pageCount,'db_op':'table'}";
            
            if(empty($tabela)){
                $table = 'onclick=tabela('.$pageCount.'); return false>';
            }else{
                $table = 'onclick='.$tabela.'('.$pageCount.'); return false>';
            }

		return "<a href=\"javascript:void(0);\"
		         " . $this->anchor_class . " $table "
				. $text .'</a>';
	
        
        }
        
}
// END Pagination Class
?>
