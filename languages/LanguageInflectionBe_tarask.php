<?php

class LanguageInflectionBe_tarask {
	
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
			case 'родны':
				return self::performGenitiveInflection( $source );
			case 'давальны':
				return self::performDativeInflection( $source );
			case 'вінавальны':
				return self::performAccusativeInflection( $source );
			case 'творны':
				return self::performInstrumentalInflection( $source );
			case 'месны':
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
				$languageWord = 'мова'; break;
			case 'родны':
				$languageWord = 'мовы'; break;
			case 'вінавальны':
				$languageWord = 'мову'; break;
			case 'давальны':
			case 'месны':
				$languageWord = 'мове'; break;
			case 'творны':
				$languageWord = 'мовай'; break;
		}
		return $source . ' ' . $languageWord;
	}
	
	private static function performGenitiveInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гвы$1', $source ); // ia
		$source = preg_replace( '/ыш($|\s)/i', 'ыша$1', $source ); // yi
		$source = preg_replace( '/ыт($|\s)/i', 'ыту$1', $source ); // he, sa
		return preg_replace( '/([кн])ая($|\s)/i', '$1ай$2', $source );
	}
	
	private static function performDativeInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гве$1', $source ); // ia
		$source = preg_replace( '/ыш($|\s)/i', 'ышу$1', $source ); // yi
		$source = preg_replace( '/ыт($|\s)/i', 'ыту$1', $source ); // he, sa
		return preg_replace( '/([кн])ая($|\s)/i', '$1ай$2', $source );
	}
	
	private static function performAccusativeInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гву$1', $source ); // ia
		return preg_replace( '/([кн])ая($|\s)/i', '$1ую$2', $source );
	}
	
	private static function performInstrumentalInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гвай$1', $source ); // ia
		$source = preg_replace( '/ыш($|\s)/i', 'ышам$1', $source ); // yi
		$source = preg_replace( '/ыт($|\s)/i', 'ытам$1', $source ); // he, sa
		return preg_replace( '/([кн])ая($|\s)/i', '$1ай$2', $source );
	}
	
	private static function performLocativeInflection( $source ) {
		$source = preg_replace( '/гва($|\s)/i', 'гве$1', $source ); // ia
		$source = preg_replace( '/ыш($|\s)/i', 'ышы$1', $source ); // yi
		$source = preg_replace( '/ыт($|\s)/i', 'ыце$1', $source ); // he, sa
		return preg_replace( '/([кн])ая($|\s)/i', '$1ай$2', $source );
	}
}