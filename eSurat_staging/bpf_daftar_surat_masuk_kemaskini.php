<?php
	//=================MAKLUMAT PROGRAMMER======================================//
	//																			//
	//			Nama Programmer		:	Asrul Izham Jaafar						//						   
	//			Tarikh				:	26.12.2017 (1:33 PM)	     			//  
	//			hari				:  	Selasa									//
	//																			//
	//==========================================================================//
	
include ("../../includefail/connection_eBPF.php");
$query_info = "SELECT *	FROM maklumat_daftar_surat_masuk WHERE  id_daftar = '$id_daftar' AND  aktif  = 'Y'";
$result_info = mysql_query($query_info) or die ("Error in query_info : $query_info ".mysql_error()); 
$row_info = mysql_fetch_array($result_info);
$perkara = $row_info['perkara'];
$perkara = ucwords($perkara);             
$perkara = ucwords(strtolower($perkara));
$jenis_surat = $row_info['jenis_surat'];
$no_ruj_fail_btm = $row_info['no_ruj_fail_btm'];
$kategori_surat = $row_info['kategori_surat'];
$surat_daripada = $row_info['surat_daripada'];
$tarikh_daftar = $row_info['tarikh_daftar'];
$no_ruj_surat = $row_info['no_ruj_surat'];
$tarikh_surat = $row_info['tarikh_surat'];
$dirujuk_kepada_id = $row_info['dirujuk_kepada_id'];
$tarikh_rujuk = $row_info['tarikh_rujuk'];
$dokumen_sokongan = $row_info['dokumen_sokongan'];
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
		  alert ("Sila Pilih No. Ruj. Fail BTM!")	
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
  <form id="form_daftar_masuk" name="form_daftar_masuk" method="post" action="bpf_daftar_surat_masuk_kemaskini_simpan.php"  enctype="multipart/form-data" onSubmit="return checksuratmasuk();" >  
      <table width="90%"  border="0" align="center">                    
          <tr>
            <td colspan="3" class="titleH1" bgcolor="#690" style="color:#FFFFFF; padding:3px"><strong>Daftar Surat Masuk BTM</strong></td>
          </tr> 
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr> 
          <tr height="30px">
              <td width="20%">Perkara</td>
              <td width="2%">:</td>
              <td>
               <input name="perkara" type="text" id="perkara" value="<?=$perkara?>" size="50" />
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">Jenis Surat</td>
              <td width="2%">:</td>
              <td>
               <strong style="color:#690">Surat Masuk</strong>
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">No.Ruj. Fail BTM</td>
              <td width="2%">:</td>
              <td>
               <select name="no_ruj_fail_btm">
                  <option value="">-Select-</option>
                  <?php 
                  include ("../../includefail/connection_eBPF.php");
                  $sql_fail = "SELECT * FROM kod_no_ruj_fail_bpf WHERE aktif = 'Y'";
                  $result_fail = mysql_query($sql_fail) or die ("Error sql_fail : $sql_fail ".mysql_error());
                  while ($row_fail = mysql_fetch_array($result_fail))
                  { 
                      $no_ruj_fail = $row_fail['no_ruj_fail'];                                  
                  ?>
                 <option <?php if ( $row_fail['id_kod'] == $no_ruj_fail_btm) { ?> selected="selected"  <?php } ?>
                 value="<?=$row_fail['id_kod']?>"><?=$no_ruj_fail?></option>
                 <?php } ?>
              </select>  
              </td>                                  
          </tr>
          <tr height="30px">
              <td>Kategori Surat</td>
              <td>:</td>
              <td>
              <select name="kategori_surat">
                  <option value="">-Select-</option>
                  <?php 
                  include ("../../includefail/connection_eBPF.php");
                  $sql_daripada = "SELECT * FROM kod_kategori_surat WHERE aktif = 'Y'";								
                  $result_daripada = mysql_query($sql_daripada) or die ("Error sql_daripada : $sql_daripada ".mysql_error());
                  while ($row_daripada = mysql_fetch_array($result_daripada))
                  { 
                      $keterangan = $row_daripada['keterangan'];
                  ?>
                 <option <?php if ( $row_daripada['id_kod'] == $kategori_surat) { ?> selected="selected"  <?php } ?>
                  value="<?=$row_daripada['id_kod']?>"><?=$keterangan?></option>
                 <?php } ?>
              </select> 
              </td>                                  
          </tr>
           <tr height="30px">
              <td width="20%">Surat Daripada</td>
              <td width="2%">:</td>
              <td>
               <input name="surat_daripada" type="text" id="surat_daripada" value="<?=$surat_daripada?>" size="50" />
              </td>                                  
          </tr>           
          <tr height="30px">
              <td>Tarikh Daftar</td>
              <td>:</td>
              <td>
               <input name="tarikh_daftar" type="date" id="tarikh_daftar" value="<?=$tarikh_daftar?>" size="25" />  
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">No. Ruj. Surat</td>
              <td width="2%">:</td>
              <td>
               <input name="no_ruj_surat" type="text" id="no_ruj_surat" value="<?=$no_ruj_surat?>" size="25" />
              </td>                                  
          </tr>
          <tr height="30px">
              <td>Tarikh Surat</td>
              <td>:</td>
              <td>
              <input name="tarikh_surat" type="date" id="tarikh_surat" value="<?=$tarikh_surat?>" size="25" />                    	
              </td>                                  
          </tr>  
          <tr height="30px">
              <td width="20%">Pegawai Dirujuk</td>
              <td width="2%">:</td>
              <td>
               <select name="dirujuk_kepada_id">
                  <option value="">-Select-</option>
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
                 <option <?php if ( $row_staf_name['id'] == $dirujuk_kepada_id) { ?> selected="selected"  <?php } ?>
                 value="<?=$row_staf_name['id']?>"><?=$name?></option>
                 <?php } ?>
              </select> 
              </td>                                  
          </tr> 
           <tr height="30px">
              <td>Tarikh Rujuk</td>
              <td>:</td>
              <td>
              <input name="tarikh_rujuk" type="date" id="tarikh_rujuk" value="<?=$tarikh_rujuk?>" size="25" />                    	
              </td>                                  
          </tr>                              
          <tr height="30px">
          <td>Dokumen</td>
          <td>:</td>
          <td>
           <?php if($dokumen_sokongan == "Tiada")
				  {
				  echo "Tiada Dokumen";
				  }
				  else
				  {?>
				  <a href="dokumenSokongan/<?=$dokumen_sokongan?>" target="_blank" title="Download">Muat Turun Dokumen</a>&nbsp;<a href="bpf_daftar_surat_masuk_del_doc.php?id_daftar=<?=$id_daftar?>" title="Padam Dokumen Sokongan"><img src="../pic/remove.jpg" width="16" height="16" /></a>
			<?php } ?> 
          </td>                                  
          </tr>
          <tr height="30px">
          <td>Dokumen Baru</td>
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
              <td colspan="2" align="left">
              <input type="submit" value="       Kemaskini        ">
              </td>
              <td align="Right">
             	<a href="bpf_daftar_surat_masuk_delete.php?id_daftar=<?=$id_daftar?>"><img src="../../pic/delete.jpg" width="30" height="38" title="Padam Daftar Surat Masuk"/></a>
              </td>
          </tr> 
      </table>
      <input type="hidden" id="form" name="form" value="kemaskini">
      <input type="hidden" id="id_daftar" name="id_daftar" value="<?=$id_daftar?>">
</form>
