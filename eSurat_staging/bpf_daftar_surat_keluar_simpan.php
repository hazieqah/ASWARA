<?php 
	//----------------------------------------------------------//
	//			Nama Programmer		:	Asrul Izham Jaafar		//						   
	//			Tarikh				:	25.12.2017  			//                           
	//			Masa				:	12:35 AM      			//                          
	//			Hari				:   Ahad 	      			//                         
	//----------------------------------------------------------//
	session_start();
	date_default_timezone_set("Asia/Kuala_Lumpur");		
	include ("../../includefail/connection_eBPF.php");
		
	$form = $_POST['form'];	
	$datecreated = date ("Y-m-d H:i");
	$id = $_SESSION['id'] ;
	$bulan=date('m');
	$tahun =date('Y');
	
	switch ($form) {
    case "task":
	
		//--------------------------------------------- Maklumat daftar mula ----------------------------------------------------------------------------------------------	
					//$tajuk =$_POST['tajuk'];
					$perkara = mysql_real_escape_string ($_POST['perkara']);
					$no_ruj_fail_btm =$_POST['no_ruj_fail_btm'];					
					$kategori_surat =$_POST['kategori_surat'];					
					$id_daripada =$_POST['id_daripada'];
					$tarikh_daftar =$_POST['tarikh_daftar'];										
					$no_ruj_surat = mysql_real_escape_string ($_POST['no_ruj_surat']);		
					$tarikh_surat =$_POST['tarikh_surat'];
					$surat_kepada = mysql_real_escape_string ($_POST['surat_kepada']);
					$tarikh_hantar =$_POST['tarikh_hantar'];					
										
					$sql_tambah_daftar = "INSERT INTO maklumat_daftar_surat_keluar (perkara, jenis_surat, no_ruj_fail_btm, kategori_surat, id_daripada, tarikh_daftar, no_ruj_surat, tarikh_surat, surat_kepada, tarikh_hantar, staf_key_in, datekeyin, aktif) VALUES ('$perkara', '2', '$no_ruj_fail_btm', '$kategori_surat', '$id_daripada', '$tarikh_daftar', '$no_ruj_surat', '$tarikh_surat', '$surat_kepada', '$tarikh_hantar', '$id', '$datecreated', 'Y')" ;					
					$result_tambah_daftar = mysql_query($sql_tambah_daftar) or die("ERROR in query sql_tambah_daftar : $sql_tambah_daftar ".mysql_error());
					
					$sql_latest = "SELECT * FROM maklumat_daftar_surat_keluar where aktif = 'Y' ORDER BY id_daftar desc LIMIT 1";
					$result_latest = mysql_query($sql_latest) or die("ERROR in query sql_latest: $sql_latest".mysql_error());	
					$row_latest = mysql_fetch_array ($result_latest);
					$id_daftar = $row_latest['id_daftar'];					
										
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
					
							if (file_exists("dokumenSokongan/" . $id_daftar ."_2_" . $_FILES["file"]["name"]))
							{
								echo "<script>alert('File Telah Wujud. Data Tidak Berjaya Disimpan')</script>";
								echo "<script>location.reload();</script>";
							}
							else
							{
								move_uploaded_file($_FILES["file"]["tmp_name"],
								"dokumenSokongan/" . $id_daftar . "_2_" . $_FILES["file"]["name"] );
								echo "Stored in: " . "dokumenSokongan/" . $_FILES["file"]["name"];
							  
								$dir = $id_daftar . "_2_" . $_FILES["file"]["name"];							  
								
								$query = "UPDATE maklumat_daftar_surat_keluar 
								SET dokumen_sokongan='$dir' 
								WHERE id_daftar='$id_daftar'";
								$result=mysql_query($query) or die("".mysql_error());
					
							}
						}
					}
					else
					{
						
						if ($_FILES["file"]["size"] == 0)
						{
								$query = "UPDATE maklumat_daftar_surat_keluar 
								SET dokumen_sokongan='Tiada'
								WHERE id_daftar='$id_daftar'";
								$result=mysql_query($query) or die("".mysql_error());
						
						}	
						else
						{
						
						}
					}
					
					?><script>alert("Daftar Surat Keluar ke Dalam Rekod BPF Berjaya!");
					 </script> <?php
						
		//--------------------------------------------- Maklumat daftar tamat ----------------------------------------------------------------------------------------------				
        break;		
    default:
       ?><script>alert("You LOST Man!");
       </script> <?php
}

  echo '<meta HTTP-EQUIV="REFRESH" content="0; url=bpf_daftar_surat_list.php?action=&jenis_surat=&id_daftar=&mode=">';
	

?>

