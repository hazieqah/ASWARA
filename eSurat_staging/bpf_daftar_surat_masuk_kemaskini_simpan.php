<?php 
	//----------------------------------------------------------//
	//			Nama Programmer		:	Asrul Izham Jaafar		//						   
	//			Tarikh				:	27.12.2017  			//                           
	//			Masa				:	6:59 AM      			//                          
	//			Hari				:   Rabu 	      			//                         
	//----------------------------------------------------------//
	session_start();
	date_default_timezone_set("Asia/Kuala_Lumpur");		
	include ("../../includefail/connection_eBPF.php");
		
	$form=$_POST['form'];	
	$datecreated = date ("Y-m-d H:i");
	$id = $_SESSION['id'] ;
	
	
	switch ($form) {
    case "kemaskini":	
		//--------------------------------------------- Kemaskini Daftar Surat Mula ----------------------------------------------------------------------------------------------	
					$id_daftar =$_POST['id_daftar'];
					$perkara = mysql_real_escape_string ($_POST['perkara']);
					$no_ruj_fail_btm =$_POST['no_ruj_fail_btm'];					
					$kategori_surat =$_POST['kategori_surat'];					
					$surat_daripada = mysql_real_escape_string ($_POST['surat_daripada']);
					$tarikh_daftar =$_POST['tarikh_daftar'];										
					$no_ruj_surat = mysql_real_escape_string ($_POST['no_ruj_surat']);		
					$tarikh_surat =$_POST['tarikh_surat'];
					$dirujuk_kepada_id =$_POST['dirujuk_kepada_id'];
					$tarikh_rujuk =$_POST['tarikh_rujuk'];
																		
					$sql_update = "UPDATE maklumat_daftar_surat_masuk SET perkara = '$perkara', jenis_surat = '1', no_ruj_fail_btm = '$no_ruj_fail_btm', kategori_surat = '$kategori_surat', surat_daripada = '$surat_daripada', tarikh_daftar = '$tarikh_daftar', no_ruj_surat = '$no_ruj_surat', tarikh_surat = '$tarikh_surat', dirujuk_kepada_id = '$dirujuk_kepada_id', tarikh_rujuk = '$tarikh_rujuk' WHERE id_daftar = '$id_daftar'";
					$result_update = mysql_query($sql_update) or die("ERROR in query sql_update : $sql_update ".mysql_error());					
										
					if ((($_FILES["file"]["type"] == "application/msword")
					|| ($_FILES["file"]["type"] == "application/pdf")
					|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/pjpeg"))
					&& ($_FILES["file"]["size"] < 10000000))
				
					{
						if ($_FILES["file"]["error"] > 0)
						{
							echo "<script>alert('Return Code: " . $_FILES["file"]["error"] . "<br />')</script>";
							echo "<script>close();</script>";
						}
						else
						{
							echo "Upload: " . $_FILES["file"]["name"] . "<br />";
							echo "Type: " . $_FILES["file"]["type"] . "<br />";
							echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
							echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
					
							if (file_exists("dokumenSokongan/" . $id_daftar . "_1_" . $_FILES["file"]["name"]))
							{
								echo "<script>alert('File Telah Wujud. Data Tidak Berjaya Disimpan')</script>";
								echo "<script>location.reload();</script>";
							}
							else
							{
								move_uploaded_file($_FILES["file"]["tmp_name"],
								"dokumenSokongan/" . $id_daftar . "_1_" . $_FILES["file"]["name"] );
								echo "Stored in: " . "dokumenSokongan/" . $_FILES["file"]["name"];
							  
								$dir = $id_daftar . "_1_" . $_FILES["file"]["name"];							  
								
								$query = "UPDATE maklumat_daftar_surat_masuk 
								SET dokumen_sokongan='$dir' 
								WHERE id_daftar='$id_daftar'";
								$result=mysql_query($query) or die("".mysql_error());
					
							}
						}
					}				
					
					?><script>alert("Maklumat Daftar Surat Masuk Berjaya Dikemaskini!");
					</script> <?php										
									
		//--------------------------------------------- Kemaskini Daftar Surat Tamat ----------------------------------------------------------------------------------------------				
        break;		
    default:
       ?><script>alert("You LOST Man!");
       </script> <?php
}

   echo '<meta HTTP-EQUIV="REFRESH" content="0; url=bpf_daftar_surat_list.php?mode=kemaskini&action=1&id_daftar='.$id_daftar.'&jenis_surat=1">';
	

?>

