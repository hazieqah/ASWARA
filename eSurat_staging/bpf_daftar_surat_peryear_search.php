<?php
//=================MAKLUMAT PROGRAMMER======================================//
//																			//
//			Nama Programmer		:	Asrul Izham Jaafar						//						   
//			Tarikh				:	4.1.2011 (3:34 PM)		     			//  
//			Hari				:  	Khamis									//
//																			//
//==========================================================================//
include("../../includefail/header.php");
include("../../includefail/connection.php"); 
$tahun = $_GET['tahun'];
$jenis_surat = $_GET['jenis_surat'];
?>
<br />
<table width="90%">
        <tr>
        <td width="5%"> 
		<img src="../../pic/bck.png" width="30" height="30" title="Kembali ke Laman Sebelum" onclick="history.back()"/>
        </td>
        <td align="left">
        <b><div style="font-size:16px">Statistik Daftar Surat</div></b>
        </td>
        <td>&nbsp;    
        </td>
        </tr>
    </table>
<hr />

<form id="form2" name="form8" method="post" action="">
 
          <table width="70%" border="0" align="center">                
                 <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td>
                    	<select id="tahun" name="tahun" class="S" id="select">
                          <option value="">-Sila Pilih-</option>
                          <?php
                            $sql = ("SELECT * FROM tahun order by tahun asc");
                            $result = mysql_query ($sql) or die ("".mysql_error());
                            while ($row = mysql_fetch_array($result))
                            {?>
                             <option <?php if ( $row ['tahun'] == $tahun) { ?> selected="selected"  <?php } ?>
                             value="<?php echo $row['tahun']; ?>"><?php echo $row ['tahun']; ?></option>
                             <?php 
                            }
                            ?>
                        </select>
                       </td>
                       <td>
                       &nbsp;
                       </td>
                       <td>
                       <input type="submit" name="Search" id="Search" value="     Papar      " /> 
                       </td>
                 </tr>
                 <tr>
                   <td colspan="3">&nbsp;                          
                   </td>
                 </tr>
                 <tr>
                 	<td colspan="3" align="left">                    
                    <input type="hidden" name="mode" id="mode" value="view" /> 
                    <input type="hidden" name="jenis_surat" id="jenis_surat" value="<?=$jenis_surat?>" /> 
                    </td>
                 </tr>
             </table>         
</form>
<hr />
<table width="100%" border="0">
  <tr>
    <td align="center">
	 <?php
	if (isset ($_POST ['Search']))
	{
		$jenis_surat = $_POST['jenis_surat'];
		
		if($jenis_surat == '1')
		{
			include ("bpf_daftar_surat_peryear_result.php");
		}
		else if($jenis_surat == '2')
		{
			include ("bpf_daftar_surat_keluar_peryear_result.php");
		}
	}			
	?>
 	</td>
  </tr>
</table>

<?php include("../../includefail/footer.php"); ?> 