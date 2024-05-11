<?php
    include('./dbconn.php');
    session_start();
    if($_SESSION['login']==0){
        header("Location: /proj1/login.php");
      }
    else{
    echo "<script type='text/javascript'>
            window.history.forward();
        </script>";
    }

    
    if (isset($_POST["submit"])) { 

        $email = $_SESSION['email'];
        
        $jsondata = json_encode($_POST);

        $checkUSer = $conn->prepare("
        select * from `page5` where `email` = '$email'
        ");

        $checkUSer->execute();
        $data = $checkUSer->fetchAll();
        if($data){
            $deleteUser = $conn->prepare("
            delete from `page5` where `email`='$email'
            ");
            $deleteUser->execute();
        }

        $insertjson = $conn->prepare("insert into `page5` (`email`,`jsondata`) values ('$email','$jsondata')");
        $insertjson->execute();
        
        if ($insertjson) {
            echo "Inserted successfully";
            header("Location: /proj1/sixthpage.php");
        }  
    }
        

?>



<html>
<head>
	<title>Academic Industrial Experience</title>
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="https://upload.wikimedia.org/wikipedia/en/thumb/5/52/Indian_Institute_of_Technology%2C_Patna.svg/1200px-Indian_Institute_of_Technology%2C_Patna.svg.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/css/bootstrap-datepicker.css">
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/jquery.js"></script>
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/bootstrap.js"></script>
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/bootstrap-datepicker.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Sintony" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">


	
</head>
<style type="text/css">
	body { background-color: lightgray; padding-top:0px!important;}

</style>
<body>
<div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
	<div class="container">
        <div class="row" style="margin-bottom:10px; ">
        	<div class="col-md-8 col-md-offset-2">

        		<!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> -->

        		<h3 style="text-align:center;color:#414002!important;font-weight: bold;font-size: 2.3em; margin-top: 3px; font-family: 'Noto Sans', sans-serif;">भारतीय प्रौद्योगिकी संस्थान पटना</h3>
    			<h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: 'Oswald', sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Patna</h3>
    			

        	</div>
        	

    	   
        </div>
		    <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div>
   </div> 
			<h3 style="color: #e10425; margin-bottom: 20px; font-weight: bold; text-align: center;font-family: 'Noto Serif', serif;" class="blink_me">Application for Faculty Position</h3>

<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
.floating-box {
    display: inline-block;
    width: 150px;
    height: 75px;
    margin: 10px;
    border: 3px solid #73AD21;  
}
</style>
<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
label{
  padding: 0 !important;
}

span{
  font-size: 1.2em;
  font-family: 'Oswald', sans-serif!important;
  text-align: left!important;
  padding: 0px 10px 0px 0px!important;
  /*margin-bottom: 20px!important;*/

}
hr{
  border-top: 1px solid #025198 !important;
  border-style: dashed!important;
  border-width: 1.2px;
}
.panel-heading{
  font-size: 1.3em;
  font-family: 'Oswald', sans-serif!important;
  letter-spacing: .5px;
}
.btn-primary {
  padding: 9px;
}
</style>
<script type="text/javascript">
             
            $(function () {
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
            });
</script>

<script type="text/javascript">
var tr="";
var counter_s_proj=1;
var counter_award=1;
var counter_prof_trg=1;
var counter_membership=1;
var counter_consultancy=1;

  $(document).ready(function(){
  

$("#add_more_s_proj").click(function(){
        create_tr();
        create_serial('s_proj');
        create_input('agency[]', 'Sponsoring Agency','agency'+counter_s_proj, 's_proj',counter_s_proj, 's_proj');
        create_input('stitle[]', 'Title of Project', 'stitle'+counter_s_proj,'s_proj',counter_s_proj, 's_proj');
        create_input('samount[]', 'Amount of grant', 'samount'+counter_s_proj,'s_proj',counter_s_proj, 's_proj');
        create_input('speriod[]', 'Period', 'speriod'+counter_s_proj,'s_proj',counter_s_proj, 's_proj');
        create_input('s_role[]', 'Role', 's_role'+counter_s_proj,'s_proj',counter_s_proj, 's_proj',false,true);
        create_input('s_status[]', 'Status', 's_status'+counter_s_proj,'s_proj',counter_s_proj, 's_proj',true);
        counter_s_proj++;
        return false;
  });
  
  $("#add_more_award").click(function(){
          create_tr();
          create_serial('award');
          create_input('award_nature[]', 'Name of Award','award_nature'+counter_award, 'award',counter_award, 'award');
          create_input('award_org[]', 'Granting body/Organization', 'award_org'+counter_award,'award',counter_award, 'award');
          create_input('award_year[]', 'Year', 'award_year'+counter_award,'award',counter_award, 'award',true);
          counter_award++;
          return false;
    });

  $("#add_more_prog_trg").click(function(){
          create_tr();
          create_serial('prof_trg');
          create_input('trg[]', 'Taining Received','trg'+counter_prof_trg, 'prof_trg',counter_prof_trg, 'prof_trg');
          create_input('porg[]', 'Organization', 'porg'+counter_prof_trg,'prof_trg',counter_prof_trg, 'prof_trg');
          create_input('pyear[]', 'Year', 'pyear'+counter_prof_trg,'prof_trg',counter_prof_trg, 'prof_trg');
          create_input('pduration[]', 'Duration', 'pduration'+counter_prof_trg,'prof_trg',counter_prof_trg, 'prof_trg',true);
          counter_prof_trg++;
          return false;
    });

  $("#add_membership").click(function(){
          create_tr();
          create_serial('membership');
          create_input('mname[]', 'Name of the Professional Society','mname'+counter_membership, 'membership',counter_membership, 'membership');
          create_input('mstatus[]', 'Membership Status (Lifetime/Annual)', 'mstatus'+counter_membership,'membership',counter_membership, 'membership',true);
          counter_membership++;
          return false;
    });

  $("#add_consultancy").click(function(){
          create_tr();
          create_serial('consultancy');
          create_input('c_org[]', 'Organization','c_org'+counter_consultancy, 'consultancy',counter_consultancy, 'consultancy');
          create_input('ctitle[]', 'Title of Project','ctitle'+counter_consultancy, 'consultancy',counter_consultancy, 'consultancy');
          create_input('camount[]', 'Amount of grant','camount'+counter_consultancy, 'consultancy',counter_consultancy, 'consultancy');
          create_input('cperiod[]', 'Period','cperiod'+counter_consultancy, 'consultancy',counter_consultancy, 'consultancy');

          create_input('c_role[]', 'Role', 'c_role'+counter_consultancy,'consultancy',counter_consultancy, 'consultancy',false,true);
          create_input('c_status[]', 'Status', 'c_status'+counter_consultancy,'consultancy',counter_consultancy, 'consultancy',true);
          counter_consultancy++;
          return false;
    });


});
  function create_select()
  {
    
  }
  function create_tr()
  {
    tr=document.createElement("tr");
  }
  function create_serial(tbody_id)
  {
    //console.log(tbody_id);
    var td=document.createElement("td");
    // var x=0;
     var x = document.getElementById(tbody_id).rows.length;
    // if(document.getElementById(tbody_id).rows)
    // {
    // }
    td.innerHTML=x;
     tr.appendChild(td);
  }
   function for_date_picker(obj)
  {
    obj.setAttribute("data-provide", "datepicker");
    obj.className += " datepicker";
    return obj;

  }
  function deleterow(e){
    var rowid=$(e).attr("data-id");
    var textbox=$("#id"+rowid).val();
    $.ajax({
            type: "POST",
            url  : "https://ofa.iiti.ac.in/facrec_che_2023_july_02/Acd_ind/deleterow/",
            data: {id: textbox},
                success: function(result) { 
                if(result.status=="OK"){
                $('.row_'+rowid).remove();
                            //remove_row('award',rowid, 'award');
                }
                   
                }});

   
    }
  function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn=false, select=false, datepicker_set=false)
  {
    //console.log(counter);
    if(select==false)
    {

      var input=document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("name", t_name);
      input.setAttribute("id", id);
      input.setAttribute("placeholder", place_value);
      input.setAttribute("class", "form-control input-md");
      input.setAttribute("required", "");
      var td=document.createElement("td");
      td.appendChild(input);
    }
    if(select==true)
    {

      var sel=document.createElement("select");
      sel.setAttribute("name", t_name);
      sel.setAttribute("id", id);
      sel.setAttribute("class", "form-control input-md");
      sel.innerHTML+="<option>Select</option>";
      sel.innerHTML+="<option value='Principal Investigator'>Principal Investigator</option>";
      sel.innerHTML+="<option value='Co-investigator'>Co-investigator</option>";
      // sel.innerHTML+="<option value='in_preparation'>In-Preparation</option>";
      var td=document.createElement("td");
      td.appendChild(sel);
    }
    if(datepicker_set==true)
    {
      input=for_date_picker(input);
    }
    if(btn==true)
    {
      // alert();
      var but=document.createElement("button");
      but.setAttribute("class", "close");
      but.setAttribute("onclick", "remove_row('"+remove_name+"','"+counter+"', '"+tbody_id+"')");
      but.innerHTML="x";
      td.appendChild(but);
    }
    tr.setAttribute("id", "row"+counter);
    tr.appendChild(td);
    document.getElementById(tbody_id).appendChild(tr);
     $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
    
  }
  function remove_row(remove_name, n, tbody_id)
  {
    var tab=document.getElementById(remove_name);
    var tr=document.getElementById("row"+n);
    tab.removeChild(tr);
    var x = document.getElementById(tbody_id).rows.length;
    for(var i=0; i<=x; i++)
    {
      $("#"+tbody_id).find("tr:eq("+i+") td:first").text(i);
      
    }
    
  }
</script>




<a href='https://ofa.iiti.ac.in/facrec_che_2023_july_02/layout'></a>

<div class="container">
  
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 well">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <fieldset>
              <input type="hidden" name="ci_csrf_token" value="" />
             
                 <legend>
                  <div class="row">
                    <div class="col-md-10">
                        <h4>Welcome : <font color="#025198"><strong><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></strong></font></h4>
                    </div>
                    <div class="col-md-2">
                    <a href="./logout.php" class="btn btn-sm btn-success  pull-right">Logout</a>
                    </div>
                  </div>
                
                
        </legend>



<!-- Membership of Professional Societies -->

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">9. Membership of Professional Societies </h4>

<div class="row">
<div class="col-md-12">
<div class="panel panel-success">
<div class="panel-heading">Fill the Details  &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_membership">Add Details</button></div>
  <div class="panel-body">

        <table class="table table-bordered">
            <tbody id="membership">
            
            <tr height="30px">
              <th class="col-md-1"> S. No.</th>
              <th class="col-md-3"> Name of the Professional Society </th>
              <th class="col-md-3"> Membership Status (Lifetime/Annual)</th>
              
            </tr>


                        
            <tr height="60px" class="row_1">
             
              <td class="col-md-1"> 
                1                </td>
              <td class="col-md-2"> 
                <input id="id1" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 
                  <input id="mname1" name="mname[]" type="text" value="Bessie Goldner"  placeholder="Name of the Professional Society" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="mstatus1" name="mstatus[]" type="text" value="Illinois"  placeholder="Membership Status (Lifetime/Annual)" class="form-control input-md" required=""> 
              </td>
              
             
            </tr>
                        
            <tr height="60px" class="row_2">
             
              <td class="col-md-1"> 
                2                </td>
              <td class="col-md-2"> 
                <input id="id2" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 
                  <input id="mname2" name="mname[]" type="text" value="Edwardo Franecki"  placeholder="Name of the Professional Society" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="mstatus2" name="mstatus[]" type="text" value="South Carolina"  placeholder="Membership Status (Lifetime/Annual)" class="form-control input-md" required=""> 
              </td>
              
             
            </tr>
                        
            <tr height="60px" class="row_3">
             
              <td class="col-md-1"> 
                3                </td>
              <td class="col-md-2"> 
                <input id="id3" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 
                  <input id="mname3" name="mname[]" type="text" value="Antonina Carter"  placeholder="Name of the Professional Society" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="mstatus3" name="mstatus[]" type="text" value="Idaho"  placeholder="Membership Status (Lifetime/Annual)" class="form-control input-md" required=""> 
              </td>
              
             
            </tr>
                        
            <tr height="60px" class="row_4">
             
              <td class="col-md-1"> 
                4                </td>
              <td class="col-md-2"> 
                <input id="id4" name="id[]" type="hidden" value="202"  class="form-control input-md" required=""> 
                  <input id="mname4" name="mname[]" type="text" value="Aleen Kuhlman"  placeholder="Name of the Professional Society" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="mstatus4" name="mstatus[]" type="text" value="Idaho"  placeholder="Membership Status (Lifetime/Annual)" class="form-control input-md" required=""> 
              </td>
              
             
            </tr>
                      </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Professional Training -->

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">10. Professional Training </h4>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
    <div class="panel-heading">Fill the Details  &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_prog_trg">Add Details</button></div>
      <div class="panel-body">

            <table class="table table-bordered">
                <tbody id="prof_trg">
                
                <tr height="30px">
                  <th class="col-md-1"> S. No.</th>
                  <th class="col-md-3"> Type of Training Received </th>
                  <th class="col-md-3"> Organisation</th>
                  <th class="col-md-2"> Year</th>
                  <th class="col-md-2"> Duration (in years & months)</th>
                  
                </tr>


                                
                <tr height="60px" class="row_1">
                 
                  <td class="col-md-1"> 
                    1                    </td>
                  <td class="col-md-2"> 
                    <input id="id1" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 
                      <input id="trg1" name="trg[]" type="text" value="Omnis nemo ipsum est recusandae."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="porg1" name="porg[]" type="text" value="Inventore voluptate tempore a ipsam maiores magni."  placeholder="Title of Project" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="pyear1" name="pyear[]" type="text" value="Niger"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="pduration1" name="pduration[]" type="text" value="Latvia"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                                
                <tr height="60px" class="row_2">
                 
                  <td class="col-md-1"> 
                    2                    </td>
                  <td class="col-md-2"> 
                    <input id="id2" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 
                      <input id="trg2" name="trg[]" type="text" value="Hic tempora ipsum praesentium possimus."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="porg2" name="porg[]" type="text" value="Totam aliquid fuga quibusdam."  placeholder="Title of Project" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="pyear2" name="pyear[]" type="text" value="Bolivia"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="pduration2" name="pduration[]" type="text" value="Brazil"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                                
                <tr height="60px" class="row_3">
                 
                  <td class="col-md-1"> 
                    3                    </td>
                  <td class="col-md-2"> 
                    <input id="id3" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 
                      <input id="trg3" name="trg[]" type="text" value="At deleniti vel harum."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="porg3" name="porg[]" type="text" value="Quod placeat quasi nam dolor ipsa dolore dolores ad."  placeholder="Title of Project" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="pyear3" name="pyear[]" type="text" value="Gabon"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="pduration3" name="pduration[]" type="text" value="Cayman Islands"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!-- Award(s) and Recognition(s) -->

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">11. Award(s) and Recognition(s)</h4>
<div class="row">
<div class="col-md-12">
<div class="panel panel-success">
<div class="panel-heading">Fill the Details  &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_award">Add Details</button></div>
  <div class="panel-body">

        <table class="table table-bordered">
            <tbody id="award">
            
            <tr height="30px">
              <th class="col-md-1"> S. No.</th>
              <th class="col-md-3"> Name of Award </th>
              <th class="col-md-3"> Awarded By</th>
              <th class="col-md-2"> Year</th>
              
            </tr>


                      </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<h4 style="text-align:center; font-weight: bold; color: #6739bb;">12. Sponsored Projects/ Consultancy Details</h4>
<!-- sponsored projects  -->
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(A) Sponsored Projects &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_s_proj">Add Details</button></div>
        <div class="panel-body">

              <table class="table table-bordered">
                  <tbody id="s_proj">
                  
                  <tr height="30px">
                    <th class="col-md-1"> S. No.</th>
                    <th class="col-md-2"> Sponsoring Agency </th>
                    <th class="col-md-2"> Title of Project</th>
                    <th class="col-md-2"> Sanctioned Amount (&#8377) </th>
                    <th class="col-md-1"> Period</th>
                    <th class="col-md-2"> Role </th>
                    <th class="col-md-2"> Status (Completed/On-going)</th>
                    
                  </tr>


                                    
                  <tr height="60px">
                   
                    <td class="col-md-1"> 
                      1                      </td>
                    <td class="col-md-2"> 
                      
                        <input id="agency1" name="agency[]" type="text" value="Porro aspernatur doloribus corrupti architecto ipsa animi."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                      </td>
                    <td class="col-md-2"> 
                      <input id="stitle1" name="stitle[]" type="text" value="Human Response Liaison"  placeholder="Title of Project" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                      <input id="samount1" name="samount[]" type="text" value="Comoros"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-1"> 
                      <input id="speriod1" name="speriod[]" type="text" value="Optio reprehenderit eum."  placeholder="Period" class="form-control input-md" required=""> 
                    </td>

                    <td class="col-md-2"> 
                      <select id="s_role" name="s_role[]" class="form-control input-md" required="">
                          <option value="">Select</option>
                          <option  value="Principal Investigator">Principal Investigator</option>
                          <option selected='selected' value="Co-investigator">Co-investigator</option>
                      </select>
                    </td>

                    <td class="col-md-2"> 
                      <input id="s_status1" name="s_status[]" type="text" value="Washington"  placeholder="Status" class="form-control input-md" required=""> 
                    </td>
                    
                   
                  </tr>
                                    
                  <tr height="60px">
                   
                    <td class="col-md-1"> 
                      2                      </td>
                    <td class="col-md-2"> 
                      
                        <input id="agency2" name="agency[]" type="text" value="Ullam earum ab eaque a."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                      </td>
                    <td class="col-md-2"> 
                      <input id="stitle2" name="stitle[]" type="text" value="National Response Coordinator"  placeholder="Title of Project" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                      <input id="samount2" name="samount[]" type="text" value="Croatia"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-1"> 
                      <input id="speriod2" name="speriod[]" type="text" value="Provident culpa explicabo quidem voluptatem aspernatur aliquid."  placeholder="Period" class="form-control input-md" required=""> 
                    </td>

                    <td class="col-md-2"> 
                      <select id="s_role" name="s_role[]" class="form-control input-md" required="">
                          <option value="">Select</option>
                          <option selected='selected' value="Principal Investigator">Principal Investigator</option>
                          <option  value="Co-investigator">Co-investigator</option>
                      </select>
                    </td>

                    <td class="col-md-2"> 
                      <input id="s_status2" name="s_status[]" type="text" value="Arizona"  placeholder="Status" class="form-control input-md" required=""> 
                    </td>
                    
                   
                  </tr>
                                    
                  <tr height="60px">
                   
                    <td class="col-md-1"> 
                      3                      </td>
                    <td class="col-md-2"> 
                      
                        <input id="agency3" name="agency[]" type="text" value="Veniam at corporis laudantium."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                      </td>
                    <td class="col-md-2"> 
                      <input id="stitle3" name="stitle[]" type="text" value="Dynamic Web Orchestrator"  placeholder="Title of Project" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                      <input id="samount3" name="samount[]" type="text" value="Cook Islands"  placeholder="Amount of grant" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-1"> 
                      <input id="speriod3" name="speriod[]" type="text" value="Quasi eius quibusdam ab vero dolore nostrum molestias quas odio."  placeholder="Period" class="form-control input-md" required=""> 
                    </td>

                    <td class="col-md-2"> 
                      <select id="s_role" name="s_role[]" class="form-control input-md" required="">
                          <option value="">Select</option>
                          <option selected='selected' value="Principal Investigator">Principal Investigator</option>
                          <option  value="Co-investigator">Co-investigator</option>
                      </select>
                    </td>

                    <td class="col-md-2"> 
                      <input id="s_status3" name="s_status[]" type="text" value="Illinois"  placeholder="Status" class="form-control input-md" required=""> 
                    </td>
                    
                   
                  </tr>
                                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

     <!-- Consultancy Details -->
             <div class="row">
                 <div class="col-md-12">
                   <div class="panel panel-success">
                   <div class="panel-heading">(B) Consultancy Projects  &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_consultancy">Add Details</button></div>
                     <div class="panel-body">

                           <table class="table table-bordered">
                               <tbody id="consultancy">
                               
                               <tr height="30px">
                                 <th class="col-md-1"> S. No.</th>
                                 <th class="col-md-3"> Organization </th>
                                 <th class="col-md-2"> Title of Project</th>
                                 <th class="col-md-2"> Amount of Grant</th>
                                 <th class="col-md-1"> Period</th>
                                 <th class="col-md-2"> Role</th>
                                 <th class="col-md-2"> Status</th>
                                 
                               </tr>


                                                              
                               <tr height="60px" class="row_1">
                                
                                 <td class="col-md-1"> 
                                   1                                   </td>
                                 <td class="col-md-2"> 
                                   <input id="id1" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 

                                     <input id="c_org1" name="c_org[]" type="text" value="Aliquam rerum nisi dolore."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                                   </td>
                                 <td class="col-md-2"> 
                                   <input id="ctitle1" name="ctitle[]" type="text" value="Regional Tactics Representative"  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>
                                 <td class="col-md-2"> 
                                   <input id="camount1" name="camount[]" type="text" value="French Guiana"  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>
                                 <td class="col-md-1"> 
                                   <input id="cperiod1" name="cperiod[]" type="text" value="Voluptatum aliquid officiis a consectetur voluptatibus earum ad at ducimus."  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>

                                 <td class="col-md-2"> 
                                   <select id="c_role" name="c_role[]" class="form-control input-md" required="">
                                       <option value="">Select</option>
                                       <option selected='selected' value="Principal Investigator">Principal Investigator</option>
                                       <option  value="Co-investigator">Co-investigator</option>
                                   </select>
                                 </td>

                                 <td class="col-md-2"> 
                                   <input id="c_status1" name="c_status[]" type="text" value="Maryland"  placeholder="Status" class="form-control input-md" required=""> 
                                 </td>
                                 
                                
                               </tr>
                                                              
                               <tr height="60px" class="row_2">
                                
                                 <td class="col-md-1"> 
                                   2                                   </td>
                                 <td class="col-md-2"> 
                                   <input id="id2" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 

                                     <input id="c_org2" name="c_org[]" type="text" value="Asperiores quam dolor distinctio odit quidem quae."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                                   </td>
                                 <td class="col-md-2"> 
                                   <input id="ctitle2" name="ctitle[]" type="text" value="Principal Marketing Manager"  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>
                                 <td class="col-md-2"> 
                                   <input id="camount2" name="camount[]" type="text" value="Palau"  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>
                                 <td class="col-md-1"> 
                                   <input id="cperiod2" name="cperiod[]" type="text" value="Nesciunt libero iure."  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>

                                 <td class="col-md-2"> 
                                   <select id="c_role" name="c_role[]" class="form-control input-md" required="">
                                       <option value="">Select</option>
                                       <option selected='selected' value="Principal Investigator">Principal Investigator</option>
                                       <option  value="Co-investigator">Co-investigator</option>
                                   </select>
                                 </td>

                                 <td class="col-md-2"> 
                                   <input id="c_status2" name="c_status[]" type="text" value="South Dakota"  placeholder="Status" class="form-control input-md" required=""> 
                                 </td>
                                 
                                
                               </tr>
                                                              
                               <tr height="60px" class="row_3">
                                
                                 <td class="col-md-1"> 
                                   3                                   </td>
                                 <td class="col-md-2"> 
                                   <input id="id3" name="id[]" type="hidden" value=""  class="form-control input-md" required=""> 

                                     <input id="c_org3" name="c_org[]" type="text" value="Numquam a possimus tempore."  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                                   </td>
                                 <td class="col-md-2"> 
                                   <input id="ctitle3" name="ctitle[]" type="text" value="Future Identity Facilitator"  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>
                                 <td class="col-md-2"> 
                                   <input id="camount3" name="camount[]" type="text" value="Netherlands"  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>
                                 <td class="col-md-1"> 
                                   <input id="cperiod3" name="cperiod[]" type="text" value="Veritatis dolor illo."  placeholder="Title of Project" class="form-control input-md" required=""> 
                                 </td>

                                 <td class="col-md-2"> 
                                   <select id="c_role" name="c_role[]" class="form-control input-md" required="">
                                       <option value="">Select</option>
                                       <option selected='selected' value="Principal Investigator">Principal Investigator</option>
                                       <option  value="Co-investigator">Co-investigator</option>
                                   </select>
                                 </td>

                                 <td class="col-md-2"> 
                                   <input id="c_status3" name="c_status[]" type="text" value="Delaware"  placeholder="Status" class="form-control input-md" required=""> 
                                 </td>
                                 
                                
                               </tr>
                                                            </tbody>
                           </table>
                         </div>
                       </div>
                     </div>

                   </div>
 
    


      




            <!-- Button -->

            <div class="form-group">
              
              <div class="col-md-1">
              <a href="./fourthpage.php" class="btn btn-primary pull-left">Back</a>
              </div>

              <div class="col-md-11">
              <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>
                
              </div>
              
            </div>

            <!-- <div class="form-group">
              <label class="col-md-5 control-label" for="submit"></label>
              <div class="col-md-4">
                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-primary">SUBMIT</button>

              </div>
            </div> -->

            </fieldset>
            </form>
            
            

        </div>
    </div>
</div>

<div id="footer"></div>
</body>
</html>

<script type="text/javascript">
	
	function blinker() {
	    $('.blink_me').fadeOut(500);
	    $('.blink_me').fadeIn(500);
	}

	setInterval(blinker, 1000);
</script>