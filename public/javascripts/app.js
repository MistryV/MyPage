(function($){  
  $(function(){
    $(document).foundationMediaQueryViewer();
    
    $(document).foundationAlerts();
    $(document).foundationAccordion();
    $(document).tooltips();
    $('input, textarea').placeholder();
    
    
    
    $(document).foundationButtons();
    
    
    
    $(document).foundationNavigation();
    
    
    
    $(document).foundationCustomForms();
    
    
    
      
    $(document).foundationTabs({callback:$.foundation.customForms.appendCustomMarkup});
      
    
    
    
    $("#featured").orbit();

    var express = require('express');

    var app = module.exports = express.createServer();

    // Configure

    app.configure(function(){
        //app.set('views', __dirname + '/views');
        app.use(express.bodyParser());
        //app.use(express.methodOverride());
        app.use(app.router);
        app.use(express.static(__dirname + '/public'));
    });

    app.set('view engine', 'ejs');

    app.get('/', function(req, res){
        res.render('index', {
            title : 'Soldhere.in'
        });
    });
    
    app.get('/peter', function(req, res){
        res.render('peter', {
            title : 'Peter\'s EJS at Soldhere.in'
        });
    });

    app.get('/about', function(req, res){
        res.render('about', {
            title : 'About Us'
        });
    });


    // UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE8 SUPPORT AND ARE USING .block-grids
    // $('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'left'});
    // $('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'left'});
    // $('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'left'});
    // $('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'left'});
  });
  
})(jQuery);
