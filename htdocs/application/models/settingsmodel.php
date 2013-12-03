<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Settingsmodel extends Basemodel
{	
	protected $_table_name = "shop";

	function Settingsmodel()
	{
		parent::Basemodel();
		$this->load->database();
	}
	
    function get_by_id($id)
    {
        $query = $this->db->get($_table_name, array('id' => $id));
        return $query->result();
    }

    function insert_entry($data)
    {
		$this->db->insert($_table_name, $data);
    }

    function update_entry($data, $id)
    {
        $this->db->update($_table_name, $data, array('id' => $id));
    }
}

/* End of file settingsmodel.php */
/* Location: ./system/application/models/settingsmodel.php */