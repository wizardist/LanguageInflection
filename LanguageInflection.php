<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	echo "This is the LanguageInflection extension. Please see the README file for installation instructions.\n";
	exit( 1 );
}

// Autoloading
$wgAutoloadClasses['LanguageInflectionHooks'] = dirname( __FILE__ ) . '/LanguageInflection.hooks.php';
$wgAutoloadClasses['LanguageInflection'] = dirname( __FILE__ ) . '/LanguageInflection_body.php';

// Internationalization
$wgExtensionMessagesFiles['LanguageInflection'] = dirname( __FILE__ ) . '/LanguageInflection.i18n.php';

$wgHooks['ParserFirstCallInit'][] = 'LanguageInflectionHooks::register';

$wgExtensionCredits['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'LanguageInflection',
	'author'         => array( 'Pavel Selitskas' ),
	'url'            => 'https://www.mediawiki.org/wiki/Extension:LanguageInflection',
	'descriptionmsg' => 'langinflect-desc',
	'version'		 => '0.1',
);
