<?php
	//
?>
<head>
	<title> Jadwal Waktu Shalat Bulanan </title>
    <style>
    		body, table, tr, form {font-family: tahoma; font-size: 20px; color: #404040; text-align: center; margin: 0; padding: 0}
    		pre {font-family: courier, serif, size: 10pt; margin: 0px 8px;}
    		input {font-size: 16px;}
    		.header {background:#eef; border-bottom: 1px solid #ddd; padding: 15px;}
    		.caption {font-size: 20px; color: #d95722; text-align: center; width: 10em;}
    		.arrow {font-weight: bold; text-decoration: none; color: #3D3D3D; }
    		.arrow:hover {text-decoration: underline;}
    		.command {font-weight: bold; text-decoration: none; color: #AAAAAA; }
    		.command:hover {text-decoration: underline;}
    		.timetable {border-width: 1px; border-style: outset; border-collapse: collapse; border-color: gray; margin: 0 auto;}
    		.timetable td {border-width: 1px; border-spacing: 1px; padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px; border-style: inset; border-color: #CCCCCC; }
    		.head-row {color: #d90036; background-color: #bfefff;}
    		.today-row {background-color: #ffefbf; color: #d90036}
    </style>	
    <style>
        hr{
       	    border-color: pink;
       }
    </style>    

	<script type="text/javascript" src="PrayTimes.js"></script>
</head>

<body>
<div align="center" style="margin-top: 7px">
    <table>
	    <tr>
            <td  text-align="justify">
                <fieldset>
                    <table border="0" align="center" class="a">
                        <tr>
                            <td text-align="justify">
                                <?php
                                    date_default_timezone_set("Asia/Jakarta");
                        	        $harini = date("d/M/Y - H:i:s A");
                        
                                    echo "<b>Posisi Matahari: ".$harini."</b><br/>";
                                    $wektu=date("Y-M-d");
                                    $sun_info = date_sun_info(strtotime($wektu), -7.06, 110.4);
                                    foreach ($sun_info as $key => $val) {
                                        echo "<font color='red'>$key:</font> " . date("H:i:s", $val) . "; \n";
                                    }
                                ?>     
                                <br/><br/>
                                Melalui data di atas, maka dapat ditentukan beberapa hal: <b>1) data sunrise</b> = Terbit matahari, <b>2) data sunset + waktu ikhtiyat 3 menit</b> = waktu Maghrib, <b>3) data transit + waktu ikhtiyat 3 menit</b> = waktu Dhuhur, <b>4) data astronomical twilight begin</b> = waktu Shubuh, <b>5) data astronomical twilight end + waktu ikhtiyat 3 menit</b> = waktu Isya.            
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>  
	    
        <tr>
            <td align="center">
                <hr/>
                <font color="brown" size="4">JADWAL WAKTU SHALAT BERBAGAI METODE</font>
                <hr/>
                    <div class="header">
                    <span style="font-size: 16px; color: blue;">Masukkan posisi Lintang (latitude) dan Bujur (longitude) tempat Anda: <br/></span>
                    <form class="form" action="javascript:update();">
                    	<span style="font-size: 16px;">Latitude:</span> <input type="text" value="-7.07" id="latitude" size="2" onchange="update();" />&nbsp;
                    	<span style="font-size: 16px;">Longitude:</span> <input type="text" value="110.4" id="longitude" size="2" onchange="update();" />&nbsp;<br/>
                    	<span style="font-size: 16px;">Time Zone:</span> <input type="text" value="7" id="timezone" size="2" onchange="update();" />&nbsp;
                    	<span style="font-size: 16px;">DST:</span> 
                    	<select id="dst" size="1" style="font-size: 16px;" onchange="update()">
                    		<option value="auto" selected="selected">Auto</option>
                    		<option value="0">0</option>
                    		<option value="1">1</option>
                        </select>&nbsp;<br/>
                        
                    	<span style="font-size: 16px;">Metode:</span> 
                    	<select id="method" size="1" style="font-size: 16px;" onchange="update()">
                    		<option value="DepagRI">Depag RI</option>
                    		<option value="ISRN">ISRN</option>
                    		<option value="MU" selected="selected">Muhammadiyah</option>
                    		<option value="MWL">Muslim World League (MWL)</option>
                    		<option value="ISNA">Islamic Society of North America (ISNA)</option>
                    		<option value="Egypt">Egyptian General Authority of Survey</option>
                    		<option value="Makkah">Umm al-Qura University, Makkah</option>
                    		<option value="Karachi">University of Islamic Sciences, Karachi</option>
                    		<option value="Jafari">Shia Ithna-Ashari (Jafari)</option>
                    		<option value="Tehran">Institute of Geophysics, University of Tehran</option>
                        </select> 
                    </form>
                    </div>
                    
                    <span style="font-size: 12px;"><b><font color="red" size="3">Catatan:</font></b> <br/>
                    <span style="font-size: 12px; color: blue;">Default Waktu Shubuh Menurut PP. Muhammadiyah</span>
                    <br/><br/>
                    Waktu Shubuh dan Isya ISRN ditentukan menurut data empirik Tim - ISRN-UHAMKA Jakarta, Shubuh: -13,2&deg; Isya: -13,0&deg;.
                    <br/> Sedangkan waktu Shubuh Muhammadiyah menggunakan keputusan parameter baru yaitu 18&deg;, bukan lagi 20&deg;.</span><hr/>
                    <table align="center">
                        <tr>
                        	<td><a href="javascript:displayMonth(-1)" class="arrow">&lt;&lt;</a></td>
                        	<td id="table-title" class="caption"></td>
                        	<td><a href="javascript:displayMonth(+1)" class="arrow">&gt;&gt;</a></td>
                        </tr>
                    </table>
                    
                    <table width="80%" id="timetable" class="timetable">
                    	<tbody></tbody>
                    </table>
                    
                    <div align="center" style="margin-top: 7px">
                        <span style="font-size: 14px;">Download <a target="_blank" href="https://blogchem.com/shalat/bulanan/index.zip">Source code</a> | <a target="_blank" href="http://praytimes.org/wiki/Code">Link PrayTimes</a> | <a target="_blank" href="https://blogchem.com/falak/">Blog Falak</a>&nbsp;-&nbsp;Time Format: <a id="time-format" href="javascript:switchFormat(1)" title="Change clock format" class="command"></a>
                    	</span>
                    </div>
            </td>
        </tr>
    </table>
</div>
<hr/> <br/>

<script type="text/javascript">

	var currentDate = new Date();
	var timeFormat = 1; 
	switchFormat(0);

	// display monthly timetable
	function displayMonth(offset) {
		var lat = $('latitude').value;
		var lng = $('longitude').value;
		var timeZone = $('timezone').value;
		var dst = $('dst').value;
		var method = $('method').value;

		prayTimes.setMethod(method);
		currentDate.setMonth(currentDate.getMonth()+ 1* offset);
		var month = currentDate.getMonth();
		var year = currentDate.getFullYear();
		var title = monthFullName(month)+ ' '+ year;
		$('table-title').innerHTML = title;
		makeTable(year, month, lat, lng, timeZone, dst);
	}

	// make monthly timetable
	function makeTable(year, month, lat, lng, timeZone, dst) {		
	var items = {day: 'Tanggal', fajr: 'Shubuh', sunrise: 'Terbit', 
					dhuhr: 'Dhuhur', asr: 'Ashar', sunset: 'Sunset', 
					maghrib: 'Maghrib', isha: 'Isya'};
				
		var tbody = document.createElement('tbody');
		tbody.appendChild(makeTableRow(items, items, 'head-row'));

		var date = new Date(year, month, 1);
		var endDate = new Date(year, month+ 1, 1);
		var format = timeFormat ?  '24h' : '12hNS';

		while (date < endDate) {
			var times = prayTimes.getTimes(date, [lat, lng], timeZone, dst, format);
			times.day = date.getDate();
			var today = new Date(); 
			var isToday = (date.getMonth() == today.getMonth()) && (date.getDate() == today.getDate());
			var klass = isToday ? 'today-row' : '';
			tbody.appendChild(makeTableRow(times, items, klass));
			date.setDate(date.getDate()+ 1);  // next day
		}
		removeAllChild($('timetable'));
		$('timetable').appendChild(tbody);
	}

	// make a table row
	function makeTableRow(data, items, klass) {
		var row = document.createElement('tr');
		for (var i in items) {
			var cell = document.createElement('td');
			cell.innerHTML = data[i];
			cell.style.width = i=='day' ? '2.5em' : '3.7em';
			row.appendChild(cell);
		}
		row.className = klass;
		return row;		
	}

	// remove all children of a node
	function removeAllChild(node) {
		if (node == undefined || node == null)
			return;

		while (node.firstChild)
			node.removeChild(node.firstChild);
	}

	// switch time format
	function switchFormat(offset) {
		var formats = ['24-hour', '12-hour'];
		timeFormat = (timeFormat+ offset)% 2;
		$('time-format').innerHTML = formats[timeFormat];
		update();
	}

	// update table
	function update() {
		displayMonth(0);
	} 

	// return month full name
	function monthFullName(month) {
		var monthName = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
						'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		return monthName[month];
	}

	function $(id) {
		return document.getElementById(id);
	}

</script>
</body>



