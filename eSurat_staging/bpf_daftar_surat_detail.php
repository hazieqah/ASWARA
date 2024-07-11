<?php
	//=================MAKLUMAT PROGRAMMER======================//
	//															//
	//			Nama Programmer		:	Asrul Izham Jaafar		//						   
	//			Tarikh				:	19.1.2018  				//                           
	//			Masa				:	1:48 PM      			//                          
	//			Hari				:   Jumaat       			//
	//															//
	//==========================================================//
	
include ("../../includefail/connection_eBPF.php");
$id_daftar = $_GET ['id_daftar'];
$jenis_surat = $_GET ['jenis_surat'];
?>
<link href="../css/bodyform.css" rel="stylesheet">
<?php
if($jenis_surat == '1')
{
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
	$tarikh_daftar = date_create($row_info['tarikh_daftar']);
	$no_ruj_surat = $row_info['no_ruj_surat'];
	$tarikh_surat = date_create($row_info['tarikh_surat']);
	$dirujuk_kepada_id = $row_info['dirujuk_kepada_id'];
	$tarikh_rujuk = date_create($row_info['tarikh_rujuk']);
	$dokumen_sokongan = $row_info['dokumen_sokongan'];
	?>	
	<div class="bg">   
		  <table width="90%"  border="0" align="center" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;line-height:135%;text-align:justify">                   
			  <tr>
				<td colspan="3" class="titleH1" bgcolor="#690" style="color:#FFFFFF; padding:3px"><strong>Daftar Surat Masuk BPF</strong></td>
			  </tr> 
			  <tr>
				<td colspan="3">&nbsp;</td>
			  </tr> 
			  <tr height="30px">
				  <td width="20%">Perkara</td>
				  <td width="2%">:</td>
				  <td>
				   <?=$perkara?>
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
					  <?php 
					  include ("../../includefail/connection_eBPF.php");
					  $sql_fail = "SELECT * FROM kod_no_ruj_fail_bpf WHERE id_kod = '$no_ruj_fail_btm' AND aktif = 'Y'";
					  $result_fail = mysql_query($sql_fail) or die ("Error sql_fail : $sql_fail ".mysql_error());
					  $row_fail = mysql_fetch_array($result_fail);
					  echo $no_ruj_fail = $row_fail['no_ruj_fail'];                                  
					  ?>
				  </td>                                  
			  </tr>
			  <tr height="30px">
				  <td>Kategori Surat</td>
				  <td>:</td>
				  <td>              
					  <?php 
					  include ("../../includefail/connection_eBPF.php");
					  $sql_daripada = "SELECT * FROM kod_kategori_surat WHERE id_kod = '$kategori_surat' AND  aktif = 'Y'";								
					  $result_daripada = mysql_query($sql_daripada) or die ("Error sql_daripada : $sql_daripada ".mysql_error());
					  $row_daripada = mysql_fetch_array($result_daripada);
					  echo $keterangan = $row_daripada['keterangan'];
					  ?>                
				  </td>                                  
			  </tr>
			   <tr height="30px">
				  <td width="20%">Surat Daripada</td>
				  <td width="2%">:</td>
				  <td>
				   <?=$surat_daripada?>
				  </td>                                  
			  </tr>           
			  <tr height="30px">
				  <td>Tarikh Daftar</td>
				  <td>:</td>
				  <td>
				  <?=date_format($tarikh_daftar,"d/m/Y")?> 
				  </td>                                  
			  </tr>
			  <tr height="30px">
				  <td width="20%">No. Ruj. Surat</td>
				  <td width="2%">:</td>
				  <td>
				   <?=$no_ruj_surat?>
				  </td>                                  
			  </tr>
			  <tr height="30px">
				  <td>Tarikh Surat</td>
				  <td>:</td>
				  <td>
				   <?=date_format($tarikh_surat,"d/m/Y")?>                          	
				  </td>                                  
			  </tr>  
			  <tr height="30px">
				  <td width="20%">Pegawai Dirujuk</td>
				  <td width="2%">:</td>
				  <td>
				   
					  <?php 
					  include ("../../includefail/connection.php");
					  $sql_staf_name = "SELECT * FROM maklumat_staf WHERE id = '$dirujuk_kepada_id' AND activate_status = 'Y'";
					  $result_staf_name = mysql_query($sql_staf_name) or die ("Error sql_staf_name :".mysql_error());
					  $row_staf_name = mysql_fetch_array($result_staf_name);
					  $name = $row_staf_name['name'];
					  $name = ucwords($name);             
					  $name = ucwords(strtolower($name));
					  echo $name
					  ?>
				  </td>                                  
			  </tr> 
			   <tr height="30px">
				  <td>Tarikh Rujuk</td>
				  <td>:</td>
				  <td>
				   <?=date_format($tarikh_rujuk,"d/m/Y")?>                                	
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
			  <tr>
				  <td colspan="3" align="left">
				  <hr />
				  </td>
			  </tr>          
		  </table>
	 </div> 
<?php	
	}
	else
	{      
	$query_info = "SELECT *	FROM maklumat_daftar_surat_keluar WHERE  id_daftar = '$id_daftar' AND  aktif  = 'Y'";
	$result_info = mysql_query($query_info) or die ("Error in query_info : $query_info ".mysql_error()); 
	$row_info = mysql_fetch_array($result_info);
	$perkara = $row_info['perkara'];
	$perkara = ucwords($perkara);             
	$perkara = ucwords(strtolower($perkara));
	$jenis_surat = $row_info['jenis_surat'];
	$no_ruj_fail_btm = $row_info['no_ruj_fail_btm'];
	$kategori_surat = $row_info['kategori_surat'];
	$id_daripada = $row_info['id_daripada'];
	$tarikh_daftar = date_create($row_info['tarikh_daftar']);
	$no_ruj_surat = $row_info['no_ruj_surat'];	
	$tarikh_surat = date_create($row_info['tarikh_surat']);
	$surat_kepada = $row_info['surat_kepada'];	
	$tarikh_hantar = date_create($row_info['tarikh_hantar']);
	$dokumen_sokongan = $row_info['dokumen_sokongan'];
?>
    <div class="bg">   
		  <table width="90%"  border="0" align="center" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;line-height:135%;text-align:justify">                    
          <tr>
            <td colspan="3" class="titleH1" bgcolor="#990033" style="color:#FFFFFF; padding:3px"><strong>Daftar Surat Keluar BPF</strong></td>
          </tr> 
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr> 
          <tr height="30px">
              <td width="20%">Perkara</td>
              <td width="2%">:</td>
              <td>
               <?=$perkara?>
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">Jenis Surat</td>
              <td width="2%">:</td>
              <td>
               <strong style="color:#900">Surat Keluar</strong>
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">No.Ruj. Fail BTM</td>
              <td width="2%">:</td>
              <td>
               <?php 
                  include ("../../includefail/connection_eBPF.php");
                  $sql_fail = "SELECT * FROM kod_no_ruj_fail_bpf WHERE id_kod = '$no_ruj_fail_btm' AND aktif = 'Y'";
                  $result_fail = mysql_query($sql_fail) or die ("Error sql_fail : $sql_fail ".mysql_error());
                  $row_fail = mysql_fetch_array($result_fail);
                  echo $no_ruj_fail = $row_fail['no_ruj_fail'];                                  
                ?>                
              </td>                                  
          </tr>
          <tr height="30px">
              <td>Kategori Surat</td>
              <td>:</td>
              <td>             
                  <?php 
                  include ("../../includefail/connection_eBPF.php");
                  $sql_daripada = "SELECT * FROM kod_kategori_surat WHERE id_kod = '$kategori_surat' AND aktif = 'Y'";								
                  $result_daripada = mysql_query($sql_daripada) or die ("Error sql_daripada : $sql_daripada ".mysql_error());
                  $row_daripada = mysql_fetch_array($result_daripada);
                  echo $keterangan = $row_daripada['keterangan'];
                  ?>                  
              </td>                                  
          </tr>
           <tr height="30px">
              <td width="20%">Surat Daripada</td>
              <td width="2%">:</td>
              <td>
              	 <?php 
                  include ("../../includefail/connection.php");
                  $sql_staf_name = "SELECT * FROM maklumat_staf WHERE id = '$id_daripada' AND activate_status = 'Y'";
                  $result_staf_name = mysql_query($sql_staf_name) or die ("Error sql_staf_name :".mysql_error());
                  $row_staf_name = mysql_fetch_array($result_staf_name);
                  $name = $row_staf_name['name'];
                  $name = ucwords($name);             
                  $name = ucwords(strtolower($name));
				  echo $name;
                  ?>                               
              </td>                                  
          </tr>           
          <tr height="30px">
              <td>Tarikh Daftar</td>
              <td>:</td>
              <td>
               <?=date_format($tarikh_daftar,"d/m/Y")?>  
              </td>                                  
          </tr>
          <tr height="30px">
              <td width="20%">No. Ruj. Surat</td>
              <td width="2%">:</td>
              <td>
               <?=$no_ruj_surat?>
              </td>                                  
          </tr>
          <tr height="30px">
              <td>Tarikh Surat</td>
              <td>:</td>
              <td>
              <?=date_format($tarikh_surat,"d/m/Y")?>                                	
              </td>                                  
          </tr>  
          <tr height="30px">
              <td width="20%">Surat Kepada</td>
              <td width="2%">:</td>
              <td>
               <?=$surat_kepada?>
              </td>                                  
          </tr> 
           <tr height="30px">
              <td>Tarikh Hantar</td>
              <td>:</td>
              <td>
              <?=date_format($tarikh_hantar,"d/m/Y")?>                  	
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
				  <a href="dokumenSokongan/<?=$dokumen_sokongan?>" target="_blank" title="Download">Muat Turun Dokumen</a>&nbsp;<a href="bpf_daftar_surat_keluar_del_doc.php?id_daftar=<?=$id_daftar?>" title="Padam Dokumen Sokongan"><img src="../../pic/remove.jpg" width="16" height="16" /></a>
			<?php } ?>
          </td>                                  
          </tr>                                      
          <tr>
              <td colspan="3" align="left">
              <hr />
              </td>
          </tr>          
      </table>
<?php
	}
?>
   

