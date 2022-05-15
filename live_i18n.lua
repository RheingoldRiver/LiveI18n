local live_i18n = {}
local php
local options

function live_i18n.setupInterface(opts)
    -- Remove setup function
    live_i18n.setupInterface = nil
    php = mw_interface
    mw_interface = nil
    options = opts

    -- Install into the mw global
    mw = mw or {}
    mw.ext = mw.ext or {}
    mw.ext.live_i18n = live_i18n

    -- Indicate that we're loaded
    package.loaded['mw.ext.live_i18n'] = live_i18n
end

function live_i18n.translate(langs)
    return php.translate(langs)
end

return live_i18n
