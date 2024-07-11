<?php
	//=================MAKLUMAT PROGRAMMER======================================//
	//																			//
	//			Nama Programmer		:	Wan Nur Hazieqah						//						   
	//			Tarikh				:	10.07.2024 (8:36 AM)	     			//  
	//			hari				:  	Rabu									//
	//																			//
	//==========================================================================//
	
include ("../../includefail/connection_eBPF.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
$tahun = date("Y");
$query_info = "SELECT COUNT(id_daftar) AS jumlah FROM maklumat_daftar_surat_masuk WHERE aktif  = 'Y'";
$result_info = mysql_query($query_info) or die ("Error in query_info : $query_info ".mysql_error()); 
$row_info = mysql_fetch_array($result_info);
$jumlah = $row_info['jumlah'];
?>
<script>
	  function checksuratmasuk()
	  {		   
		  if (document.form_daftar_masuk.perkara.value=="")
		  {
		  alert ("Sila Isikan Rungan Perkara!")	
		  document.form_daftar_masuk.perkara.focus;
		
		  return false;
		  } 
		  
		   if (document.form_daftar_masuk.no_ruj_fail_btm.value=="")
		  {
		  alert ("Sila Pilih No. Ruj. Fail BPF!")	
		  document.form_daftar_masuk.no_ruj_fail_btm.focus;
		
		  return false;
		  } 
		  
		  if (document.form_daftar_masuk.kategori_surat.value=="")
		  {
		  alert ("Sila Pilih Kategori Surat!")	
		  document.form_daftar_masuk.kategori_surat.focus;
		
		  return false;
		  } 
		  		  
		   if (document.form_daftar_masuk.surat_daripada.value=="")
		  {
		  alert ("Sila Isikan Ruangan Surat Daripada!")	
		  document.form_daftar_masuk.surat_daripada.focus;
		
		  return false;
		  }
		  
		  if (document.form_daftar_masuk.tarikh_daftar.value=="")
		  {
		  alert ("Sila Pilih Tarikh Daftar Surat!")	
		  document.form_daftar_masuk.tarikh_daftar.focus;
		
		  return false;
		  }
		  
		  if (document.form_daftar_masuk.no_ruj_surat.value=="")
		  {
		  alert ("Sila Isikan No. Ruj. Surat!")	
		  document.form_daftar_masuk.no_ruj_surat.focus;
		
		  return false;
		  }
		  
		  if (document.form_daftar_masuk.tarikh_surat.value=="")
		  {
		  alert ("Sila Pilih Tarikh Surat!")	
		  document.form_daftar_masuk.tarikh_surat.focus;
		
		  return false;
		  }
		  
		   if (document.form_daftar_masuk.dirujuk_kepada_id.value=="")
		  {
		  alert ("Sila Pilih Pegawai Yang Dirujuk!")	
		  document.form_daftar_masuk.dirujuk_kepada_id.focus;
		
		  return false;
		  }	
		  
		  if (document.form_daftar_masuk.tarikh_rujuk.value=="")
		  {
		  alert ("Sila Pilih Tarikh Surat Dirujuk!")	
		  document.form_daftar_masuk.tarikh_rujuk.focus;
		
		  return false;
		  }		  
	  } 
</script>
  <form id="form_daftar_surat" name="form_daftar_surat" method="post" action="bpf_daftar_surat_masuk_simpan.php"  enctype="multipart/form-data" onSubmit="return checksurat();" >  
      <table width="100%"  border="0" align="center">                    
          <tr>
            <td colspan="3" class="titleH1" bgcolor="#690" style="color:#FFFFFF; padding:3px"><strong>Daftar Surat BPF</strong></td>
          </tr> 
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr> 
          <tr height="30px">
              <td width="20%">Perkara</td>
              <td width="2%">:</td>
              <td>
               <input name="perkara" type="text" id="perkara" value="" size="50" />
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">Jenis Surat</td>
              <td width="2%">:</td>
              <td>
              <select name="jenis_surat">
                  <option value="">-Sila Pilih-</option>
                  <?php 
                  include ("../../includefail/connection_eBPF.php");
                  $sql_jenis_surat = "SELECT * FROM kod_jenis_surat WHERE aktif = 'Y'";								
                  $result_jenis_surat = mysql_query($sql_jenis_surat) or die ("Error sql_jenis_surat : $sql_jenis_surat ".mysql_error());
                  while ($row_jenis_surat = mysql_fetch_array($result_jenis_surat))
                  { 
                      $kategori = $row_jenis_surat['kategori'];
                  ?>
                 <option value="<?=$row_jenis_surat['id_kategori']?>"><?=$kategori?></option>
                 <?php } ?>
              </select> 
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">No. Ruj. Fail BPF</td>
              <td width="2%">:</td>
              <td>
               <select name="no_ruj_fail_btm">
                  <option value="">- Sila Pilih -</option>
                  <?php 
                  include ("../../includefail/connection_eBPF.php");
                  $sql_fail = "SELECT * FROM kod_no_ruj_fail_bpf WHERE aktif = 'Y'";
                  $result_fail = mysql_query($sql_fail) or die ("Error sql_fail : $sql_fail ".mysql_error());
                  while ($row_fail = mysql_fetch_array($result_fail))
                  { 
                      $no_ruj_fail = $row_fail['no_ruj_fail'];                                  
                  ?>
                 <option value="<?=$row_fail['id_kod']?>"><?=$no_ruj_fail?></option>
                 <?php } ?>
              </select>  
              <a href="bpf_add_daftar_no_fail.php?action=" title="Daftar No. Fail">
                <img src="../pic/add.jpg" width="24" height="24" title="Daftar No. Fail"/> 
              </a>  
              </td>                                  
          </tr>
          <tr height="30px">
              <td>Nama Fail</td>
              <td>:</td>
              <td>
                <input type="text" id="namaFail" class="short-input" value="<?php echo strtoupper($rowNamaFail['nama_fail']);?>" readonly>
              </td>

                  </tr>
          <tr height="30px">
              <td>Kategori Surat</td>
              <td>:</td>
              <td>
              <select name="kategori_surat">
                  <option value="">- Sila Pilih -</option>
                  <?php 
                  include ("../../includefail/connection_eBPF.php");
                  $sql_daripada = "SELECT * FROM kod_kategori_surat WHERE aktif = 'Y'";								
                  $result_daripada = mysql_query($sql_daripada) or die ("Error sql_daripada : $sql_daripada ".mysql_error());
                  while ($row_daripada = mysql_fetch_array($result_daripada))
                  { 
                      $keterangan = $row_daripada['keterangan'];
                  ?>
                 <option value="<?=$row_daripada['id_kod']?>"><?=$keterangan?></option>
                 <?php } ?>
              </select> 
              </td>                                  
          </tr>
           <tr height="30px">
              <td width="20%">Surat Daripada</td>
              <td width="2%">:</td>
              <td>
               <input name="surat_daripada" type="text" id="surat_daripada" value="" size="50" />
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">Perkhidmatan</td>
              <td width="2%">:</td>
              <td>
               <input name="perkhidmatan" type="text" id="perkhidmatan" value="" size="50" />
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">Nama Bahagian/Syarikat</td>
              <td width="2%">:</td>
              <td>
               <input name="namaBahagian" type="text" id="namaBahagian" value="" size="50" />
              </td>                                  
          </tr>      
          <tr height="30px">
              <td>Tarikh Daftar</td>
              <td>:</td>
              <td>
               <input name="tarikh_daftar" type="date" id="tarikh_daftar" value="" size="25" />  
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">No. Ruj. Surat</td>
              <td width="2%">:</td>
              <td>
               <input name="no_ruj_surat" type="text" id="no_ruj_surat" value="" size="25" />
              </td>                                  
          </tr>
          <tr height="30px">
              <td>Tarikh Surat</td>
              <td>:</td>
              <td>
              <input name="tarikh_surat" type="date" id="tarikh_surat" value="" size="25" />                    	
              </td>                                  
          </tr>  
          <tr height="30px">
              <td width="20%">Pegawai Dirujuk</td>
              <td width="2%">:</td>
              <td>
               <select name="dirujuk_kepada_id">
                  <option value="">- Sila Pilih -</option>
                  <?php 
                  include ("../../includefail/connection.php");
                  $sql_staf_name = "SELECT * FROM maklumat_staf WHERE activate_status = 'Y' AND bahagian = '6' ORDER BY SORT";
                  $result_staf_name = mysql_query($sql_staf_name) or die ("Error sql_staf_name :".mysql_error());
                  while ($row_staf_name = mysql_fetch_array($result_staf_name))
                  { 
                      $name = $row_staf_name['name'];
                      $name = ucwords($name);             
                      $name = ucwords(strtolower($name));
                  ?>
                 <option value="<?=$row_staf_name['id']?>"><?=$name?></option>
                 <?php } ?>
              </select> 
              </td>                                  
          </tr> 
           <tr height="30px">
              <td>Tarikh Rujuk</td>
              <td>:</td>
              <td>
              <input name="tarikh_rujuk" type="date" id="tarikh_rujuk" value="" size="25" />                    	
              </td>                                  
          </tr>                              
          <tr height="30px">
          <td>Dokumen Sokongan</td>
          <td>:</td>
          <td>
           <input name="file" type="file" class="submit" id="file" />
          </td>                                  
          </tr>                               
          <tr>
              <td colspan="3" align="left">
              <hr />
              </td>
          </tr>
           <tr>
              <td colspan="3" align="left">
              <input type="submit" value="       Daftar        ">
              </td>
          </tr> 
      </table>
      <input type="hidden" id="form" name="form" value="task">
</form>
<br />
<strong style="font-size:12px;color:#690"><em><a href="bpf_daftar_surat_peryear_search.php?tahun=<?=$tahun?>&jenis_surat=1" title="Jana Laporan">Jumlah Daftar Surat Masuk Terkini :<?=$jumlah?></a></em></strong>