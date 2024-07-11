<?php	
//=================MAKLUMAT PROGRAMMER======================================//
//																			//
//			Nama Programmer		:	Asrul Izham Jaafar						//						   
//			Tarikh				:	5.1.2011 (11:47 AM)		     			//  
//			Hari				:  	Jumaat									//
//																			//
//==========================================================================//
	include("../../includefail/connection.php"); 

	$tahun = $_POST ['tahun'];	
		
	if ($tahun == "")
	{
		$tahun = date("Y");
	}
	else
	{
		$tahun = $_POST ['tahun'];
	}	
$colspan = 0;
?>
<div style="font-size:16px"><b><u>Statistik Daftar Surat Keluar (<?=$tahun?>)</U> </b></div>
<p>
<table width="100%" border="0" align="center">
  <tr>
    <td>  
      <div align="center">
        <table width="100%" border="0">
          <tr bgcolor="#999999">            
            <td width="40%"><div align="center"><strong>Jenis</strong></div></td>
            <?php
			include("../../includefail/connection.php");
              $sql_bulan = "SELECT * FROM bulan order by idbulan";		
              $result_bulan=mysql_query($sql_bulan)or die ("".mysql_error());	
              while($row_bulan=mysql_fetch_array($result_bulan))
              {	
			  	$colspan = $colspan + 1;	  					  
            ?>
            <td width="5%" bgcolor="#999999"><div align="center"><strong><?=$row_bulan['singkatanBM']?></strong></div></td>
            <?php } ?>
          </tr>				     
          <tr>
          	<td align="center"><strong>Daftar Surat Keluar</strong></td>
            <?php
			//  $jumlahtiadaalasanbulan = 0;
			  include("../../includefail/connection.php");
              $sql_bulan_row = "SELECT * FROM bulan order by idbulan";		
              $result_bulan_row=mysql_query($sql_bulan_row)or die ("Error sql_bulan_row : ".mysql_error());	
              while($row_bulan_row=mysql_fetch_array($result_bulan_row))
              {	
			  	 
				 $monthloop = $row_bulan_row['idbulan'];
				 
				switch ($monthloop) {
					case "1":
						$bulanloop="01";
						break;
					case "2":
						$bulanloop="02";
						break;
					case "3":
						$bulanloop="03";
						break;
					case "4":
						$bulanloop="04";
						break;
					case "5":
						$bulanloop="05";
						break;
					case "6":
						$bulanloop="06";
						break;
					case "7":
						$bulanloop="07";
						break;
					case "8":
						$bulanloop="08";
						break;
					case "9":
						$bulanloop="09";
						break;
					case "10":
						$bulanloop="10";
						break;
					case "11":
						$bulanloop="11";
						break;
					case "12":
						$bulanloop="12";
						break;																		
				}				 
				 
				 include("../../includefail/connection_eBPF.php");             	
				 $sql_laporan = "SELECT COUNT(id_daftar) AS bilangan, id_daftar FROM maklumat_daftar_surat_keluar WHERE month(tarikh_daftar) = '$bulanloop' AND year(tarikh_daftar) = '$tahun' AND aktif  = 'Y'";
             	 $result_laporan=mysql_query($sql_laporan)or die ("".mysql_error());
				 $row_laporan=mysql_fetch_array($result_laporan);	
				 //echo $sql_laporan;
				 if (!isset($bulan[$row_bulan_row['idbulan']]))
				 {
					 $bulan[$row_bulan_row['idbulan']]=0;
				 }
				 
				 if (!isset($row_laporan['bilangan']))
				 {
					 $displayLaporan="-";
				 }	
				 else
				 {
					 if ($row_laporan['bilangan']==0)
					 {
						 $displayLaporan="-";
					 }
					 else
					 {
					 	$displayLaporan=$row_laporan['bilangan'];
					 }
				 }
				 
				 $bulan[$row_bulan_row['idbulan']] +=  $row_laporan['bilangan'];
				 //$id_maklumat = $row_laporan['id_daftar'];	  	  					  
            ?>            
            <td><?php if (($displayLaporan < 10)&&($displayLaporan >= 1)) { ?>		
                    <div align="center" style="color:#FF0000">
                    <?php } 
                    else
                    {
                    ?>
                    <div align="center">
                    <?php } ?>
                    <a href="bpf_daftar_surat_keluar_list_permonth.php?bulan=<?=$bulanloop?>&tahun=<?=$tahun?>&action=&id_daftar=&jenis_surat=&mode="><?=$displayLaporan?></a>
                    </div>               
            </td> 
            
            <?php } ?> 
          </tr>       
          <tr bgcolor="#FFFFCC">
          	<td colspan="1"><strong>Jumlah</strong></td>
            <?php
			include("../../includefail/connection.php");
              $sql_bulan_jumlah = "SELECT * FROM bulan order by idbulan";		
              $result_bulan_jumlah=mysql_query($sql_bulan_jumlah)or die ("".mysql_error());	
              while($row_bulan_jumlah=mysql_fetch_array($result_bulan_jumlah))
              {	
  					  
            ?>
            <td width="5%" ><div align="center"><strong><?=$bulan[$row_bulan_jumlah['idbulan']]//$jumlahtiadaalasanbulan?></strong></div></td>
            <?php 
			$bulan[$row_bulan_jumlah['idbulan']]=0;
			} ?>            
          </tr>         
		</table>
	</div>
    </td>  
  </tr>                    
</table>