<?php
/**
 * Class for the #live_i18n parser function.
 *
 * @author Megan Cutrofello
 * @ingroup LiveI18n
 */

use MediaWiki\Languages\LanguageFallback;
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
		$defaultLang = $GLOBALS["wgLiveI18nDefaultLanguageCode"];
		if ( array_key_exists( $userLang, $params ) ) {
			return $params[$userLang];
		} else {
			$languageFallback = MediaWikiServices::getInstance()->getLanguageFallback();
			$fallbacks = $languageFallback->getAll( $userLang, LanguageFallback::STRICT );

			foreach ( $fallbacks as $attemptedLang ) {
				if ( array_key_exists( $attemptedLang, $params ) ) {
					return $params[$attemptedLang];
				}
			}

			return array_key_exists( $defaultLang, $params ) ? $params[$defaultLang] : '';
		}
	}

}