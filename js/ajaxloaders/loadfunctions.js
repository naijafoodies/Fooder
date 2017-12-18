"use strict";

  $(document).ready(function(){
    $('.four.cards .image').dimmer({
    on: 'hover'
    });
      $('.mainLoader').hide();

      $('#example1').progress();

      var windowHeight = $(window).height();
      var menuCardMargin = windowHeight/5;

      $('#homePage').height(windowHeight);
      $('#menuCard').css("margin-top",menuCardMargin+"px");


    /*Start of datatable initialization */

      $('#nfTables').DataTable({
        dom: 'Bfrtip',
        paging: true,
        "pagingType": "full_numbers", 

        buttons: [
          'copy','csv','excel','pdf','print'
        ]

      });

      /* End of datatable initializarion */



  });

function ajaxLoad(id,url){

      $('footer.site-footer').hide();
      $('#'+id).html('');
      $('body').removeClass('modal-open');
      $('#'+id).html('<div class="text-center"><div class="example-loading height-350 vertical-align text-center"><div data-type="default" class="loader vertical-align-middle loader-dot"></div></div></div>');

      $('#'+id).load(url,function()
      {
        $('footer.site-footer').show(1000);
      });
}

function loadModal(divId,urls)
{
	$('#'+divId).load(urls,function()
	{
		$('#LargeModal').modal('show');
	});
}

function loadLittleModal(divId,urls)
{
	$('#'+divId).load(urls,function()
	{
		$('#littleModal').modal('show');
	});
}


function loadQuestionModal(divId,url)
{
  //function loads modal for verifying action

  $('#'+divId).load(urls,function()
  {
    $('#questionModal').modal('show');
  });

}
