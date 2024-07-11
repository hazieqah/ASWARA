<?php
	//=================MAKLUMAT PROGRAMMER======================//
	//															//
	//			Nama Programmer		:	Asrul Izham Jaafar		//						   
	//			Tarikh				:	19.1.2018  				//                           
	//			Masa				:	9:23 AM      			//                          
	//			Hari				:   Jumaat       			//
	//															//
	//==========================================================//
	include("../../../includefail/connection_eBTM.php"); 
	date_default_timezone_set("Asia/Kuala_Lumpur");	
	$carian=$_POST['carian'];
	$mode=$_POST['mode'];

	$time_start = microtime(true);
	
	$count_query = "SELECT COUNT(id_daftar) AS jumlah_count FROM
					(
					SELECT *
					FROM maklumat_daftar_surat_masuk  
					WHERE perkara LIKE '%$carian%' AND aktif  = 'Y'  
					UNION
					SELECT *
					FROM maklumat_daftar_surat_keluar 
					WHERE perkara LIKE '%$carian%' AND aktif  = 'Y'  
					ORDER BY tarikh_daftar
					) AS T";		
	$result_count = mysql_query ($count_query)or die ("Error in count_query : $count_query ".mysql_error());
	$row_count = mysql_fetch_array($result_count);
	$jumlah_count = $row_count['jumlah_count'];	
	usleep(100);
	
	$time_end = microtime(true);
	$time = $time_end - $time_start;	
	$time_selct = substr($time, 0, 6);
	//echo "Did nothing in $time seconds\n";	
?>
<div style="color:#CCC;font-size:13px"><em>About <?=$jumlah_count?> results (<?=$time_selct?> seconds)</em></div>
<p>
<?php	
	
	$query = "SELECT *
			  FROM maklumat_daftar_surat_masuk  
			  WHERE perkara LIKE '%$carian%' AND aktif  = 'Y'  
			  UNION
			  SELECT *
			  FROM maklumat_daftar_surat_keluar 
			  WHERE perkara LIKE '%$carian%' AND aktif  = 'Y'  
			  ORDER BY tarikh_daftar";		
	$result = mysql_query ($query)or die ("Error in query : $query ".mysql_error());	
?>                
        <table width="95%" border="1" style="font-size:14px" align="center">
                <tr style="color:#FFFFFF">
                  <td width="5%" bgcolor="#6CB1F1"><div align="center"><strong>No.</strong></div></td>
                  <td bgcolor="#6CB1F1"><div align="left" style="padding:3px"><strong>Perkara</strong></div></td>
                  <td bgcolor="#6CB1F1"><div align="center"><strong>Tarikh Daftar</strong></div></td>
                  <td bgcolor="#6CB1F1"><div align="center"><strong>Tarikh Surat</strong></div></td>                  
                  <td bgcolor="#6CB1F1"><div align="center"><strong>Kategori Surat</strong></div></td>
                  <td bgcolor="#6CB1F1"><div align="center"><strong>Jenis Surat</strong></div></td>                               
                </tr> 
	<?php
	if (mysql_num_rows($result)>0)
    {
		$bilangan = 0;
		while($row_info_surat=mysql_fetch_array($result))
			{ 
			$bilangan = $bilangan + 1;
			$id_daftar = $row_info_surat['id_daftar'];
			$perkara = $row_info_surat['perkara'];
			$tarikh_surat = date("d-m-Y", strtotime($row_info_surat['tarikh_surat']));			
			$tarikh_daftar = date("d-m-Y", strtotime($row_info_surat['tarikh_daftar']));
			$jenis_surat = $row_info_surat['jenis_surat'];			
			$kategori_surat = $row_info_surat['kategori_surat'];
			$perkara_selct = substr($perkara, 0, 50);
			$perkara_selct = ucwords($perkara_selct);             
			$perkara_selct = ucwords(strtolower($perkara_selct));
						
			include ("../../../includefail/connection_eBTM.php");		
			$query_jenis="SELECT * FROM kod_jenis_surat WHERE id_kategori  = '$jenis_surat' AND aktif = 'Y'";				
            $result_jenis=mysql_query($query_jenis) or die ('Error in query_jenis : $query_jenis '.mysql_error());
			$row_jenis = mysql_fetch_array($result_jenis);
			$jenis = $row_jenis['kategori'];
			
			$query_kategori="SELECT * FROM kod_kategori_surat WHERE id_kod  = '$kategori_surat' AND aktif = 'Y'";				
            $result_kategori=mysql_query($query_kategori) or die ('Error in query_kategori : $query_kategori '.mysql_error());
			$row_kategori = mysql_fetch_array($result_kategori);
			$kategori = $row_kategori['keterangan'];
 ?>
				<tr onMouseOver="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" onclick="window.open('btm_daftar_surat_detail.php?id_daftar=<?=$id_daftar?>&jenis_surat=<?=$jenis_surat?>','popUpWindow','height=450,width=1000,left=200,top=200,scrollbars=no,menubar=no')" class="tr">
                    <td align="center"><?=$bilangan."."?></td>
                    <td style="padding:3px"><?=$perkara_selct?>..</td>                    
                    <td align="center"><?=$tarikh_daftar?></td> 
                    <td align="center"><?=$tarikh_surat?></td>                   
                    <td align="center"><?=$kategori?></td> 
                    <td align="center"><img src="../../pic/<?=$jenis_surat?>_jenis_surat.png" width="35" height="21" title="<?=$jenis?>"/> 
					</td> 
                </tr>						
<?php			}//Penutup WHILE
	  }
	  else 
	  {
?>              <tr>
            	<td colspan="7" align="center"><em>- Tiada Daftar Surat Direkodkan -</em></td><!-- Display when no data -->
            </tr>
 <?php } ?>
		</table>
