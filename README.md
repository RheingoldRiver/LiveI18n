# LiveI18n
Lightweight translation extension for MediaWiki

## Motivation & use

If you want to extend the translation of the interface slightly to infobox labels and navigational help, but not your main content, the Translate extension is a bit excessive. It's possible to use the MyVariables parser function with the `#switch` parser function, but this is a bit unwieldy; and it's also possible to use the `int` magic word, but this requires sysop permissions to edit the MediaWiki namespace (and is also a bit inconvenient, because you have to edit multiple pages to edit the content).

This extension attempts to present an alternative, with a single parser function that captures the spirit of the MyVariables/switch approach:

```
{{#live_i18n:en=hello|es=hola}}
```

There is also Lua support:

```lua
mw.ext.live_i18n.translate{ en = "Hello", es = "Hola" }
```

## Configuration
You can set a variable `$wgLiveI18nDefaultLanguageCode` with the default language to use; this is what will display if the user's language is not present in the parser function. The default value provided by the extension is `en`.
