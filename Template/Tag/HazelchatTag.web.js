(function () {
    return function (parameters, TagManager) {
        // Loads the Hazelchat chat once per page: https://app.hazelchat.co/widget.js
        // with the website's public key. The chat itself decides whether to
        // show (the agent must be live for this website) and follows the
        // website's cookie banner where Hazelchat supports it.
        this.fire = function () {
            var key = parameters.get('hazelchatKey');
            if (typeof key !== 'string' || !/^[a-f0-9]{64}$/.test(key)) {
                return;
            }
            var doc = parameters.document || document;
            // A container can fire a tag again (a second trigger, a history
            // change). The chat's own script also ignores a second copy.
            if (doc.getElementById('hazelchat-matomo')) {
                return;
            }
            var script = doc.createElement('script');
            script.id = 'hazelchat-matomo';
            script.src = 'https://app.hazelchat.co/widget.js';
            script.async = true;
            script.setAttribute('data-agent', key);
            if (parameters.get('hazelchatWaitForConsent')) {
                script.setAttribute('data-require-consent', 'true');
            }
            (doc.head || doc.documentElement).appendChild(script);
        };
    };
})();
