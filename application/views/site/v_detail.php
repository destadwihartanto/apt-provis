<?php $this->load->view('template/alert')?>
<!-- left column -->
<div class="col-md-12">
    <p>
        <a href="<?=base_url('site/update/'.base64_encode($query['id']))?>" class="btn btn-primary">
            <i class="fas fa-pencil-alt"></i> Update
        </a>
    </p>

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Detail Site</h3>
        </div>

        <!-- <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th>Nama Lokasi</th>
                    <td><?=$query['nama_site']?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <?php $bg = $query['status'] == 'Request' ? 'warning' : 'success'; ?>
                    <td><span class="badge bg-<?=$bg?>"><?=$query['status']?></span></td>
                </tr>
                <tr>
                    <th>Nama Customer</th>
                    <td><?=$query['company']?></td>
                </tr>
                <tr>
                    <th>IP Modem</th>
                    <td><?=$query['ip_modem']?></td>
                </tr>
                <tr>
                    <th>IP Mikrotik</th>
                    <td><?=$query['ip_mikrotik']?></td>
                </tr>
                <tr>
                    <th>IP LAN</th>
                    <td><?=$query['ip_lan']?></td>
                </tr>
                <tr>
                    <th>IP Router</th>
                    <td><?=$query['ip_router']?></td>
                </tr>
                <tr>
                    <th>Airmac Modem</th>
                    <td><?=$query['airmac_modem']?></td>
                </tr>
                <tr>
                    <th>VLAN Oam Mikrotik</th>
                    <td><?=$query['vlan_oam_mikrotik']?></td>
                </tr>
                <tr>
                    <th>VLAN Oam e nodeB</th>
                    <td><?=$query['vlan_oam_nodeb']?></td>
                </tr>
                <tr>
                    <th>VLAN Oam CCTV</th>
                    <td><?=$query['vlan_oam_cctv']?></td>
                </tr>
                <tr>
                    <th>VLAN Oam Power</th>
                    <td><?=$query['vlan_oam_power']?></td>
                </tr>
                <tr>
                    <th>VLAN s1-C</th>
                    <td><?=$query['vlan_s1c']?></td>
                </tr>
                <tr>
                    <th>VLAN s1-U</th>
                    <td><?=$query['vlan_s1u']?></td>
                </tr>
                <tr>
                    <th>Site ID</th>
                    <td><?=$query['sid']?></td>
                </tr>
                <tr>
                    <th>Community String SNMP Router dan AP</th>
                    <td><?=$query['snmp_community']?></td>
                </tr>
                <tr>
                    <th>Batch</th>
                    <td><?=$query['batch']?></td>
                </tr>
                <tr>
                    <th>Nama PIC Lokasi</th>
                    <td><?=$query['nama_pic_lokasi']?></td>
                </tr>
                <tr>
                    <th>Telepon PIC Lokasi</th>
                    <td><?=$query['telp_pic_lokasi']?></td>
                </tr>
                <tr>
                    <th>Longitude</th>
                    <td><?=$query['longitude']?></td>
                </tr>
                <tr>
                    <th>Latitude</th>
                    <td><?=$query['latitude']?></td>
                </tr>
                <tr>
                    <th>PIC Penyedia</th>
                    <td><?=$query['nama_pic_provider']?></td>
                </tr>
                <tr>
                    <th>Nama Vendor</th>
                    <td><?=$query['nama_vendor']?></td>
                </tr>
                <tr>
                    <th>Nama Program</th>
                    <td><?=$query['nama_program']?></td>
                </tr>
                <tr>
                    <th>Penyedia LC</th>
                    <td><?=$query['nama_penyedia_lc']?></td>
                </tr>
                <tr>
                    <th>Sumber Listrik Utama</th>
                    <td><?=$query['nama_source_power']?></td>
                </tr>
                <tr>
                    <th>Operation Band VSAT</th>
                    <td><?=$query['nama_operation_band']?></td>
                </tr>
                <tr>
                    <th>Beam</th>
                    <td><?=$query['nama_beam']?></td>
                </tr>
                <tr>
                    <th>Satelit</th>
                    <td><?=$query['nama_satelit']?></td>
                </tr>
                <tr>
                    <th>Dish</th>
                    <td><?=$query['nama_dish']?></td>
                </tr>
                <tr>
                    <th>Propinsi</th>
                    <td><?=$query['province']?></td>
                </tr>
                <tr>
                    <th>Kota/Kabupaten</th>
                    <td><?=$query['kota']?></td>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <td><?=$query['kecamatan']?></td>
                </tr>
                <tr>
                    <th>Desa/Kelurahan</th>
                    <td><?=$query['desa']?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?=$query['alamat']?></td>
                </tr>
                <tr>
                    <th>Tanggal Operasional</th>
                    <td><?= date('d F Y', strtotime($query['operational_date']))?></td>
                </tr>
            </tbody>
        </table> -->

        <div class="form-group row">
        <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlInput1" class="form-label">Nama Lokasi</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['nama_site']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">Status</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['status']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">Nama Customer</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['company']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">IP Modem</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['ip_modem']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">IP Mikrotik</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['ip_mikrotik']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">IP LAN</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['ip_lan']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">IP Router</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['ip_router']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">Airmac Modem</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['airmac_modem']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">VLAN Oam Mikrotik</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['vlan_oam_mikrotik']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">VLAN Oam e nodeB</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['vlan_oam_nodeb']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">VLAN Oam CCTV</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['vlan_oam_cctv']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">VLAN Oam Power</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['vlan_oam_power']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">VLAN s1-C</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['vlan_s1c']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">VLAN s1-U</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['vlan_s1u']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">Site ID</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['sid']?>" disabled>
            </div>
            <div class="col-lg-3  mt-2 mb-2">
            <label for="exampleFormControlTextarea1" class="form-label">Community String SNMP Router&AP</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?=$query['snmp_community']?>" disabled>
            </div>
            <table class="table table-bordered table-hover">
                <tbody>
            <tr>
                    <th>Batch</th>
                    <td><?=$query['batch']?></td>
                </tr>
                <tr>
                    <th>Nama PIC Lokasi</th>
                    <td><?=$query['nama_pic_lokasi']?></td>
                </tr>
                <tr>
                    <th>Telepon PIC Lokasi</th>
                    <td><?=$query['telp_pic_lokasi']?></td>
                </tr>
                <tr>
                    <th>Longitude</th>
                    <td><?=$query['longitude']?></td>
                </tr>
                <tr>
                    <th>Latitude</th>
                    <td><?=$query['latitude']?></td>
                </tr>
                <tr>
                    <th>PIC Penyedia</th>
                    <td><?=$query['nama_pic_provider']?></td>
                </tr>
                <tr>
                    <th>Nama Vendor</th>
                    <td><?=$query['nama_vendor']?></td>
                </tr>
                <tr>
                    <th>Nama Program</th>
                    <td><?=$query['nama_program']?></td>
                </tr>
                <tr>
                    <th>Penyedia LC</th>
                    <td><?=$query['nama_penyedia_lc']?></td>
                </tr>
                <tr>
                    <th>Sumber Listrik Utama</th>
                    <td><?=$query['nama_source_power']?></td>
                </tr>
                <tr>
                    <th>Operation Band VSAT</th>
                    <td><?=$query['nama_operation_band']?></td>
                </tr>
                <tr>
                    <th>Beam</th>
                    <td><?=$query['nama_beam']?></td>
                </tr>
                <tr>
                    <th>Satelit</th>
                    <td><?=$query['nama_satelit']?></td>
                </tr>
                <tr>
                    <th>Dish</th>
                    <td><?=$query['nama_dish']?></td>
                </tr>
                <tr>
                    <th>Propinsi</th>
                    <td><?=$query['province']?></td>
                </tr>
                <tr>
                    <th>Kota/Kabupaten</th>
                    <td><?=$query['kota']?></td>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <td><?=$query['kecamatan']?></td>
                </tr>
                <tr>
                    <th>Desa/Kelurahan</th>
                    <td><?=$query['desa']?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?=$query['alamat']?></td>
                </tr>
                <tr>
                    <th>Tanggal Operasional</th>
                    <td><?= date('d F Y', strtotime($query['operational_date']))?></td>
                </tr>
                </tbody>
                </table>
    </div> <!-- /.card -->
</div> <!--/.col (left) -->
