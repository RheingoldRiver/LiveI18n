<?php
/**
 * Class for the #live_i18n parser function.
 *
 * @author Megan Cutrofello
 * @ingroup LiveI18n
 */

use PPFrame;

class LiveI18n {
	public static function run( Parser $parser, PPFrame $frame, array $args ) {
		$lang = $parser->getOptions()->getUserLang();
		$params = [];
		foreach ( $args as $arg ) {
			$param = trim( $frame->expand( $arg ) );
			$parts = explode( '=', $param, 2 );
			if ( count( $parts == 2 ) ) {
				$params[$parts[0]] = $parts[1];
			}
		}

		if ( array_key_exists( $lang, $params ) ) {
			return $params[$lang];
		} else {
			$defaultLang = $GLOBALS["wgLiveI18nDefaultLanguageCode"];

			return $params[$defaultLang];
		}
	}
}