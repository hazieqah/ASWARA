<?php 
//------------------------------------------------------------------------------//
//				Nama Programmer	:	  Ts. Asrul Izham Jaafar               		          //
//				Tarikh			    :	  14.03.2024                       		              //
//				Masa			      :	  7:49 am                     		                  //   
//				Hari			      :   Khamis                         		                //
//------------------------------------------------------------------------------//
date_default_timezone_set("Asia/Kuala_Lumpur");
include ("../../includefail/header.php");
include ("../../includefail/connection_eBPF.php");
$action                         =       $_GET['action'];
?>
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/new.css"> 
	<link rel="stylesheet" type="text/css" media="screen" href="../newdatatable/css/jquery.dataTables.min.css"> 
	<link rel="stylesheet" type="text/css" media="screen" href="../newdatatable/css/responsive.dataTables.min.css"> 
	<script src="../newdatatable/js/jquery-3.5.1.js"></script>
	<script src="../newdatatable/js/jquery.dataTables.min.js"></script>
	<script src="../newdatatable/js/dataTables.responsive.min.js"></script>	  
</head>
<body>
<?php
  $sql_fail                     =       "SELECT * FROM  kod_no_ruj_fail_bpf WHERE aktif = 'Y' ORDER BY id_kod DESC";							
  $result_fail                  =        mysql_query($sql_fail) or die ('Error in sql_fail : $sql_fail '.mysql_error());
  ?>
  <h2>Pengurusan No Fail BPF</h2><hr>
  <div class="testbox">	
  <table class="display" id="tabel-data1" style="width:80%; border:1px;">
    <thead>
		<tr bgcolor="#588b97" style="align: center;">			 
      <td align="center"><b>#</b></td>
      <td align="left"><strong>No. Rujukan Fail</strong></td> 
      <td align="left"><strong>Keterangan</strong></td>  
      <td align="center"><strong>Kemaskini</strong></td>
      <td align="center"><b>Padam</b></td>                    
	    </tr>
  </thead>
  <tbody>
<?php
	if (mysql_num_rows($result_fail)  > 0)
      {
        $no                     =       1;	
        while($row_fail         =       mysql_fetch_array($result_fail))
          {           
          $id_kod               =       $row_fail['id_kod'];
          $no_ruj_fail          =       $row_fail['no_ruj_fail'];
          $keterangan           =       $row_fail['keterangan'];	
          if ($keterangan       ==      '')
          {
            $keterangan         =       "-";
          }
          else
          {
            $keterangan         =       $keterangan;
          } ?>
    <tr>
      <td align="center"><?=$no?>.</td> 
      <td align="left"><?=$no_ruj_fail?></td> 
      <td align="left"><?=$keterangan?></td>              
      <td align="center"><a href="bpf_add_daftar_no_fail.php?id=<?=$id_kod?>&action=edit" title="Kemaskini Maklumat"><img src="../pic/edit.png" width="25" height="25" /></a></td>
      <td align="center"><a href="bpf_add_daftar_no_fail.php?id=<?=$id_kod?>&action=delete" onclick="return confirm('Anda Pasti Ingin Memadam Rekod Ini?');"><img src="../../pic/delete.jpg" width="16" height="16" /></a></td>
    </tr>	
<?php	$no++;
    	} 
     }	?>
  </tbody>	
  </table>
<br />
<table width="80%" border="0" align="center">
    <tr>
      <td align="right"><strong><a href="?action=tambah" title="Tambah No. Fail Rujukan"><img src="../pic/add.jpg" width="30" height="30"></a></strong></td>
    </tr>
</table>
<br />
<?php
if ($action                     ==        "tambah")
  {  ?>
  <form id="form" name="form" method="post" action=""  onSubmit="return checkdata();">
    <table width="80%"  border="0" align="center" bgcolor="#588b97">                
        <tr bgcolor="#588b97">
            <td colspan="3" style="color:#CCC;padding:3px"><strong>::Tambah No. Fail Baharu::</strong></td>     
        </tr>
        <tr>
        <td colspan="3">&nbsp;</td> 
        </tr>
        <tr height="30px">
          <td width="20%"><b>No. Fail Rujukan</b></td>
          <td width="2%">:</td>
          <td>                  
          <textarea id="no_ruj_fail" name="no_ruj_fail" style="height: 100px; padding: 10px 18px; width: 300px;" placeholder="Masukan No. Rujukan Fail"></textarea>
          </td>                                  
      </tr>
      <tr>
        <td  height="50"><b>Keterangan</b></td>
        <td>:</td>
        <td> 
        <textarea id="keterangan" name="keterangan" style="height: 100px; padding: 10px 18px; width: 300px;" placeholder="Masukan Keterangan"></textarea> 
        </td>
      </tr>                                                   
      <tr>
        <td colspan="4">
        <hr />
        </td>
      </tr>
        <tr>
        <td colspan="4"><input type="submit" name="submit" id="submit" value="Daftar Baharu" /></td>
      </tr>
    </table>
    </form>  
  <?php
  }
  else if($action               ==          'edit')
  {
    $id                         =           $_GET['id'];
    $sql_get                    =           "SELECT * FROM  kod_no_ruj_fail_bpf where aktif = 'Y' AND id_kod = '$id'";							
    $result_get                 =           mysql_query($sql_get) or die ('Error in sql_get : $sql_get '.mysql_error());
    $row_get                    =           mysql_fetch_array($result_get);

    $id_kod                     =           $row_get['id_kod'];
    $no_ruj_fail                =           $row_get['no_ruj_fail'];
    $keterangan                 =           $row_get['keterangan'];
    if ($keterangan             ==          '')
    {
      $keterangan               =           "Tiada";
    }
    else
    {
      $keterangan               =         $keterangan;
    }
    ?>
    <form id="form" name="form" method="post" action=""  onSubmit="return checkdata();">
      <table width="80%"  border="0" align="center" bgcolor="#588b97">                
        <tr bgcolor="#588b97">
            <td colspan="3" style="color:#CCC;padding:3px"><strong>::Kemaskini No. Fail BPF::</strong></td>     
        </tr>
        <tr>
        <td colspan="3">&nbsp;</td> 
        </tr>
        <tr height="30px">
          <td width="20%"><b>No Ruj. Fail</b></td>
          <td width="2%">:</td>
          <td>
            <textarea id="no_ruj_fail" name="no_ruj_fail" style="height: 100px; padding: 10px 18px; width: 300px;" placeholder="Masukan No. Rujukan Fail"><?=$no_ruj_fail?></textarea>
          </td>                                  
      </tr>
      <tr>
        <td  height="50"><b>Keterangan</b></td>
        <td>:</td>
        <td>
          <textarea id="keterangan" name="keterangan" style="height: 100px; padding: 10px 18px; width: 300px;" placeholder="Masukan Keterangan"><?=$keterangan?></textarea>          
        </td>
      </tr>                          
      <tr>
        <td colspan="4">
        <hr />
        </td>
      </tr>
        <tr>
        <td colspan="4">                                
        <input type="hidden" id="id_kod" name="id_kod" value="<?=$id_kod?>">
        <input type="submit" name="update" id="update" value="Kemaskini" />
        </td>
      </tr>
    </table>
    <br />          
    </form>
  <?php
  }
  else if($action               ==      "delete")
  {
    $id                         =       $_GET['id'];
              
    $sql_delete                 =       "UPDATE kod_no_ruj_fail_bpf SET aktif = 'N' WHERE id_kod = '$id'";
    $result                     =       mysql_query ($sql_delete) or die ("Error in sql_delete : $sql_delete ".mysql_error());   

    print '<script type="text/javascript">'; 
    print 'alert("No. Fail Berjaya Dipadam!")'; 
    print '</script>';
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=bpf_add_daftar_no_fail.php?action=">';
    exit();
  }

if (isset ($_POST['submit']))
{
 $no_ruj_fail                   =     $_POST['no_ruj_fail'];
  $keterangan                   =     $_POST['keterangan'];				            
          

  $sql_insert                   =     "INSERT INTO kod_no_ruj_fail_bpf (no_ruj_fail, keterangan, aktif) VALUES ('$no_ruj_fail', '$keterangan', 'Y')";
  $result_insert                =     mysql_query($sql_insert) or die ("Error in sql_insert : $sql_insert ".mysql_error());

  print '<script type="text/javascript">';
  print 'alert("No. Fail Berjaya Disimpan!")';
  print '</script>';
  echo '<meta HTTP-EQUIV="REFRESH" content="0; url=bpf_add_daftar_no_fail.php?action=">';
  exit();
}
else if (isset ($_POST['update']))
{
  $id_kod                       =     $_POST['id_kod'];
  $no_ruj_fail                  =     $_POST['no_ruj_fail'];
  $keterangan                   =     $_POST['keterangan'];	 

  $sql_update                   =     "UPDATE kod_no_ruj_fail_bpf SET no_ruj_fail = '$no_ruj_fail', keterangan='$keterangan', aktif='Y' WHERE id_kod = '$id_kod'";
  $result_insert                =     mysql_query($sql_update) or die ("Error in sql_update : $sql_update ".mysql_error());

  print '<script type="text/javascript">';
  print 'alert("No. Fail Berjaya Dikemaskini!")';
  print '</script>';
  echo '<meta HTTP-EQUIV="REFRESH" content="0; url=bpf_add_daftar_no_fail.php?action=edit&id='.$id_kod.'">';
  exit();
}
 include("../../../includefail/footerekeluar.php"); ?>
 </div>
 <script>
  $.extend( $.fn.dataTable.defaults, 
  {
      responsive: true
  } );

  $(document).ready( function () 
  {
      $('#tabel-data1').DataTable();
  } );  
 
  function checkdata() 
  {    
    let isValid = true;
    if (document.form.no_ruj_fail.value == "") 
    {
      alert("Sila Isikan No. Fail Ruj.");
      isValid = false; 
    }
    
    if (document.form.keterangan.value == "") 
    {
      alert("Sila Isikan Keterangan, Jika Tiada Isikan : Tiada");
      isValid = false; 
    }
    return isValid;
  }
</script>
</body>
 