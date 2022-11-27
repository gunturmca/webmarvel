

<script src="<?php echo base_url(); ?>js/qrcode.js"></script>
<script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>



<style>    
@page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
div {position:absolute; z-index:25}
					a {text-decoration:none}
					a img {border-style:none; border-width:0}
					.fciepdoghnqao-0 {font-size:8pt;color:#000000;font-family:Calibri;font-weight:normal;}
					.fciepdoghnqao-1 {font-size:6pt;color:#000000;font-family:Calibri;font-weight:bold;}
					.fciepdoghnqao-2 {font-size:8pt;color:#ffffff;font-family:Calibri;font-weight:bold;}
					.fciepdoghnqao-3 {font-size:6pt;color:#000000;font-family:Calibri;font-weight:normal;}
					.fciepdoghnqao-4 {font-size:6pt;color:#ffffff;font-family:Calibri;font-weight:normal;}
					.fciepdoghnqao-5 {font-size:6pt;color:#000000;font-family:Calibri;font-weight:bold;}
					.fciepdoghnqao-6 {font-size:5pt;color:#000000;font-family:Calibri;font-weight:normal;}
					.adiepdoghnqao-0 {border-color:#000000;border-left-width:0;border-right-width:0;border-top-width:0;border-bottom-width:0;}
					.adiepdoghnqao-1 {border-color:#000000;border-left-width:0;border-right-width:0;border-top-width:0;border-bottom-width:0;}
				</style>


<div id="demo" style="margin-top:-73px;margin-left:-9px;"></div>

<div id="qrcode"> </div>

<script type="text/javascript" >
var s;
var k;


$(document).ready(function(){ 
	var data = <?php echo  $this->input->post('arr'); ?>;
	const date = new Date();
	const formattedDate = date.toLocaleDateString('en-GB', {
	day: 'numeric', month: 'short', year: 'numeric'
	}).replace(/ /g, '-');

	function cstr(val) {
		if (typeof val === "undefined") {
			return "";
		} else if (val === null) {
			return "";
		}
		else
		{return val}
	}
	i=0;
	$.each(data, function(i, item) {
		
    	var datse = new Date(cstr(item.AllocationDate));
		let date = new Date( Date.parse(cstr(item.AllocationDate)) );
			Asset = cstr(item.Asset);
			PhysicalTagNo = cstr(item.PhysicalTagNo);
			SerialNo = cstr(item.SerialNo);
			LocalOrImport = cstr(item.LocalOrImport);
			Description=cstr(item.Description);
			Description2=cstr(item.Description2);
			Department=cstr(item.Department);
			Section=cstr(item.Section)	;
			Dates=`${date.getDate()}-${date.toLocaleString('default', { month: 'short' })}-${date.getFullYear()}`;
			newDepartment = Department.replaceAll('And','&');
			
			if (newDepartment !== '' && Section !== '')
				{
					ds=newDepartment + ' - ' + Section;
				}
			else if (newDepartment !== '' )
				{
					ds=newDepartment ;
				}
			ds=ds.replaceAll('And','&'); ;
			if (i>0)
			{
				tp=-12;
				bt=137+1;
			}
			else
			{tp=-5;bt=90;}
			createqrcode(bt,tp,i,Asset,PhysicalTagNo,SerialNo,LocalOrImport,Description,Description2,newDepartment,Section,ds,Dates)
			
			i++;
         
	
	/*$.ajax({
		 url : "./loadqrcode",
		 type: "get",
		 data:{arr:data},
		 async: true,
		 dataType: "json",
		 success: function(data)
			 {
				 	i=0;
                    $.each(data, function(i, item) {
                       
						asset = item.Asset;
						SerialNo = item.SerialNo;
						LocalOrImport = item.LocalOrImport;
						Description=item.Description;
						Description2=item.Description2;
						Department=item.Department;
						Section=item.Section;
						ds=Department + ' - ' + Section;
						createqrcode(i,asset,SerialNo,LocalOrImport,Description,Description2,ds)
						i++;
                    });
				
			 }*/
	});
	$.each(data, function(i, item) {
        var qrcode = new QRCode(document.getElementById("Blob" + i), {
                width : 77,
                height : 77,
                useSVG: true
            });
			
			qrcode.makeCode(item.Asset);
        });
		
		
		window.onafterprint = function(e){
        $(window).off('mousemove', window.onafterprint);
		window.close();
    	};

		window.print();
		

		


});
function createqrcode(bt,tp,i,Asset,PhysicalTagNo,SerialNo,LocalOrImport,Description,Description2,newDepartment,Section,ds,Dates)
{
	
			s = '<table width="75px" height="105px"   style="margin-bottom:' + bt + 'px;margin-top:' + tp + 'px;" > <tr>' 
			s = s + '<td>' 
			
			s = s + '<div id ="frame" style="margin-top:3px" > '
			s = s + '<div title=" (DateTime)" class="adiepdoghnqao-1" style="top:86px;left:6px;width:77px;height:16px;text-align:center;"> '
			s = s + '			<span align="center" class="fciepdoghnqao-0">' + Dates + '</span></div> '
			s = s + '<div style="z-index:10;left:89px;width:145px;height:15px;border-color:#000000;border-style:solid;border-width:1px;background-color:#000000;layer-background-color:#000000;"> '
			s = s + '	<table width="138px" height="12px"> '
			s = s + '	<tr> '
			s = s + '	<td> '
			s = s + '		<div id="Blob' + i + '"  class="adiepdoghnqao-0" style="left:-81px;top:2px;width:78px;height:78px;"> '

			s = s + '		</div> '
			s = s + '	</td> '
			s = s + '	</tr> '
			s = s + '	</table> '
			s = s + '</div> '
			s = s + '<div style="z-index:10;left:7px;width:81px;height:81px;border-color:#000000;border-style:solid;border-width:1px;"> '
			s = s + '	<table width="75px" height="75px"> '
			s = s + '	<tr> '
			s = s + '	<td > '
				
				
			s = s + '	<div title=" (String)" class="fciepdoghnqao-1" style="top:2px; left:84px;width:144px;height:5px;text-align:center;"> '
			s = s + '	<span align="center" class="fciepdoghnqao-2"  style="color:#ffffff;">' + Asset + '</span></div> '
					
			s = s + '	</td> '
			s = s + '	</tr> '

			s = s + '	</table> '
			s = s + '</div> '
			s = s + '<div style="padding-top:1px;text-align:center; font-size: 8px;line-height: 150%;z-index:2000;top:16px;left:89px;width:145px;height:15px;border-color:#000000;border-style:solid;border-width:1px;border-bottom-style: none;">	 '
			s = s + '	<span class="fciepdoghnqao-2" style="color:#000000;">' + PhysicalTagNo + '</span>	 '
			s = s + '</div>'
			s = s + '<div style="padding-top:1px;font-size: 8px;line-height: 90%;z-index:10;top:30.5px;left:89px;width:145px;height:21px;border-color:#000000;border-style:solid;border-width:1px;">	 '
			s = s + '	<span class="fciepdoghnqao-1">' + Description + '</span>	 '
			s = s + '</div> '
			
			s = s + '<div style="font-size: 8px;line-height: 90%;padding-top:2px;padding-left:1px;z-index:10;padding-right:2px;top:54px;left:89px;width:120px;height:33px;border-color:#000000;border-style:none;border-width:0px;"> '
			s = s + '	<span class="fciepdoghnqao-6">' + Description2 + '</span> '
			s = s + '</div> '
			s = s + '<div style="top:54.5px;left:209px;width:26px;height:26.5px;border-color:#000000;border-style:solid;border-width:1px;border-left: 0px;"> '
			s = s + '	<div  style="background-color:#000000;text-align:center;line-height: 50%;z-index:10;width:25px;height:13px;left:2px;padding-top:3px" > '
			s = s + '		<span align="center" class="fciepdoghnqao-4"> ' + LocalOrImport + ' </span> '
			s = s + '	</div> '
			s = s + '</div> '
			s = s + '<div style="z-index:10;top:72px;left:90px;width:144px;border-color:#000000;" > '
			s = s + '	<span class="fciepdoghnqao-1" >SN</span><span class="fciepdoghnqao-1">:&nbsp;</span><span class="fciepdoghnqao-6">' + SerialNo + '</span> '
			s = s + '</div> '
			
			s = s + '<div style="z-index:10;top:86px;left:90px;width:144px;border-color:#000000;text-align:center;"> '
			s = s + '	<span class="fciepdoghnqao-1" style="font-size:0.51em;" >' + ds + '</span> '
			s = s + '</div> '
			
			s = s + '<div id="tgl" style="z-index:10;top:82px;left:7px;width:81px;height:20px;border-color:#000000;border-style:solid;border-width:1px;"></div> ' 
			s = s + '<div id="sewing" style="z-index:10;top:82px;left:89px;width:145px;height:20px;border-color:#000000;border-style:solid;border-width:1px;"></div> ' 
			s = s + '</div> ' 
			
			s = s + '</td> ' 
			s = s + '</tr> ' 
			s = s + '</table> ' ;
			k  = k+s;
            
            document.getElementById("demo").innerHTML = k ;
}


    

	</script>
