/* @version 1.1 lksMenu
 * @author Lucas Forchino
 * @webSite: http://www.tutorialjquery.com
 * lksMenu.
 * jQuery Plugin to create a css menu
 */
(function($){
    $.fn.lksMenu=function(){
        return this.each(function(){
            var menu= $(this);
            menu.find('ul li ul.active').slideDown('medium');
            menu.find('ul li > header').bind('click',function(event){
                var ahref = $(event.currentTarget).attr('href');
                
                    var currentlink=$(event.currentTarget);

                    if (currentlink.parent().find('ul.active').size()==1)
                    {
                        currentlink.parent().find('ul.active').slideUp('medium',function(){
                            currentlink.parent().find('ul.active').removeClass('active');
                            currentlink.parent().find('header').removeClass('active');
                            currentlink.parent().find('header i').removeClass('icon-minus').addClass('icon-plus');
                            
                        });
                    }
                    else if (menu.find('ul li ul.active').size()==0)
                    {
                        
                        show(currentlink);
                    }
                    else
                    {
                        menu.find('ul li ul.active').slideUp('medium',function(){
                            menu.find('ul li ul').removeClass('active');
                            menu.find('ul li header').removeClass('active');
                            menu.find('ul li header i').removeClass('icon-minus').addClass('icon-plus');
                            show(currentlink);
                        });
                    }
            });
            function show(currentlink){
                
                currentlink.parent().find('ul').addClass('active');
                currentlink.parent().find('header').addClass('active');
                currentlink.parent().find('header i').removeClass('icon-plus').addClass('icon-minus');
                currentlink.parent().find('ul').slideDown('medium');
            }
        });
    }
})(jQuery);