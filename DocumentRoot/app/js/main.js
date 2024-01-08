    var config = {
    apiKey: '65ed63297fbb81b492d8a1b85831b3697ebe5132',
    product: 'community',
        optionalCookies: [
            {
                name: 'analytics',
                label: 'Analytics',
                description: '',
                cookies: [],
                onAccept : function(){},
                onRevoke: function(){}
            },{
                name: 'marketing',
                label: 'Marketing',
                description: '',
                cookies: [],
                onAccept : function(){},
                onRevoke: function(){}
            },{
                name: 'preferences',
                label: 'Preferences',
                description: '',
                cookies: [],
                onAccept : function(){},
                onRevoke: function(){}
            }
        ],

        position: 'RIGHT',
        theme: 'DARK'
    };

    CookieControl.load( config );
