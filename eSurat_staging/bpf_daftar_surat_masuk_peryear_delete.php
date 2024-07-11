<?php
include ("../../../includefail/connection_eBTM.php");
$id_daftar =$_GET['id_daftar'];
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];

    $sql_del_personel = "UPDATE maklumat_daftar_surat_masuk SET aktif = 'N' WHERE id_daftar = '$id_daftar'";		
	$result_del_personel = mysql_query ($sql_del_personel) or die ("Error in sql_del_personel : $sql_del_personel ".mysql_error()); 	
	
    print '<script type="text/javascript">'; 
    print 'alert("Daftar Surat Masuk Berjaya Dipadam!")'; 
    print '</script>';
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=btm_daftar_surat_masuk_list_permonth.php?mode=&action=&id_daftar=&jenis_surat=&tahun='.$tahun.'&bulan='.$bulan.'">';
    exit();
?>
