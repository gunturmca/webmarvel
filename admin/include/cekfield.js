var url = window.location.pathname;
var idtable = url.substring(url.lastIndexOf('/')+1);
var userid;
var username;


var tgltable = moment();
var update_time = tgltable.format('YYYY-MM-DD HH:mm:ss');


//var update_time=new Date().toJSON().slice(0,10).replace(/-/g,'/');

function save(){
var JSONObject;
var tahun =new Object();
var kosong=0;
komponen=document.form2.elements.length;

$.ajax({
    type: "get",
	url: "./getjsonsample",
    data:{},
    
    dataType: "json",
    success: function(JSONObject) {


      // Loop through Object and create peopleHTML
      for (var key in JSONObject)
	   {			
	   		for (i = 0; i<komponen; i++)
				{ 
					var type=form2.elements[i].type;
					var id=form2.elements[i].id;	
					var row=form2.elements[i].rows;
					var value=form2.elements[i].value;
					var name=form2.elements[i].name;
					var checked=form2.elements[i].checked;
					var invalid=form2.elements[i].alt;
					var placeholder=form2.elements[i].placeholder;
					var title=form2.elements[i].title;
					
					//{ tahun[i] = i + 2000;<br> document.write("tahun[" + i + "] = " + tahun [i] + "<br />"); }
						
						/*if (invalid != "" && value =="" && type =="text")
							{
								kosong = 1 ;	
								form2.elements[i].placeholder =invalid + " Tidak Boleh Kosong" ;
								form2.elements[i].className += " Red";
							}

						if (title != "" && $("#" + id).val() == 0 && type == "select-one")
							{
								
								kosong = 1 ;	
								$('#'+id).css("color", 'red');
							}*/
							
							
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="varchar" || JSONObject[key]["data_type"].substring(0,7) =="varchar"))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="timestamp" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="money" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="time" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="numeric" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="bigint" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="char" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
						
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="date" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="datetime" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="nvarchar" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"] && value != ""  && name == "userPassword" )
							{
							
								tahun[JSONObject[key]["column_name"]] =  calcMD5(value);
							}
							if (type == "password" && id == JSONObject[key]["column_name"] && value != "" && name == "userPassword")
							{
					
								tahun[JSONObject[key]["column_name"]] =  calcMD5(value);
							}
							if (type == "email" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "email" ))
							{
							
								tahun[JSONObject[key]["column_name"]] =  value;
							}
							
						
						
						if (type == "text" && id == JSONObject[key]["column_name"]  && JSONObject[key]["data_type"] =="float" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,3)=="int" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,7)=="decimal" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "select-one" && id == JSONObject[key]["column_name"] )
							{
								
								tahun[JSONObject[key]["column_name"]] = value ;
							}
										
						if (type == "checkbox" && id == JSONObject[key]["column_name"] )
							{
								if (value == 'on' || value == '0')
									{value = 0 ;}
								else
									{value = 1 ;}
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (row > 0 && id == JSONObject[key]["column_name"] )
							{
								tahun[JSONObject[key]["column_name"]] = value ;
							}	
						if (type == "radio" && id == JSONObject[key]["column_name"]  && checked==true )
							{

								tahun[JSONObject[key]["column_name"]] = value ;

							}
						if ( JSONObject[key]["column_name"]=="insert_by" )
							{
								tahun[JSONObject[key]["column_name"]] = userid ;
							}
						if ( JSONObject[key]["column_name"]=="insert_time" )
							{
								tahun[JSONObject[key]["column_name"]] = update_time ;
							}
				}
         
        }
				if (kosong == 0)
							{
 						 var myjson = JSON.stringify(tahun);
							
							
							$.ajax({
								type:'get',	

								url:"./insertdata",
								dataType:'json',
								data:{myjson: myjson},
								success:function(data)
								{
									
									alert("Data Tersimpan");
								}
							
							});
							alert("Data Tersimpan");
					};
				if (kosong == 1)
					{alert("Data Belum Lengkap, Silahkan Isi Text Yang Berwarna Merah");}	
    }
	
 });
 
 

							
	}
	
	
function tambah()
{
	
komponen=document.form2.elements.length;

      // Loop through Object and create peopleHTML
			
	   		for (i = 0; i<komponen; i++)
				{ 
					var type=form2.elements[i].type;
					var id=form2.elements[i].id;	
					var row=form2.elements[i].rows;
					var value=form2.elements[i].value;
					var name = form2.elements[i].name;
					var title=form2.elements[i].title;
					
						if (type == "text" )
							{
								form2.elements[i].value = "" ;
								if (name.substring(name.length - 3) == 'cmb')
									{
										var multicolumncombobox = $('#'+id).data("kendoMultiColumnComboBox");
										multicolumncombobox.text('');	
									}
							}
						if (type == "text" &&  name =="img" )
							{		
								document.getElementById(id+'1').src ="";			
							}
						if (type == "select-one" )
							{
								form2.elements[i].value = 0 ;
							}
						if (type == "checkbox" )
							{
									form2.elements[i].value = 0 ;
							}
						if (row > 0 )
							{
								form2.elements[i].value = ""  ;
							}			
				}						
}

function validasi()
{
	

komponen=document.form2.elements.length;

      // Loop through Object and create peopleHTML
			
	   		for (i = 0; i<komponen; i++)
				{ 
					var type=form2.elements[i].type;
					var id=form2.elements[i].id;	
					var row=form2.elements[i].rows;
					var value=form2.elements[i].value;
					var title=form2.elements[i].title;
					
						
						if (type == "text"   && title == "date" )
						
								{
									
									$('#'+id).datepicker({
										format: "yyyy-mm-dd",
										autoclose:true
									});
									
								}
						if (type == "text"   && title == "number" )
						
								{
									
									
									
									$("#"+id).on("keypress keyup blur",function (event) {    
									    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
										if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
											event.preventDefault();
										}
									});
									
									
								}
								
						
				}						
}

	
	
	
function update(){
var JSONObject;
var tahun =new Object();
var kosong=0;

komponen=document.form2.elements.length;

$.ajax({
    type: "get",
	url: "../getjsonsample",
    data:{id:idtable},
    dataType: "json",
    success: function(JSONObject) {


      // Loop through Object and create peopleHTML
      for (var key in JSONObject)
	   {			
		
		
	   		for (i = 0; i<komponen; i++)
				{ 
					var type=form2.elements[i].type;
					var id=form2.elements[i].id;	
					var row=form2.elements[i].rows;
					var value=form2.elements[i].value;
					var name=form2.elements[i].name;
					var checked=form2.elements[i].checked;
					var invalid=form2.elements[i].alt;
					var title=form2.elements[i].title;
					
					//{ tahun[i] = i + 2000;<br> document.write("tahun[" + i + "] = " + tahun [i] + "<br />"); }
						
						/*if (invalid != "" && value =="" && type =="text")
							{
								kosong = 1 ;	
								form2.elements[i].placeholder =invalid + " Tidak Boleh Kosong" ;
								form2.elements[i].className += " Red";
							}

						if (title != "" && $("#" + id).val() == 0 && type == "select-one")
							{
								
								kosong = 1 ;	
								$('#'+id).css("color", 'red');
							}*/
							
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="varchar" || JSONObject[key]["data_type"].substring(0,7) =="varchar"))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="timestamp" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="money" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="time" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="numeric" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="bigint" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="char" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
						
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="date" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="datetime" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="nvarchar" ))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
								
							}
							if (type == "text" && id == JSONObject[key]["column_name"] && value != ""  && name == "userPassword" )
							{
							
								tahun[JSONObject[key]["column_name"]] =  calcMD5(value);
							}
							if (type == "password" && id == JSONObject[key]["column_name"] && value != "" && name == "userPassword")
							{
					
								tahun[JSONObject[key]["column_name"]] =  calcMD5(value);
							}
							if (type == "email" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "email" ))
							{
							
								tahun[JSONObject[key]["column_name"]] =  value;
							}
							
						
						
						if (type == "text" && id == JSONObject[key]["column_name"]  && JSONObject[key]["data_type"] =="float" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,3)=="int" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,7)=="decimal" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "select-one" && id == JSONObject[key]["column_name"] )
							{
								
								tahun[JSONObject[key]["column_name"]] = value ;
							}
										
						if (type == "checkbox" && id == JSONObject[key]["column_name"] )
							{
								if (value == 'on' || value == '0')
									{value = 0 ;}
								else
									{value = 1 ;}
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (row > 0 && id == JSONObject[key]["column_name"] )
							{
								tahun[JSONObject[key]["column_name"]] = value ;
							}	
						if (type == "radio" && id == JSONObject[key]["column_name"]  && checked==true )
							{

								tahun[JSONObject[key]["column_name"]] = value ;

							}
							
						if ( JSONObject[key]["column_name"]=="update_by" )
							{
								tahun[JSONObject[key]["column_name"]] = userid ;
								
							}
						if ( JSONObject[key]["column_name"]=="update_time" )
							{
								tahun[JSONObject[key]["column_name"]] = update_time ;
								
							}
				}
         
        }
					if (kosong == 0)
					{
 						 var myjson = JSON.stringify(tahun);
							
							$.ajax({
								type:'get',	
								url:"../updatedata",
								dataType:'json',
								data:{myjson: myjson, id:idtable},
								
								success:function(data)
								{
									alert("Alloh");
								}
							
							});
							alert("Data Tersimpan");
					}
					if (kosong == 1)
					{alert("Data Belum Lengkap, Silahkan Isi Text Yang Berwarna Merah");}
							
							
    }
	
 });
 
 

							
	}	
	
	
	
	
function showfield(){;
var JSONObject;
var tahun =new Object();
komponen=document.form2.elements.length;

	$.ajax({
	type: "get",
	url:'../getjsonshow',
    data:{id:idtable},
    
    dataType: "json",
    success: function(JSONObject) 
		{
			/*batas show otomatis*/
			
			
				  // Loop through Object and create peopleHTML
				  for (var key in JSONObject)
				   {			
					
						for (i = 0; i<komponen; i++)
							{ 
								var type=form2.elements[i].type;
								var name=form2.elements[i].name;
								var id=form2.elements[i].id;	
								var row=form2.elements[i].rows;
								var value=form2.elements[i].value;
									
								
									if (type == "text" && id == key)
										{
											
											form2.elements[i].value = JSONObject[key] ;
											
											/*form2.elements[i].style.textAlign="right";*/
										}
									
									if (type == "text" && id == key && name =="password")
										{
												
												
												form2.elements[i].value = Base64.decode(JSONObject[key]);
											/*form2.elements[i].style.textAlign="right";*/
										}
									if (type == "password" && id == key && name =="password")
										{
												
												
												form2.elements[i].value = Base64.decode(JSONObject[key]);
											/*form2.elements[i].style.textAlign="right";*/
										}
									if (type == "email" && id == key && name =="email")
										{
												
												
												form2.elements[i].value = JSONObject[key];
											/*form2.elements[i].style.textAlign="right";*/
										}
										
									
									if (type == "text" && id == key  && name =="number" )
										{
											
											/*form2.elements[i].value =formatThousands(JSONObject[key])*/
											var dollarUSLocale = Intl.NumberFormat('en-US');
											form2.elements[i].value =dollarUSLocale.format(JSONObject[key]);
										}
									if (type == "select-one" && id == key)
										{
										
											 $('#'+key).val(JSONObject[key]);
										
											 
										}
									if (type == "text" && id == key  && name =="img" )
										{
											
											document.getElementById(id+'1').src =window.location.origin + "/sunson/admin" + JSONObject[id];
											
											
										}
									if (type == "checkbox" && id == key)
										{
											if (JSONObject[key] == 1)
											{
												form2.elements[i].checked = value ;
											}
											
										}
									if (row > 0 && id  == key )
										{
											form2.elements[i].value = JSONObject[key] ;
											
										}	
									if (type == "radio" && id == key && value ==JSONObject[key] )
										{
											form2.elements[i].checked = true ;
											/*form2.elements[i].style.textAlign="right";*/
										}
								
									if (  id == "")
										{
											

											// $('#preview').attr('src', window.location.protocol+"//" + window.location.hostname + "/sunson/admin" + JSONObject['path'])
											/*form2.elements[i].style.textAlign="right";*/
										}
							}
					 
					}
			
					
		}
	});
			/*batas shwo otomatis*/
										

}

function updatealt(idrow){
	var JSONObject;
	var tahun =new Object();
	var kosong=0;
	
	komponen=document.form2.elements.length;
	
	$.ajax({
		type: "get",
		url: "./getjsonsample",
		data:{id:idrow},
		dataType: "json",
		success: function(JSONObject) {
	
	
		  // Loop through Object and create peopleHTML
		  for (var key in JSONObject)
		   {			
			
			
				   for (i = 0; i<komponen; i++)
					{ 
						var type=form2.elements[i].type;
						var id=form2.elements[i].id;	
						var row=form2.elements[i].rows;
						var value=form2.elements[i].value;
						var name=form2.elements[i].name;
						var checked=form2.elements[i].checked;
						var invalid=form2.elements[i].alt;
						var title=form2.elements[i].title;
						
						//{ tahun[i] = i + 2000;<br> document.write("tahun[" + i + "] = " + tahun [i] + "<br />"); }
							
							
								
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="varchar" || JSONObject[key]["data_type"].substring(0,7) =="varchar"))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="timestamp" ))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="money" ))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="time" ))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="numeric" ))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="bigint" ))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="char" ))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
							
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="date" ))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="datetime" ))
								{
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="nvarchar" ))
								{
								
									tahun[JSONObject[key]["column_name"]] = value ;
									
								}
								if (type == "text" && id == JSONObject[key]["column_name"] && value != ""  && name == "userPassword" )
								{
								
									tahun[JSONObject[key]["column_name"]] =  calcMD5(value);
								}
								if (type == "password" && id == JSONObject[key]["column_name"] && value != "" && name == "userPassword")
								{
						
									tahun[JSONObject[key]["column_name"]] =  calcMD5(value);
								}
								if (type == "email" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "email" ))
								{
								
									tahun[JSONObject[key]["column_name"]] =  value;
								}
								
							
							
							if (type == "text" && id == JSONObject[key]["column_name"]  && JSONObject[key]["data_type"] =="float" )
								{
									
									tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
								}
							if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,3)=="int" )
								{
									
									tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
								}
							if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,7)=="decimal" )
								{
									
									tahun[JSONObject[key]["column_name"]] =  value;
								}
							if (type == "select-one" && id == JSONObject[key]["column_name"] )
								{
									
									tahun[JSONObject[key]["column_name"]] = value ;
								}
											
							if (type == "checkbox" && id == JSONObject[key]["column_name"] )
								{
									if (value == 'on' || value == '0')
										{value = 0 ;}
									else
										{value = 1 ;}
									tahun[JSONObject[key]["column_name"]] = value ;
								}
							if (row > 0 && id == JSONObject[key]["column_name"] )
								{
									tahun[JSONObject[key]["column_name"]] = value ;
								}	
							if (type == "radio" && id == JSONObject[key]["column_name"]  && checked==true )
								{
	
									tahun[JSONObject[key]["column_name"]] = value ;
	
								}
							
							if ( JSONObject[key]["column_name"]=="modifiedby" )
								{
								
									tahun[JSONObject[key]["column_name"]] = username ;
									
								}
							if ( JSONObject[key]["column_name"]=="modifieddate" )
								{
									tahun[JSONObject[key]["column_name"]] = update_time ;
									
								}
							if ( JSONObject[key]["column_name"]=="userid" )
								{
									tahun[JSONObject[key]["column_name"]] = userid ;
									
								}

							if ( JSONObject[key]["column_name"]=="lastmodifyby" )
								{
									tahun[JSONObject[key]["column_name"]] = username ;
									
								}
							if ( JSONObject[key]["column_name"]=="lastmodifydate" )
								{
									tahun[JSONObject[key]["column_name"]] = update_time ;
									
								}
							
					}
			 
			}
						if (kosong == 0)
						{
							  var myjson = JSON.stringify(tahun);
								
								$.ajax({
									type:'get',	
									url:"./updatedata",
									dataType:'json',
									data:{myjson: myjson, id:idrow},
									
									success:function(data)
									{
										if (data==1)
										{alert('Success Update');}
										else
										{alert('Error Duplicate Data');}
									}
								
								});
								
						}
						if (kosong == 1)
						{alert("Data Belum Lengkap, Silahkan Isi Text Yang Berwarna Merah");}
								
								
		}
		
	 });
	 
	 
	
								
		}	

function savealt(){
			var JSONObject;
			var tahun =new Object();
			var kosong=0;
			komponen=document.form2.elements.length;
			
			$.ajax({
				type: "get",
				url: "./getjsonsample",
				data:{},
				
				dataType: "json",
				success: function(JSONObject) {
			
			
				  // Loop through Object and create peopleHTML
				  for (var key in JSONObject)
				   {			
						   for (i = 0; i<komponen; i++)
							{ 
								var type=form2.elements[i].type;
								var id=form2.elements[i].id;	
								var row=form2.elements[i].rows;
								var value=form2.elements[i].value;
								var name=form2.elements[i].name;
								var checked=form2.elements[i].checked;
								var invalid=form2.elements[i].alt;
								var placeholder=form2.elements[i].placeholder;
								var title=form2.elements[i].title;
								
								//{ tahun[i] = i + 2000;<br> document.write("tahun[" + i + "] = " + tahun [i] + "<br />"); }
									
									/*if (invalid != "" && value =="" && type =="text")
										{
											kosong = 1 ;	
											form2.elements[i].placeholder =invalid + " Tidak Boleh Kosong" ;
											form2.elements[i].className += " Red";
										}
			
									if (title != "" && $("#" + id).val() == 0 && type == "select-one")
										{
											
											kosong = 1 ;	
											$('#'+id).css("color", 'red');
										}*/
										
										
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="varchar" || JSONObject[key]["data_type"].substring(0,7) =="varchar"))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="timestamp" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="money" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="time" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="numeric" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="bigint" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="char" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
									
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="date" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="datetime" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="nvarchar" ))
										{
											tahun[JSONObject[key]["column_name"]] = value ;
											
										}
										if (type == "text" && id == JSONObject[key]["column_name"] && value != ""  && name == "userPassword" )
										{
										
											tahun[JSONObject[key]["column_name"]] =  calcMD5(value);
										}
										if (type == "password" && id == JSONObject[key]["column_name"] && value != "" && name == "userPassword")
										{
								
											tahun[JSONObject[key]["column_name"]] =  calcMD5(value);
										}
										if (type == "email" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "email" ))
										{
										
											tahun[JSONObject[key]["column_name"]] =  value;
										}
										
									
									
									if (type == "text" && id == JSONObject[key]["column_name"]  && JSONObject[key]["data_type"] =="float" )
										{
											
											tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
										}
									if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,3)=="int" )
										{
											
											tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
										}
									if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,7)=="decimal" )
										{
											
											tahun[JSONObject[key]["column_name"]] =  value;
										}
									if (type == "select-one" && id == JSONObject[key]["column_name"] )
										{
											
											tahun[JSONObject[key]["column_name"]] = value ;
										}
													
									if (type == "checkbox" && id == JSONObject[key]["column_name"] )
										{
											if (value == 'on' || value == '0')
												{value = 0 ;}
											else
												{value = 1 ;}
											tahun[JSONObject[key]["column_name"]] = value ;
										}
									if (row > 0 && id == JSONObject[key]["column_name"] )
										{
											tahun[JSONObject[key]["column_name"]] = value ;
										}	
									if (type == "radio" && id == JSONObject[key]["column_name"]  && checked==true )
										{
			
											tahun[JSONObject[key]["column_name"]] = value ;
			
										}
									if ( JSONObject[key]["column_name"]=="createby" )
										{
											
											tahun[JSONObject[key]["column_name"]] = username ;
										}
									if ( JSONObject[key]["column_name"]=="createdate" )
										{
											tahun[JSONObject[key]["column_name"]] = update_time ;
										}
							}
					 
					}
							if (kosong == 0)
										{
									  var myjson = JSON.stringify(tahun);
										
										
										$.ajax({
											type:'get',	
			
											url:"./insertdata",
											dataType:'json',
											data:{myjson: myjson},
											success:function(data)
											{
												
												if (data==1)
												{alert('Saved Success');}
												else
												{alert('Error Duplicate Data');}
											   
											}
										
										});
										
								};
							if (kosong == 1)
								{alert("Data Belum Lengkap, Silahkan Isi Text Yang Berwarna Merah");}	
				}
				
			 });
			 
			 
			
										
				}
			


function showfieldaltlower(id){;
	var JSONObject;
	var tahun =new Object();
	komponen=document.form2.elements.length;
	
		$.ajax({
		type: "get",
		url:'./getjsonshow',
		data:{id:id},
		
		dataType: "json",
		success: function(JSONObject) 
			{
				/*batas show otomatis*/
	  			// Loop through Object and create peopleHTML
				for (var key in JSONObject)
				{			
					
						for (i = 0; i<komponen; i++)
							{	 
								var type=form2.elements[i].type;
								var name=form2.elements[i].name;
								var id=form2.elements[i].id;	
								var row=form2.elements[i].rows;
								var value=form2.elements[i].value;
					
				
								if (type == "text" && id.toLowerCase() == key.toLowerCase())
										{
											form2.elements[i].value = JSONObject[key] ;
											
											if (name.substring(name.length - 3) == 'cmb')
												{
													var multicolumncombobox = $('#'+id).data("kendoMultiColumnComboBox");
													multicolumncombobox.text(JSONObject[key]);	
												}
											/*form2.elements[i].style.textAlign="right";*/
										}
																	
								if (type == "text" && id == key && name =="password")
										{
																				
											form2.elements[i].value = Base64.decode(JSONObject[key]);
											/*form2.elements[i].style.textAlign="right";*/
										}
								if (type == "password" && id == key && name =="password")
										{
												
											form2.elements[i].value = Base64.decode(JSONObject[key]);
											/*form2.elements[i].style.textAlign="right";*/
										}
								if (type == "email" && id == key && name =="email")
										{
										
											form2.elements[i].value = JSONObject[key];
											/*form2.elements[i].style.textAlign="right";*/
										}
																		
																	
								if (type == "text" && id == key  && name =="number" )
										{
																			
											/*form2.elements[i].value =formatThousands(JSONObject[key])*/
											var dollarUSLocale = Intl.NumberFormat('en-US');
											form2.elements[i].value =dollarUSLocale.format(JSONObject[key]);
										}
								if (type == "select-one" && id == key)
										{
																		
											$('#'+key).val(JSONObject[key]);
																		
																			
										}
								if (type == "text" && id == key  && name =="img" )
										{
																			
											document.getElementById(id+'1').src =window.location.origin + "/sunson/admin" + JSONObject[id];
																			
																			
										}
								if (type == "checkbox" && id == key)
										{
											if (JSONObject[key] == 1)
												{
													form2.elements[i].checked = value ;
												}
																			
										}
								if (row > 0 && id  == key )
										{
											form2.elements[i].value = JSONObject[key] ;
																			
										}	
								if (type == "radio" && id == key && value ==JSONObject[key] )
										{
											form2.elements[i].checked = true ;
											/*form2.elements[i].style.textAlign="right";*/
										}
																
								if (  id == "")
										{
																			
								
											// $('#preview').attr('src', window.location.protocol+"//" + window.location.hostname + "/sunson/admin" + JSONObject['path'])
												/*form2.elements[i].style.textAlign="right";*/
										}
							}
													
				}
								
										
			}
		});
								/*batas shwo otomatis*/
															
					
	}
function disablebutton(url){;
	var JSONObject;
	var tahun =new Object();

	komponen=document.form2.elements.length;
	
		$.ajax({
		type: "get",
		url:url,
		data:{},
		
		dataType: "json",
		success: function(JSONObject) 
			{
				/*batas show otomatis*/
				
				
					  // Loop through Object and create peopleHTML
					  for (var key in JSONObject)
					   {			
						
							for (i = 0; i<komponen; i++)
								{ 
									var type=form2.elements[i].type;
									var name=form2.elements[i].name;
									var id=form2.elements[i].id;	
									var row=form2.elements[i].rows;
									var value=form2.elements[i].value;
										
									
										if (name == key)
											{
												if (JSONObject[key]==='checked')
												{	
													form2.elements[i].disabled = false ;
												
												}
												else{form2.elements[i].disabled = true ; }
												
												
												/*form2.elements[i].style.textAlign="right";*/
											}
										
										
								}
						 
						}
				
						
			}
		});
				/*batas shwo otomatis*/
											
	
	}

function showfieldalt(id){
var JSONObject;
var tahun =new Object();

komponen=document.form2.elements.length;

	$.ajax({
	type: "get",
	url:'./getjsonshow',
    data:{id:id},
    
    dataType: "json",
    success: function(JSONObject) 
		{
			/*batas show otomatis*/

			
				  // Loop through Object and create peopleHTML
				  for (var key in JSONObject)
				   {			
				   
						for (i = 0; i<komponen; i++)
							{ 
								var type=form2.elements[i].type;
								var name=form2.elements[i].name;
								var id=form2.elements[i].id;	
								var row=form2.elements[i].rows;
								var value=form2.elements[i].value;
								
								
									if (type == "text" && id == key)
										{
											
											form2.elements[i].value = JSONObject[key] ;
											/*form2.elements[i].style.textAlign="right";*/
										}
									
									if (type == "text" && id == key && name =="password")
										{
												
												
												form2.elements[i].value = Base64.decode(JSONObject[key]);
											/*form2.elements[i].style.textAlign="right";*/
										}
									if (type == "password" && id == key && name =="password")
										{
												
												
												form2.elements[i].value = Base64.decode(JSONObject[key]);
											/*form2.elements[i].style.textAlign="right";*/
										}
									if (type == "email" && id == key && name =="email")
										{
												
												
												form2.elements[i].value = JSONObject[key];
											/*form2.elements[i].style.textAlign="right";*/
										}
										
									
									if (type == "text" && id == key  && name =="number" )
										{
											
											/*form2.elements[i].value =formatThousands(JSONObject[key])*/
											var dollarUSLocale = Intl.NumberFormat('en-US');
											form2.elements[i].value =dollarUSLocale.format(JSONObject[key]);
										}
									if (type == "select-one" && id == key)
										{
											 $('#'+key).val(JSONObject[key]);
										
											 
										}
									if (type == "text" && id == key  && name =="img" )
										{
											
											document.getElementById(id+'1').src =window.location.origin + "/sunson/admin" + JSONObject[id];
											
											
										}
									if (type == "checkbox" && id == key)
										{
											if (JSONObject[key] == 1)
											{
												form2.elements[i].checked = value ;
											}
											
										}
									if (row > 0 && id  == key )
										{
											form2.elements[i].value = JSONObject[key] ;
											
										}	
									if (type == "radio" && id == key && value ==JSONObject[key] )
										{
											form2.elements[i].checked = true ;
											/*form2.elements[i].style.textAlign="right";*/
										}
								
									if (  id == "")
										{
											

											 $('#preview').attr('src', window.location.protocol+"//" + window.location.hostname + "/sunson/admin" + JSONObject['path'])
											/*form2.elements[i].style.textAlign="right";*/
										}
							}
					 
					}
			
					
		}
	});
			/*batas shwo otomatis*/
										

}
function update2(idrecord,url){
var JSONObject;
var tahun =new Object();
var kosong=0;
komponen=document.form2.elements.length;
url1 = url + '/getjsonsample'
url2 = url + '/updatedata'
$.ajax({
    type: "get",
	url: url1,
    data:{id:idrecord},
    dataType: "json",
    success: function(JSONObject) {


      // Loop through Object and create peopleHTML
      for (var key in JSONObject)
	   {			
	   		for (i = 0; i<komponen; i++)
				{ 
					var type=form2.elements[i].type;
					var id=form2.elements[i].id;	
					var row=form2.elements[i].rows;
					var value=form2.elements[i].value;
					var name=form2.elements[i].name;
					var checked=form2.elements[i].checked;
					var invalid=form2.elements[i].alt;
					var title=form2.elements[i].title;
					
					//{ tahun[i] = i + 2000;<br> document.write("tahun[" + i + "] = " + tahun [i] + "<br />"); }
						
						/*if (invalid != "" && value =="" && type =="text")
							{
								kosong = 1 ;	
								form2.elements[i].placeholder =invalid + " Tidak Boleh Kosong" ;
								form2.elements[i].className += " Red";
							}

						if (title != "" && $("#" + id).val() == 0 && type == "select-one")
							{
								
								kosong = 1 ;	
								$('#'+id).css("color", 'red');
							}*/
							
						if (type == "text" && id == JSONObject[key]["column_name"]  && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar"))
							{
								tahun[JSONObject[key]["column_name"]] = value ;
							}
							
							if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "password" ))
							{
							
								tahun[JSONObject[key]["column_name"]] =  Base64.encode(value);
							}
							if (type == "password" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "password" ))
							{
					
								tahun[JSONObject[key]["column_name"]] =  Base64.encode(value);
							}
							if (type == "email" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "email" ))
							{
							
								tahun[JSONObject[key]["column_name"]] =  value;
							}
							
						if (type == "text" && id == JSONObject[key]["column_name"]  && JSONObject[key]["data_type"] =="date" )
							{
								
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (type == "text" && id == JSONObject[key]["column_name"]  && JSONObject[key]["data_type"] =="datetime" )
							{
								
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (type == "text" && id == JSONObject[key]["column_name"]  && JSONObject[key]["data_type"] =="time" )
							{
								
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (type == "text" && id == JSONObject[key]["column_name"]  && JSONObject[key]["data_type"] =="float" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,7)=="decimal" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,3)=="int" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "select-one" && id == JSONObject[key]["column_name"] )
							{
								
								tahun[JSONObject[key]["column_name"]] = value ;
							}
										
						if (type == "checkbox" && id == JSONObject[key]["column_name"] )
							{
								if (value == 'on' || value == '0')
									{value = 0 ;}
								else
									{value = 1 ;}
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (row > 0 && id == JSONObject[key]["column_name"] )
							{
								tahun[JSONObject[key]["column_name"]] = value ;
							}	
						if (type == "radio" && id == JSONObject[key]["column_name"]  && checked==true )
							{

								tahun[JSONObject[key]["column_name"]] = value ;

							}
							
						if ( JSONObject[key]["column_name"]=="update_by" )
							{
								tahun[JSONObject[key]["column_name"]] = userid ;
								
							}
						if ( JSONObject[key]["column_name"]=="update_time" )
							{
								tahun[JSONObject[key]["column_name"]] = update_time ;
								
							}
				}
         
        }
		
					if (kosong == 0)
					{
 						 var myjson = JSON.stringify(tahun);
							
							$.ajax({
								type:'get',	
								url:url2,
								dataType:'json',
								data:{myjson: myjson, id:idrecord},
								
								success:function(data)
								{
									alert("Alloh");
								}
							
							});
							alert("Data Tersimpan");
					}
					if (kosong == 1)
					{alert("Data Belum Lengkap, Silahkan Isi Text Yang Berwarna Merah");}
							
							
    }
	
 });
 
 

							
	}	

function showfield2(idrecord,url){;
var JSONObject;
var tahun =new Object();
komponen=document.form2.elements.length;

	$.ajax({
	type: "get",
	url:url,
    data:{id:idrecord},
    
    dataType: "json",
    success: function(JSONObject) 
		{
			/*batas show otomatis*/

			
				  // Loop through Object and create peopleHTML
				  for (var key in JSONObject)
				   {			
				   
						for (i = 0; i<komponen; i++)
							{ 
								var type=form2.elements[i].type;
								var name=form2.elements[i].name;
								var id=form2.elements[i].id;	
								var row=form2.elements[i].rows;
								var value=form2.elements[i].value;
								
								
									if (type == "text" && id == key)
										{
												
											form2.elements[i].value = JSONObject[key] ;
											/*form2.elements[i].style.textAlign="right";*/
										}
									
									if (type == "text" && id == key && name =="password")
										{
												
												
												form2.elements[i].value = Base64.decode(JSONObject[key]);
											/*form2.elements[i].style.textAlign="right";*/
										}
									if (type == "password" && id == key && name =="password")
										{
												
												
												form2.elements[i].value = Base64.decode(JSONObject[key]);
											/*form2.elements[i].style.textAlign="right";*/
										}
									if (type == "email" && id == key && name =="email")
										{
												
												
												form2.elements[i].value = JSONObject[key];
											/*form2.elements[i].style.textAlign="right";*/
										}
										
									
									if (type == "text" && id == key  && name =="number" )
										{
											
											/*form2.elements[i].value =formatThousands(JSONObject[key])*/
											var dollarUSLocale = Intl.NumberFormat('en-US');
											form2.elements[i].value =dollarUSLocale.format(JSONObject[key]);
										}
									if (type == "select-one" && id == key)
										{
											 $('#'+key).val(JSONObject[key]);
										
											 
										}
									if (type == "text" && id == key  && name =="img" )
										{
											
											document.getElementById(id+'1').src =window.location.origin + "/sunson/admin" + JSONObject[id];
											
											
										}
									if (type == "checkbox" && id == key)
										{
											if (JSONObject[key] == 1)
											{
												form2.elements[i].checked = value ;
											}
											
										}
									if (row > 0 && id  == key )
										{
											form2.elements[i].value = JSONObject[key] ;
											
										}	
									if (type == "radio" && id == key && value ==JSONObject[key] )
										{
											form2.elements[i].checked = true ;
											/*form2.elements[i].style.textAlign="right";*/
										}
								
									if (  id == "")
										{
											

											 $('#preview').attr('src', window.location.protocol+"//" + window.location.hostname + "/sunson/admin" + JSONObject['path'])
											/*form2.elements[i].style.textAlign="right";*/
										}
							}
					 
					}
			
					
		}
	});
			/*batas shwo otomatis*/
										

}
<!--khusus ubtuk formkaryawan saja karena ada nya pemilihan kombo wilayah-->
function showfield1(){;
var JSONObject;
var s;
var tahun =new Object();
komponen=document.form2.elements.length;

	$.ajax({
	type: "get",
	url:'../getjsonshow',
    data:{id:idtable},
    
    dataType: "json",
    success: function(JSONObject) 
		{
			/*batas show otomatis*/

			
				  // Loop through Object and create peopleHTML
				  for (var key in JSONObject)
				   {			
				   
						for (i = 0; i<komponen; i++)
							{ 
								var type=form2.elements[i].type;
								var name=form2.elements[i].name;
								var id=form2.elements[i].id;	
								var row=form2.elements[i].rows;
								var value=form2.elements[i].value;
								
			
								
								
									if (type == "text" && id == key)
										{
											form2.elements[i].value = JSONObject[key] ;
											/*form2.elements[i].style.textAlign="right";*/
										}
									if (type == "text" && id == key  && name =="number" )
										{
											
											/*form2.elements[i].value =formatThousands(JSONObject[key])*/
											var dollarUSLocale = Intl.NumberFormat('en-US');
											form2.elements[i].value =dollarUSLocale.format(JSONObject[key]);
										}
									if (type == "text" && id == key  && name =="img" )
										{
											
											document.getElementById(id+'1').src =window.location.origin + "/sunson/admin" + JSONObject[id];
										}
									if (type == "select-one" && id == key)
										{
											$('#'+id).val(JSONObject[key]);
												
												if ( id == "idpropinsi")
													{
														var id=JSONObject[key];
														$.ajax({
														  url : "../getkota",
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
																		if (data[i].id == JSONObject['idkota'])
																		{s= i;}
																	  }
																	  
																  $('#idkota').html(html);
																  $("#idkota").prop('selectedIndex',s+1);
																
															  }
														  });
													}
													
											 if ( id == "idkota")
											 {
														var id=JSONObject[key];
														$.ajax({
														  url : "../getkecamatan",
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
																		if (data[i].id == JSONObject['idkecamatan'])
																		{s= i;}
																	  }
																	  
																  $('#idkecamatan').html(html);
																  $("#idkecamatan").prop('selectedIndex',s+1);
																
															  }
														  });	 
												 }
											 if ( id == "idkecamatan")
											 {
														var id=JSONObject[key];
														
														$.ajax({
														  url : "../getdesa",
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
														
																		if (data[i].id == JSONObject['iddesa'])
																		{s= i;}
																	  }
																	  
																  $('#iddesa').html(html);
																  $("#iddesa").prop('selectedIndex',s+1);
																
															  }
														  });	 	 
														
												 }
											
											 
										}
									if (type == "checkbox" && id == key)
										{
											if (JSONObject[key] == 1)
											{
												form2.elements[i].checked = value ;
											}
											
										}
									if (row > 0 && id  == key )
										{
											form2.elements[i].value = JSONObject[key] ;
											
										}	
									if (type == "radio" && id == key && value ==JSONObject[key] )
										{
											form2.elements[i].checked = true ;
											/*form2.elements[i].style.textAlign="right";*/
										}
								
									i
							}
					 
					}
			
					
		}
	});
			/*batas shwo otomatis*/
			 
			 
										

}

function showdata()
{

	var JSONObject;
var tahun =new Object();

	$.ajax({
	type: "get",
	url:'./getjsonsample',
    data:{id:idtable},
    
    dataType: "json",
    success: function(JSONObject) 
		{
			for (var key in JSONObject)
				{		
					if (JSONObject[key]["COLUMN_COMMENT"] !="")
					{
						  $("#kepala").append("<th id =" + JSONObject[key]["column_name"]+">"+JSONObject[key]["COLUMN_COMMENT"]+"</th>");
					}
				}	
					
				$("#kepala").append("<th>"+"Action"+"</th>");		
					
	    }
	
 	});
	

	}

/*function showpopup(fields)
{
	 var hgt;
	 var frm;
				
	 hgt = 300;
	$('#grid1').height(hgt-12);
	$("#grid1").kendoGrid({
	dataSource: {
	transport: {
	read: 
					{
						url: 'http://localhost/bpbd/admin/crespons/getjson_popup?fields='+ fields,
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						type: 'GET',
						 success: function(data) {
			
							 alert("asd");
							}
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
				  field: "idkk",
				  title: "Jenis ID",
				  filterable: true,
				  hidden:true
				  
			  }, {
				  field: "nokk",
				  title: "No. KK",
				  filterable: true,
				  
			  },{
				  field: "namakk",
				  title:  "Nama",
				  filterable: true,
			  }
			  
			  ],

	  dataBound: onDataBound
	});
	

	
}*/
    
/*show POPUP automatic*/
function showpopup(fields,header)
{
	 var hgt;
	 var frm;
	 var taskb = document.documentElement.clientHeight;
	 hgt = 300;
	 $('#grid1').height(hgt-12);
		 
	  $.ajax({
			url: 'http://localhost/bpbd/admin/crespons/getjson_popup?fields='+ fields,
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			type: 'GET',
			success: function(data)
			{	
				generateGrid(data,header);	
			}
      });	
}

function generateGrid(response,header) {
	  
/*var columns=[{field: 'idkk',title: 'Jenis ID',filterable: true}];*/
 var columns = [];
 var r = 1;
	 $.ajax({
       url: 'http://localhost/bpbd/admin/crespons/getjson_headerpopup?fields='+ header,
		contentType: "application/json; charset=utf-8",
		type: 'GET',
		dataType: "json",
		success: function(JSONObject) {	
			var arr = header.split(",");
			 for (var key in arr)
				{
					for (var key1 in JSONObject)
					   {
							if (JSONObject[key1]["column_name"] == arr[key] && JSONObject[key1]["column_name"] != "undefined")
								{
									if (r == 1)
									{
										columns.push({
											field: JSONObject[key1]["column_name"],
											title: JSONObject[key1]["COLUMN_COMMENT"],
											hidden:true,
											filterable: true,
										})
									}
									else
									{
										columns.push({
											field: JSONObject[key1]["column_name"],
											title: JSONObject[key1]["COLUMN_COMMENT"],

											filterable: true,
										})
									}
								}	 
								
						  }

						 r++;
					}
		

					$('#grid1').kendoGrid({
															 
							  dataSource: {
								transport:{
								  read:  function(options){
									options.success(response.data);
														} 
											},	
								},
							 
								sortable: true,
								filterable:true,
								scrollable:true,
								
								pageable: {
									refresh: true,
									pageSizes: true
								},
								
								selectable: "row",
								selectable: "row",
						 columns: columns,
						  dataBound: onDataBound
							});
	
		}
		
      
			});
        
		
      }
	  
/*Batas show POPUP automatic*/
 


function formatThousands(n, dp) {
  var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
  while ( (i -= 3) > 0 ) { r = ',' + s.substr(i, 3) + r; }
  return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
}


function showcombo(url,cmb){
	
	  $.ajax({
		  url: url,
		  type: "get",
		  data:{id:idtable},
		  async: true,
		  dataType: "json",
		  success: function(data)
			  {
				 
				  var html='';
				  var i;
				  $('#'+cmb).append('<option value="0">' + "Select Item" + '</option>');
				 //html += '<option value=' + "0" + '>' + "Select Item" + '</option>';
				  for (i = 0; i < data.length; i++)
				  {
					  //html += '<option value='+ data[i].id+ '>' + data[i].nama + '</option>';
					  $('#'+cmb).append('<option value="'+ data[i].id+ '">' + data[i].nama + '</option>');
					  }
					  
				  //$('#'+cmb).html(html);
			  }
	  });

}
function autonumber(url,txt){

	  $.ajax({
		  url: url,
		  type: "get",
		  data:{id:idtable},
		  async: true,
		  dataType: "json",
		  success: function(data)
			  {
				  $('#'+txt).val(data[0].anmbr);
				 

				 
			  }
	  });

}

function saveuser(){
var JSONObject;
var tahun =new Object();
var kosong=0;
komponen=document.form2.elements.length;

$.ajax({
    type: "get",
	url: "signup/getjsonsample",
    data:{},
    
    dataType: "json",
    success: function(JSONObject) {


      // Loop through Object and create peopleHTML
      for (var key in JSONObject)
	   {			
	   		for (i = 0; i<komponen; i++)
				{ 
					var type=form2.elements[i].type;
					var id=form2.elements[i].id;	
					var row=form2.elements[i].rows;
					var value=form2.elements[i].value;
					var name=form2.elements[i].name;
					var checked=form2.elements[i].checked;
					var invalid=form2.elements[i].alt;
					var placeholder=form2.elements[i].placeholder;
					var title=form2.elements[i].title;
					
					//{ tahun[i] = i + 2000;<br> document.write("tahun[" + i + "] = " + tahun [i] + "<br />"); }
						
						/*if (invalid != "" && value =="" && type =="text")
							{
								kosong = 1 ;	
								form2.elements[i].placeholder =invalid + " Tidak Boleh Kosong" ;
								form2.elements[i].className += " Red";
							}

						if (title != "" && $("#" + id).val() == 0 && type == "select-one")
							{
								
								kosong = 1 ;	
								$('#'+id).css("color", 'red');
							}*/
							
							
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar"))
						{

								tahun[JSONObject[key]["column_name"]] = value ;
							}
						
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "password" ))
							{
							
								tahun[JSONObject[key]["column_name"]] =  Base64.encode(value);
							}
							if (type == "password" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "password" ))
							{
					
								tahun[JSONObject[key]["column_name"]] =  Base64.encode(value);
							}
							if (type == "email" && id == JSONObject[key]["column_name"] && value != "" && (JSONObject[key]["data_type"] =="text" || JSONObject[key]["data_type"].substring(0,7) =="varchar" && name == "email" ))
							{
							
								tahun[JSONObject[key]["column_name"]] =  value;
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"] =="date" )
							{
								
								tahun[JSONObject[key]["column_name"]] = new Date (value) ;
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"] =="time" )
							{
								
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"] =="float" )
							{
								
								tahun[JSONObject[key]["column_name"]] =  parseInt(value.replace(/[,]/g,''));
							}
						if (type == "text" && id == JSONObject[key]["column_name"] && value != "" && JSONObject[key]["data_type"].substring(0,3)=="int" )
							{
								
								tahun[JSONObject[key]["column_name"]] = parseInt(value.replace(/[,]/g,''));
							}

						if (type == "select-one" && id == JSONObject[key]["column_name"] && value != "")
							{
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (type == "checkbox" && id == JSONObject[key]["column_name"] && value != "")
							{
								if (value == 'on' || value == '0')
									{value = 0 ;}
								else
									{value = 1 ;}
								tahun[JSONObject[key]["column_name"]] = value ;
							}
						if (row > 0 && id == JSONObject[key]["column_name"] && value != "")
							{
								tahun[JSONObject[key]["column_name"]] = value ;
							}	
						if (type == "radio" && id == JSONObject[key]["column_name"] && value != "" && checked==true )
							{

								tahun[JSONObject[key]["column_name"]] = value ;

							}
						if ( JSONObject[key]["column_name"]=="insert_by" )
							{
								tahun[JSONObject[key]["column_name"]] = userid ;
							}
						if ( JSONObject[key]["column_name"]=="insert_time" )
							{
								tahun[JSONObject[key]["column_name"]] = update_time ;
							}
				}
         
        }
				if (kosong == 0)
							{
 						 var myjson = JSON.stringify(tahun);
							
							
							$.ajax({
								type:'get',	

								url:"signup/insertdata",
								dataType:'json',
								data:{myjson: myjson},
								success:function(data)
								{
									alert(data.msg);
									
								}
							
							});
							
					};
				if (kosong == 1)
					{alert("Data Belum Lengkap, Silahkan Isi Text Yang Berwarna Merah");}	
    }
	
 });
 
 

							
	}