<?php

class LiveI18nHooks {
	public static function registerExtension() {
		define( 'LIVE_I18N_VERSION', '0.0.1' );
	}

	public static function registerParserFunctions( &$parser ) {
		$parser->setFunctionHook( 'live_i18n', [ 'LiveI18n', 'run' ], Parser::SFH_OBJECT_ARGS );
	}

	public static function addLuaLibrary( $engine, &$extraLibraries ) {
		$extraLibraries['mw.ext.live_i18n'] = 'LiveI18nLuaLibrary';

		return true;
	}

}