	<style type="text/css">
.kanan {
    text-align: right;
}

.bgcolor {
    background-color: #98FB98;
}
	</style>

	<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>


	<script type="text/javascript" class="init">
var idsToSend = [];
var assets = [];
var arrsave = [];
var frm = 'Fixes Assets';
$(function() {
    $('#last_movement_date').datepicker({
        "format": "yyyy-mm-dd",
    });
});
var arrLocName = [];
$(document).ready(function() {




    $('#print').on('click', function() {

        arr = JSON.stringify(idsToSend);
        arr = JSON.stringify(idsToSend).replaceAll('&', 'And');
        $.redirect("<?php echo base_url(); ?>cfixedassets/printqr2?arr=" + arr, '', "POST", "_blank");

    });

    var d = moment();
    $('#last_movement_date').val(d.format('YYYY-MM-DD'));
    var input = document.getElementById("table_search");
    document.getElementById("table_search").focus();
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("btnsrch").click();
        }
    });


    disablebutton('<?php echo base_url(); ?>cfixedassets/getstatusbutton');
    $(window).on("load", function() {
        $("#export").prop("disabled", true);
        showfield();

    });
    $("#asset").kendoMultiColumnComboBox({
        dataTextField: "asset",
        dataValueField: "asset",
        height: 400,

        columns: [

            {
                field: "asset",
                title: "No. Asset",
                width: "100%"
            },



        ],
        footerTemplate: 'Total #: instance.dataSource.total() # items found',
        filter: "contains",
        filterFields: ["asset"],
        dataSource: {

            transport: {
                read: {
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    type: 'post',
                    url: '<?php echo base_url(); ?>cregistrasiasset/dataasset',
                }

            }
        },
        /*change: function (e) {
        			var dataItem = e.sender.dataItem();
        			idpengajar =  dataItem.idpengajar;

        		}*/
    });

    $("#LocationCode").kendoMultiColumnComboBox({
        dataTextField: "LocName",
        dataValueField: "LocName",
        height: 400,

        columns: [

            {
                field: "LocName",
                title: "Loc Name",
                width: "100%"
            },



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
    $("#ProductionLineCode").kendoMultiColumnComboBox({
        dataTextField: "LineCode",
        dataValueField: "LineCode",
        height: 400,

        columns: [

            {
                field: "LineCode",
                title: "Line Code",
                width: "100%"
            },



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




    function ArraySave() {
        arrsave = []


        var grid = $("#grid").data("kendoGrid")
        var ds = grid.dataSource.view();
        var userid = "<?php echo $this->session->userdata('userid'); ?>";
        for (var i = 0; i < ds.length; i++) {
            var row = grid.table.find("tr[data-uid='" + ds[i].uid + "']");
            var checkbox = $(row).find(".chk");
            if (checkbox.is(":checked")) {

                var Asset = ds[i].Asset;
                var Section = ds[i].Section;
                var ProductionLineCode = ds[i].ProductionLineCode;
                var LocationCode = ds[i].LocationCode;
                var sn = ds[i].SerialNo;
                arrsave.push({
                    Asset: Asset,
                    Section: Section,
                    ProductionLineCode: ProductionLineCode,
                    LocationCode: LocationCode,
                    sn: sn,
                    userid: userid,
                });
            }

        }

    }



    $('#save').on('click', function() {
        ArraySave()
        var arr = JSON.stringify(arrsave);

        //alert(arr);
        $.ajax({
            url: "./simpan",
            type: "post",
            data: {
                arr1: arr
            },

            success: function(data) {

                if (data == 1) {
                    alert('Saved Data');
                } else {
                    alert('Error Saved');
                }


            }
        });

    });


    $('#btnsrch').on('click', function() {

        var clm = $('#column').val();

        if (clm === "a.Asset") {

            $('#camera').modal('show');
            initScanner();
        } else {
            $("#grid").remove();
            $('#groupinput').append("<div id='grid'></div>");
            $('#groupinput').height(hgt + 4);
            $('#grid').height(hgt + 2);
            loadgrid();
        }

    });


    $('#export').on('click', function() {

        /*arr= JSON.stringify(assets);
        if(assets.length > 0)
        {
        $.redirect("<?php echo base_url(); ?>cfixedassets/createExcel?arr="+arr,'' , "POST", "_blank");}*/
        var field = $('#table_search').val();
        var clm = $('#column').val();;
        var arrdata = {
            field: field,
            clm: clm
        };
        arr = JSON.stringify(arrdata);
        $.redirect("<?php echo base_url(); ?>cfixedassets/createExcel?arr=" + arr, '', "POST",
        "_blank");



    });


    var hgt;
    var frm;
    var wnd;
    var taskb = document.documentElement.clientHeight;
    hgt = taskb - 166;
    $('#groupinput').height(hgt + 4);
    $('#grid').height(hgt + 2);

    $('#OnSite').val("<?php echo $this->session->userdata('onsite') ?>");


    $(window).on("load", function() {
        loadgrid();

    });


    $('#DeptCode').change(function() {
        var id = $(this).val();
        var DeptName = $("#DeptCode option:selected").text();
        $("#DeptName").val(DeptName);
        datasection(id);

    });

    $('#SectCode').change(function() {
        var id = $(this).val();
        var SectName = $("#SectCode option:selected").text();
        $("#SectName").val(SectName);
        DataLine(id);

    });

    $('#LocCode').change(function() {

        var LocName = $("#LocCode option:selected").text();
        $("#LocName").val(LocName);


    });
    /*
    			 function DataLine(id)
    			 {
    				 $.ajax({
    				  url : "./getdataline",
    				  type: "get",
    				  data:{id:id},
    				  async: true,
    				  dataType: "json",
    				  success: function(data)
    					  {
    						  var html='';
    						  var i;
    						 html += '<option value=' + "0" + '>' + "Select Item" + '</option>';
    						  for (i = 0; i < data.length; i++)
    						  { 
    							  html += '<option value='+ data[i].id+ '>' + data[i].name + '</option>';
    							  }
    							  
    						  $('#LineCode').html(html);
    					  }
    				  });
    				 
    				 }
    				 */
    /*	 
    			function datasection(id)
    			{
    				$.ajax({
    				  url : "./getdatasection",
    				  type: "get",
    				  data:{id:id},
    				  async: true,
    				  dataType: "json",
    				  success: function(data)
    					  {
    						 
    						  var html='';
    						  var i;
    						 html += '<option value=' + "0" + '>' + "Select Item" + '</option>';
    						  for (i = 0; i < data.length; i++)
    						  {
    							  
    							  html += '<option value='+ data[i].id+ '>' + data[i].name + '</option>';
    							  }
    							  
    						  $('#SectCode').html(html);
    					  }
    				  });
    				
    				}
    	
    	*/
    $('#simpanalt').on('click', function() {
        var last_movement_date = $('#last_movement_date').val();
        var asset = $('#asset').val();
        var ProductionLineCode = $('#ProductionLineCode').val();
        var LocationCode = $('#LocationCode').val();

        //alert(arr);
        $.ajax({
            url: "<?php echo base_url(); ?>cfixedassets/simpanpopup",
            type: "post",
            data: {
                last_movement_date: last_movement_date,
                asset: asset,
                ProductionLineCode: ProductionLineCode,
                LocationCode: LocationCode
            },

            success: function(data) {

                if (data == 1) {
                    alert('Saved Data');
                } else {
                    alert('Error Saved');
                }


            }
        });


    });

    $('#simpan').on('click', function() {
        var idfixedassets = $("#idfixedassets").val();


        if (parseFloat(idfixedassets) > 0) {
            url = "<?php echo base_url(); ?>cfixedassets/";
            update2(idfixedassets, url);
        } else {
            save();
        }
    });

});


//bind grid

//batas bind


function loadgrid() {
    idsToSend = [];
    //var dataLocName=JSON.stringify(arrLocName);
    var field = $('#table_search').val();
    var clm = $('#column').val();;

    $("#grid").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: "<?php echo base_url(); ?>cfixedassets/tampilgrid",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: {
                        clm: clm,
                        field: field
                    },
                    type: 'get',
                },
            },
            pageSize: 50,
            schema: {
                model: {
                    fields: {
                        FAQty: {
                            type: "number",
                            format: "{0:n2}"
                        },
                        LocCode: {
                            field: "LocCode",
                            defaultValue: 1
                        },
                    }
                }
            },


        },




        sortable: true,

        editable: true,
        pageable: {
            pageSizes: [50, 75, 100],
        },
        /*
						pageable: {
                          	info: false,
                           
                          	previousNext: false,
                          	numeric: false
                        },*/
        selectable: "row",
        detailInit: detailInit,
        dataBound: function(e) {

            /*this.pager
            	.element
            	.append(
              	'<span class="k-pager-info k-label">' + 
              		e.sender.dataSource.view().length + 
              	' Record</span>'
            	);*/
            $(".chk").bind("change", function(e) {
                var grid = $("#grid").data("kendoGrid");

                var row = $(e.target).closest("tr");
                row.toggleClass("k-state-selected");
                var data = grid.dataItem(row);
                var checkbox = $(row).find(".chk");
                var userid = "<?php echo $this->session->userdata('userid'); ?>";
                if (checkbox.is(":checked")) {
                    // alert(data.Asset);
                    //idsToSend.push("'" + data.Asset + "'");
                    var Asset = data.Asset;
                    var PhysicalTagNo = data.PhysicalTagNo;
                    var SerialNo = data.SerialNo;
                    var LocalOrImport = data.LocalOrImport;
                    var AllocationDate = data.AllocationDate;
                    var Description = data.Description;
                    var Description2 = data.Description2;
                    var Department = data.Department;
                    var Section = data.Section;
                    var ProductionLineCode = data.ProductionLineCode;
                    var LocationCode = data.LocationCode;
                    var newDepartment = Department.replace('&', 'And');
                    var DS = newDepartment + ' - ' + Section;
                    idsToSend.push({
                        Asset: Asset.toString(),
                        PhysicalTagNo: PhysicalTagNo.toString(),
                        AllocationDate: AllocationDate,
                        SerialNo: SerialNo,
                        LocalOrImport: LocalOrImport,
                        Description: Description,
                        Description2: Description2,
                        Department: newDepartment,
                        Section: Section,
                        ProductionLineCode: ProductionLineCode,
                        LocationCode: LocationCode,
                        DS: DS,
                        userid: userid,
                    });
                    assets.push({
                        Asset: Asset.toString(),
                    });

                } else {
                    const removeById = (idsToSend, Asset) => {
                        const requiredIndex = idsToSend.findIndex(el => {
                            return el.Asset === String(Asset);
                        });
                        if (requiredIndex === -1) {
                            return false;
                        };
                        return !!idsToSend.splice(requiredIndex, 1);
                    };
                    removeById(idsToSend, data.Asset.toString());

                    const removeByIdAsset = (assets, Asset) => {
                        const requiredIndexAsset = assets.findIndex(el => {
                            return el.Asset === String(Asset);
                        });
                        if (requiredIndexAsset === -1) {
                            return false;
                        };
                        return !!assets.splice(requiredIndexAsset, 1);
                    };
                    removeByIdAsset(assets, data.Asset.toString());





                }
                //alert(arr);

            });
        },


        /* dataBound: function() {
            this.expandRow(this.tbody.find("tr.k-master-row").first());
        },*/
        columns: [{
                title: "Check",
                width: 75,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false",

                attributes: {
                    style: "text-align: center; font-size: 14px"
                },
                template: "<div style='text-align: center'><div style='text-align: center'><input name='chk' id='chk' class='chk' type='checkbox'  data-bind='checked: chk' #= chk ? checked=chk : '' #/></div>"
            },
            {
                field: "Asset",
                title: "FA Tag No",
                width: 200,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "PhysicalTagNo",
                title: "Physical Tag No",
                width: 200,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "Description",
                title: "FA Desc",
                width: 350,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "LocationCode",
                title: "Loc Name",
                width: 200,
                headerAttributes: {
                    style: "font-weight: bold;"
                },
                attributes: {
                    "class": "bgcolor"
                },


                editor: function(container, options) {
                    $('<input data-text-field="LocName" data-value-field="LocCode" data-bind="value:' +
                            options.field + '"/>')
                        .appendTo(container)
                        .kendoMultiColumnComboBox({
                            dataTextField: "LocName",
                            dataValueField: "LocCode",
                            height: 400,
                            columns: [


                                {
                                    field: "LocName",
                                    title: "Loc Name",
                                    width: 200
                                },



                            ],
                            footerTemplate: 'Total #: instance.dataSource.total() # items found',
                            filter: "contains",
                            filterFields: ["LocName"],
                            value: options.model.LocCode, // THIS IS THE CHANGE I MADE
                            dataSource: {
                                transport: {
                                    read: {
                                        dataType: "json",
                                        url: '<?php echo base_url(); ?>cfixedassets/dataLocName',
                                    }
                                }
                            },
                            change: function(e) {
                                var dataItem = e.sender.dataItem();
                                options.model.set("LocationCode", dataItem.LocName);


                            }
                        });
                },







            },
            {
                field: "ProductionLineCode",
                title: "Line Code",
                width: 200,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                attributes: {
                    "class": "bgcolor"
                },

                editor: function(container, options) {
                    $('<input data-text-field="LineName" data-value-field="LineCode" data-bind="value:' +
                            options.field + '"/>')
                        .appendTo(container)
                        .kendoMultiColumnComboBox({
                            dataTextField: "LineName",
                            dataValueField: "LineCode",
                            height: 400,
                            columns: [


                                {
                                    field: "LineName",
                                    title: "Line Code",
                                    width: 200
                                },



                            ],
                            footerTemplate: 'Total #: instance.dataSource.total() # items found',
                            filter: "contains",
                            filterFields: ["LineCode"],
                            value: options.model.LocCode, // THIS IS THE CHANGE I MADE
                            dataSource: {
                                transport: {
                                    read: {
                                        dataType: "json",
                                        url: '<?php echo base_url(); ?>cfixedassets/dataLineName',
                                    }
                                }
                            },
                            change: function(e) {
                                var dataItem = e.sender.dataItem();
                                options.model.set("ProductionLineCode", dataItem.LineName);


                            }
                        });
                },


            },



            {
                field: "Print_Time",
                title: "Last Qty Print",
                width: 140,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "print_date",
                title: "Last Print Date",
                width: 190,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "userID",
                title: "Last Print By",
                width: 230,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false",
            },
            {
                field: "ModifiedDate",
                title: "Last Update",
                width: 190,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "last_movement_date",
                title: "Last Move Date",
                width: 190,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },

            {
                field: "SupplierName",
                title: "Supp. Name",
                width: 250,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "InvoiceRef",
                title: "Supp. Invoice",
                width: 170,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "LocalOrImport",
                title: "Local/Import",
                width: 120,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "DocLink",
                title: "Link Doc",
                width: 300,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "BCNo",
                title: "BC Doc",
                width: 200,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "AllocationDate",
                title: "Acq Date",
                width: 95,
                editable: "false",
                headerAttributes: {
                    style: "font-weight: bold"
                },
                attributes: {
                    style: "text-align: Center; font-size: 14px"
                },
                editable: "false"
            },
            {
                field: "ReferenceNo",
                title: "Ref Sage",
                width: 190,
                editable: "false",
                headerAttributes: {
                    style: "font-weight: bold"
                }
            },
            {
                field: "COA",
                title: "Sage COA",
                width: 120,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },



            {
                field: "Description2",
                title: "FASubDesc",
                width: 350,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "Quantity",
                title: "FA Qty",
                width: 90,
                editable: "false",
                headerAttributes: {
                    style: "font-weight: bold"
                },
                attributes: {
                    style: "text-align: Right; font-size: 14px"
                },
                format: "{0:n2}"
            },
            {
                field: "Unit",
                title: "FA Unit",
                width: 80,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "ExcRate",
                title: "Exc Rate",
                width: 140,
                hidden: true,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "AcquisitionCost",
                title: "Acq Cost",
                width: 140,
                hidden: true,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },

            {
                field: "DepreciationYear",
                title: "DepreciationYears",
                width: 135,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                hidden: "true"
            },
            {
                field: "Department",
                title: "Dept Name",
                width: 250,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "Section",
                title: "Sect Name",
                width: 140,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },
            {
                field: "SerialNo",
                title: "Serial Number",
                width: 140,
                headerAttributes: {
                    style: "font-weight: bold"
                },
                editable: "false"
            },




        ]
    });


}

function detailInit(e) {
    var Asset = e.data.Asset;
    $("<div/>").appendTo(e.detailCell).kendoGrid({

        columns: [{
                field: "date",
                title: "Date",
                width: "70px"
            },
            {
                field: "asset",
                title: "FA Tag No",
                width: "70px"
            },
            {
                field: "LocationCode",
                title: "Line Code",
                width: "70px"
            },
            {
                field: "ProductionLineCode",
                title: "Loc Name",
                width: "70px"
            },
            {
                field: "CreateDate",
                title: "Create Date",
                width: "70px"
            },
            {
                field: "CreateBy",
                title: "User ID",
                width: "70px"
            }

        ],
        dataSource: {
            transport: {
                read: {

                    url: "<?php echo base_url(); ?>cfixedassets/dtl",
                    contentType: "application/json; charset=utf-8",

                    type: 'get',
                    dataType: "json",
                    data: {
                        Asset: Asset
                    },

                }
            },
            schema: {
                data: "data",
                model: {

                }
            },
            serverPaging: true,
            serverSorting: true,
            serverFiltering: true,
            pageSize: 10


        },

        scrollable: false,
        sortable: true,
        pageable: false,
        //detailInit: detailInitdtl,
        /*dataBound: function() {
            this.expandRow(this.tbody.find("tr.k-master-row").first());
        },*/


    });


}
	</script>

	<div id="content" class="">
	    <!-- content starts -->
	    <div>
	        <ul class="breadcrumb">
	            <li>
	                <a href="<?php echo base_url(); ?>admin">Home</a>
	            </li>
	            <li>
	                <a href="#">Fixed Assets</a>
	            </li>
	        </ul>
	    </div>




	    <div class=" row" style="margin-top:-18px">
	        <div class="box col-md-12">
	            <div class="box-inner">
	                <!--<div class="box-header well" data-original-title="">
        <h2><i ></i> </h2>

       
    </div>-->
	                <div class="box-content">


	                    <form id="form2" name="form2">
	                        <div id="form20" name="form20">

	                            <div class="box-tools" style="float:right">

	                                <div class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
	                                    <span class="input-group"
	                                        style="width: 150px; margin-top:0px; padding-right:-10px">
	                                        <input type="text" name="table_search" id="table_search"
	                                            class="form-control input-sm pull-right" placeholder="Search" />
	                                    </span>
	                                    <div class="input-group-btn">
	                                        <button type="button" id="btnsrch" class="btn btn-sm btn-default"
	                                            style="margin-left:2px;"><i class="fa fa-search"></i> </button>
	                                    </div>

	                                </div>

	                            </div>

	                            <div class="box-tools" style="float:right;margin-right:5px">
	                                <div class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
	                                    <span class="input-group"
	                                        style="width: 150px; margin-top:0px; padding-right:-10px">

	                                        <select name="column" id="column" class="form-control input-sm pull-right"
	                                            style="margin-top:0px">
	                                            <option value="">Choice Column</option>
	                                            <option value="a.Asset">FA Tag No</option>
	                                            <option value="a.PhysicalTagNo">Physical Tag No</option>
	                                            <option value="a.Description">FA Desc</option>
	                                            <option value="a.SupplierName">Supplier Name</option>
	                                            <option value="a.InvoiceRef">Supplier Invoice</option>
	                                            <option value="a.LocalOrImport">Local Import</option>
	                                            <option value="a.DocLink">Link Doc</option>
	                                            <option value="a.BCNo">BC Doc</option>
	                                            <option value="a.ReferenceNo">Ref Sage</option>
	                                            <option value="a.COA">Sage COA</option>
	                                            <option value="a.Description2">FA Sub Desc</option>
	                                            <option value="a.Unit">FA Unit</option>
	                                            <option value="a.Department">Dept Name</option>
	                                            <option value="a.LocationCode">Location Name</option>
	                                            <option value="a.Section">Section Name</option>
	                                            <option value="a.ProductionLineCode">Line Code</option>
	                                            <option value="a.SerialNo">Serial No</option>
	                                            <option value="a.AcquisitionCost">Acq Cost</option>
	                                            <option value="a.DepreciationYear">Depreciation Year</option>
	                                            <option value="a.Remark">Remark</option>



	                                        </select>
	                                    </span>


	                                </div>

	                            </div>
	                            <div class="box-tools" style="float:right;margin-right:5px">
	                                <div class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
	                                    <span class="input-group"
	                                        style="width: 150px; margin-top:0px; padding-right:-10px">

	                                        <select name="OnSite" id="OnSite" class="form-control input-sm pull-right"
	                                            style="margin-top:0px">
	                                            <option value="">On Site</option>
	                                            <option value="L-MJL">Majalengka</option>
	                                            <option value="M-SKB">Sukabumi</option>
	                                            <option value="M-TGR">Tanggerang</option>

	                                        </select>
	                                    </span>


	                                </div>

	                            </div>

	                            <button type="button" id="save" name="chkEdit" class="btn btn-sm btn-primary btn-flat"><i
	                                    class="fa fa-save"></i> Save </button>
	                            <button type="button" id="export" href="#" class="btn btn-sm btn-primary btn-flat"
	                                style="display:none"><i class="fa fa-file-excel-o"></i> Export </button>
	                            <button type="button" id="print" href="#" class="btn btn-sm btn-primary btn-flat"><i
	                                    class="fa fa-retweet"></i> Print </button>
	                            <button type="button" id="backdate" data-toggle="modal" data-target="#lastmovement"
	                                class="btn btn-sm btn-primary btn-flat"><i class="fa fa-retweet"></i> Back Date
	                            </button>



	                        </div>



	                    </form>
	                    <div id="groupinput" class="form-group" style="overflow:auto; margin:5px 0 5px 0;">

	                        <div id="grid"></div>


	                    </div>

	                    <div id="lastmovement" class="modal fade" role="dialog">
	                        <div class="modal-dialog">

	                            <!-- Modal content back date-->
	                            <div class="modal-content" style="border-radius: 20px;">
	                                <div class="modal-header">
	                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                    <h4 class="modal-title">Back Date Fixed Asset</h4>
	                                </div>
	                                <div class="modal-body">
	                                    <form name="form">
	                                        <table width="100%">
	                                            <tr>
	                                                <th>Move Date</th>
	                                                <td>:</td>
	                                                <td><input style="margin-top: -5px;margin-bottom: -10px;"
	                                                        class="form-control datepicker" name="last_movement_date"
	                                                        id="last_movement_date" placeholder="Date"></td>
	                                            </tr>
	                                            <tr>
	                                                <th>No Asset</th>
	                                                <td>:</td>
	                                                <td>
	                                                    <div style="margin-bottom:-10px"><input type="text" name="assetcmb"
	                                                            id="asset" style="width:100%; " placeholder="No Asset">
	                                                    </div>
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th>Loc Name To</th>
	                                                <td>:</td>
	                                                <td>
	                                                    <div style="margin-bottom:-10px"><input type="text"
	                                                            style="width:100%; " name="LocationCodecmb"
	                                                            id="LocationCode" placeholder="Loc Name To"></div>
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th>Line Code To</th>
	                                                <td>:</td>
	                                                <td><input type="text" style="width:100%; "
	                                                        name="ProductionLineCodecmb" id="ProductionLineCode"
	                                                        placeholder="Line Code To"></td>
	                                            </tr>
	                                        </table>



	                                    </form>
	                                </div>
	                                <div class="modal-footer">
	                                    <button type="button" id="simpanalt" class="btn btn-success"
	                                        data-dismiss="modal">Save</button>
	                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                                </div>
	                            </div>
	                        </div>
	                    </div>




	                    <div id="camera" class="modal fade" role="dialog">
	                        <div class="modal-dialog">

	                            <!-- Modal content back date-->
	                            <div class="modal-content" style="border-radius: 20px;width: 330px;margin-top:10px">

	                                <div class="modal-body">
	                                    <form name="form">

	                                        <div>Camera</div>
	                                        <div>
	                                            <video id="previewKamera" style="width: 300px;height:250px">
	                                                <select id="pilihKamera" style="display:none "></select>
	                                        </div>
	                                        <div style="margin-top:-10px;display:none ">Result</div>
	                                        <input type="text" name="hasilscan" id="hasilscan" placeholder="Result"
	                                            style="display:none ">

	                                    </form>
	                                </div>

	                            </div>
	                        </div>
	                    </div>




	                    <script type="text/javascript">
	                    let selectedDeviceId = null;
	                    const codeReader = new ZXing.BrowserMultiFormatReader();
	                    const sourceSelect = $("#pilihKamera");

	                    $(document).on('change', '#pilihKamera', function() {
	                        selectedDeviceId = $(this).val();
	                        if (codeReader) {
	                            codeReader.reset()
	                            initScanner()

	                        }
	                    })

	                    function initScanner() {
	                        codeReader
	                            .listVideoInputDevices()
	                            .then(videoInputDevices => {
	                                videoInputDevices.forEach(device =>
	                                    console.log(`${device.label}, ${device.deviceId}`)
	                                );

	                                if (videoInputDevices.length > 0) {

	                                    if (selectedDeviceId == null) {
	                                        if (videoInputDevices.length > 1) {
	                                            selectedDeviceId = videoInputDevices[1].deviceId
	                                        } else {
	                                            selectedDeviceId = videoInputDevices[0].deviceId
	                                        }
	                                    }


	                                    if (videoInputDevices.length >= 1) {
	                                        sourceSelect.html('');
	                                        videoInputDevices.forEach((element) => {
	                                            const sourceOption = document.createElement('option')
	                                            sourceOption.text = element.label
	                                            sourceOption.value = element.deviceId
	                                            if (element.deviceId == selectedDeviceId) {
	                                                sourceOption.selected = 'selected';
	                                            }
	                                            sourceSelect.append(sourceOption)
	                                        })

	                                    }

	                                    codeReader

	                                        .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
	                                        .then(result => {

	                                            //hasil scan
	                                            console.log(result.text)
	                                            $("#hasilscan").val(result.text);

	                                            $('#table_search').val(result.text);
	                                            loadgrid();
	                                            //$('#camera').modal('hide');

	                                            if (codeReader) {
	                                                $('#camera').modal('hide');
	                                                codeReader.reset()

	                                            }
	                                        })
	                                        .catch(err => console.error(err));

	                                } else {
	                                    alert("Camera not found!")
	                                }
	                            })
	                            .catch(err => console.error(err));
	                    }


	                    if (navigator.mediaDevices) {


	                        initScanner()


	                    } else {
	                        alert('Cannot access camera.');
	                    }
	                    </script>