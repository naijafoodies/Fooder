$(document).ready(function() {

    var system = NfEnvironment.getServerEnvironment();
    // initialize select box

    $('.ui fluid dropdown').dropdown('show');


    // CALL AJAX REQUEST


    $.when.apply($,menuDeffereds).then(function(menu) {

        // get menu

        var init = new initDescription();

        init.addImage(NfEnvironment.getServerEnvironment()+"assets/uploads/menu/"+describeDataPoint.menuDetails.image);
        init.addMenuName(describeDataPoint.menuDetails.menuName);
        init.addMenuDescription(describeDataPoint.menuDetails.description);
        init.addMenuOrigin(describeDataPoint.menuDetails.origin);

        // Get All Depenedent Data

        getSides(describeDataPoint.menuDetails.vendorId);
        getMeat(describeDataPoint.menuDetails.vendorId);
        getCategoryMenu(describeDataPoint.menuDetails.categoryId);

        // wait till Sides is successful

        $.when.apply($,sidesDeffereds).then(function() {

            // load Dependent constructors

            var sides = new Sides(describeDataPoint.sides);

            // load options
            sides.loadSides();

        });

        $.when.apply($,meatDeffereds).then(function() {

            // load Dependent constructors

            var meat = new Meat(describeDataPoint.meats);

            // load meats

            meat.loadMeat();
        });

        $.when.apply($,categoryDeffereds).then(function() {

            //  load menu that belongs to the same category

            var category = new Category(describeDataPoint.sameCategoryMenu);

            // load category dishes

            category.loadSameCategoryMenu();


        });

        // loads the summary object which encapsulates the events for all options

        var summary = new Summary();


    });


});

function initDescription() {

    this.cardContainer = $('#describe-food-card');
    this.cardImage = $('#describe-food-image');
    this.cardHeader = $('#describe-food-header');
    this.cardContent = $('#describe-content');


    this.addImage = function(imageUrl) {

        this.cardImage.attr('src',imageUrl);
    };

    this.addMenuName = function(data) {

        this.cardContent.append("<p class='w3-panel w3-border w3-round-small describe-menu-header'><span id='menu-label'></span>"+data+"</p>");

    };

    this.addMenuDescription = function (data) {

      if(data) {
        this.cardContent.append("<p><span class='describe-label'>Details: </span>"+data+"</p>");
      }

    };

    this.addMenuOrigin = function(data) {

      if(data){
          this.cardContent.append("<p><span class='describe-label'>Origin: </span>"+data+"</p>");
      }

    };



}


function addMenuOptions(data) {

    this.describeSide1 = $('#describe-side-1');
    this.describeSide2 = $('#describe-side-2');
    this.meatAndFishSelecction = $('#describe-meat-fish');
    this.data = data;

    if(typeof this.data !== 'object') {

        throw TypeError("Expected an object. You gave "+ typeof data);
    }

    this.drawSides = function() {

        // method loads the side One options

        $.each(this.data.sides,function(key,val) {

            if(val.available) {

                $('#describe-side-1').append("<option value='"+ val.id +"'>"+val.name+"</option>");
                $('#describe-side-2').append("<option value='"+ val.id +"'>"+val.name+"</option>")
            }

        });
    }
}
