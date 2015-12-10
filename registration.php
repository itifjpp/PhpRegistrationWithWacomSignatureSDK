<!DOCTYPE html>
<html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <title>Registration</title>

	    <!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">

	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<script src="js/bootstrap.min.js"></script>

    	<style>
    		.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  				background-color: #ffce64;
			}
    	</style>

	    <script>
	    	$(document).ready(function(){
	    		$("#btnPending").click(function(){
	    			$("#btnPending").addClass("btn-primary");
	    			$("#btnArrived").removeClass("btn-primary");
	    			$("#btnAll").removeClass("btn-primary");
	    			$(".arrived").addClass("hidden");
	    			$(".pending").removeClass("hidden");
	    		});
	    		$("#btnArrived").click(function(){
	    			$("#btnPending").removeClass("btn-primary");
	    			$("#btnArrived").addClass("btn-primary");
	    			$("#btnAll").removeClass("btn-primary");
	    			$(".arrived").removeClass("hidden");
	    			$(".pending").addClass("hidden");
	    		});
	    		$("#btnAll").click(function(){
	    			$("#btnPending").removeClass("btn-primary");
	    			$("#btnArrived").removeClass("btn-primary");
	    			$("#btnAll").addClass("btn-primary");
	    			$(".arrived").removeClass("hidden");
	    			$(".pending").removeClass("hidden");
	    		});
	    		$('#btnAdd').click(function(){
	    			try{
	          			var xhttp = new XMLHttpRequest();
	          			xhttp.onreadystatechange = function(){
	          				if(xhttp.readyState == 4 && xhttp.status == 200){
	          					alert(xhttp.responseText);
	          					location.reload(true);
	          				}
	          			}
	          			var company = encodeURIComponent($('#txtCompany').val());
	          			var title = encodeURIComponent($('#txtTitle').val());
	          			var name = encodeURIComponent($('#txtName').val());
	          			var param = "company=" + company + "&title=" + title + "&name=" + name;
	          			xhttp.open("GET", "addnew.php?" + param , true);
	          			xhttp.send();


	      			}catch(ex){
	      				Exception("Capture() error: " + ex.message);
	      			}
	    		});
	    		$('#txtCompany').keyup(function(){
	    			var searchstring = $('#txtCompany').val();
	    			$(".tdrow").addClass("hidden");
	    			$(".tdcompany:contains('" + searchstring + "')").parent().removeClass("hidden");
	    		});
	    		$('#txtTitle').keyup(function(){
	    			var searchstring = $('#txtTitle').val();
	    			$(".tdrow").addClass("hidden");
	    			$(".tdtitle:contains('" + searchstring + "')").parent().removeClass("hidden");
	    		});
	    		$('#txtName').keyup(function(){
	    			var searchstring = $('#txtName').val();
	    			$(".tdrow").addClass("hidden");
	    			$(".tdname:contains('" + searchstring + "')").parent().removeClass("hidden");
	    		});
	    		$('#confirmModal').on('show.bs.modal', function(event){
	    			var button = $(event.relatedTarget);
	    			var identity = button.data('identity');
	    			var name = button.data('name');
	    			var title = button.data('title');
	    			var company = button.data('company');
	    			var modal = $(this);
	    			modal.find('.modal-body #regId').val(identity);
	    			modal.find('.modal-body #regName').val(name);
	    			modal.find('.modal-body #regTitle').val(title);
	    			modal.find('.modal-body #regCompany').val(company);
	    		});
	    		$("#confirmBtn").click(function(){
	    			capture($("#regName").val(), $("#regId").val());
	    		});

	    		var pendingCount = $(".pending").length;
	    		var arrivedCount = $(".arrived").length;
	    		var totalCount = pendingCount + arrivedCount;

	    		$("#btnPending").text("Pending (" + pendingCount + ")");
				$("#btnArrived").text("Arrived (" + arrivedCount + ")");
				$("#btnAll").text("All (" + totalCount + ")");
	    	});

	    	function OnLoad() {
        		try {
		  			if( !("ActiveXObject" in window) ) {
            			document.getElementById("not_ie_warning").style.display="block";
  		    			return;
          			}
			        var sigCtl = document.getElementById("sigCtl1");
			        sigCtl.BackStyle = 1;
			        sigCtl.DisplayMode=0; // fit signature to control
			        
			        var sigcapt = new ActiveXObject('Florentis.DynamicCapture');  // force 'can't create object' error if components not yet installed
			        var lic = new ActiveXObject("Wacom.Signature.Licence");
				}
			    catch(ex) {
					Exception("OnLoad() error: " + ex.message);
				}
      		}

      		function capture(name, id){
      			try{
      				var sigCtl = document.getElementById("sigCtl1");
          			var dc = new ActiveXObject("Florentis.DynamicCapture");
          			var rc = dc.Capture(sigCtl, name, "Sign In");
          			
          			if(rc == 0){
          				var sigText = sigCtl.Signature.SigText;
          				capture2(id, sigText);
          			}else{
          				alert("rc" + rc);
          				alert("signature not captured");
          			}
          		
      			}catch(ex){
      				Exception("Capture() error: " + ex.message);
      			}
      		}

      		function capture2(id, sigText){
      			try{
      				var xhttp = new XMLHttpRequest();
          			xhttp.onreadystatechange = function(){
          				if(xhttp.readyState == 4 && xhttp.status == 200){
          					//alert(xhttp.responseText);
          					location.reload(true);
          				}
          			}
          			var param = "id=" + id + "&sigText=" + sigText;
          			xhttp.open("GET", "signin.php?" + param , true);
          			xhttp.send();
          		}catch(ex){
      				Exception("Capture() error: " + ex.message);
      			}
      		}

	    </script>
  	</head>
	<body onload="OnLoad()">
		
		<h1>Registration</h1>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p class="text-center">
						<button id="btnPending" type="button" class="btn btn-lg">Pending</button>
						<button id="btnArrived" type="button" class="btn btn-lg">Arrived</button>
						<button id="btnAll" type="button" class="btn btn-lg btn-primary">All</button>
					</p>
				</div>
			</div>
			<div class="row">
				<form>
					<div class="col-md-3 col-md-offset-1">
						<input type="text" class="form-control" id="txtCompany" placeholder="Company"/>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" id="txtTitle" placeholder="Title"/>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" id="txtName" placeholder="Name"/>
					</div>
					<div class="col-md-1">
						<p class="text-left">
							<button id="btnAdd" type="button" class="btn btn-success">Add</button>
						</p>
					</div>
				</form>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php
					require 'config.php';
					
					$cnn = new mysqli($server, $user, $password, $database);
					if($cnn->connect_error){
						die("Connection failed");
					}

					$sql = "select * from registration order by Company";
					$result =$cnn->query($sql);

					?>
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Company</th>
								<th>Title</th>
								<th>Name</th>
								<th>Sign In</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								$arrived_css = "arrived";
								if($row['Signature'] == null || $row['Signature'] == ""){
									$arrived_css = "pending";
								}
								echo "<tr class='".$arrived_css." tdrow'>";
									echo "<td class='tdcompany'>" . $row['Company'] . "</td>";
									echo "<td class='tdtitle'>" . $row['Title'] . "</td>";
									echo "<td class='tdname'>" . $row['Name'] . "</td>";
									if($row['Signature'] == null || $row['Signature'] == ""){
										echo "<td><button type='button' class='btn btn-success signbtn' data-toggle='modal' data-target='#confirmModal' data-name='".$row['Name']."' data-identity='".$row['ID']."' data-title='".$row['Title']."' data-company='".$row['Company']."'>Sign In</button></td>";
									}else{
										echo "<td id='timestamp'>" . $row['Timestamp'] . "</td>";	
									}
								echo "</tr>";
							}
						}else{
							echo "<tr><td colspan='4'>No data</td></tr>";
						}
						?>
						</tbody>
					</table>

					<div style="display:none" ondblclick="DisplaySignatureDetails()" title="Double-click a signature to display its details">
						<object id="sigCtl1" style="width:60mm;height:35mm" type="application/x-florentis-signature">
			            </object>
			        </div>
		        </div>
			</div>
		</div>

		<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="confirmModalLabel">Please check details</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="regName" class="control-label col-sm-3">Name:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="regName" />
									<input type="hidden" id="regId"/>
								</div>
							</div>	
							<div class="form-group">
								<label for="regTitle" class="control-label col-sm-3">Title:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="regTitle" />
								</div>
							</div>	
							<div class="form-group">
								<label for="regCompany" class="control-label col-sm-3">Company:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="regCompany" />
								</div>
							</div>	
						</form>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="confirmBtn">Confirm</button>
					</div>
				</div>
			</div>
		</div> 
	
	</body>
</html>