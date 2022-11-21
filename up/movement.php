
<style>
	#myProgress {
	width: 100%;
	background-color: #ddd;
	margin-top:5px;
	}

	#myBar {
	width: 1%;
	height: 30px;
	background-color: #04AA6D;
	}
</style>

	<script type="text/javascript" class="init">
	var arrexcel = [];
	var chk2 = 0;
	var checked ;
	var totrecord;
	var ret ;
	var tgl;
	var flag=0;
	var savestatus = '';
		 $(document).ready(function() {
			  var taskb = document.documentElement.clientHeight;
			   hgt = taskb -195
			    $('#groupinput').height(hgt+32);

			   $('#grid').height(hgt+27)
			   clearlock();
			   document.getElementById("myProgress").style.display = 'none';
			   document.getElementById("refresh").style.display = 'none';
			   
				var date = new Date();
				var begin = moment().format("YYYY-MM-DD");
				//var end = moment().format("YYYY-MM-") + moment().daysInMonth();
				var end = moment().format("YYYY-MM-DD");
				//var begin = "2021-12-10";
				
				//var end = "2021-12-10";


				$('#MoveDate').val(begin);
				$('#todate').val(end);
				document.getElementById("todate").disabled = true;
				document.getElementById("hour").value = "6";
				$('#MoveDate').datepicker({
				"format": "yyyy-mm-dd",
				}); 
				$('#todate').datepicker({
					"format": "yyyy-mm-dd",
				}); 
				$('#MoveDate').on('change', function(){
					var date1 = $('#MoveDate').val();
					$('#todate').val(date1);

  				 });
				
				var  fromdate  =  $('#MoveDate').val();
				var  todate = $('#todate').val();
				var  statussage  =$('#SageStatus').val();
				var  qhour = $("#hour option:selected").text().substring(0,2);
				loadgrid(begin,end,qhour);
				
				
				$('#search').on('click', function(){
					var  fromdate  =  $('#MoveDate').val();
					var  todate = $('#todate').val();
					var  statussage  =$('#SageStatus').val();
					var  qhour = $("#hour option:selected").text().substring(0,2);
					
					$( "div" ).remove( "#grid" );
					
					$('#groupinput').append("<div id='grid' style='margin-left:10px;margin-right:10px'></div>");   
					$('#grid').height(hgt+27)
					 srcgrid(fromdate,todate,statussage,qhour);
					 
					 
				});
				$('#save').on('click', function(){
				
							 updateqrnumber();
	
				});
				$('#refresh').on('click', function(){
					loadgrid(begin,end,qhour);
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
				



				function loadgrid(fromdate,todate,qhour)
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
										data:{fromdate:fromdate,todate:todate,qhour:qhour},
										type: 'get',
										
									},			
									},
									schema: {data: "data",
													model: {
														fields: {
															QtyYard: { type: "number",format: "{0:n2}" },
															QtyKgs: { type: "number",format: "{0:n2}" },
															
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
						dataBound: function(e) {
							
							   $(".chk").bind("change", function(e) {
									var grid = $("#grid").data("kendoGrid");
									var row = $(e.target).closest("tr");
									row.toggleClass("k-state-selected");
									var data = grid.dataItem(row);
									var val = data.qHour ;
									// var updatetmplock
									var qhour = data.qHour ;
									var movedate = data.MoveDate ;
									var moveby = data.moveby ;
									
									var chk = data.chk ;


									
									var grid1 = $("#grid").data("kendoGrid")
									var ds1 = grid.dataSource.view();
									totrecord = ds1.length;
									var dataItem = grid.dataItem(grid.select());
									var index = grid.dataSource.indexOf(dataItem);	
									var row = grid.table.find("tr[data-uid='" + ds1[index].uid + "']");
									var checkbox = $(row).find(".chk");
									 		
									
											if (checkbox.is(":checked")) 
												{

													updatetmplock(movedate,qhour,"insert")

													for (var i = 0; i < ds1.length; i++) 
														{
														
																var data1 = ds1[i].qHour;	
																if (val === data1)
																{
																	var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];
																	
																	dataItem.chk='checked';
																	
																	
																}
															}
													$('#grid').data('kendoGrid').refresh(); 
												}
												else 
												{
													updatetmplock(movedate,qhour,"delete")
													for (var i = 0; i < ds1.length; i++) 
														{
														
																var data1 = ds1[i].qHour;	
																if (val === data1)
																{
																	var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];
																	
																	dataItem.chk='unchecked';
																	dataItem.SageStatus='unchecked'; 
																	dataItem.SageMoveId='';
																	
																}
															}
													$('#grid').data('kendoGrid').refresh(); 
												}
										 
								
    							});

								$(".SageStatus").bind("change", function(e) {
									var grid = $("#grid").data("kendoGrid");
									var row = $(e.target).closest("tr");
									row.toggleClass("k-state-selected");
									var data = grid.dataItem(row);
									var val = data.MoveDate ;
									var SageStatus = data.SageStatus ;
									tgl = val;

									
									var grid1 = $("#grid").data("kendoGrid")
									var ds1 = grid.dataSource.view();

									if (chk=='unchecked')
									   {data.set("unchecked", 'checked');	}
									else
									{data.set("checked", 'unchecked');$('#SageMoveId').val('');$('#contact-modal').modal('show');}

									for (var i = 0; i < ds1.length; i++) 
										{
											/*if (ds1[i].SageStatus=='checked')
											{
												
												alert('Can only choose one date');
												//window.location.reload(true);
												
												return false;
											}*/
											var data1 = ds1[i].MoveDate;	
												if (val === data1)
												{
													var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];
													
													
													dataItem.SageStatus='checked';
													
												}
										}
										$('#grid').data('kendoGrid').refresh();
								
    							});
								
								
								
  							},
                        /* dataBound: function() {
                            this.expandRow(this.tbody.find("tr.k-master-row").first());
                        },*/
                        columns: [
							
						{ title:"Check",width:75,headerAttributes: {style: "font-weight: bold"} ,editable: "false",
						  template: "<input name='chk' id='chk' class='chk' type='checkbox'  data-bind='checked: chk' #= chk ? checked=chk : '' #/>"
						  },
						 {field: "OnSite",title: "OnSite",width: 95,headerAttributes: {style: "font-weight: bold"},editable: "false" },
						 {field: "MoveDate",title: "Move Date",width: 105,headerAttributes: {style: "font-weight: bold"} ,editable: "false"},
						 {field: "qHour",title: "Hour",width: 80,headerAttributes: {style: "font-weight: bold"} ,editable: "false"},
						 {field: "qProdCode",title: "Product Code",width: 200,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qProdDesc",title: "Produk Description",width: 280,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qPO",title: "Po No",width: 160,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qLot",title: "Lot No",width: 95,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "QtyYard",title: "Stock Yard",width: 95,format:"{0:n2}",editable: "false",
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
						 {field: "SageMoveId",title: "Sage MoveId",width: 140,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "flag_statusage",title: "flag_statusage",width: 140,hidden:true,headerAttributes: {style: "font-weight: bold"}},
						 {field: "StockUnit",title: "Stock Unit",width: 140,hidden:false,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "SageMoveId1",title: "SageMoveId1",width: 140,hidden:true,headerAttributes: {style: "font-weight: bold"}},
						 

						 
                        ]
                    });

				}
				function srcgrid(fromdate,todate,statussage,qhour)
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
											data:{fromdate:fromdate,todate:todate,statussage:statussage,qhour:qhour},
										},			
										},
										schema: {data: "data",
														model: {
															fields: {
																QtyYard: { type: "number",format: "{0:n2}" },
																QtyKgs: { type: "number",format: "{0:n2}" },
																
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
						dataBound: function(e) {
							
							$(".chk").bind("change", function(e) {
									var grid = $("#grid").data("kendoGrid");
									var row = $(e.target).closest("tr");
									row.toggleClass("k-state-selected");
									var data = grid.dataItem(row);
									var val = data.MoveDate ;
									var chk = data.chk ;
									var qhour = data.qHour ;
									var movedate = data.MoveDate ;
									var moveby = data.moveby ;
									/*if (chk=='unchecked')
									   {data.set("unchecked", 'checked');

									 }
								else
									{data.set("checked", 'unchecked');}*/

									
									var grid1 = $("#grid").data("kendoGrid")
									var ds1 = grid.dataSource.view();
									totrecord = ds1.length;
									var dataItem = grid.dataItem(grid.select());
									var index = grid.dataSource.indexOf(dataItem);	
									var row = grid.table.find("tr[data-uid='" + ds1[index].uid + "']");
									var checkbox = $(row).find(".chk");
											if (checkbox.is(":checked")) 
												{
													updatetmplock(movedate,qhour,"insert");
													for (var i = 0; i < ds1.length; i++) 
														{
														
																var data1 = ds1[i].MoveDate;	
																if (val === data1)
																{
																	var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];
																	
																	dataItem.chk='checked';
																	
																	
																}
															}
													$('#grid').data('kendoGrid').refresh(); 
												}
												else 
												{
													updatetmplock(movedate,qhour,"delete");
													for (var i = 0; i < ds1.length; i++) 
														{
														
																var data1 = ds1[i].MoveDate;	
																if (val === data1)
																{
																	var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];

																	dataItem.chk='unchecked';
																	dataItem.SageStatus='unchecked'; 
																	dataItem.SageMoveId='';
																	
																	
																}
															}
													$('#grid').data('kendoGrid').refresh(); 
												}
										 
								
    							});
								
								$(".SageStatus").bind("change", function(e) {
									var grid = $("#grid").data("kendoGrid");
									var row = $(e.target).closest("tr");
									row.toggleClass("k-state-selected");
									var data = grid.dataItem(row);
									var val = data.MoveDate ;
									var SageStatus = data.SageStatus ;
									tgl = val;

									
									var grid1 = $("#grid").data("kendoGrid")
									var ds1 = grid.dataSource.view();

									if (chk=='unchecked')
									   {data.set("unchecked", 'checked');	}
									else
									{data.set("checked", 'unchecked');$('#SageMoveId').val('');$('#contact-modal').modal('show');}

									for (var i = 0; i < ds1.length; i++) 
										{
											/*if (ds1[i].SageStatus=='checked')
											{
												
												alert('Can only choose one date');
												//window.location.reload(true);
												
												return false;
											}*/
											var data1 = ds1[i].MoveDate;	
												if (val === data1)
												{
													var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];
													
													
													dataItem.SageStatus='checked';
													
												}
										}
										$('#grid').data('kendoGrid').refresh();
								
    							});
  							},
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
						 {field: "qHour",title: "Hour",width: 80,headerAttributes: {style: "font-weight: bold"} ,editable: "false"},
						 {field: "qProdCode",title: "Product Code",width: 200,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qProdDesc",title: "Produk Description",width: 280,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qPO",title: "Po No",width: 160,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "qLot",title: "Lot No",width: 95,headerAttributes: {style: "font-weight: bold"},editable: "false"},
						 {field: "QtyYard",title: "Stock Yard",width: 95,format:"{0:n2}",editable: "false",
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
						 {field: "SageMoveId",title: "Sage MoveId",width: 140,headerAttributes: {style: "font-weight: bold"},editable: "false"},
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
				 var qhour = e.data.qHour;
				 
				 var  fromdate  = e.data.MoveDate;
				 var  statussage  =$('#SageStatus').val();
				
                    $("<div/>").appendTo(e.detailCell).kendoGrid({
					
						columns: [
							{ field: "OnSite",title:"On Site" , width: "70px"},
							{ field: "MoveDate",title:"Move Date", width: "100px"},
							{ field: "qHour",title:"Hour", width: "80px"},
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
												data:{qProdCode:qProdCode,qPO:qPO,qLot:qLot,Loc_From:Loc_From,fromdate:fromdate,Loc_Dest:Loc_Dest,statussage:statussage,qhour:qhour},

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
						function clearlock()
						{
							
							$.ajax({
									 url: "<?php echo base_url(); ?>cmovement/clearlock",
									 type: 'get',
									 data:{},
									 dataType: "json",
									 success: function(data)
										 {
										
										 }				  
								});
						}
						function updatetmplock(movedate,qhour,status)
						{
							
							
							$.ajax({
									 url: "<?php echo base_url(); ?>cmovement/updatetmplock",
									 type: 'get',
									 data:{movedate:movedate,qhour:qhour,status:status},
									 dataType: "json",
									 success: function(data)
										 {
											alert(data.message);
												
											
													for (var i = 0; i < totrecord; i++) 
														{
															var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];
																dataItem.chk='unchecked';
																dataItem.SageStatus='unchecked'; 
														}
														$('#grid').data('kendoGrid').refresh();
										 }
														  
								});
						}

						
							

							function updateqrnumber() {
								var arr = [];
								var loaddata;
								var grid = $("#grid").data("kendoGrid");
								var data = grid.dataSource.data();
								var grid = $("#grid").data("kendoGrid")
								var ds = grid.dataSource.view();
								var elem = document.getElementById("myBar");
								var width = 1;
								var persen = 1;
								var flag = 0;
								let i = 0;
    							
								
								for (i = 0; i < ds.length; i++) {
									var row = grid.table.find("tr[data-uid='" + ds[i].uid + "']");
									var checkbox = $(row).find(".chk");
									if (checkbox.is(":checked")) 
									{

										
												var qProdCode = ds[i].qProdCode;
												var qPO = ds[i].qPO;
												var qLot = ds[i].qLot;
												var QRNumber = ds[i].QRNumber;
												var tgl = ds[i].MoveDate;
												var Loc_From = ds[i].Loc_From;
												var Loc_Dest = ds[i].Loc_Dest;
												var SageMoveId = ds[i].SageMoveId;
												var qhour = ds[i].qHour;

											if (qProdCode != '' && qPO != '' && qLot != '' && Loc_Dest != '' && SageMoveId != '')
												{
													if (flag==0 && i > 1)
													{
														$("#myProgress").show();
														falg=1;
													}
													
													$.ajax({
															url: "<?php echo base_url(); ?>cmovement/loadqrnumber",
															type: 'get',
															data:{qProdCode:qProdCode,qPO:qPO,qLot:qLot,Loc_Dest:Loc_Dest,tgl:tgl,SageMoveId:SageMoveId,qhour:qhour,Loc_From:Loc_From},
															dataType: "json",
															success: function(data)
																{
																	//DoEvent(width,ds);
																	//if (data.status==='Saved Data' && savestatus==='')
																		//{alert(data.status);savestatus='1';}
																		
																		
           								 							    elem.style.width = width++ * 100/ds.length + '%';	
																			if ( (width * 100/ds.length) == 100) {
																				document.getElementById("myProgress").style.display = 'none';
																			
																			}
																		
																		//
																		
																}
															
																});		
												}		

												
									}

									
									
									
								}
			
						
										
							
									
							}
										
					
												
						




	</script>
 <div id="content" style="margin-top:-20px">
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
											<div class="box-tools" style="float:right;margin-right:-0px;margin-top:0px">
														<div class="input-group" style="width: 85px; margin-top:0px; padding-right:-10px">
															<span class="input-group" style="width: 85px; margin-top:0px; padding-right:5px">
														
															<select name="hour" id="hour" class="form-control input-sm pull-right" style="margin-top:0px;height:30px">
																<option value="0">01-02</option>
																<option value="1">02-03</option>
																<option value="2">03-04</option>
																<option value="3">04-04</option>
																<option value="4">05-06</option>
																<option value="5">06-07</option>
																<option value="6">07-08</option>
																<option value="7">08-09</option>
																<option value="8">09-10</option>
																<option value="9">10-11</option>
																<option value="10">11-12</option>
																<option value="11">12-13</option>
																<option value="12">13-14</option>
																<option value="13">14-15</option>
																<option value="14">15-16</option>
																<option value="15">16-17</option>
																<option value="16">17-18</option>
																<option value="17">18-19</option>
																<option value="18">19-20</option>
																<option value="19">20-21</option>
																<option value="20">21-22</option>
																<option value="21">22-23</option>
																<option value="22">23-24</option>
																<option value="23">24-01</option>
																
																
																
															</select>
															</span>
															
													
														</div>
													
											</div>
											<div class="box-tools" style="float:right;margin-right:-5px;margin-top:5px">
														
														<div class="input-group" style="width: 45px; margin-top:0px; margin-left:3px">
															<span class="input-group" style="width: 30px; margin-top:0px; margin-right:3px"> Hour
															
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
						<div class="input-group-btn" style="margin-right:0px;">
						<button type="button" name="refresh" id="refresh" class="btn btn-sm btn-primary btn-flat" style="margin-right:5px;"><i class="fa fa-refresh"></i> Refresh</button>

						</div>	
						
                      
                    </div>
                    <div id="myProgress" >
  						<div id="myBar"></div>
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