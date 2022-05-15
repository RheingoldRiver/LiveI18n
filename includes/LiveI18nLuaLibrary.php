<?php

class LiveI18nLuaLibrary extends Scribunto_LuaLibraryBase {
    public function register() {
        $lib = [
            'translate' => [ $this, 'translate' ],
        ];
        return $this->getEngine()->registerInterface( __DIR__ . '/../live_i18n.lua', $lib, [] );
    }

    public function translate($args) {
        $parser = $this->getParser();
        $lang = $parser->getOptions()->getUserLang();
        if (array_key_exists($lang, $args)) {
            return $args[$lang];
        } else {
            $defaultLang = $GLOBALS["wgLiveI18nDefaultLanguageCode"];
            return $args[$defaultLang];
        }
    }

}