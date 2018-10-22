// Generating year ranges
	var yearRangeStr; 
	var year = 2018;
	while (year > 1919){
		yearRangeStr += '<option value="' + year + '">';
		year -= 1;
	}