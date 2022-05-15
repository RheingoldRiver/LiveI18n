<?php

class LiveI18nLuaLibrary extends Scribunto_LuaLibraryBase {
	public function register() {
		$lib = [
			'translate' => [ $this, 'translate' ],
		];

		return $this->getEngine()->registerInterface( __DIR__ . '/../live_i18n.lua', $lib, [] );
	}

	public function translate( $args ) {
		return [ LiveI18n::getOutput( $this->getParser(), $args )];
	}

}