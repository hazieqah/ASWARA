<?php
	//=================MAKLUMAT PROGRAMMER======================//
	//															//
	//			Nama Programmer		:	Asrul Izham Jaafar		//						   
	//			Tarikh				:	19.1.2018  				//                           
	//			Masa				:	6:46 AM      			//                          
	//			Hari				:   Jumaat       			//
	//															//
	//==========================================================//
	
	include("../../includefail/header.php");
	include("../../includefail/connection.php"); 
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$bulan = date("m");	
	$tahun = date("Y");
	$day = date("d");
	$mode = $_GET ['mode'];	
	$action = $_GET ['action'];
	$id_daftar = $_GET ['id_daftar'];
	$jenis_surat = $_GET ['jenis_surat'];
		
?>  
	<script type="text/javascript">
      function ChangeColor(tableRow, highLight)
      {
      if (highLight)
      {
        tableRow.style.backgroundColor = '#dcfac9';
      }
      else
      {
        tableRow.style.backgroundColor = 'white';
      }
    }
    
    function DoNav(theUrl)
    {
    document.location.href = theUrl;
    }
    </script>

	<head>
	<link rel="stylesheet" type="text/css" media="screen" href="../datatable/css/jquery.dataTables.min.css"> <!--https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css-->
	<script src="../datatable/js/jquery.min.js"></script><https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js>
	<script src="../datatable/js/jquery.dataTables.min.js"></script><https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js>
	</head>
	
    <style>
	a:link:after,a:visited:after{content:"(" attr(href) ")";font-size:0%}	
	</style> 
</br>            
      <table width="90%">
        <tr>
        <td width="5%">
        <img src="../pic/bck.png" width="30" height="30" title="Kembali ke Laman Sebelum" onclick="location.href = '<?=$gl_url?>/pages/eBPF/index.php?action=&jenis_surat=&id_daftar=&mode=';"/> 
        </td>
        <td align="left">
        <b><div style="font-size:16px">Carian Daftar Surat Menyurat BPF</div></b>
        </td>
        <td>&nbsp;    
        </td>
        </tr>
    </table>
	<hr>
<style type="text/css">
.style1 {
	bgcolor="#FF0000"
}
</style>		
			
<?php


include ("../../includefail/connection_eBPF.php");
$query_info_surat="	SELECT *
					FROM maklumat_daftar_surat_masuk  
					WHERE aktif  = 'Y'  
					UNION
					SELECT *
					FROM maklumat_daftar_surat_keluar 
					WHERE aktif  = 'Y'  
					ORDER BY tarikh_daftar DESC";
$result_info_surat=mysql_query($query_info_surat) or die ('Error in query_info_surat:$query_info_surat.'.mysql_error()); 

?>                
	<table width="95%" border="1" style="font-size:14px" align="center" class="content-table table-list" id="table1">
	<thead>
		<tr bgcolor="#94B271">
			<td width="5%"><div align="center"><strong>No.</strong></div></td>
			<td><div align="left" style="padding:3px"><strong>Perkara</strong></div></td>
			<td><div align="center"><strong>Tarikh Daftar</strong></div></td>
			<td><div align="center"><strong>Tarikh Surat</strong></div></td>                  
			<td><div align="center"><strong>Kategori Surat</strong></div></td>
			<td><div align="center"><strong>Jenis Surat</strong></div></td>              
		</tr> 
	</thead>
	<tbody>
	<?php
	if (mysql_num_rows($result_info_surat)>0)
    {
			$bilangan = 0;
			while($row_info_surat = mysql_fetch_array($result_info_surat))
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
			$perkara_low = ucwords(strtolower($perkara));
						
			include ("../../includefail/connection_eBPF.php");		
			$query_jenis="SELECT * FROM kod_jenis_surat WHERE id_kategori  = '$jenis_surat' AND aktif = 'Y'";				
            $result_jenis=mysql_query($query_jenis) or die ('Error in query_jenis : $query_jenis '.mysql_error());
			$row_jenis = mysql_fetch_array($result_jenis);
			$jenis = $row_jenis['kategori'];
			
			$query_kategori="SELECT * FROM kod_kategori_surat WHERE id_kod  = '$kategori_surat' AND aktif = 'Y'";				
            $result_kategori=mysql_query($query_kategori) or die ('Error in query_kategori : $query_kategori '.mysql_error());
			$row_kategori = mysql_fetch_array($result_kategori);
			$kategori = $row_kategori['keterangan'];
?>
				<tr onMouseOver="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" onclick="window.open('bpf_daftar_surat_detail.php?id_daftar=<?=$id_daftar?>&jenis_surat=<?=$jenis_surat?>','popUpWindow','height=450,width=1000,left=200,top=200,scrollbars=no,menubar=no')" class="tr">
                    <td align="center"><?=$bilangan."."?></td>
                    <td style="padding:3px"><?=$perkara_low?></td>                    
                    <td align="center"><?=$tarikh_daftar?></td> 
                    <td align="center"><?=$tarikh_surat?></td>                   
                    <td align="center"><?=$kategori?></td> 
                    <td align="center"><img src="../pic/<?=$jenis_surat?>_jenis_surat.png" width="35" height="21" title="<?=$jenis?>"/> 
					</td> 
                </tr>	
	<?php } //Penutup WHILE
	  }
	  else 
	  {
	  ?>
             <tr>
            	<td colspan="7" align="center"><em>- Tiada Daftar Surat Direkodkan -</em></td><!-- Display when no data -->
            </tr>
 <?php } ?>
	  </tbody>
	 </table>
<br />
<?php
mysql_free_result($result_info_surat);
//mysql_close($connection);
?>
<p>
<?php
//===========CLOSE PAGE==========
include ("../../includefail/connection_eBPF.php");
include("../../includefail/footerekeluar.php"); ?>
 
<script>
$(document).ready( function () {
    $('#table1').DataTable();
} );
</script>