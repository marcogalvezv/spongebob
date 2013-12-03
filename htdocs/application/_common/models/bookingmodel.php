<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Bookingmodel extends Basemodel{

    protected $_table_name = "booking";

    public function getAddressList($city = "")
    {
        $this->db->select('v_booking.id,v_booking.addlat,v_booking.addlng,v_booking.destlat,v_booking.destlng');
        $this->db->from('v_booking');
        $this->db->order_by('id', 'ASC');




        $query = $this->db->get();

        $res = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
            $res = array();
            foreach($result as $row) {
                $res[] = $row;
            }
        }
        return $res;
    }
}