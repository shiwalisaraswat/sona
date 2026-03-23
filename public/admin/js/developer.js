// Tooltip starts here
document.addEventListener("DOMContentLoaded", function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (el) {
        return new bootstrap.Tooltip(el);
    });
});
// Tooltip ends here

// Toggle(Show more/less) starts here
// $(document).on('click', '.toggle-text', function (e) {
//     e.preventDefault();
    
//     let $this = $(this);
//     let $parent = $this.closest('.desc-cell');

//     $parent.find('.short-text, .full-text').toggleClass('d-none');

//     if ($this.text() === 'Show more') {
//         $this.text('Show less');
//         $this.removeClass('text-primary');
//         $this.addClass('text-info');
//     } else {
//         $this.text('Show more');
//         $this.removeClass('text-info');
//         $this.addClass('text-primary');
//     }
// });

$(document).on('click', '.toggle-text', function (e) {
    e.preventDefault();
    const isMore = $(this).text() === 'Show more';
    
    $(this).closest('.desc-cell').find('.short-text, .full-text').toggleClass('d-none');
    
    $(this).text(isMore ? 'Show less' : 'Show more')
           .toggleClass('text-primary text-info');
});
// Toggle(Show more/less) ends here


// Sidebar starts here
// Look for this logic and COMMENT IT OUT or REMOVE IT
var current = location.pathname;
$('.nav li a').each(function() {
  var $this = $(this);
  if ($this.attr('href').indexOf(current) !== -1) { // This is the bug!
      $this.addClass('active');
  }
});
// Sidebar ends here