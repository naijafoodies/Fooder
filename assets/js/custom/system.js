/***
 Script holds global Object Parameter
 */

var NfEnvironment = (function(environment) {

    var serverEnvironment = environment;

    var config = {

        getServerEnvironment : function() {

            if(serverEnvironment === "development") {
                return "//localhost:8080/naijafoodies/";
            }
            else if(serverEnvironment === 'staging') {
                return "https://www.naijafoodies.com/dev/";
            }
            else if(serverEnvironment === "production") {
                return "https://www.naijafoodies.com/";
            }
            else {

                throw new URIError("Invalid Server Environment");
            }
        },

        setServerEnvironment : function(newEnvironment) {

            serverEnvironment = newEnvironment;

            return config.getServerEnvironment();
        }


    };

    return config;

})("staging");