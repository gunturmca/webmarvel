
	<script type="text/javascript" class="init">
	var arrexcel = [];
	var chk2 = 0;
	var checked ;
	var ret ;
	var tgl;
	var flag=0;
	var savestatus = '';
		 $(document).ready(function() {
			  var taskb = document.documentElement.clientHeight;
			   hgt = taskb -195
			    $('#groupinput').height(hgt+32);

			   $('#grid').height(hgt+27)

			   
			   
				var date = new Date();
				var begin = moment().format("YYYY-MM-01");
				var end = moment().format("YYYY-MM-") + moment().daysInMonth();

				$('#MoveDate').val(begin);
				$('#todate').val(end);

				$('#MoveDate').datepicker({
				"format": "yyyy-mm-dd",
				}); 
				$('#todate').datepicker({
					"format": "yyyy-mm-dd",
				}); 
				
				var  fromdate  =  $('#MoveDate').val();
				var  todate = $('#todate').val();
				loadgrid(begin,end);
				
				
				$('#search').on('click', function(){
					var  fromdate  =  $('#MoveDate').val();
					var  todate = $('#todate').val();
					var  statussage  =$('#SageStatus').val();
					
					$( "div" ).remove( "#grid" );
					
					$('#groupinput').append("<div id='grid' style='margin-left:10px;margin-right:10px'></div>");   
					$('#grid').height(hgt+27)
					 srcgrid(fromdate,todate,statussage);
					 
					 
				});
				$('#save').on('click', function(){
					savestatus = '';
					if (flag==1)
					{updateqrnumber();}
					else
					{alert('Please select the date by ticking the check box');}
				});
				$('#export').on('click', function(){
					arrexcel = [];
					inserttoarray();
					var arr= JSON.stringify(arrexcel);
					if (arr.length > 2)
					{//$(location).prop('href', '<?php echo base_url(); ?>cmovement/createExcel?arr=' + arr);
					 $.redirect('<?php echo base_url(); ?>cmovement/createExcel?arr=' + arr,'' , "POST", "_blank");
					}
					
					
					else{alert('Please select the check box');}
				});
					$('#close').on('click', function(){
						
									var grid = $("#grid").data("kendoGrid");
									var ds1 = grid.dataSource.view();
									var $SageMoveIdInput = $('#SageMoveId').val();
									for (var i = 0; i < ds1.length; i++) 
										{
											if (ds1[i].SageStatus=='checked' && ds1[i].MoveDate== tgl)
												{
													var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];
													dataItem.SageMoveId=$SageMoveIdInput;
													
												}
										}
										$('#grid').data('kendoGrid').refresh();
						});
				
                });
				



				function loadgrid(fromdate,todate)
				{
					flag = 0;
					$("#grid").kendoGrid({
						dataSource: {
								transport: {
								read: 
									{
										url: "<?php echo base_url(); ?>cmovement/hdr",
										contentType: "application/json; charset=utf-8",
										dataType: "json",
										data:{fromdate:fromdate,todate:todate},
										type: 'get',
										
									},			
									},
									schema: {data: "data",
													model: {
														fields: {
															QtyYard: { type: "number",format: "{0:n2}" },
															QtyKgs: { type: "number",format: "{0:n2}" },
															SageMoveId: {editable: true },
															
														}
													}},
										 
										 
										 aggregate: [
											{ field: "QtyYard", aggregate: "sum" },
											{ field: "QtyKgs", aggregate: "sum" }
										]},	
											
                        
                        	pageSize: 5,
                        serverPaging: true,
                        serverSorting: true,
                        sortable: true,
                        
						editable: true, 
				
                        detailInit: detailInit,
						
                        /* dataBound: function() {
                            this.expandRow(this.tbody.find("tr.k-master-row").first());
                        },*/
                        columns: [
						
						{ title:"Check",width:75,headerAttributes: {style: "font-weight: bold"} ,editable: "false",
						  template: "<input name='chk' id='chk' class='chk' type='checkbox'  data-bind='checked: chk' #= chk ? checked=chk : '' #/>"
						  },
						 {field: "OnSite",title: "OnSite",width: 95,headerAttributes: {style: "font-weight: bold"},editable: "false" },
						 {field: "MoveDate",title: "Move Date",width: 105,headerAttributes: {style: "font-weight: bold"} ,editable: "false"},
						 {field: "qProdCode",title: "Product Code",width: 200,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qProdDesc",title: "Produk Description",width: 280,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qPO",title: "Po No",width: 160,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qLot",title: "Lot No",width: 95,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "QtyYard",title: "Stock yard",width: 95,format:"{0:n2}",editable: "false",
						  headerAttributes: {style: "font-weight: bold"},
						  footerTemplate: "<div style='text-align:right'> #: kendo.toString(sum, 'n2') # </div>",
						  attributes: { style: "text-align: Right; font-size: 14px"},editable: "false"},
						 {field: "QtyKgs",title: "Stock Kgs",width: 95,editable: "false",
						  headerAttributes: {style: "font-weight: bold"}, 
						  attributes: { style: "text-align: Right; font-size: 14px"},format:"{0:n2}",
						  footerTemplate: "<div style='text-align:right'> #: kendo.toString(sum, 'n2') # </div>"},
						  {field: "LocationType",title: "Location Type",width: 120,headerAttributes: {style: "font-weight: bold"},hidden:true},
						 {field: "Loc_From",title: "From Loc",width: 150,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "Loc_Dest",title: "Dest Loc",width: 110,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 { title:"Sage Status",width:105,headerAttributes: {style: "font-weight: bold"} ,editable: "false",
						  template: '# if (SageStatus=="unchecked") { #<div style="text-align: center"><input name="SageStatus" id="SageStatus" class="SageStatus" type="checkbox"   data-bind="checked: SageStatus" #= SageStatus ? checked=SageStatus : "" #/></div># } else { #<div style="text-align: center"><input name="SageStatus" id="SageStatus" class="SageStatus" type="checkbox"  data-bind="checked: SageStatus" #= SageStatus ? checked="checked" : "" #/></div># } #'},							  
						 {field: "SageUpdateBy",title: "Sage Update By",width: 135,headerAttributes: {style: "font-weight: bold"},hidden: "true"},
						 {field: "SageUpdateTime",title: "Sage Update Time",width: 140,headerAttributes: {style: "font-weight: bold"},hidden: "true"},
						 {field: "SageMoveId",title: "Sage MoveId",width: 140,headerAttributes: {style: "font-weight: bold"}},
						 {field: "flag_statusage",title: "flag_statusage",width: 140,hidden:true,headerAttributes: {style: "font-weight: bold"}},
						 {field: "StockUnit",title: "Stock Unit",width: 140,hidden:false,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "SageMoveId1",title: "SageMoveId1",width: 140,hidden:true,headerAttributes: {style: "font-weight: bold"}},
						 

						 
                        ]
                    });

				}
				function srcgrid(fromdate,todate,statussage)
				{
					flag = 0;
					$("#grid").kendoGrid({
						dataSource: {
								transport: {
									read: 
										{
											url: "<?php echo base_url(); ?>cmovement/srchdr",
											contentType: "application/json; charset=utf-8",
											dataType: "json",
											type: 'get',
											data:{fromdate:fromdate,todate:todate,statussage:statussage},
										},			
										},
										schema: {data: "data",
														model: {
															fields: {
																QtyYard: { type: "number",format: "{0:n2}" },
																QtyKgs: { type: "number",format: "{0:n2}" },
																SageMoveId: {editable: true },
																
															}
														}},
											
											
											aggregate: [
												{ field: "QtyYard", aggregate: "sum" },
												{ field: "QtyKgs", aggregate: "sum" }
											]
									},				
									pageSize: 5,
                        serverPaging: true,
                        serverSorting: true,
                        sortable: true,
                        
						editable: true, 
						
                        detailInit: detailInit,
                       /* dataBound: function() {
                            this.expandRow(this.tbody.find("tr.k-master-row").first());
                        },*/
                        columns: [
							{ title:"Check",width:75,headerAttributes: {style: "font-weight: bold"} ,editable: "false",
						  template: "<input name='chk' id='chk' class='chk' type='checkbox'  data-bind='checked: chk' #= chk ? checked=chk : '' #/>"
						  },
						 {field: "OnSite",title: "OnSite",width: 95,headerAttributes: {style: "font-weight: bold"},editable: "false" },
						 {field: "MoveDate",title: "Move Date",width: 105,headerAttributes: {style: "font-weight: bold"} ,editable: "false"},
						 {field: "qProdCode",title: "Product Code",width: 200,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qProdDesc",title: "Produk Description",width: 280,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qPO",title: "Po No",width: 160,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qLot",title: "Lot No",width: 95,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "QtyYard",title: "Stock yard",width: 95,format:"{0:n2}",editable: "false",
						  headerAttributes: {style: "font-weight: bold"},
						  footerTemplate: "<div style='text-align:right'> #: kendo.toString(sum, 'n2') # </div>",
						  attributes: { style: "text-align: Right; font-size: 14px"},editable: "false"},
						 {field: "QtyKgs",title: "Stock Kgs",width: 95,editable: "false",
						  headerAttributes: {style: "font-weight: bold"}, 
						  attributes: { style: "text-align: Right; font-size: 14px"},format:"{0:n2}",
						  footerTemplate: "<div style='text-align:right'> #: kendo.toString(sum, 'n2') # </div>"},
						  {field: "LocationType",title: "Location Type",width: 120,headerAttributes: {style: "font-weight: bold"},hidden:true},
						 {field: "Loc_From",title: "From Loc",width: 150,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "Loc_Dest",title: "Dest Loc",width: 110,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 { title:"Sage Status",width:105,headerAttributes: {style: "font-weight: bold"} ,editable: "false",
						  template: '# if (SageStatus=="unchecked") { #<div style="text-align: center"><input name="SageStatus" id="SageStatus" class="SageStatus" type="checkbox"  data-bind="checked: SageStatus" #= SageStatus ? checked=SageStatus : "" #/></div># } else { #<div style="text-align: center"><input name="SageStatus" id="SageStatus" class="SageStatus" type="checkbox"  data-bind="checked: SageStatus" #= SageStatus ? checked="checked" : "" #/></div># } #'},							  
						 {field: "SageUpdateBy",title: "Sage Update By",width: 135,headerAttributes: {style: "font-weight: bold"},hidden: "true"},
						 {field: "SageUpdateTime",title: "Sage Update Time",width: 140,headerAttributes: {style: "font-weight: bold"},hidden: "true"},
						 {field: "SageMoveId",title: "Sage MoveId",width: 140,headerAttributes: {style: "font-weight: bold"}},
						 {field: "flag_statusage",title: "flag_statusage",width: 140,hidden:true,headerAttributes: {style: "font-weight: bold"}},
						 {field: "StockUnit",title: "Stock Unit",width: 140,hidden:false,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "SageMoveId1",title: "SageMoveId1",width: 140,hidden:true,headerAttributes: {style: "font-weight: bold"}},


						 
                        ]
                    });

				}

				function detailInit(e) {
				var qProdCode = e.data.qProdCode;
				 var qPO = e.data.qPO;
				 var qLot = e.data.qLot;
				 var Loc_From = e.data.Loc_From;
				 var Loc_Dest = e.data.Loc_Dest;
				 var  fromdate  = e.data.MoveDate;
				
                    $("<div/>").appendTo(e.detailCell).kendoGrid({
						
						columns: [
							{ field: "OnSite",title:"On Site" , width: "70px"},
							{ field: "MoveDate",title:"Move Date", width: "100px"},
							{ field: "QRNumber", title:"QRNumber", width: "130px" },
                            { field: "Bluebin_from", title:"Bluebin from", width: "115px"},
							{ field: "Bluebin_to", title:"Bluebin to", width: "105px"},
							{ field: "Loc_From",title:"Loc From", width: "145px"},
							{ field: "Loc_Dest", title:"Loc Dest", width: "145px" },
                            { field: "QtyYard", title:"Qty Yard",width: "85px",attributes: { style: "text-align: Right; font-size: 14px"},
							 footerTemplate: "<div style='text-align:right'> #: kendo.toString(sum, 'n2') # </div>"},
							{ field: "QtyKgs",title:"Qty Kgs",width: "85px",attributes: { style: "text-align: Right; font-size: 14px"},
							footerTemplate: "<div style='text-align:right'> #: kendo.toString(sum, 'n2') # </div>"},
							{ field: "MoveBy", title:"Move By", width: "110px" },
                            { field: "MoveDate", title:"Move Date",width: "85px"},
                            { field: "qLinkGrn", title:"qLinkGrn",width: "150px"},
							
                        ],
                       dataSource: {
							 transport: {
										read: 
											{

												url: "<?php echo base_url(); ?>cmovement/dtl",
												contentType: "application/json; charset=utf-8",
												
												type: 'get',
												dataType: "json",
												data:{qProdCode:qProdCode,qPO:qPO,qLot:qLot,Loc_From:Loc_From,fromdate:fromdate,Loc_Dest:Loc_Dest},

												}
											},
										 schema: {data: "data",
													model: {
														fields: {
															QtyYard: { type: "number",format: "{0:n2}" },
															QtyKgs: { type: "number",format: "{0:n2}" },
															
														}
													}},
										 serverPaging: true,
										 serverSorting: true,
										 serverFiltering: true,
										 pageSize: 10,
										 
										 aggregate: [
											{ field: "QtyYard", aggregate: "sum" },
											{ field: "QtyKgs", aggregate: "sum" }
										]
								}, 
										
                        scrollable: false,
                        sortable: true,
                        pageable:false,
						//detailInit: detailInitdtl,
                        /*dataBound: function() {
                            this.expandRow(this.tbody.find("tr.k-master-row").first());
                        },*/
                        
						
                    });
					
					
                }
				
				

				//SAVE
				function inserttoarray() {
								var arr = [];
								var loaddata;
								var grid = $("#grid").data("kendoGrid");
								var data = grid.dataSource.data();
								
								var grid = $("#grid").data("kendoGrid")
								var ds = grid.dataSource.view();
								
								for (var i = 0; i < ds.length; i++) {
									var row = grid.table.find("tr[data-uid='" + ds[i].uid + "']");
									var checkbox = $(row).find(".chk");
									
									if (checkbox.is(":checked")) 
									{
												    var OnSite = ds[i].OnSite;
													var MoveDate = ds[i].MoveDate;
													var qProdCode = ds[i].qProdCode;
													var qProdDesc = ds[i].qProdDesc;
													var qPO = ds[i].qPO;
													var qLot = ds[i].qLot;
													var QtyYard = ds[i].QtyYard;
													var QtyKgs = ds[i].QtyKgs;
													var LocationType = ds[i].LocationType;
													var Loc_From = ds[i].Loc_From;
													var Loc_Dest = ds[i].Loc_Dest;
													var SageStatus = ds[i].SageStatus;
													var StockUnit = ds[i].StockUnit;
													
													
													arrexcel.push({
															OnSite :OnSite,
															MoveDate :MoveDate,
															qProdCode :qProdCode,
															qProdDesc :qProdDesc,
															qPO :qPO,
															qLot :qLot,
															LocationType:LocationType,
															QtyYard :QtyYard,
															QtyKgs :QtyKgs,
															Loc_From :Loc_From,
															Loc_Dest :Loc_Dest,
															SageStatus :SageStatus,
															StockUnit :StockUnit
														});

											
									}
									
									
								}
								
									
									
							
									
							}

						function exporttoexcel()
						{
							
							
							/*$.ajax({
									 url: "<?php echo base_url(); ?>cmovement/createExcel",
									 type: 'get',
									 data:{arr:arr},
									 dataType: "json",
									 success: function(data)
										 {
											
										 }
														  
								});*/
						}

							function updateqrnumber() {
								var arr = [];
								var loaddata;
								var grid = $("#grid").data("kendoGrid");
								var data = grid.dataSource.data();
								
								var grid = $("#grid").data("kendoGrid")
								var ds = grid.dataSource.view();
								
								for (var i = 0; i < ds.length; i++) {
								
									var flag_chk= ds[i].chk;
									
									if (flag_chk == 'checked') 
									{
									
										
											
												var qProdCode = ds[i].qProdCode;
												var qPO = ds[i].qPO;
												var qLot = ds[i].qLot;
												var QRNumber = ds[i].QRNumber;
												var Loc_Dest = ds[i].Loc_Dest;
												var SageMoveId = ds[i].SageMoveId;

											if (qProdCode != '' && qPO != '' && qLot != '' && Loc_Dest != '' && SageMoveId != '')
												{
													

													$.ajax({
															url: "<?php echo base_url(); ?>cmovement/loadqrnumber",
															type: 'get',
															data:{qProdCode:qProdCode,qPO:qPO,qLot:qLot,Loc_Dest:Loc_Dest,SageMoveId:SageMoveId},
															dataType: "json",
															success: function(data)
																{
																	if (data.status==='Saved Data' && savestatus==='')
																		{alert(data.status);savestatus='1';}
																}
															
																});
																
														
															
												}	
										

													
									}
									
								}
								
									
									
							
									
							}
										
					
												
						




	</script>
 <div id="content" style="margin-top:0px">
            <!-- content starts -->
     <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>admin">Home</a>
            </li>
            <li>
                <a href="#">Movement</a>
            </li>
        </ul>
    </div>

 	<div class=" row"  style="margin-top:-18px">
    <div class="box col-md-12">
    <div class="box-inner">
    <!--<div class="box-header well" data-original-title="">
        <h2><i ></i> Movement</h2>

       
    </div>-->
    <div class="box-content">
	 	

                
                  
                  

											<div class="box-tools" style="float:right;margin-right:-5px;margin-top:0px">
														<div class="input-group" style="width: 40px; margin-top:0px; padding-right:-10px">
															<span class="input-group" style="width: 40px; margin-top:0px; padding-right:5px">
														
															<div class="input-group-btn" >
																	<button id="search"  class="btn btn-sm btn-default" style = "margin-left:2px;"><i class="fa fa-search"></i> </button>
																</div>
                      												

                  
															</span>
															
													
														</div>
													
											</div>



											<div class="box-tools" style="float:right;margin-right:-5px;margin-top:0px">
														<div class="input-group" style="width: 70px; margin-top:0px; padding-right:-10px">
															<span class="input-group" style="width: 70px; margin-top:0px; padding-right:5px">
														
															<select name="SageStatus" id="SageStatus" class="form-control input-sm pull-right" style="margin-top:0px;height:30px">
																<option value="0">No</option>
																<option value="1">Yes</option>
																<option value="2">All</option>
																
																
															</select>
															</span>
															
													
														</div>
													
											</div>
										
											<div class="box-tools" style="float:right;margin-right:-5px;margin-top:5px">
														
														<div class="input-group" style="width: 87px; margin-top:0px; margin-left:3px">
															<span class="input-group" style="width: 87px; margin-top:0px; margin-right:3px"> Status Sage
															
															</span>
															
													
														</div>
													
											</div>
											<div class="box-tools" style="float:right;margin-right:0px;margin-top:0px">
														<div class="input-group" style="width: 100px; margin-top:0px; padding-right:5px">
															<span class="input-group" style="width: 100px; margin-top:0px; margin-left:0px">
															<input type="text" name="todate"  id="todate" placeholder="Date"  class="form-control input-sm pull-right" style="width:100px;" />
															
															</span>
															
													
														</div>
													
											</div>
											<div class="box-tools" style="float:right;margin-right:-5px;margin-top:5px">
														
														<div class="input-group" style="width: 30px; margin-top:0px; margin-left:3px">
															<span class="input-group" style="width: 30px; margin-top:0px; margin-right:3px"> To
															
															</span>
															
													
														</div>
													
											</div>
											<div class="box-tools" style="float:right;margin-right:-5px;margin-top:0px">
														
														<div class="input-group" style="width: 100px; margin-top:0px; padding-right:10px">
															<span class="input-group" style="width: 100px; margin-top:0px; padding-right:-10px">
															<input type="text" name="MoveDate"  id="MoveDate" placeholder="Date"  class="form-control input-sm pull-right" style="width:100px" />
															</span>
															
													
														</div>
													
											</div>

											
											<div class="box-tools" style="float:right;margin-right:5px;margin-top:5px">
														
														<div class="input-group" style="width: 70px; margin-top:0px; margin-left:3px">
															<span class="input-group" style="width: 70px; margin-top:0px; margin-right:3px"> From Date
															
															</span>
															
													
														</div>
													
											</div>



					<div class="box-tools" style="">
                     <form id="form2" name="form2" method="post" action="<?php echo base_url();?>cmovement/tampil"  >
      
                    <div class="" style="width: 50px; margin-left:0px; ">
						<div  style="width:10px;">
						

						</div>
						

					 <div class="input-group-btn"  >
                      <button type="button" name="save" id="save" class="btn btn-sm btn-primary btn-flat" style = "margin-right:5px"><i class="fa fa-save"></i> Save</button>

                      </div>
					  <div class="input-group-btn" style="margin-right:0px;">
						<button type="button" name="export" id="export" class="btn btn-sm btn-primary btn-flat" style="margin-right:5px;"><i class="fa fa-file-excel-o"></i> Export To Excel</button>

						</div>			
                      
					  
                      
                    </div>
                    
                  </div>


 				
				
				  
                   </div><!-- /.box-header -->
</form>
          <div  id="groupinput" class="form-group" style="overflow:auto; margin:0 0 10px 0;"> 
                
 <div id="grid" style="margin-left:10px;margin-right:10px"></div>
 				
                    
 </div>        
                    
 
<div id="contact-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="height:50px;">
				<a class="close" data-dismiss="modal">×</a>
				<h3 style="margin-top:0px;">Input Sage Move ID</h3>
			</div>
			<form id="contactForm" name="contact" role="form">
				<div class="modal-body">				
					<div class="form-group">
						<label for="name">Sage Move ID</label>
						<input type="text" name="SageMoveId" id="SageMoveId" class="form-control">
					</div>
						
				</div>
				<div class="modal-footer" style="height:50px;">					
					<button type="button" class="btn btn-success" id="close" style="margin-top:-7px;" data-dismiss="modal">Close</button>
					
				</div>
			</form>
		</div>
	</div>
</div>

               
    <!--/span-->

<!--/row-->
<!--/row-->
<!-- content ends -->
        </div>



            </div>
        </div>
    </div>
    </div>