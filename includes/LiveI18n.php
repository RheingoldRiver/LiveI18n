<?php
/**
 * Class for the #live_i18n parser function.
 *
 * @author Megan Cutrofello
 * @ingroup LiveI18n
 */

use MediaWiki\Languages\LanguageNameUtils;
use MediaWiki\MediaWikiServices;
use PPFrame;

class LiveI18n {
	public static function run( Parser $parser, PPFrame $frame, array $args ) {
		$params = [];
		foreach ( $args as $arg ) {
			$param = trim( $frame->expand( $arg ) );
			$parts = explode( '=', $param, 2 );
			if ( count( $parts == 2 ) ) {
				$params[$parts[0]] = $parts[1];
			}
		}

		return self::getOutput( $parser, $params );

	}

	public static function getOutput( $parser, $params ) {
		$userLang = $parser->getOptions()->getUserLang();
		if ( array_key_exists( $userLang, $params ) ) {
			return $params[$userLang];
		} else {
			// check for cldr extension being installed
			// if it is, then maybe we can do a better fallback than just the extension default
			$cldr = is_callable( [ 'LanguageNames', 'getNames' ] );
			if ($cldr) {
				$fallbackLangs = LanguageNames::getNames( $userLang,
					LanguageNames::FALLBACK_NORMAL,
					LanguageNames::LIST_MW_AND_CLDR
				);
				foreach ($fallbackLangs as $attemptedLang) {
					if (array_key_exists($attemptedLang, $params)) {
						return $params[$attemptedLang];
					}
				}
			}

			// if no cldr, or no acceptable preferred fallback was defined, then oh well,
			// just return the default or else an empty string
			$defaultLang = $GLOBALS["wgLiveI18nDefaultLanguageCode"];
			return array_key_exists($defaultLang, $params) ? $params[$defaultLang] : '';
		}
	}

}