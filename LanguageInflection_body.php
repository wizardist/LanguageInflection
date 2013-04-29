<?php

class LanguageInflection {

	public static $inflectedLanguages;

	public static function inflectLanguageName( $code, $inLanguage = '', $case = '*' ) {
		if($case === '')
			$case = '*';

		if($inLanguage === '')
			$inLanguage = $code;

		if ( isset( self::$inflectedLanguages[$inLanguage][$case][$code] ) )
			return self::$inflectedLanguages[$inLanguage][$case][$code];

		$languageName = Language::fetchLanguageName( $code, $inLanguage );

		$callClassName = self::loadLanguageClass( $inLanguage );
		$languageName = call_user_func( array( $callClassName, 'performInflection' ), $code, $languageName, $case );

		if( $code !== '' ) {
			self::$inflectedLanguages[$inLanguage][$case][$code] = $languageName;
		}
		return $languageName;
	}

	public static function inflectFullLanguageName( $code, $inLanguage = '', $case = '*' ) {
		$languageName = self::inflectLanguageName( $code, $inLanguage, $case );
		
		$callClassName = self::loadLanguageClass( $inLanguage );
		$fullLanguageName = call_user_func( array( $callClassName, 'fullLanguageName'), $code, $languageName, $case );
		return $fullLanguageName;
	}

	/**
	 * Performs inflection of language name
	 *
	 * @param string $code   language code
	 * @param string $source language name
	 * @param string $case   grammatical case
	 * @return string
	 */
	public static function performInflection( $code, $source, $case = '*' ) {
		return $source;
	}

	/**
	 * Loads a language class if needed
	 * and returns its name, current class
	 * name if no class file found
	 *
	 * @param string $code
	 * @return string
	 */
	private static function loadLanguageClass( $code ) {
		$inflectClassPath = dirname( __FILE__ ) .
			Language::getFileName( '/languages/LanguageInflection', $code);
		$inflectClassName = Language::getFileName( 'LanguageInflection', $code, '' );
		if( !class_exists( $inflectClassName ) && file_exists( $inflectClassPath ) ) {
			include_once( $inflectClassPath );
			return $inflectClassName;
		} elseif( class_exists( $inflectClassName )) {
			return $inflectClassName;
		} else {
			return __CLASS__;
		}
	}
}
