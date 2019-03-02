/*------------------------------------------------------------------
 * Theme Name: Smashing Studio Responsive Template
 * Theme URI: http://www.brandio.io/envato/smashing
 * Author: Brandio
 * Author URI: http://www.brandio.io/
 * Description: A Bootstrap Responsive HTML5 Template
 * Version: 1.0
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2017 Brandio.
 -------------------------------------------------------------------*/

"use strict";
var teamSlider = $(".team-slider","#team");
teamSlider.slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {breakpoint: 1200,settings: {slidesToShow: 2,slidesToScroll: 1}},
        {breakpoint: 800,settings: {slidesToShow: 1,slidesToScroll: 1}}
      ]
});
var partnersSlider = $(".partners-slider","#partners");
partnersSlider.slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 1,
  responsive: [
    {breakpoint: 1024,settings: {slidesToShow: 5,slidesToScroll: 1}},
	{breakpoint: 990,settings: {slidesToShow: 4,slidesToScroll: 1}},
	{breakpoint: 800,settings: {slidesToShow: 3,slidesToScroll: 1}},
    {breakpoint: 600,settings: {slidesToShow: 2,slidesToScroll: 1}},
    {breakpoint: 480,settings: {slidesToShow: 1,slidesToScroll: 1}}
  ]
});
$(window).on("load", function() {
    // Load case studies projects list from the Json file.
    var projectList = $(".works-slider", "#works");
    
    $.getJSON( "data/data.json", function( data ) {
        var items = "";
        var prolength = data.projects.length;
        
        for(var i=0;i<prolength;i++){
            items += "<div><a class='project-link' href='#' data-id='"+ i +"'><img src='" + data.projects[i].preview.img + "' alt=''></a></div>";
        }
        projectList.html(items);

    }).done(function() {
        
    }).fail(function() {
        
    }).always(function() {
        projectList.slick({
            dots: false,
            arrows: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {breakpoint: 1024,settings: {slidesToShow: 3,slidesToScroll: 1}},
                {breakpoint: 990,settings: {slidesToShow: 2,slidesToScroll: 1}},
                {breakpoint: 600,settings: {slidesToShow: 1,slidesToScroll: 1}}
              ]
        });
        // Adding click function to the project button to the popup for details.
        var projectLink = $(".works-slider a.project-link","#works");
        projectLink.on("click",function(e){
            e.preventDefault();
            loadProject($(this).data("id"));
            return false;
        });
    });
    
    // Load the project details from the Json file.
    var workPopup = $('#work-popup');
    var pageHolder = $('#body-holder');
    var projectSlider = $(".project-slider","#work-popup");
    
    function loadProject(projectId){
        workPopup.addClass("loading");
        workPopup.addClass("open");
        pageHolder.addClass("back");
        
        $.getJSON( "data/data.json", function( data ) {
            var items = "";
            $.each( data.projects[projectId].images, function( key, val ) {
                items += "<div><img src=" + val + " alt=" + key + "></div>";
            });
            
            projectSlider.html(items);
            projectSlider.slick({dots: true,arrows: false,speed: 200,infinite: false});
            
            var projectTitle = $(".details-holder .project-title","#work-popup");
            var infoText = $(".details-holder .info-text","#work-popup");
            var skills = $(".details-holder .skills","#work-popup");
            var dateCompleted = $(".details-holder .datecompleted","#work-popup");
            var dwButtonLink = $(".details-holder .dw-button-link","#work-popup");
            
            projectTitle.html(data.projects[projectId].details.title);
            infoText.html(data.projects[projectId].details.info);
            skills.html(data.projects[projectId].details.skills);
            dateCompleted.html(data.projects[projectId].details.datecompleted);
            dwButtonLink.attr('href',data.projects[projectId].details.link);
            
        }).done(function() {
            
        }).fail(function() {
            
        }).always(function() {
            workPopup.removeClass("loading");
            projectSlider.slick('unslick');
            projectSlider.slick({dots: true,arrows: false,speed: 200,infinite: false});
        });
    }
    
    // Adding click function to the close button in the project popup box.
    var closeBtn = $("#closebtn","#work-popup");
    closeBtn.on("click",function(e){
        e.preventDefault();
        workPopup.removeClass("open");
        pageHolder.removeClass("back");
        projectSlider.slick('unslick');
        return false;
    });
    
    // Fix image resize issue.
    var aboutImgHolder = $(".image-holder", "#about");
    var aboutText = $(".txt-col","#about");
    
    //// Popup slider images height fix
    var popupContent = $(".popup-content", "#work-popup");
    var projectSlider = $(".project-slider", "#work-popup");
    
    if ($(window).width() > 990) {
        aboutImgHolder.css("height",aboutText.height()+100);
        
        //// Popup slider images height fix
        projectSlider.css("height",popupContent.height());
    }
    // Fix image resize issue when the window resized
    $(window).on("resize",function() {
        if ($(window).width() > 990) {
            aboutImgHolder.css("height",aboutText.height()+100);
            
            //// Popup slider images height fix
            projectSlider.css("height",popupContent.height());
        }else{
            projectSlider.css("height","inherit");
        }
        return false;
    });
    
    // Features Section hover function
    var featureHolder = $(".feature-icon-holder", "#features");
    featureHolder.on("mouseover",function(){
        featureHolder.removeClass("opened");
        $(this).addClass("opened");
        $(".show-details", "#features").removeClass("show-details");
        $(".feature-details"+$(this).data("id"), "#features").addClass("show-details");
    });
    
    // Contact form function.
    var form = $('#contactform');
    var formMessages = $('#form-messages');
    var ajaxButton = $('.ajax-button','#contactform');
    var senderName = $('#name','#contactform');
    var senderEmail = $('#email','#contactform');
    var senderMessage = $('#message','#contactform');
    
    $(form).submit(function(e) {
        e.preventDefault();
        ajaxButton.addClass('sending');
        var formData = $(form).serialize();
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        }).done(function(response) {
            ajaxButton.removeClass('sending');
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');
            $(formMessages).text(response);

            senderName.val('');
            senderEmail.val('');
            senderMessage.val('');
        }).fail(function(data) {
            ajaxButton.removeClass('sending');
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');

            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('Oops! An error occured and your message could not be sent.');
            }
        });
    });
});