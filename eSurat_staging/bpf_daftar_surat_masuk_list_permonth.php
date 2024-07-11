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
	include ("../../includefail/connection_eBTM.php"); 
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$bulan = $_GET ['bulan'];	
	$tahun = $_GET ['tahun'];			
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
    <style>
	a:link:after,a:visited:after{content:"(" attr(href) ")";font-size:0%}	
	</style> 
</br>            
      <table width="90%">
        <tr>
        <td width="5%">
        <img src="../pic/bck.png" width="30" height="30" title="Kembali ke Laman Sebelum" onclick="history.back()"/> 
        </td>
        <td align="center">
        <b><div style="font-size:16px">Daftar Surat Menyurat Masuk<br /><font color="red"><?=$full_month?> <?=$tahun?></font></div></b>
        </td>
        <td>&nbsp;    
        </td>
        </tr>
    </table>
<hr />
		
<?php		
	 
			$limit =10;  
			
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
			$start_from = ($page-1) * $limit;  
			
			if (isset($_GET["next"])) 
			{ 
			$start_from = $_GET["start"];
			$start_from = $start_from + $limit; 
			} 
			
			else 
			{ 
			$start_from = $start_from;
			};
			
			if (isset($_GET["prev"])) 
			{ 
			$start_from = $_GET["start"];
			
				if ($start_from < $limit)
				{
				$start_from = $start_from;
				}
				else
				{
				$start_from = $start_from - $limit; 
				}
			} 
			
			else 
			{ 
			
			$start_from = $start_from;
			};


?>

<style type="text/css">
.style1 {
	bgcolor="#FF0000"
}
</style>		
			
				<?php
                
                if (!isset($_GET['no']))
                {
                $no = 0;
                $nolama = 0;
                $nobaru = 10;
                }
                else
                {
                $no = $_GET['no'];
                    if ($no >= 10)
                    {
                        $nolama = $no - 10;
                        $nobaru = $no + 10;
                    }
                    else
                    {
                        $nolama = 0;
                        $nobaru = $no + 10;	
                    }
                }
			include ("../../includefail/connection_eBPF.php");
			$query_info_surat = "SELECT *
								FROM maklumat_daftar_surat_masuk WHERE month(tarikh_daftar) = '$bulan' AND year(tarikh_daftar) = '$tahun' AND  aktif  = 'Y' ORDER BY tarikh_daftar DESC LIMIT $start_from, $limit ";	
			//echo $query_info_surat;
			$result_info_surat = mysql_query($query_info_surat) or die ("Error in query_info_surat : $query_info_surat ".mysql_error()); ?>
                
            <table width="90%" border="0" style="font-size:14px" align="center">
                <tr style="color:#FFFFFF">
                  <td width="5%" bgcolor="#6CB1F1"><div align="center"><strong>No.</strong></div></td>
                  <td bgcolor="#6CB1F1"><div align="left"><strong>Perkara</strong></div></td>
                  <td bgcolor="#6CB1F1"><div align="left"><strong>Tarikh Surat</strong></div></td>
                  <td bgcolor="#6CB1F1"><div align="center"><strong>Tarikh Daftar</strong></div></td>
                  <td bgcolor="#6CB1F1"><div align="center"><strong>Kategori Surat</strong></div></td>                                                
                </tr> 
	<?php
	if (mysql_num_rows($result_info_surat)>0)
    {
			$bilangan = $no;
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
				<tr onMouseOver="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" onclick="DoNav('btm_daftar_surat_masuk_list_permonth.php?bulan=<?=$bulan?>&action=1&id_daftar=<?=$id_daftar?>&tahun=<?=$tahun?>&jenis_surat=<?=$jenis_surat?>');" class="tr">
                <td align="center"><?=$bilangan."."?></td>
                    <td><?=$perkara_selct?>..</td>
                    <td align="left"><?=$tarikh_surat?></td>
                    <td align="center"><?=$tarikh_daftar?></td>                    
                    <td align="center"><?=$kategori?></td>                      
					</td>                     
               </tr>	
			
	<?php } ?>
<?php }
	  else 
	  {
	  ?>
             <tr>
            	<td colspan="8" align="center"><em>- Tiada Daftar Surat Direkodkan Pada Bulan <?=$full_month?>-<?=$tahun?> -</em></td><!-- Display when no data -->
            </tr>
 <?php } ?>
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
$query="SELECT *
FROM maklumat_daftar_surat_masuk  
WHERE  month(tarikh_daftar) = '$bulan' AND year(tarikh_daftar) = '$tahun' AND  aktif  = 'Y'";
$rs_result = mysql_query($query) or die ('Error in query:$query.'.mysql_error());  
$row = mysql_num_rows($rs_result); 
$total_records = $row[0];  
$total_pages = ceil(mysql_num_rows($rs_result) / $limit);  
$pagLink = ""; 

echo $row[0];
$noloop =0;
?>
[ <a href="?prev=Y&start=<?=$start_from?>&action=<?php echo $action;?>&no=<?php echo $nolama;?>&bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>&mode=view&id_daftar=<?php echo $id_daftar;?>&jenis_surat=<?php echo $jenis_surat;?>"><<</a> ]
<?php
for ($i=1; $i<=$total_pages; $i++) 
{  
  $pagLink .="<a href='bpf_daftar_surat_masuk_list_permonth.php?page=".$i."&action=".$action."&no=".$noloop."&bulan=".$bulan."&tahun=".$tahun."&mode=view&action=&id_daftar=".$id_daftar."&jenis_surat=".$jenis_surat."'>".$i."</a>&nbsp;";
  $noloop = $noloop+10;
}
echo $pagLink . "";  
?>
[ <a href="?next=Y&start=<?=$start_from?>&action=<?php echo $action;?>&no=<?php echo $nobaru;?>&bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>&mode=view&id_daftar=<?php echo $id_daftar;?>&jenis_surat=<?php echo $jenis_surat;?>">>></a> ]

<hr />
<?php   	if($action == '1')
			{
				include ("bpf_daftar_surat_masuk_peryear_kemaskini.php");
				
			}			
include("../../includefail/footer.php"); ?>