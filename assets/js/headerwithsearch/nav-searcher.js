$(document).ready(function() {

    var _cart = new NfCart();

    // get Menu items

    getAllMenuItems();

    $.when.apply($,deferreds).then(function () {

        // activate type head

        var searchData = [];

        // push all menu into array

        $.each(dataPoint.menu.activeMenu,function(key,value) {

            searchData.push({"text": value.foodName,"website-link":NfEnvironment.getServerEnvironment()+"describe/"+value.foodId})

        });

        // set options for jquery search

        var options = {
            data : searchData,
            getValue : "text",
            theme : "bootstrap",
            list : {
                maxNumberOfElements : 10,
                match : {
                    enabled:true
                },
                sort : {
                    enabled : true
                },
                showAnimation: {
                    type: "fade", //normal|slide|fade
                    time: 200,
                    callback: function() {}
                },
                hideAnimation: {
                    type: "slide", //normal|slide|fade
                    time: 200,
                    callback: function() {}
                },
                onChooseEvent : function() {

                    var url = $("#nf-searchalize-protected").getSelectedItemData();

                    location.assign(url["website-link"]);
                }

            },

            template : {
                type : "links",
                fields : {
                    link : "website-link"
                }
            }
        };

        $('#nf-searchalize-protected').easyAutocomplete(options);

        //console.log(searchData);

    });

});
