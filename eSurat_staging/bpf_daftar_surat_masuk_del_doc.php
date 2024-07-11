<?php
include ("../../../includefail/connection_eBTM.php");
$id_daftar =$_GET['id_daftar'];

    $sql = "UPDATE maklumat_daftar_surat_masuk SET dokumen_sokongan = 'Tiada' WHERE id_daftar = '$id_daftar'";	
    $result = mysql_query ($sql) or die ("Error in sql : $sql ".mysql_error()); 
	
    print '<script type="text/javascript">'; 
    print 'alert("Dokumen Berjaya Dipadam!")'; 
    print '</script>';
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=btm_daftar_surat_list.php?mode=kemaskini&action=1&id_daftar='.$id_daftar.'&jenis_surat=1">';
    exit();
?>
