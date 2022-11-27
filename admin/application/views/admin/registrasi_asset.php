
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>include/frminput.css">


<style type="text/css">
	  .kanan {
		text-align : right;
	  }
</style>





	
 <div id="content" class="">
            <!-- content starts -->
     <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url();?>admin">Home</a>
            </li>
            <li>
                <a href="#">Low Value Asset</a>
            </li>
        </ul>
    </div>

 	
    
    
	<div class=" row"  style="margin-top:-18px">
    <div class="box col-md-12">
    <div class="box-inner">
    <!--<div class="box-header well" data-original-title="">
        <h2><i ></i> Standard Gramasi</h2>

       
    </div>-->
    <div class="box-content">
	 	

									<form id="form2" name="form2" >
										<div id="form20" name="form20"  >	
										
													<div class="box-tools" style="float:right">
														
															<div class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
																<span class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
																<input type="text" name="table_search" id ="table_search"  class="form-control input-sm pull-right" placeholder="Search" style="z-index:0;" />
																</span>
																<div class="input-group-btn"  >
																	<button type="button" id="btnsrch"  class="btn btn-sm btn-default" style = "margin-left:2px;z-index:0;"><i class="fa fa-search"></i> </button>
																</div>
														
															</div>
														
													</div>
												
													<div class="box-tools" style="float:right;margin-right:3px;margin-top:0px">
														<div class="input-group" style="width: 70px; margin-top:0px; padding-right:-10px">
															<span class="input-group" style="width: 70px; margin-top:0px; padding-right:2px">
														
															<select name="column" id="column" class="form-control input-sm pull-right" style="margin-top:0px;height:30px;width:150px">
																<option value="">Choice Column</option>
																<option value="Asset">FA Tag No</option>
																<option value="Description">FA Desc</option>
																<option value="SupplierName">Supplier Name</option>
																<option value="InvoiceRef">Supplier Invoice</option>
																<option value="LocalOrImport">Local Import</option>
																<option value="DocLink">Link Doc</option>
																<option value="BCNo">BC Doc</option>
																<option value="ReferenceNo">Ref Sage</option>
																<option value="COA">Sage COA</option>
																<option value="Description2">FA Sub Desc</option>
																<option value="Unit">FA Unit</option>
																<option value="Department">Dept Name</option>
																<option value="LocationCode">Location Name</option>
																<option value="Section">Section Name</option>
																<option value="ProductionLineCode">Line Code</option>
																<option value="SerialNo">Serial No</option>
																<option value="AcquisitionCost">Acq Cost</option>
																<option value="DepreciationYear">Depreciation Year</option>
																<option value="Remark">Remark</option>
																
																
																
															</select>
															</span>
															
													
														</div>
													
													
												</div>

												
												
												
											<button type="button"  id="chkAdd" name="chkAdd"  style= "border-radius: 3px;" class="btn btn-sm btn-primary btn-flat" ><i class="fa fa-plus"></i>  Add </button>
											<button type="button"  id="chkEdit" name="chkEdit"  style= "border-radius: 3px;" class="btn btn-sm btn-primary btn-flat" ><i class="fa fa-edit"></i>  Edit </button>
											<button type="button"  id="chkDel" name="chkDel"  style= "border-radius: 3px;" class="btn btn-sm btn-primary btn-flat" ><i class="fa fa-remove"></i>  Delete </button>

											</div>
                  
			<div class="floating-form" id="contact_form" style="z-index:2;">
			<div class="contact-opener">Open Form</div>
				<div class="judul" style="margin-top:20px;margin-bottom:10px">Register Asset</div>
				<div id="contact_results"></div>
				<div id="contact_body" class="contact_body" style="z-index:1;">
				
						
						
						<input type="text" name="onsite" id="onsite" class="input-field" style = "width:100%;display:none"  >

						<div style="margin-top: 3px;" >FA Tag No</div>
						<input type="text" name="asset" id="asset" class="input-field" style = "width:100%"  >

						<div style="margin-top: 3px;">FA Desc</div>
						<input type="text" class="input-field"name="description" id="description"  style = "width:100%; " >
						
						
						
						<div style="margin-top: 3px;">Supplier Name</div>
						<input type="text"  name="suppliernamecmb" id="suppliername"  style = "width:100%; " >
						
						<div style="margin-top: 3px;">Supplier Invoice</div>
						<input type="text" name="invoiceref" id="invoiceref" class="input-field" style = "width:100%">    
						

						<div style="margin-top: 3px;">Local Import</div>
						<input type="text" name="localorimportcmb" id="localorimport"  style = "width:100%"  >
	  				
						<div style="margin-top: 3px;">Link Doc</div>
						<input type="text" name="doclink" id="doclink"  class="input-field" style = "width:100%; " >
						
						<div style="margin-top: 3px;">BC Doc</div>
						<input type="text" name="bcno" id="bcno" class="input-field" style = "width:100%">  

						<div style="margin-top: 3px;">Acq Date</div>
						<input type="text" class="form-control datepicker" name="allocationdate" id="allocationdate" class="input-field" style = "width:100%"  >
						
						<div style="margin-top: 3px;">Reference No</div>
						<input type="text" name="referenceno" id="referenceno" class="input-field" style = "width:100%; " >
						
						<div style="margin-top: 3px;">Sage COA</div>
						<input type="text" name="coa" id="coa" class="input-field" style = "width:100%; " >

						<div style="margin-top: 3px;">FA Sub Desc</div>
						<input type="text" name="description2" id="description2" class="input-field" style = "width:100%">  

						<div style="margin-top: 3px;">FA Qty</div>
						<input type="text" name="quantity" id="quantity" class="input-field" style = "width:100%"  >
						
						<div >FA Unit</div>
						<input type="text" name="unit" id="unit" class="input-field"  style = "width:100%; " >
						
						<div style="margin-top: 3px;">Dept Name</div>
						<input type="text" name="departmentcmb" id="department"   style = "width:100%; " >

						<div style="margin-top: 3px;">Sect Name</div>
						<input type="text" name="sectioncmb" id="section"  style = "width:100%">
						
						<div style="margin-top: 3px;">Loc Name	</div>
						<input type="text" name="locationcodecmb" id="locationcode"  style = "width:100%"> 

						<div  style="margin-top: 3px;">Line Code</div>
						<input type="text" name="productionlinecodecmb" id="productionlinecode" style = "width:100%"  >

						<div style="margin-top: 3px;">Serial Number</div>
						<input type="text" name="serialno" id="serialno" class="input-field" style = "width:100%"> 

												
						<div style="margin-top: 3px;">Exc Rate</div>
						<input type="text" name="excrate" id="excrate" class="input-field" style = "width:100%"> 

						<div style="margin-top: 3px;">Depreciation Years</div>
						<input type="text" name="depreciationyear" id="depreciationyear" class="input-field" style = "width:100%">   

						<div style="margin-top: 3px;">Acq Cost</div>
						<input type="text" name="acquisitioncost" id="acquisitioncost" class="input-field" style = "width:100%">   

						

						<div style="margin-top: 3px;">Remark</div>
						<input type="text" name="remark" id="remark"  class="input-field" style = "width:100%; " ></div> 
						
					 
						
						<button type="button"  id="chkSave" style= "border-radius: 3px;" name="chkSave"  class="btn btn-sm btn-primary btn-flat" style="margin-top:-10px" ><i class="fa fa-save"></i>  Save </button>
						<button type="button"  id="chkCancel" style= "border-radius: 3px;" name="chkCancel"  class="btn btn-sm btn-primary btn-flat" style="margin-top:-10px" ><i class="fa fa-refresh"></i>  Cancel </button>
						<!--<button type="button"  id="save" style= "border-radius: 3px;" name="chkAdd"  class="btn btn-sm btn-primary btn-flat" ><i class="fa fa-retweet"></i>  Add New </button>-->
					
				
			</div>

 				
</form>

<div  id="groupinput" class="form-group" style="overflow:auto; margin:5px 0 5px 0;"> 
                
	 <div id="grid"></div>
 				
                    
 </div>        











			  

<script type="text/javascript" >
var idfixedassets;
var actsave;
$(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
  
$(document).ready(function(){ 

				var hgt;
				 var frm;
				 var wnd;
				 var taskb = document.documentElement.clientHeight;
				 	hgt = taskb -166;
				 	
				 	
					 $('#contact_form').height(hgt+87);
        			 $('#contact_body').height(hgt-12);

					 $('#groupinput').height(hgt+4);
					 $('#grid').height(hgt+2);


				var input = document.getElementById("table_search");
				document.getElementById("table_search").focus();
				// Execute a function when the user releases a key on the keyboard
				input.addEventListener("keyup", function(event) {
					// Number 13 is the "Enter" key on the keyboard
					if (event.keyCode === 13) {
						// Cancel the default action, if needed
						event.preventDefault();
						// Trigger the button element with a click
						document.getElementById("btnsrch").click();
					}
				});


				disablebutton('<?php echo base_url(); ?>cfixedassets/getstatusbutton');
				$( window ).on( "load", function() {
                        loadgrid();  
                    });

				$('#btnsrch').on('click', function(){
					$("#grid").remove();
					$('#groupinput').append("<div id='grid'></div>");   
					$('#groupinput').height(hgt+4);
					$('#grid').height(hgt+2);
					loadgrid();
				
				});
        
				$("#quantity").keypress(function (e) {
					if (String.fromCharCode(e.keyCode).match(/[^0-9.]/g)) return false;
				});
				$("#acquisitioncost").keypress(function (e) {
					if (String.fromCharCode(e.keyCode).match(/[^0-9.]/g)) return false;
				});
				$("#excrate").keypress(function (e) {
					if (String.fromCharCode(e.keyCode).match(/[^0-9.]/g)) return false;
				});
				$("#depreciationyear").keypress(function (e) {
					if (String.fromCharCode(e.keyCode).match(/[^0-9.]/g)) return false;
				});
				
				
	$("#chkDel").click(function(){
		$("#chkEdit").prop("disabled",true);
		$("#chkAdd").prop("disabled",true);
		if (idfixedassets > 0)
		{
			confirmAction = confirm("Are you sure to execute this action?");
			if (confirmAction) {
							$.ajax({
								url : "./hapusregistrasiasset",
								type: "post",
								data:{id:idfixedassets},

								success: function(data)
									{
										if (data==1)
										{alert('Delete Success'); location.reload();}
										else
										{alert('Error Delete');}	
									}
								});
								$("#chkEdit").prop("disabled",true);
								$("#chkAdd").prop("disabled",true);
			} 
			else
			{
				$("#chkEdit").prop("disabled",false);
				$("#chkAdd").prop("disabled",false);
			}
					
		}
		else
		{
			alert('Please select the row to be deleted');
			$("#chkEdit").prop("disabled",false);
				$("#chkAdd").prop("disabled",false);
		}
    
        
	});
	$("#chkSave").click(function(){
		/*var fatagno= $("#fatagno").val()
		var select = $("#fabtype").val();
		var fabtype= select;
		if (fabtype=='')
		{fabtype=$("#fabtypecmb").data("kendoComboBox").text();
			$("#fabtype").val(fabtype);
			alert(fabtype);
		}*/

		
		/*fabtype=$("#fabtypecmb").data("kendoComboBox").text();
			$("#fabtype").val(fabtype);*/
		
		
		
		//if((typeof(fatagno) != "undefined" && fatagno !== null && fatagno !== '') && (typeof(fabtype) != "undefined" && fabtype !== null) && fabtype !== ''  ) {
			//if (fabtype)
			//{
				if (actsave==1)
					{
						if (idfixedassets > 0)
						{
							confirmAction = confirm("Are you sure you want to change the record in?");
							if (confirmAction) {
								updatealt(idfixedassets);
								setTimeout(function(){
									location.reload();
								}, 2000);
							}
						}

						/*setTimeout(function(){
							location.reload();
						}, 500);*/
					}
				if (actsave==0)
					{
						
						idfixedassets=0;
						confirmAction = confirm("Are you sure you want to save the record in?");
						if (confirmAction) {
								
							savealt();idfixedassets=0;
							setTimeout(function(){
								location.reload();
							}, 2000);

							}
						
						
						/*setTimeout(function(){
							location.reload();
						}, 500);*/
						
					}

			
        	/*}
		}
		else
		{
			alert('Text Style Code or Fabric Type cannot be empty');
		}*/
	});
	
	chkEdit = $("#chkEdit") ;
	chkEdit.click(function(){
		
		{
			
			actsave=1;
           _floatbox.animate({"right":"0px"},  {duration: 300}).addClass('visiable');
		   	$("#chkAdd").prop("disabled",true);
			$("#chkDel").prop("disabled",true);
			$("#asset").prop("disabled",true);
			
			showfieldaltlower(idfixedassets);
			
			/*setTimeout(function(){
				var txt = $("#fabtype").val();
				 var combobox = $("#fabtypecmb").data("kendoComboBox");
				 combobox.text(txt);
			}, 900);*/
			
			
        }
	});

	chkAdd = $("#chkAdd") ;
	chkAdd.click(function(){
		
		{
			idfixedassets=0;
			actsave=0;
			
			$("#chkEdit").prop("disabled",true);
			$("#chkDel").prop("disabled",true);
			var onsite="<?php echo $this->session->userdata('onsite'); ?>";
			
           _floatbox.animate({"right":"0px"},  {duration: 300}).addClass('visiable');
		   tambah();
		   $("#onsite").val(onsite);
		   var d = moment();
  			$('#allocationdate').val(d.format('YYYY-MM-DD'));
        }
	});

	chkCancel = $("#chkCancel") ;
	chkCancel.click(function(){
		
		{
			idfixedassets=0;
			actsave=0;
			$("#chkEdit").prop("disabled",false);
			$("#chkDel").prop("disabled",false);
			$("#chkAdd").prop("disabled",false);
			$("#asset").prop("disabled",false);
           _floatbox.animate({"right":"0px"},  {duration: 300}).addClass('visiable');
		   
		   _floatbox.animate({"right":"-350px"}, {duration: 300}).removeClass('visiable');
		   tambah();
		   
        }
	});

	
	var _scroll = true, _timer = false, _floatbox = $("#contact_form"), _floatbox_opener = $(".contact-opener") ;
	_floatbox.css("right", "-350px"); //initial contact form position
	
	//Contact form Opener button
	_floatbox_opener.click(function(){
		/*
		if (_floatbox.hasClass('visiable')){
            _floatbox.animate({"right":"-350px"}, {duration: 300}).removeClass('visiable');
        }else{
           _floatbox.animate({"right":"0px"},  {duration: 300}).addClass('visiable');
        }
		tambah();
		idfixedassets=0;*/
	});

	//Effect on Scroll
	$(window).scroll(function(){
		if(_scroll){
			_floatbox.animate({"top": "30px"},{duration: 300});
			_scroll = false;
		}
		if(_timer !== false){ clearTimeout(_timer); }           
			_timer = setTimeout(function(){_scroll = true; 
			_floatbox.animate({"top": "10px"},{easing: "linear"}, {duration: 500});}, 400); 
	});

								$("#localorimport").kendoMultiColumnComboBox({
									dataSource: [
										{ name: "Local" },
										{ name: "Import" }
									],
									columns: [
										{ field: "name", title: "Local Import", width: "100%"  }
									],
									dataTextField: "name",
									dataValueField: "name",
								});

							$("#locationcode").kendoMultiColumnComboBox({
										dataTextField: "LocName",
										dataValueField: "LocName",
										height: 400,
									
										columns: [
											
											{ field: "LocName", title: "Loc Name", width: "100%" },
											
											
									  		
										],
										footerTemplate: 'Total #: instance.dataSource.total() # items found',
										filter: "contains",
										filterFields: ["LocName"],
										dataSource: {
											
											transport: {
												read: {
														contentType: "application/json; charset=utf-8",
														dataType: "json",
														type: 'post',
														url: '<?php echo base_url(); ?>cregistrasiasset/dataLocName',
													}
												
											}
										},
										/*change: function (e) {
													var dataItem = e.sender.dataItem();
													idpengajar =  dataItem.idpengajar;

												}*/
									});
									$("#productionlinecode").kendoMultiColumnComboBox({
										dataTextField: "LineCode",
										dataValueField: "LineCode",
										height: 400,
									
										columns: [
											
											{ field: "LineCode", title: "Line Code", width: "100%" },
											
											
									  		
										],
										footerTemplate: 'Total #: instance.dataSource.total() # items found',
										filter: "contains",
										filterFields: ["LineCode"],
										dataSource: {
											
											transport: {
												read: {
														contentType: "application/json; charset=utf-8",
														dataType: "json",
														type: 'post',
														url: '<?php echo base_url(); ?>cregistrasiasset/dataLineName',
													}
												
											}
										},
										/*change: function (e) {
													var dataItem = e.sender.dataItem();
													idpengajar =  dataItem.idpengajar;

												}*/
									});

									$("#suppliername").kendoMultiColumnComboBox({
										dataTextField: "SupplierName",
										dataValueField: "SupplierName",
										height: 400,
									
										columns: [
											
											{ field: "SupplierName", title: "Supplier Name", width: "100%" },
											
											
									  		
										],
										footerTemplate: 'Total #: instance.dataSource.total() # items found',
										filter: "contains",
										filterFields: ["SupplierName"],
										dataSource: {
											
											transport: {
												read: {
														contentType: "application/json; charset=utf-8",
														dataType: "json",
														type: 'post',
														url: '<?php echo base_url(); ?>cregistrasiasset/dataSupplierName',
													}
												
											}
										},
										/*change: function (e) {
													var dataItem = e.sender.dataItem();
													idpengajar =  dataItem.idpengajar;

												}*/
									});
												
							$("#department").kendoMultiColumnComboBox({
										dataTextField: "Department",
										dataValueField: "Department",
										height: 400,
									
										columns: [
											
											{ field: "Department", title: "Dept Name", width: "100%" },
											
											
									  		
										],
										footerTemplate: 'Total #: instance.dataSource.total() # items found',
										filter: "contains",
										filterFields: ["Department"],
										dataSource: {
											
											transport: {
												read: {
														contentType: "application/json; charset=utf-8",
														dataType: "json",
														type: 'post',
														url: '<?php echo base_url(); ?>cregistrasiasset/dataDepartment',
													}
												
											}
										},
										/*change: function (e) {
													var dataItem = e.sender.dataItem();
													idpengajar =  dataItem.idpengajar;

												}*/
									});


								$("#section").kendoMultiColumnComboBox({
										dataTextField: "Section",
										dataValueField: "Section",
										height: 400,
									
										columns: [
											
											{ field: "Section", title: "Sect Name", width: "100%" },
											
											
									  		
										],
										footerTemplate: 'Total #: instance.dataSource.total() # items found',
										filter: "contains",
										filterFields: ["Section"],
										dataSource: {
											
											transport: {
												read: {
														contentType: "application/json; charset=utf-8",
														dataType: "json",
														type: 'post',
														url: '<?php echo base_url(); ?>cregistrasiasset/dataSection',
													}
												
											}
										},
										/*change: function (e) {
													var dataItem = e.sender.dataItem();
													idpengajar =  dataItem.idpengajar;

												}*/
									});


});

function loadgrid()
				{
					
					//var dataLocName=JSON.stringify(arrLocName);
					var  field  =  $('#table_search').val();
					var  clm  =  $('#column').val();;
				
					$("#grid").kendoGrid({
						dataSource: {
								transport: {
								read: 
									{
										url: "<?php echo base_url(); ?>cregistrasiasset/tampilgrid",
										contentType: "application/json; charset=utf-8",
										dataType: "json",
										data:{clm:clm,field:field},
										type: 'get',
									},			
									},
									pageSize: 50,
									schema: {
													model: {
														fields: {
															FAQty: { type: "number",format: "{0:n2}" },
															AcquisitionCost: { type: "number",format: "{0:n2}" },
															LocCode: { field: "LocCode", defaultValue: 1 },
														}
													}},
										 },	

                        sortable: true,
						
						pageable: {
                        pageSizes: [50, 75, 100],
                    },
						selectable: "row",
                        columns: [
						{field: "idfixedassets",title: "idfixedassets",hidden:true, width: 100,headerAttributes: {style: "font-weight: bold"},headerAttributes: {style: "font-weight: bold"},},
						  {field: "Asset",title: "FA Tag No",width: 250,headerAttributes: {style: "font-weight: bold"},headerAttributes: {style: "font-weight: bold"},},
						  {field: "Description",title: "FA Desc",width: 350,headerAttributes: {style: "font-weight: bold"},},
						 
							
						 {field: "SupplierName",title: "Supp. Name",width: 250,headerAttributes: {style: "font-weight: bold"} , },
						 {field: "InvoiceRef",title: "Supp. Invoice",width: 170,headerAttributes: {style: "font-weight: bold"},},
						 {field: "LocalOrImport",title: "Local/Import",width: 120,headerAttributes: {style: "font-weight: bold"},},
						 {field: "DocLink",title: "Link Doc",width: 300,headerAttributes: {style: "font-weight: bold"},},
						 {field: "BCNo",title: "BC Doc",width: 200,headerAttributes: {style: "font-weight: bold"},},
						 {field: "AllocationDate",title: "Acq Date",width: 95,
						  headerAttributes: {style: "font-weight: bold"}, 
						  attributes: { style: "text-align: Center; font-size: 14px"},},
						 {field: "ReferenceNo",title: "Ref Sage",width: 190,
						  headerAttributes: {style: "font-weight: bold"}},
						 {field: "COA",title: "Sage COA",width: 120,headerAttributes: {style: "font-weight: bold"},},
						 {field: "Description2",title: "FA Sub Desc",width: 350,headerAttributes: {style: "font-weight: bold"},},
						 {field: "Quantity",title: "FA Qty",width: 90,
						  headerAttributes: {style: "font-weight: bold"}, 
						  attributes: { style: "text-align: Right; font-size: 14px"},template: '#= kendo.format("{0:n2}",Quantity) #'},
						 {field: "Unit",title: "FA Unit",width: 80,headerAttributes: {style: "font-weight: bold"},},
						 {field: "ExcRate",title: "Exc Rate",width: 140,headerAttributes: {style: "font-weight: bold"},
						  attributes: { style: "text-align: Right; font-size: 14px"},
						  template: '#= kendo.format("{0:n2}",ExcRate) #'},
						 {field: "AcquisitionCost",title: "Acq Cost",width: 140,headerAttributes: {style: "font-weight: bold"},
						  attributes: { style: "text-align: Right; font-size: 14px"},
						  template: '#= kendo.format("{0:n2}",AcquisitionCost) #'},
						 {field: "DepreciationYear",title: "DepreciationYears",width: 135,headerAttributes: {style: "font-weight: bold"},hidden: "true"},
						 {field: "Department",title: "Dept Name",width: 250,headerAttributes: {style: "font-weight: bold"},},
						 
						 
						 {field: "Section",title: "Sect Name",width: 140,headerAttributes: {style: "font-weight: bold"},},
						 {field: "LocationCode",title: "Loc Name",width: 200,headerAttributes: {style: "font-weight: bold;"},attributes: { "class": "bgcolor"},},
						 {field: "ProductionLineCode",title: "Line Code",width: 200,headerAttributes: {style: "font-weight: bold"},attributes: { "class": "bgcolor"},},
						 {field: "SerialNo",title: "Serial Number",width: 140,headerAttributes: {style: "font-weight: bold"},},
						 
						 {field: "Remark",title: "Remark",width: 140,headerAttributes: {style: "font-weight: bold"},},
						 
						 

						 
                        ]
                    }).on("click", "tbody td", function(e) {
					var cell = $(e.currentTarget);
					var cellIndex = cell[0].cellIndex;
					var grid = $("#grid").data("kendoGrid");
					var column = grid.columns[cellIndex];
					var dataItem = grid.dataItem(cell.closest("tr"));
					idfixedassets= dataItem.idfixedassets;
						//alert(idfixedassets);
				});

					
				}
</script>