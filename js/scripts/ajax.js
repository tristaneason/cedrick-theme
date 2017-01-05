// DOM Ready
(function($, window, undefined) {
   $(function() {

      // =================================================================
         //Be sure to put all intializations on the allInits Variable and call it at the last step of your transitions!
      // =================================================================
      var allInits = function() {
         vAlignShow();
         vAlignFun();
         aosInit();

         $.stellar('destroy');
         setTimeout(function(){
            stellarJsInit();
         }, 200);

         bxInit();
         screenSizeCalc();
         smoothScroll();

         setTimeout(function(){
            Waypoint.refreshAll();
            waypointInit();
         }, 200);

         $(window).resize(function() {
            vAlignFun();
            screenSizeCalc();
         }).resize();

         // Listen for resize changes (mobile orientation change)
         window.addEventListener("resize", function() {
            vAlignFun();
         }, false);
      };

      //barbr.js PJAX Stuff
      Barba.Pjax.start();
      Barba.Prefetch.init();

      var lastElementClicked;
      Barba.Dispatcher.on('linkClicked', function(el) {
         lastElementClicked = el;
      });



      // =================================================================
         //All barba transitions are below!
      // =================================================================
      var HideShowTransition = Barba.BaseTransition.extend({
         start: function() {
            Promise
               .all([this.newContainerLoading, this.fadeOut()])
               .then(this.fadeIn.bind(this));
         },

         fadeOut: function() {
            return $(this.oldContainer).animate({ opacity: 0 }).promise();
         },

         fadeIn: function() {
            document.body.scrollTop = 0;
            allInits();

            var _this = this;
            var $el = $(this.newContainer);

            $(this.oldContainer).hide();
            $el.css({
               visibility : 'visible',
               opacity : 0
            });

            $el.animate({ opacity: 1 }, 400, function() {
               _this.done();
            });
         }
      });

      Barba.Pjax.getTransition = function() {
         //put an "if barba-container.hasClass" or if "lastElementClicked" return AlternateTransition for alernative transitions
         //If you have alternate transitions, make the "return HideShowTransition;" the default with an else

         return HideShowTransition;
      };



   });
})(jQuery, window);
