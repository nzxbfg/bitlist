$(document).ready(function() {

   $.fn.matches = function(selector) {
       return (
           this[0].matches ||
           this[0].msMatchesSelector ||
           this[0].mozMatchesSelector ||
           this[0].webkitMatchesSelector ||
           function(s) {
               var matches = (this.document || this.ownerDocument).querySelectorAll(s),
                   i = matches.length;
               while (--i >= 0 && matches.item(i) !== this) {}
               return i > -1;
           }
       ).call(this[0], selector);
   };

   $.fn.closest = function(selector) {
       var el = this[0];
       while (el && el.nodeType === 1) {
           if ($(el).matches(selector)) {
               return el;
           }
           el = el.parentNode;
       }
       return null;
   };

   $(document).on('click', '.js-modal-close', function(e) {
      var parentModal = $(this).closest('.modal');
  
      if (parentModal.length) {
          parentModal.removeClass('active');
      } else {
          $('.modal.active').removeClass('active');
      }
  
      $('.js-overlay-modal').removeClass('active');
  });
  
  $(document).on('click', '.js-overlay-modal', function(e) {
      $('.modal.active').removeClass('active');
      $(this).removeClass('active');
  });

   $('.js-open-modal').on('click', function(e) {
       e.preventDefault();

       var modalId = $(this).data('modal'),
           modalElem = $('.modal[data-modal="' + modalId + '"]');

       modalElem.addClass('active');
       $('.js-overlay-modal').addClass('active');
   });

   $('body').on('keyup', function(e) {
       var key = e.keyCode;

       if (key == 27) {
           $('.modal.active').removeClass('active');
           $('.js-overlay-modal').removeClass('active');
       }
   });

   //-----------------------------------------------------------

   // $.ajax({
   //    url: 'user/register.php',
   //    method: 'post',
   //    data: $('#create_user').serialize(),
   //    dataType: 'json',
   //    success: function (response) {

   //    },
   //    error: function (error) {
   //       console.log(error);
   //    }
   // });

});
