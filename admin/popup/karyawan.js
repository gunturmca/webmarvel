
	    function closeall() {
	        var myWindow = $("#window").data("kendoWindow");
	        myWindow.close();
	        alert("sd");
	    }
		
	    
			function keypress(){
				var keyPressed = event.keyCode || event.which;
				if (keyPressed==13)
					{
						event.preventDefault();
						tampil();
					}
			}
			
 			function frmsearh_karyawan() {
						
				var myWindow = $("#window"),
					undo = $("#undo");

				function onClose() {
					undo.fadeIn();
				}
					myWindow.kendoWindow({
						width: "50%",
						title: "List Data Karyawan",
						resizable: false,
						close: onClose,
						appendTo:"form#form2",
						position:{
							top:"100px",
							left:"25%"
						}
					})
					myWindow.data("kendoWindow").open();
					
				}



function tampil()
{
	
		 var hgt;
		 var frm;		
		 var taskb = document.documentElement.clientHeight;
		 var cari= document.getElementById('table_search1').value;
		 var path = window.location.pathname;
 		 var str = path.split("/");
 	     var url = document.location.protocol+ "//" + document.location.host + "/" + str[1]+ "/" + str[2]+ "/" + str[3];
		 
		<!-- var cari= document.getElementById('table_search1').value;-->
		 hgt = 300;
		 $('#grid1').height(hgt-12);
		$("#grid1").kendoGrid({
		 dataSource: {
		 transport: {
					read: 
						{
							url: url + '/getjson_popup',
							
							  contentType: "application/json; charset=utf-8",
							  data:{fields:cari},
							  dataType: "json",
							  type: 'GET'
							}
						},
					 schema: {data: "data"},
						
					},

						sortable: true,
						filterable:true,
						scrollable:true,
						
						pageable: {
							refresh: true,
							pageSizes: true
						},
						selectable: "row",
						 
						 columns: [{
							  field: "idkaryawan",
							  title: "idkaryawan",
							  filterable: true,
							  hidden:true
							  
						  }, {
							  field: "nik",
							  title: "NIK",
							  filterable: true,
							  
						  },
						   {
							  field: "nmkaryawan",
							  title: "Nama",
							  filterable: true,
							  
						  }],
						  dataBound: onDataBound
					});
			}
					function onDataBound() {
						  var grid = this;
						  grid.element.on('dblclick','tbody tr[data-uid]',function (e) {
						  
						    passValues();
							
						  })
					}
				   function passValues()
                    {
                      var grid = $("#grid1").data("kendoGrid");  
                       var selectedItem = grid.dataItem(grid.select());  
                         var cell = grid.select();
                                          var cellIndex = cell[0].cellIndex;
                                          var column = grid.columns[0];
                                          var dataItem = grid.dataItem(cell.closest("tr"));			
										  var kosong = "";	
                       for (var i = 0; i < grid.columns.length; i++) {

                                    try
                                    	{
                                        	 document.getElementById(grid.columns[i].field).value = dataItem[grid.columns[i].field];
											  if (document.getElementById(grid.columns[i].field).value == "undefined" )
												{
													document.getElementById(grid.columns[i].field).value = "";
												 }
									 	}
                                    catch(err) 
										{
											
                                    	} 
                                
                        }
						var myWindow = $("#window").data("kendoWindow");
						myWindow.close();
                    }