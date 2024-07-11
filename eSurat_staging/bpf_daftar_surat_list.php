<?php
	//=================MAKLUMAT PROGRAMMER======================//
	//															//
	//			Nama Programmer		:	Asrul Izham Jaafar		//						   
	//			Tarikh				:	25.12.2017 	    		//                           
	//			Masa				:	12:15 PM      			//                          
	//			Hari				:   Isnin	       			//
	//															//
	//==========================================================//
	
	include("../../includefail/header.php");
	include ("../../includefail/connection_eBPF.php"); 
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$bulan = date("m");	
	$tahun = date("Y");
	$day = date("d");
	$mode = $_GET ['mode'];	
	$action = $_GET ['action'];
	$id_daftar = $_GET ['id_daftar'];
	$jenis_surat = $_GET ['jenis_surat'];

	switch ($bulan) {
		case "01":
			$full_month="Januari";
			break;
		case "02":
			$full_month="Februari";
			break;
		case "03":
			$full_month="Mac";
			break;
		case "04":
			$full_month="April";
			break;
		case "05":
			$full_month="Mei";
			break;
		case "06":
			$full_month="Jun";
			break;
		case "07":
			$full_month="Julai";
			break;
		case "08":
			$full_month="Ogos";
			break;
		case "09":
			$full_month="September";
			break;
		case "10":
			$full_month="Oktober";
			break;
		case "11":
			$full_month="November";
			break;
		case "12":
			$full_month="Disember";
			break;																		
	}
	 
	$hariBI=date("l");	 
	switch ($hariBI) {
		case "Monday":
			$hariBM = "Isnin";
			$weekend = "N";
			break;
		case "Tuesday":
			$hariBM =  "Selasa";
			$weekend = "N";
			break;
		case "Wednesday":
			$hariBM = "Rabu";
			$weekend = "N";
			break;
		case "Thursday":
			$hariBM =  "Khamis";
			$weekend = "N";
			break;
		case "Friday":
			$hariBM =  "Jumaat";
			$weekend = "N";
			break;
		case "Saturday":
			$hariBM =  "Sabtu";
			$weekend = "Y";
			break;
		case "Sunday":
			$hariBM =  "Ahad";
			$weekend = "Y";
			break;	
	}			
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
	<link rel="stylesheet" type="text/css" media="screen" href="../newdatatable/css/jquery.dataTables.min.css"> 
	<link rel="stylesheet" type="text/css" media="screen" href="../newdatatable/css/responsive.dataTables.min.css"> 
	<script src="../newdatatable/js/jquery-3.5.1.js"></script><https://code.jquery.com/jquery-3.5.1.js>
	<script src="../newdatatable/js/jquery.dataTables.min.js"></script><https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js>
	<script src="../newdatatable/js/dataTables.responsive.min.js"></script><https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js>
</head>
<script>
$.extend( $.fn.dataTable.defaults, {
    responsive: true
} );
$(document).ready(function() {
    $('#tableDaftarSurat').DataTable();
} );			
</script>
    <style>
	a:link:after,a:visited:after{content:"(" attr(href) ")";font-size:0%}	
	</style> 
</br>            
      <table width="90%">
        <tr>
        <td width="5%">
        <img src="../../pic/bck.png" width="30" height="30" title="Kembali ke Laman Sebelum" onclick="location.href = '<?=$gl_url?>/pages/eBPF/index.php';"/> 
        </td>
        <td align="center">
        <b><div style="font-size:16px">Daftar Surat Menyurat <br /><font color="red"><?=$day?> <?=$full_month?> <?=$tahun?> (<?=$hariBM?>)</font></div></b>
        </td>
        <td>&nbsp;    
        </td>
        </tr>
    </table>
<hr />
		

<style type="text/css">
.style1 {
	bgcolor="#FF0000"
}
</style>		
			
				<?php

			include ("../../includefail/connection_eBPF.php");
			$query_info_surat = "SELECT *
								FROM maklumat_daftar_surat_masuk  
								WHERE  day(tarikh_daftar) = '$day' AND month(tarikh_daftar) = '$bulan' AND year(tarikh_daftar) = '$tahun' AND  aktif  = 'Y'  
								UNION
								SELECT *
								FROM maklumat_daftar_surat_keluar 
								WHERE  day(tarikh_daftar) = '$day' AND month(tarikh_daftar) = '$bulan' AND year(tarikh_daftar) = '$tahun' AND  aktif  = 'Y'  
								ORDER BY tarikh_daftar ";	
			//echo $query_info_surat;
			$result_info_surat = mysql_query($query_info_surat) or die ("Error in query_info_surat : $query_info_surat ".mysql_error()); ?>
                
            <table width="90%" border="1" style="font-size:14px" align="center" class="display" id="tableDaftarSurat">
				<thead>
					<tr style="background-color:#6CB1F1; color:white">
					<td width="5%" ><div align="center"><strong>No.</strong></div></td>
					<td><div align="left"><strong>Perkara</strong></div></td>
					<td><div align="left"><strong>Tarikh Surat</strong></div></td>
					<td><div align="center"><strong>Tarikh Daftar</strong></div></td>
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
						
			include ("../../../includefail/connection_eBPF.php");		
			$query_jenis="SELECT * FROM kod_jenis_surat WHERE id_kategori  = '$jenis_surat' AND aktif = 'Y'";				
            $result_jenis=mysql_query($query_jenis) or die ('Error in query_jenis : $query_jenis '.mysql_error());
			$row_jenis = mysql_fetch_array($result_jenis);
			$jenis = $row_jenis['kategori'];
			
			$query_kategori="SELECT * FROM kod_kategori_surat WHERE id_kod  = '$kategori_surat' AND aktif = 'Y'";				
            $result_kategori=mysql_query($query_kategori) or die ('Error in query_kategori : $query_kategori '.mysql_error());
			$row_kategori = mysql_fetch_array($result_kategori);
			$kategori = $row_kategori['keterangan'];			
			?>
				<tr onMouseOver="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" onclick="DoNav('bpf_daftar_surat_list.php?mode=kemaskini&action=<?=$jenis_surat?>&id_daftar=<?=$id_daftar?>&jenis_surat=<?=$jenis_surat?>');" class="tr">
                <td align="center"><?=$bilangan."."?></td>
                    <td><?=$perkara_selct?>..</td>
                    <td align="left"><?=$tarikh_surat?></td>
                    <td align="center"><?=$tarikh_daftar?></td>                    
                    <td align="center"><?=$kategori?></td> 
                    <td align="center"><img src="../pic/<?=$jenis_surat?>_jenis_surat.png" width="35" height="21" title="<?=$jenis?>"/> 
					</td>                     
               </tr>	
			
	<?php } ?>
<?php }
	  ?>
 </tbody>
	 </table>
<br />

<br />
<table width="90%" align="center">
    <tr>
     <td align="right" width="82%">&nbsp;
    
    </td>     
    <td align="right" width="2%">
    <a href="bpf_daftar_surat_search_list.php?mode=tambah&action=&id_daftar=&jenis_surat=" title="Carian Surat">
    <img src="../pic/search3d.png" width="25" height="25" title="Daftar Surat"/> 
    </a>
    </td> 
    <td align="right" width="1%">&nbsp;
    
    </td> 
    <td align="right" width="2%">
    <a href="bpf_daftar_surat_list.php?mode=tambah&action=&id_daftar=&jenis_surat=" title="Daftar Surat">
    <img src="../../pic/add.jpg" width="30" height="30" title="Daftar Surat"/> 
    </a>
    </td>    
    </tr>
</table>
<hr />
<?php  if($mode == "tambah")
		{
			include ("bpf_daftar_surat.php");			
		}
		else if($mode == "kemaskini")
		{
			if($action == '1')
			{
				include ("bpf_daftar_surat_masuk_kemaskini_tab.php");
				
			}
			else if($action == '2')
			{
				include ("bpf_daftar_surat_keluar_kemaskini_tab.php");
				
			}
		}

include("../../includefail/footer.php"); ?>