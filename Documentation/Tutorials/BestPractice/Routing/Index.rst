routeEnhancers:

    # PERSON START
    ExtendTtAddress:
        type: Extbase
        extension: ExtExtendttaddress
        plugin: Extendttaddress
        routes:
            -   routePath: /
                _controller: 'ExtendTtAddress::list'
            -   routePath: '/letter/{atoz}'
                _controller: 'ExtendTtAddress::list'
                _arguments:
                    atoz: atoz
            -   routePath: '/category/{override-category}'
                _controller: 'ExtendTtAddress::list'
                _arguments:
                    override-category: overrideCategory
            -   routePath: '/page/{page}'
                _controller: 'ExtendTtAddress::list'
                _arguments:
                    page: 'currentPage'
            -   routePath: '/letter/{atoz}/page/{page}'
                _controller: 'ExtendTtAddress::list'
                _arguments:
                    atoz: atoz
                    page: 'currentPage'
            -   routePath: '/{person_slug}'
                _controller: 'ExtendTtAddress::show'
                _arguments:
                    person_slug: extendTtAddress
        defaultController: 'ExtendTtAddress::list'
        requirements:
            page: '\d+'
            atoz: '[A-Z]'
        aspects:
            override-category:
                type: PersistedAliasMapper
                tableName: sys_category
                routeFieldName: slug
            person_slug:
                type: PersistedPatternMapper
                tableName: tt_address
                routeFieldPattern: '^(?P<slug>.+)-(?P<uid>\d+)$'
                routeFieldResult: '{slug}-{uid}'
            atoz:
                type: StaticRangeMapper
                start: A
                end: Z
            page:
                type: StaticRangeMapper
                start: '1'
                end: '100'
    # PERSON END
