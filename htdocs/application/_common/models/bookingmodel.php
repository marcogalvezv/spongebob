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


    public function getActiveBookingClientPositions()
    {

        $query = $this->db->query("select addlat as lat, addlng as lng, fullname from v_booking where status not in ('5','6')");
        $result = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
    }

    public function getAssignedBookingByTaxi($taxiId)
    {
        $query = $this->db->query("select * from booking where status not in ('1','5','6') and idtaxi = '". $taxiId."'");
        //log_message("debug", "*********MEthod:" . print_r('getAssignedBookingByTaxi', true));
        //log_message("debug", "*********query:" . print_r("select * from booking where status not in ('1','5','6') and idtaxi = '". $taxiId."'", true));

        if ($query->num_rows()>0){

                return $query->row();
            }

        return null;
    }

    public function getTaxiLocationByBooking($id)
    {
        $this->db->select('number,lat,lng');
        $this->db->from('taxi');
        //$this->db->order_by('id', 'ASC');

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