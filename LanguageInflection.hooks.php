<?php

/**
 * Hooks for LanguageInflection extension
 *
 * @file
 * @ingroup Extensions
 */

class LanguageInflectionHooks {

	/**
	 *
	 * @param Parser $parser
	 * @return boolean
	 */
	public static function register( $parser ) {
		$parser->setFunctionHook( 'language', array( __CLASS__, 'language' ) );
		$parser->setFunctionHook( 'languagefull', array( __CLASS__, 'languagefull' ) );
		return true;
	}

	public static function language( $parser, $code = '', $inLanguage = '', $case = '' ) {
		$lang = LanguageInflection::inflectLanguageName( $code, $inLanguage, $case );
		
		if( $lang !== '' )
			return $lang;
		else
			return wfBCP47 ( $code );
	}
	
	public static function languagefull( $parser, $code = '', $inLanguage = '', $case = '' ) {
		$lang = LanguageInflection::inflectFullLanguageName( $code, $inLanguage, $case );
		
		if( $lang !== '' )
			return $lang;
		else
			return wfBCP47 ( $code );
	}
}