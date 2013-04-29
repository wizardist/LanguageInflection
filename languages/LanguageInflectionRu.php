<?php

class LanguageInflectionRu {
	
	private static $standaloneLanguages = array(
		'af', 'eo', 'he', 'hi', 'hif', 'hif-deva', 'hif-latn', 'ia', 'qu',
		'sa', 'sw', 'vo', 'yi',
	);
	
	private static $noninflectedLanguages = array(
		'af', 'eo', 'hi', 'qu', 'sw',
	);
	
	public static function performInflection( $code, $source, $case = '*' ) {
		// don't inflect non-inflected language names
		if( in_array( $code, self::$noninflectedLanguages ))
			return $source;
		
		switch( $case ) {
			case '*':
			default:
				return $source;
			case 'родительный':
				return self::performGenitiveInflection( $source );
			case 'дательный':
				return self::performDativeInflection( $source );
			case 'винительный':
				return self::performAccusativeInflection( $source );
			case 'творительный':
				return self::performInstrumentalInflection( $source );
			case 'предложный':
				return self::performLocativeInflection( $source );
		}
	}
	
	public static function fullLanguageName( $code, $source, $case = '*' ) {
		if( in_array( $code, self::$standaloneLanguages ) )
			return $source;
		
		$languageWord = '';
		switch( $case ) {
			case '*':
			default:
				$languageWord = 'язык'; break;
			case 'родительный':
				$languageWord = 'языка'; break;
			case 'дательный':
				$languageWord = 'языку'; break;
			case 'винительный':
				$languageWord = 'язык'; break;
			case 'творительный':
				$languageWord = 'языком'; break;
			case 'предложный':
				$languageWord = 'языке'; break;
		}
		return $source . ' ' . $languageWord;
	}
	
	private static function performGenitiveInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гвы$1', $source ); // ia
		$source = preg_replace( '/иш($|\s)/i', 'иша$1', $source ); // yi
		$source = preg_replace( '/ит($|\s)/i', 'ита$1', $source ); // he, sa
		return preg_replace( '/кий($|\s)/i', 'кого$1', $source );
	}
	
	private static function performDativeInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гве$1', $source ); // ia
		$source = preg_replace( '/иш($|\s)/i', 'ишу$1', $source ); // yi
		$source = preg_replace( '/ит($|\s)/i', 'иту$1', $source ); // he, sa
		return preg_replace( '/кий($|\s)/i', 'кому$1', $source );
	}
	
	private static function performAccusativeInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гву$1', $source ); // ia
		return preg_replace( '/кий($|\s)/i', 'кий$1', $source ); // FIXME
	}
	
	private static function performInstrumentalInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гвой$1', $source ); // ia
		$source = preg_replace( '/иш($|\s)/i', 'ишем$1', $source ); // yi
		$source = preg_replace( '/ит($|\s)/i', 'итом$1', $source ); // he, sa
		return preg_replace( '/кий($|\s)/i', 'ким$1', $source );
	}
	
	private static function performLocativeInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гве$1', $source ); // ia
		$source = preg_replace( '/иш($|\s)/i', 'ише$1', $source ); // yi
		$source = preg_replace( '/ит($|\s)/i', 'ите$1', $source ); // he, sa
		return preg_replace( '/кий($|\s)/i', 'ком$1', $source );
	}
}