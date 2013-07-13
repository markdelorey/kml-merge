<?php

ini_set('memory_limit', '4096M');
ini_set('auto_detect_line_endings', true);

$csvs	=	scandir('to-merge');

$ofile	=	'output.csv';
$ohandle	=	fopen($ofile,'w');

$totalcount	=	0;

$include	=	array(
	'739',	// Oklahoma
	'738',
	'736',
	'735',
	'734',
	'747',
	'884',	// New Mexico
	'881',
	'882',
	'883',
	'880',
	'710',	// Louisiana
	'711',
	'714',
	'706',
	'718'	// Arkansas
);

$ignore	=	array(
	'402', // Louisville
	'401',
	'405',
	'400',
	'403',
	'630', // Missouri
	'631',
	'633',
	'622',
	'634',
	'641',
	'649',
	'647',
	'640',
	'648',
	'656',
	'657',
	'727', // Arkansas
	'762',
	'729',
	'722',
	'719',
	'718',
	'392', // Mississippi
	'396',
	'394',
	'393',
	'243', // Virginia
	'240',
	'241',
	'245',
	'239',
	'230',
	'238',
	'232',
	'227',
	'224',
	'221',
	'208',
	'220',
	'222',
	'223',
	'201',
	'226',
	'225',
	'236',
	'237',
	'235',
	'279', // North Carolina
	'285',
	'278',
	'276',
	'277',
	'275',
	'283',
	'272',
	'273',
	'274',
	'271',
	'286',
	'301', // Georgia
	'311',
	'399',
	'300',
	'306',
	'308',
	'309',
	'312',
	'302',
	'310',
	'313',
	'314',
	'304',
	'317',
	'398',
	'319',
	'318',
	'355', // Alabama
	'351',
	'352',
	'350',
	'362',
	'368',
	'364',
	'365',
	'366',
	'363',
	'369',
	'361',
	'360',
	'367',
	'354'
);

$headers	=	array(
	'Route ID',
	'ZipCRID',
	'Zip Code',
	'Zip3',
	'Route Code',
	'Route Name',
	'State',
	'lat',
	'lon',
	'geometry'
);

fputcsv($ohandle,$headers);

foreach($csvs as $csv) {
	
	$ihandle	=	fopen('merge/'.$csv,'r');
	
	$count	=	0;
	
	while( !feof($ihandle) ) {
	
		$row	=	fgetcsv($ihandle);
		
		if($count != 0) {
		
			$zip3	=	substr($row[3],0,3);
			
			//if( in_array($zip3, $include) ) {
		
				$out	=	array(
					$row[1],
					$row[2],
					$row[3],
					$zip3,
					$row[4],
					$row[5],
					$row[6],
					$row[9],
					$row[10],
					$row[17]
				);
			
				fputcsv($ohandle,$out);
			//}
		}
		
		
		$count++;
		$totalcount++;
	}
	
}


fclose($ohandle);

?>