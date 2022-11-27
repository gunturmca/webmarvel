
	    function closeall() {
	        var myWindow = $("#window").data("kendoWindow");
	        myWindow.close();
	        alert("sd");
	    }
		
	    function tampilfrmbank() 
		{

	        var myWindow = $("#window"),
                        undo = $("#undo");
//	        $('#window').css("display","block");
	        function onClose() 
			{
	            undo.fadeIn();
	     	}
		 
	       myWindow.kendoWindow({
	            width: "305px",
	            title: "Form Data Bank",
                resizable: false,
                close: onClose,
                appendTo:"form#form2"
	        })
		 
	       myWindow.data("kendoWindow").center().open();

	    }
			function keypress(){
				var keyPressed = event.keyCode || event.which;
				if (keyPressed==13)
					{
						event.preventDefault();
						tampil();
					}
			}
			
 			function frmsearh_penduduk() {
						
				var myWindow = $("#window"),
					undo = $("#undo");

				function onClose() {
					undo.fadeIn();
				}
					myWindow.kendoWindow({
						width: "50%",
						title: "List Data Penduduk",
						resizable: false,
						close: onClose,
						appendTo:"form#form2",
						position:{
							top:"100px",
							left:"25%"
						}
					})
					myWindow.data("kendoWindow").open();
					tampil();
				}



function tampil()
{
		var hgt;
		 var frm;
					
		 var taskb = document.documentElement.clientHeight;
		 var cari= document.getElementById('table_search1').value;
		 
		<!-- var cari= document.getElementById('table_search1').value;-->
		 hgt = 300;
		  $('#grid1').height(hgt-12);
		
		
		$("#grid1").kendoGrid({
		 dataSource: {
		 transport: {
					read: 
						{
							url: window.location.origin + '/sunson/admin/cijin/getjson_popup?field='+ cari,
							
									 contentType: "application/json; charset=utf-8",
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
							  field: "nama",
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