# PERSON
[traverse(request.getQueryParams(), 'tx_extextendttaddress_extendttaddress/extendTtAddress') > 0]
    lib.breadCrumbs.10.1.NO.doNotLinkIt = 0
    lib.breadCrumbs.10.1.NO.allWrap = <li>|</li>

    lib.breadCrumbs.20 = RECORDS
    lib.breadCrumbs.20 {
        dontCheckPid = 1
        tables = tt_address
        source.data = GP:tx_extextendttaddress_extendttaddress|extendTtAddress
        source.intval = 1
        conf.tt_address = TEXT
        conf.tt_address.field = name
        conf.tt_address.htmlSpecialChars = 1
        wrap = <li>|</li>
    }
[END]