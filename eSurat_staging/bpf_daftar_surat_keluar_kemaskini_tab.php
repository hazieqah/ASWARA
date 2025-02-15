﻿<?php
	//=================MAKLUMAT PROGRAMMER======================//
	//															//
	//			Nama Programmer		:	Asrul Izham Jaafar		//						   
	//			Tarikh				:	26.12.2017  			//                           
	//			Masa				:	01:25 PM      			//                          
	//			Hari				:   Selasa       			//
	//															//
	//==========================================================//
	
	include("../../includefail/connection_eBPF.php"); 
	$jenis = $_GET ['jenis_surat'];
	$id_daftar = $_GET ['id_daftar'];	
?>
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script>
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $("#tabs li").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }
    });
});
</script>
<style>
#tabs {
  overflow: hidden;
  width: 90%;
  margin: 0;
  padding: 0;
  list-style: none;
  text-align:center;  
}

#tabs li {
  float: left;
  margin: 0 .5em 0 0;
}

#tabs a {
  position: relative;
  background: #ddd;
  background-image: linear-gradient(to bottom, #fff, #ddd);  
  padding: .7em 3.5em;
  float: left;
  text-decoration: none;
  color: #444;
  text-shadow: 0 1px 0 rgba(255,255,255,.8);
  border-radius: 5px 0 0 0;
  box-shadow: 0 2px 2px rgba(0,0,0,.4);
}

#tabs a:hover,
#tabs a:hover::after,
#tabs a:focus,
#tabs a:focus::after {
  background: #fff;
}

#tabs a:focus {
  outline: 0;
}

#tabs a::after {
  content:'';
  position:absolute;
  z-index: 1;
  top: 0;
  right: -.5em;  
  bottom: 0;
  width: 1em;
  background: #ddd;
  background-image: linear-gradient(to bottom, #fff, #ddd);  
  box-shadow: 2px 2px 2px rgba(0,0,0,.4);
  transform: skew(10deg);
  border-radius: 0 5px 0 0;  
}

#tabs #current a,
#tabs #current a::after {
  background: #fff;
  z-index: 3;
}

#content {
  background: #fff;
  padding: 2em;
  /*height: 220px;*/
  position: relative;
  z-index: 2; 
  border-radius: 0 5px 5px 5px;
  box-shadow: 0 -2px 3px -2px rgba(0, 0, 0, .5);
}
</style>
<div>
    <ul id="tabs">
    	<li><a href="#" name="tab1">Surat Keluar</a></li>
    </ul>  
    <div id="content">
    		<div id="tab1"> 
     			 <?php 	include ("bpf_daftar_surat_keluar_kemaskini.php");?>                 
           </div>    		            
     </div>
</div>
  
                       
 	