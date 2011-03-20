<?php

$plugin_info = array(
	'pi_name'			=> 'Contributions Count',
	'pi_version'		=> '1.0',
	'pi_author'			=> 'Nine Four',
	'pi_author_url'		=> 'http://ninefour.co.uk/labs',
	'pi_description'	=> 'Returns the number of contributions made by a member to a specific weblog, something not possible with native tags.',
	'pi_usage'			=> ''
);

class contributions_count {

	function contributions_count() {
		global $DB, $TMPL;
		
		//collect our parameters
		$member_id = $TMPL->fetch_param('member_id');
		$weblog_id = $TMPL->fetch_param('weblog_id');
		$status = $TMPL->fetch_param('status');
		$link_url = $TMPL->fetch_param('link_url');
		$link_text = $TMPL->fetch_param('link_text');
		$link_title = $TMPL->fetch_param('link_title');
		$link_class = $TMPL->fetch_param('link_class');
		
		$sql = "SELECT entry_id FROM exp_weblog_titles
				WHERE author_id=".$member_id." AND weblog_id=".$weblog_id." AND status='".$status."'";
		$query = $DB->query($sql);
		if ($query->num_rows > 0) {
			
			$data = $query->num_rows;
			
			if ($link_url!="" AND $link_text!="") {
				$data .= "<a href='".$link_url."'";
				if ($link_title!="") {
					$data .= " title='".$link_title."'";
				}
				if ($link_class!="") {
					$data .= " class='".$link_class."'";
				}
				$data .= " >".$link_text."</a>\r";
			}
		} else {
			$data = '0';
		}
		
		$this->return_data = $data;
		return $this->return_data;
	}
	
}
?>