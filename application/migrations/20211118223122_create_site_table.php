<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_site_table extends CI_Migration
{
    private $table = 'site';

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'server_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'vendor_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'program_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'penyedia_jasa_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'kelurahan_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'penyedia_lc_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'sid' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'nama_kontrak' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'nama_router' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'latitude' => array(
                'type' => 'FLOAT',
                'null' => true,
            ),
            'longitude' => array(
                'type' => 'FLOAT',
                'null' => true,
            ),
            'ip_modem' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ),
            'ip_router' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ),
            'ip_network' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ),
            'ip_ap1' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ),
            'ip_ap2' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ),
            'ip_v6' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'fqdn' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'ssid1' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ),
            'ssid2' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ),
            'sensor_ping_modem' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'sensor_ping_router' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'sensor_ping_ap1' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'sensor_ping_ap2' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'sensor_traffic_download_modem' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'sensor_traffic_upload_modem' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'status_modem' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => true,
            ),
            'status_router' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => true,
            ),
            'status_ap1' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => true,
            ),
            'status_ap2' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => true,
            ),
            'lastcheck_modem' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'lastcheck_router' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'lastcheck_ap1' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'lastcheck_gain' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'batch' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'nama_pic_lokasi' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'telp_pic_lokasi' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'pic_penyedia_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'source_power_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'pengusul_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'spotbeam_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'satelit_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => true,
            ),
            'operation_band' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ),
            'dish' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ),
            'snmp_community' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ),
            'alamat' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'operational_date' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
        ));
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->table, true);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }
}
