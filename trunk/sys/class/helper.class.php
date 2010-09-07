<?php
/* ------------------------------------------------------------------------

 * Free Control Panel for Aoin
 *
 * @version 1.0
 * @author NetSoul (FDCore main Developer )
 * @link http://www.fdcore.ru
 *
 * http://code.google.com/p/aioncp/
 *
 * @license http://fdcore.ru/license.html

------------------------------------------------------------------------ */
if(!defined('CORE')) exit('hacking attept!');

class helper {


    static 	function world($id){
		switch ($id) {

		//Sanctum - //moveto 110010000 1532 1511 565
			case '1':
				return(array('w'=>110010000,'x'=>1532,'y'=>1511,'z'=>565));
				break;

		//Poeta - //moveto 210010000 526 1461 106
			case '2':
				return(array('w'=>210010000,'x'=>526,'y'=>1461,'z'=>106));
				break;

		//Verteron - //moveto 210030000 1339 2195 143
			case '3':
				return(array('w'=>210030000,'x'=>1339,'y'=>2195,'z'=>143));
				break;

		//Eltnen - //moveto 210020000 1487 1466 300
			case '4':
				return(array('w'=>210020000,'x'=>1487,'y'=>1466,'z'=>300));
				break;

		//Theobomos - //moveto 210060000 1400 1550 31
			case '5':
				return(array('w'=>210060000,'x'=>1400,'y'=>1550,'z'=>31));
				break;

		//Interdiktah - //moveto 210040000 1508 1568 112
			case '6':
				return(array('w'=>210040000,'x'=>1508,'y'=>1568,'z'=>112));
				break;

		//Pandaemonium - //moveto 120010000 1268 1428 208
			case '7':
				return(array('w'=>120010000,'x'=>1268,'y'=>1428,'z'=>208));
				break;

		//Ishalgen (Asmodian Starting Zone) - //moveto 220010000 850 2218 267
			case '8':
				return(array('w'=>220010000,'x'=>850,'y'=>2218,'z'=>267));
				break;

		//Altgard - //moveto 220030000 1781 1930 261
			case '9':
				return(array('w'=>220030000,'x'=>1781,'y'=>1930,'z'=>261));
				break;

		//Morheim - //moveto 220020000 872 2180 337
			case '10':
				return(array('w'=>220020000,'x'=>872,'y'=>2180,'z'=>337));
				break;

		//Brusthonin - //moveto 220050000 2428 2298 13
			case '11':
				return(array('w'=>220050000,'x'=>2428,'y'=>2298,'z'=>13));
				break;

		//Beluslan - //moveto 220040000 1967 2533 590
			case '12':
				return(array('w'=>220040000,'x'=>1967,'y'=>2533,'z'=>590));
				break;

		//Ereshuranta (Abyss) - //moveto 400010000 1365 1177 1516
			case '13':
				return(array('w'=>400010000,'x'=>1365,'y'=>1177,'z'=>1516));
				break;

		//No Zone Name - //moveto 300010000 225 276 206
			case '14':
				return(array('w'=>300010000,'x'=>225,'y'=>276,'z'=>206));
				break;

		//Karamatis - //moveto 310010000 225 276 206
			case '15':
				return(array('w'=>310010000,'x'=>225,'y'=>276,'z'=>206));
				break;

		//Karamatis (not sure why there are two of these) - //moveto 310020000 225 276 206
			case '16':
				return(array('w'=>310020000,'x'=>225,'y'=>276,'z'=>206));
				break;

		//Aerdina (Abyss Gate) - //moveto 310030000 269 173 204
			case '17':
				return(array('w'=>310030000,'x'=>269,'y'=>173,'z'=>204));
				break;

		//Geranaia (Abyss Gate) - //moveto 310040000 269 173 204
			case '18':
				return(array('w'=>310040000,'x'=>269,'y'=>173,'z'=>204));
				break;

		//Lepharist (Bio Experiment Lab) - //moveto 310050000 191 324 125
			case '19':
				return(array('w'=>310050000,'x'=>191,'y'=>324,'z'=>125));
				break;

		//Fragment of Darkness - //moveto 310060000 1618 782 1188
			case '20':
				return(array('w'=>310060000,'x'=>1618,'y'=>782,'z'=>1188));
				break;

		//Fragment of Darkness (not sure why there are two of these) - //moveto 310070000 83 238 1222
			case '21':
				return(array('w'=>310070000,'x'=>83,'y'=>238,'z'=>1222));
				break;

		//Sanctum Underground Arena - //moveto 310080000 276 185 162
			case '22':
				return(array('w'=>310080000,'x'=>276,'y'=>185,'z'=>162));
				break;

		//Indratu (Castle Indratu) - //moveto 310090000 560 335 1016
			case '23':
				return(array('w'=>310090000,'x'=>560,'y'=>335,'z'=>1016));
				break;

		//Azoturan (Castle Lehpar) - //moveto 310100000 359 410 1537
			case '24':
				return(array('w'=>310100000,'x'=>359,'y'=>410,'z'=>1537));
				break;

		//Narsass - //moveto 320010000 225 276 206
			case '25':
				return(array('w'=>320010000,'x'=>225,'y'=>276,'z'=>206));
				break;

		//Narsass (not sure why there are two of these) - //moveto 320020000 225 276 206
			case '26':
				return(array('w'=>320020000,'x'=>225,'y'=>276,'z'=>206));
				break;

		//Bregirun (Abyss Gate) - //moveto 320030000 269 175 204
			case '27':
				return(array('w'=>320030000,'x'=>269,'y'=>175,'z'=>204));
				break;

		//Nidalber (Abyss Gate) - //moveto 320040000 269 175 204
			case '28':
				return(array('w'=>320040000,'x'=>269,'y'=>175,'z'=>204));
				break;
				/*
		//Inside of the Sky Temple of Arkanis 320050000 128 133 575
		    case '29':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
		//Space of Oblivion - //moveto 320060000 1709 807 1226
			case '30':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Space of Destiny - //moveto 320070000 256 252 126
			case '31':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Draupnir - //moveto 320080000 493 600 513 (central control room)
			case '32':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Draupnir - //moveto 320080000 762 431 321 (beritra oracle chamber)
			case '33':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Triniel Underground Arena - //moveto 320090000 276 183 162
			case '34':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Fire Temple - //moveto 320100000 148 455 142
			case '35':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Alquimia - //moveto 320110000 545 527 200
			case '36':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Secret Prison - //moveto 320120000 454 553 225
			case '37':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Player Prison 1- //moveto 510010000 229 257 50
			case '38':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Player Prison 2- //moveto 520010000 229 257 50
			case '39':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Test Basic - //moveto 900020000 151 135 20
			case '40':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Test Server - //moveto 900030000 403 254 50
			case '41':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;

		//Test Giant Monster - //moveto 900100000 245 323 20
			case '42':
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;	*/
			default:
				exit('teleport error');
				break;
		}
	}
    static function exp_list() 
	{
	 $level[1]=1;
	 $level[2]=650;
	 $level[3]=2567;
	 $level[4]=6797;
	 $level[5]=15490;
	 $level[6]=30073;
	 $level[7]=52958;
	 $level[8]=87894;
	 $level[9]=140329;
	 $level[10]=213454;
	 $level[11]=307558;
	 $level[12]=483553;
	 $level[13]=608161;
	 $level[14]=825336;
	 $level[15]=1091985;
	 $level[16]=1418170;
	 $level[17]=1810467;
	 $level[18]=2332547;
	 $level[19]=3002259;
	 $level[20]=3820081;
	 $level[21]=4820228;
	 $level[22]=6115322;
	 $level[23]=7725199;
	 $level[24]=9727123;
	 $level[25]=12075781;
	 $level[26]=14762522;
	 $level[27]=17879938;
	 $level[28]=21482201;
	 $level[29]=25494737;
	 $level[30]=30171209;
	 $level[31]=35999532;
	 $level[32]=42807774;
	 $level[33]=50898898;
	 $level[34]=60588305;
	 $level[35]=73257434;
	 $level[36]=89381899;
	 $level[37]=109123921;
	 $level[38]=135145762;
	 $level[39]=165081925;
	 $level[40]=201229895;
	 $level[41]=243367815;
	 $level[42]=292723295;
	 $level[43]=350683175;
	 $level[44]=415055544;
	 $level[45]=485437946;
	 $level[46]=559304956;
	 $level[47]=643833129;
	 $level[48]=741341640;
	 $level[49]=853768081;
	 $level[50]=982677974;
	 return $level;
	}

    static function get_level($EXP='')
	{
	   if($EXP=='') return false;

	    if ($EXP <= 650) {$level = 1;}
	   else if ($EXP < 650) {$level = 2;}
	   else if ($EXP < 2567) {$level = 3;}
	   else if ($EXP < 6797) {$level = 4;}
	   else if ($EXP < 15490) {$level = 5;}
	   else if ($EXP < 30073) {$level = 6;}
	   else if ($EXP < 52958) {$level = 7;}
	   else if ($EXP < 87894) {$level = 8;}
	   else if ($EXP < 140329) {$level = 9;}
	   else if ($EXP < 213454) {$level = 10;}
	   else if ($EXP < 307558) {$level = 11;}
	   else if ($EXP < 483553) {$level = 12;}
	   else if ($EXP < 608161) {$level = 13;}
	   else if ($EXP < 825336) {$level = 14;}
	   else if ($EXP < 1091985) {$level = 15;}
	   else if ($EXP < 1418170) {$level = 16;}
	   else if ($EXP < 1810467) {$level = 17;}
	   else if ($EXP < 2332547) {$level = 18;}
	   else if ($EXP < 3002259) {$level = 19;}
	   else if ($EXP < 3820081) {$level = 20;}
	   else if ($EXP < 4820228) {$level = 21;}
	   else if ($EXP < 6115322) {$level = 22;}
	   else if ($EXP < 7725199) {$level = 23;}
	   else if ($EXP < 9727123) {$level = 24;}
	   else if ($EXP < 12075781) {$level = 25;}
	   else if ($EXP < 14762522) {$level = 26;}
	   else if ($EXP < 17879938) {$level = 27;}
	   else if ($EXP < 21482201) {$level = 28;}
	   else if ($EXP < 25494737) {$level = 29;}
	   else if ($EXP < 30171209) {$level = 30;}
	   else if ($EXP < 35999532) {$level = 31;}
	   else if ($EXP < 42807774) {$level = 32;}
	   else if ($EXP < 50898898) {$level = 33;}
	   else if ($EXP < 60588305) {$level = 34;}
	   else if ($EXP < 73257434) {$level = 35;}
	   else if ($EXP < 89381899) {$level = 36;}
	   else if ($EXP < 109123921) {$level = 37;}
	   else if ($EXP < 135145762) {$level = 38;}
	   else if ($EXP < 165081925) {$level = 39;}
	   else if ($EXP < 201229895) {$level = 40;}
	   else if ($EXP < 243367815) {$level = 41;}
	   else if ($EXP < 292723295) {$level = 42;}
	   else if ($EXP < 350683175) {$level = 43;}
	   else if ($EXP < 415055544) {$level = 44;}
	   else if ($EXP < 485437946) {$level = 45;}
	   else if ($EXP < 559304956) {$level = 46;}
	   else if ($EXP < 643833129) {$level = 47;}
	   else if ($EXP < 741341640) {$level = 48;}
	   else if ($EXP < 853768081) {$level = 49;}
	   else if ($EXP < 982677974) {$level = 50;}
	   else {$level = 51;}
	   unset($EXP);
	   return $level;
	}

    static function secure($check_string)
	{
	    $ret_string = $check_string;
	    $ret_string = htmlspecialchars ($ret_string);
	    $ret_string = strip_tags ($ret_string);
	    $ret_string = trim ($ret_string);
	    $ret_string = str_replace ('\\l', '', $ret_string);
	    $ret_string = str_replace (' ', '', $ret_string);
	    $ret_string  = str_replace("'", "", $ret_string );
	    $ret_string  = str_replace("\"", "",$ret_string );
	    $ret_string  = str_replace("--", "",$ret_string );
	    $ret_string  = str_replace("#", "",$ret_string );
	    $ret_string  = str_replace("$", "",$ret_string );
	    $ret_string  = str_replace("%", "",$ret_string );
	    $ret_string  = str_replace("^", "",$ret_string );
	    $ret_string  = str_replace("&", "",$ret_string );
	    $ret_string  = str_replace("(", "",$ret_string );
	    $ret_string  = str_replace(")", "",$ret_string );
	    $ret_string  = str_replace("=", "",$ret_string );
	    $ret_string  = str_replace("+", "",$ret_string );
	    $ret_string  = str_replace("%00", "",$ret_string );
	    $ret_string  = str_replace(";", "",$ret_string );
	    $ret_string  = str_replace(":", "",$ret_string );
	    $ret_string  = str_replace("|", "",$ret_string );
	    $ret_string  = str_replace("<", "",$ret_string );
	    $ret_string  = str_replace(">", "",$ret_string );
	    $ret_string  = str_replace("~", "",$ret_string );
	    $ret_string  = str_replace("`", "",$ret_string );
	    $ret_string  = str_replace("%20and%20", "",$ret_string );
	    $ret_string = stripslashes ($ret_string);
	    return $ret_string;
	}
 // END
 
	/*
	 * Return title name of character's
	 * @param int id
	 * 
	 * */
    function GetTitle($id=0){

    if($id==1) return 'Poeta\'s Protector';
    if($id==2) return 'Verteron\'s Warrior';
    if($id==3) return 'Bottled Lightning';
    if($id==4) return 'Tree-Hugger';
    if($id==5) return 'Krall Hunter';
    if($id==6) return 'Straw for Brains';
    if($id==7) return 'Animal Lover';
    if($id==8) return 'Fluent in Krall';
    if($id==9) return 'Patient';
    if($id==10) return 'Mabangtah\'s Envoy';
    if($id==11) return 'Demolitions Expert';
    if($id==12) return 'Eltnen\'s Hero';
	if($id==13) return 'Klaw Hunter';
	if($id==14) return 'Aerialist';
	if($id==15) return 'Kobold Chef';
	if($id==16) return 'Respects the Fallen';
	if($id==17) return 'Eulogist';
	if($id==18) return 'Love Cynic';
	if($id==19) return 'Anti';
	if($id==20) return 'Savior of Eiron Forest';
	if($id==21) return 'Honorary Meniherk Union Member';
	if($id==22) return 'Lonely Bounty Hunter';
	if($id==23) return 'Recognized by Arbolu';
	if($id==24) return 'Chief Investigator';
	if($id==25) return 'Defeater of the Indratu Legion';
	if($id==26) return 'Belbua';
	if($id==27) return 'Poor Camouflage Master';
	if($id==28) return 'Experienced Fisher';
	if($id==29) return 'Excellent Spy';
	if($id==30) return 'Fluent in Balaur';
	if($id==31) return 'Tough';
	if($id==32) return 'Battle';
	if($id==33) return 'Invincible';
	if($id==34) return 'Heroic';
	if($id==35) return 'Pirate Busting';
	if($id==36) return 'Top Expert';
	if($id==37) return 'Miragent Holy Templar';
	if($id==38) return 'Adept DP Manipulator';
	if($id==39) return 'Daeva in White';
	if($id==40) return 'Owner of the Dragon Sword';
	if($id==41) return 'Honorary Black Cloud';
	if($id==42) return 'Krall Slaughterer';
	if($id==43) return 'Gatekeeper Hunter';
	if($id==44) return 'Obstinate Herdsman';
	if($id==45) return 'Gullible';
	if($id==46) return 'Azoturan Destroyer';
	if($id==47) return 'Project Drakanhammer Researcher';
	if($id==48) return 'Homuron Knights';
	if($id==49) return 'The One who Confronted Fate';
	if($id==50) return 'Savior of Future';
	if($id==51) return 'Raider Hero';
	if($id==52) return 'Treasure Hunter';
	if($id==53) return 'Mosbear Slayer';
	if($id==54) return 'Fluent in Mau';
	if($id==55) return 'Kind';
	if($id==56) return 'Legendary Hunter';
	if($id==57) return 'Protector of Altgard';
	if($id==58) return 'Tayga Slayer';
	if($id==59) return 'Courageous Destructor';
	if($id==60) return 'Protector of Morheim';
	if($id==61) return 'Shugo Chef';
	if($id==62) return 'Energized after eating Millennium Ginseng';
	if($id==63) return 'Honorary Kidorun';
	if($id==64) return 'Champion of the Elderly';
	if($id==65) return 'Friend of Kong and Pat';
	if($id==66) return 'Silver Mane Benefactor';
	if($id==67) return 'Postal';
	if($id==68) return 'Slayer of Mabangtah';
	if($id==69) return 'Tenacious';
	if($id==70) return 'Fast';
	if($id==71) return 'Unyielding Pioneer';
	if($id==72) return 'Protector of Brusthonin';
	if($id==73) return 'Cheated by Sleipnir';
	if($id==74) return 'Beluslan';
	if($id==75) return 'Hunter of the Snowfield';
	if($id==76) return 'Savior of Besfer Villagers';
	if($id==77) return 'Sweeper of Mt';
	if($id==78) return 'Ancient Book Collector';
	if($id==79) return 'All the Way to Elysea for Nothing i';
	if($id==80) return 'Fluent in Balaur';
	if($id==81) return 'Tough';
	if($id==82) return 'Battle';
	if($id==83) return 'Invincible';
	if($id==84) return 'Heroic';
	if($id==85) return 'Steel Rake Demolisher';
	if($id==86) return 'Top Expert';
	if($id==87) return 'Fenris';
	if($id==88) return 'DP Test Passing';
	if($id==89) return 'Light on the Battlefield';
	if($id==90) return 'Owner of Agrif';
	if($id==91) return 'Wheeler';
	if($id==92) return 'Poking into Everything';
	if($id==93) return 'Gatekeeper Stabber';
	if($id==94) return 'True Friend of Silver Mane';
	if($id==95) return 'Born Merchant';
	if($id==96) return 'Marked One';
	if($id==97) return 'Expert Vengeful Spirit Consoler';
	if($id==98) return 'Pirate of the Carobian';
	if($id==99) return 'The One who Changed Destiny';
	if($id==100) return 'Future Traveling';
	if($id==101) return 'Settler of Aion';
	if($id==102) return 'As You Wish';
	if($id==103) return 'Adept of Aion';
	if($id==104) return 'Shining Intellectual';
	if($id==105) return 'Sage of Aion';
	if($id==106) return 'Very Generous';
    }

/**
 * Create a Directory Map
 *
 * Reads the specified directory and builds an array
 * representation of it.  Sub-folders contained with the
 * directory will be mapped as well.
 *
 * @author	ExpressionEngine Dev Team
 * @access	public
 * @param	string	path to source
 * @param	bool	whether to limit the result to the top level only
 * @return	array
 */
	function directory_map($source_dir, $top_level_only = FALSE, $hidden = FALSE)
	{
		if ($fp = @opendir($source_dir))
		{
			$source_dir = rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
			$filedata = array();

			while (FALSE !== ($file = readdir($fp)))
			{
				if (($hidden == FALSE && strncmp($file, '.', 1) == 0) OR ($file == '.' OR $file == '..'))
				{
					continue;
				}

				if ($top_level_only == FALSE && @is_dir($source_dir.$file))
				{
					$temp_array = array();

					$temp_array = directory_map($source_dir.$file.DIRECTORY_SEPARATOR, $top_level_only, $hidden);

					$filedata[$file] = $temp_array;
				}
				else
				{
					$filedata[] = $file;
				}
			}
			
			closedir($fp);
			return $filedata;
		}
		else
		{
			return FALSE;
		}
	}

		/**
		 * Get i18n list files
		 *
		 * @return array
		 * @author NetSoul
		 */
    function GetAlli18n(){
        $list=self::directory_map(LANG_PATH,TRUE);
        return $list;
    }

    function GetLangPath($lang){
        return LANG_PATH."$lang/$lang.php";
    }
    
   	function pagination($total_rows,$page_url='',$per_page=10,$num_links=2,$cur_page=1){
		
		$CP=aioncp::GetInstance();
		
		if ($total_rows == 0 OR $per_page == 0)
		{
			return '';
		}  	
		// Calculate the total number of pages
		$num_pages = ceil($total_rows / $per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1 || $num_pages == 0)
		{
			return '';
		}
		if($cur_page == 0) $cur_page=1;
		
		if($cur_page < 0 || !is_numeric($cur_page))
			return '';
		// start pagination links
  		$return='<div class="barNav clearfix">';
  		if($cur_page > 1)$return.=sprintf('<a class="butNav pg" href="%s%d">&laquo; '.$CP->lang['first'].'</a>',$page_url,1);
  		if($cur_page > 1)$return.=sprintf('<a class="butNav pg" href="%s%d">&laquo; '.$CP->lang['back'].'</a>',$page_url,$cur_page-1);
  		
  		// offset links
  		if($cur_page > $num_links){
  			$start=$cur_page-$num_links;
  			$num_links=$num_links*2;
  		} else{
  			$start=1;
  			//$num_links
  		}

  		$count=0; // page counter

		for($i=$start; $i < $num_pages; $i++){
			if($count > $num_links) break;
			if($cur_page==$i)$return.=sprintf('<a class="butPage pg" href="%s%d">%d</a>',$page_url,$i,$i);
				else $return.=sprintf('<a class="butNav pg" href="%s%d">%d</a>',$page_url,$i,$i);
			$count++;
		}
		if($count == 1) return '';
		$num_pages=$num_pages-1;
		
		if($cur_page != $num_pages)$return.=sprintf('<a class="butNav pg" href="%s%d">'.$CP->lang['next'].' &raquo;</a>',$page_url,$cur_page+1);
		if($cur_page != $num_pages)$return.=sprintf('<a class="butNav pg" href="%s%d">'.$CP->lang['last'].' &raquo;</a>',$page_url,$num_pages);		  	
  		$return.='</div>';
  		return $return;
  	}   
  	
	 function decodeSize( $bytes )
		{
		    $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
		    for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
		    return( round( $bytes, 2 ) . " " . $types[$i] );
		}
	
	function dirSize($directory) { 
	    $size = 0; 
	    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){ 
	        $size+=$file->getSize(); 
	    } 
	    return $size; 
	} 

	function safesql($query){
	
	}
}
