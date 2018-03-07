<?php
	
	class Date {
		public static function RelativeTime($timestamp){
			if($timestamp == '0000-00-00 00:00:00')
				return '';
			
			if(! is_numeric($timestamp))
				$timestamp = strtotime($timestamp);
			
			$difference = time() - $timestamp;
			$periods = array("segundo", "minuto", "hora", "dia", "semana", "mês", "ano", "década");
			$periods_plural = array("segundos", "minutos", "horas", "dias", "semanas", "meses", "anos", "décadas");
			$lengths = array("60", "60", "24", "7", "4.35", "12", "10");
	
			if ($difference > 0) {
				$ending = "atrás";
			} else {
				$difference = -$difference;
				$ending = "daqui a";
			}
			
			for($j = 0; $difference >= $lengths[$j]; $j++){
				if($lengths[$j] == 0){
					return "há muito tempo";
					break;
				}
				$difference /= $lengths[$j];
			}
				
			
			$difference = round($difference);
			
			if ($difference == 1){
				$text = "há $difference $periods[$j]";	
			} else {
				$text = "há $difference $periods_plural[$j]";
			}
				
			return $text;
		}
	
	}
