<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Site_model extends CI_Model
{
    private $table = 'site';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_condition($where = [])
    {
        $this->db->order_by('nama_kontrak');
        $query = $this->db->get_where($this->table, $where);
        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id = null, $data = [])
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function show_table($where)
    {
        $this->db->select('s.id id,nama_kontrak, sid, lc.nama penyedia_lc, company, s.status status, x.status xpole,user_id');
        $this->db->from($this->table.' s');
        $this->db->join('penyedia_lc lc', 'lc.id = s.penyedia_lc_id', 'left');
        $this->db->join('users u', 'u.id = s.user_id', 'left');
        $this->db->join('xpoles x', 's.id = x.site_id', 'left');
        $this->db->order_by('nama_kontrak');
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_detail($where = [])
    {
        $this->db->select('s.id id,s.nama_kontrak nama_site,company,s.status status,ip_modem,ip_mikrotik,ip_lan,ip_router,airmac_modem,vlan_oam_mikrotik,vlan_oam_nodeb,vlan_oam_cctv,vlan_oam_power,vlan_s1c,vlan_s1u,sid,snmp_community,batch,nama_pic_lokasi,alamat,telp_pic_lokasi,latitude,longitude,operational_date,user_id,pic_penyedia_id,vendor_id,program_id,penyedia_lc_id,source_power_id,operation_band_id,spotbeam_id,satelit_id,dish_id, rv.name desa, village_id, district_id, rd.name kecamatan, regency_id, rr.name kota, province_id, rp.name province, pp.nama nama_pic_provider,v.nama nama_vendor, pr.nama nama_program,lc.nama nama_penyedia_lc, sp.nama nama_source_power, ob.nama nama_operation_band, sb.nama nama_beam, st.nama nama_satelit,d.nama nama_dish');
        $this->db->from($this->table.' s');
        $this->db->join('xpoles x', 's.id = x.site_id', 'left');
        $this->db->join('pic_provider pp', 'pp.id = s.pic_penyedia_id', 'left');
        $this->db->join('vendor v', 'v.id = s.vendor_id', 'left');
        $this->db->join('users u', 'u.id = s.user_id', 'left');
        $this->db->join('program pr', 'pr.id = s.program_id', 'left');
        $this->db->join('spotbeam sb', 'sb.id = s.spotbeam_id', 'left');
        $this->db->join('dish d', 'd.id = s.dish_id', 'left');
        $this->db->join('source_power sp', 'sp.id = s.source_power_id', 'left');
        $this->db->join('satelit st', 'st.id = s.satelit_id', 'left');
        $this->db->join('operation_band ob', 'ob.id = s.operation_band_id', 'left');
        $this->db->join('penyedia_lc lc', 'lc.id = s.penyedia_lc_id', 'left');
        $this->db->join('reg_villages rv', 'rv.id = s.village_id', 'left');
        $this->db->join('reg_districts rd', 'rd.id = rv.district_id', 'left');
        $this->db->join('reg_regencies rr', 'rr.id = rd.regency_id', 'left');
        $this->db->join('reg_provinces rp', 'rp.id = rr.province_id', 'left');
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        return $this->db->get()->result_array();
    }

    public function print($where = [])
    {
        $this->db->select('s.id id,s.nama_kontrak nama_site,company, sid, latitude, longitude, sb.nama spotbeam_name, username, registered_at, approved_at, url_img_plang,url_img_antenna,url_img_ethernet,url_img_first_modem,url_img_second_modem,url_img_xpole,url_img_speedtest ');
        $this->db->from($this->table.' s');
        $this->db->join('xpoles x', 's.id = x.site_id', 'left');
        $this->db->join('spotbeam sb', 'sb.id = s.spotbeam_id', 'left');
        $this->db->join('users u', 'u.id = s.user_id', 'left');
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        return $this->db->get()->result_array();
    }

    public function delete($id = null)
    {
        $this->db->delete($this->table, array('id' => $id));
    }

    public function dashboard()
    {
        $this->db->select('xp.status, COUNT(*)jumlah');
        $this->db->from($this->table.' s');
        $this->db->join('xpoles xp', 's.id = xp.site_id', 'left');
        $this->db->group_by('xp.status');
        return $this->db->get()->result_array();
    }

    public function get_where($params = [])
    {
        isset($params['select']) ? $this->db->select($params['select']) : $this->db->select('*');
        $this->db->from($this->table. ' s');
        $this->db->join('xpoles xp', 's.id = xp.site_id', 'left');
        if (isset($params['where'])) {
            foreach ($params['where'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (isset($params['where_in'])) {
            foreach ($params['where_in'] as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }

        if (isset($params['like'])) {
            foreach ($params['like'] as $key => $value) {
                $this->db->like($key, $value);
            }
        }

        if (isset($params['order_by'])) {
            foreach ($params['order_by'] as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        if (isset($params['limit'])) {
            $this->db->limit($params['limit']);
        }

        return $this->db->get()->result_array();
    }

}
