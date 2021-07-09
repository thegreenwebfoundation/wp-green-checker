/**
 * Show the latest 10 checks in an activity feed format
 */
function activityFeed() {
    if($('#activity_feed_checks').length > 0){
        activityFeedGetter();    
        setInterval (function() {
            activityFeedGetter();    
        }, 3000);
    }
}

/**
 * Show the total amount of checks done and the percentage green (last week)
 */
function getTotalStats()
{
    // Add numbers to header
  $.getJSON('https://api.thegreenwebfoundation.org/stats?callback=?', function (data) {
        $('.greencheck_checks_total').html(numeral(data.total.checks).format('0,0'));
        $('.greencheck_checks_percentage').html(data.tld.percentage + '%');

	var labels = [];
	var percs = [];
	var monthTotal = 0;
	var week = 0;
	$.each(data.weekly, function( key, check ) {
		var label = check[0];
		var perc = check[1];
		var day = moment(label);
		var weekNumber = moment(label).week();
		//if(moment(label).isAfter('2014-12-29')){
		  monthTotal += perc;
		  week++;
		//}
		if(moment(label).isAfter('2015-01-01') && weekNumber % 4 == 0){
		  monthPerc = monthTotal / week;
		  labels.push(day.format('MMMM'));
		  percs.push(monthPerc);
		  monthTotal = 0;
	 	  week = 0;
		} else {
		} 
	});
//	console.log(data.weekly);

       // Get context with jQuery - using jQuery's .get() method.
       var ctx = $("#myChart").get(0).getContext("2d");
       // This will get the first returned node in the jQuery collection.

var data = {
    labels: labels, // ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "Percentage green domains checked",
            fillColor: "rgba(118,194,45,0.2)",
            strokeColor: "rgba(118,194,45,1)",
            pointColor: "rgba(118,194,45,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(118,194,45,1)",
            data: percs //[65, 59, 80, 81, 56, 55, 40]
        }
    ]
};
var options = {
legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
};
      var myLineChart = new Chart(ctx).Line(data, options);


    });
}

function activityFeedGetter()
{
    $.getJSON('https://api.thegreenwebfoundation.org/checks/latest?callback=?', function (data) {
            var $list = $('<ul>');
            $.each(data, function( key, check ) {
                check = $.parseJSON(check);
                $smallresult = $('<li>');

                if(check.green){
                    var imgsmall = $("<img />").attr('class', '').attr('style', 'margin-top:20px;').attr('src', "https://www.thegreenwebfoundation.org/wp-content/themes/tgwf2015/img/20.png")
                    var smalltext = '';
                    if(check.hostingProviderUrl) {
                        //var a = $('<a />').attr('href', "/directory/#" + check.hostingProviderId);
                        var a = $('<a />').attr('href', "/green-web-check/?url=" + check.url);
                        a.append(imgsmall);
                        smalltext = check.url + ' is green hosted by ' + check.hostingProviderName;
                        a.append(smalltext);
                        $smallresult.append(a);
                    } else {
                        $smallresult.append(imgsmall).append(check.url + ' is green hosted by ' + check.hostingProviderName);
                    }
                } else {
                    // Not green
                    var imgsmall = $("<img />").attr('class', '').attr('style', 'margin-top:20px;').attr('src', "https://www.thegreenwebfoundation.org/wp-content/themes/tgwf2015/img/grey20x20.gif");
                        var a = $('<a />').attr('href', "/green-web-check/?url=" + check.url).attr('style','color:grey !important;');
                        a.append(imgsmall);
                        smalltext = check.url + ' is grey ';
                        a.append(smalltext);
                        $smallresult.append(a);

//                    $smallresult.append(imgsmall).append(check.url + ' is grey ');
                }

                $list.append($smallresult.append('<span class="pull-right"> | Checked ' + moment(check.date).fromNow() + '</span'));
            });            
            $('#activity_feed_checks').html('');
            $('#activity_feed_checks').append($list);
        });
}

function attachDirectory()
{
    console.log('called');
    if($("h1").text() == 'Directory'){
        console.log('directory page found');
    }

    // Add the directory
    if($('#tgwf_directory').length > 0){
        textnotfound = $("#tgwf_directory").data('notfound');
        partnerlink  = $("#tgwf_directory").data('partnerlink');
        partnertext  = $("#tgwf_directory").data('partnertext');
        directorycontains = $("#tgwf_directory").data('headertext');

        $.getJSON('https://api.thegreenwebfoundation.org/data/directory?callback=?', function (data) {
            var sample_data = {};
            var providers = isos = 0;
            $.each(data, function( iso, row ) {
                if(row.providers){
                    sample_data[iso.toLowerCase()] = row.providers.length + ".00";
                    isos++;
                    providers += row.providers.length;
                }else{
                    sample_data[iso.toLowerCase()] = 0;
                }
            });
            sample_data['gb'] = sample_data['uk'];

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: '#999',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                normalizeFunction: 'polynomial',
                scaleColors: ['#40aa2b', '#70ba2b'],
                onLabelShow: function(event, label, code)
                {
                    label.text(label.text() + ' ' + Math.round(sample_data[code]));
                },
                onRegionClick: function(element, code, region)
                {
                   scrollToAnchor(code.toUpperCase());
                }
            });

            function scrollToAnchor(aid){
                if (aid == 'GB') {
                    aid = 'UK';
                }
                var aTag = $("a[name='"+ aid +"']");
                $('html,body').animate({scrollTop: aTag.offset().top - 100},'slow');
            }

            headertext = directorycontains.replace(/%hosters%/, providers);
            headertext = headertext.replace(/%countries%/, isos);
            $('#tgwf_directory').append('<h2>' + headertext + '</h2>');

            $.each(data, function( iso, row ) {
                countryname = row.countryname;

                if(row.providers){
                    headertext = '<a id="' + iso + '" name="' + iso + '"></a><h2 style=\'margin-bottom:10px;\'>' + countryname;
                    headertext += ' - ' + row.providers.length;   
                    headertext += '</h2>'

                    $('#tgwf_directory').append(headertext); 

                    //$('#tgwf_directory').append('<ul>');    
                    $.each(row.providers, function( key, provider ) {
                        providernaam = provider.naam;
                        if(provider.partner != '' && provider.partner != 'null' && provider.partner != null){
                            providernaam += ' (' + provider.partner + ')';
                        }
                        providertext = "<p><a id='" + provider.id + "' name='" + provider.id + "'/><a class='providerlink providerlink-" + provider.id + "' data-providerid='" + provider.id + "' href='https://www.thegreenwebfoundation.org/thegreenweb/#providers/" + provider.id + "'>" + providernaam + "</a></p>";

                        providerinfo = "<p class='hide providerinfo' id=providerinfo-" + provider.id + ">Provider information here</p>";

                        $('#tgwf_directory').append(providertext);    
                        $('#tgwf_directory').append(providerinfo);    
                    });
                    //$('#tgwf_directory').append('</ul>');    
                } else {
                    notfound = textnotfound.replace(/%countryname%/, countryname);
                    notfound = notfound.replace(/%partnerlink%/, '<a href=\'https://www.thegreenwebfoundation.org/partners\'>' + partnerlink + '</a>');
                    //$('#tgwf_directory').append('<p>' + notfound + '</p>');        
                }                
            });

            /*
            * @todo This can be done so much better with a template engine, move this to angular!
            */
            $('.providerlink').click(function(e){
                    $('.providerinfo').addClass('hide');
                    e.preventDefault();
                    providerId = $(this).data('providerid');
                    $.getJSON('https://api.thegreenwebfoundation.org/data/hostingprovider/' + providerId, function(data){
                        data = data[0];

                        var template = "<div><table class='table'><tr><th>Name</th><td><a href='http://" + data.website + "' target=\"_blank\">" + data.naam + "</a></td></tr>";
                        if(data.partner == null || data.partner =='') { 
                        } else { 
                            template += "<tr><th>Partner</th><td>" + data.partner + "</td></tr>";
                        } 
                        template += "<tr><th>Active in</th><td>" + data.countrydomain + "</td></tr><tr><tr><th>Certificate</th>";
                        if(data.certurl == null) { 
                            template += "<td>Certificate Unknown</td>";
                         } else { 
                            template += "<td><table><tr><td> " + data.valid_from + " - </td><td> " + data.valid_to + " </td><td><a href='" + data.certurl + "' target=\"_blank\">Show Certificate</a></td></tr></table></td>";
                        } 
                        template += "</tr><tr><th>Datacenters in use</th><td>";
                        if (data.datacenters.length == 0) { 
                            template += "Unknown ";
                        } else { 
                            template += data.datacenters.length;

                        } 
                        template += "</td></tr></table></div>";
                    
                        if (data.datacenters.length > 0) { 
                            template += "<table class='table'><thead><tr><th>Name</th><th>City</th><th>Country</th><th>PUE</th><th>Green Energy Certificates</th></tr></thead><tbody>";
                            $.each(data.datacenters, function( index, dc ){
                                template += "<tr><td><a href='" + dc.website + "' target=\"_blank\">" + dc.naam +"</a></td>";
                                template += "<td>";
                                if(dc.city) { 
                                    template += dc.city;
                                }else{ 
                                    template += "Unknown";
                                } 
                                template += "</td>";
                                template += "<td>";
                                if(dc.country) { 
                                    template += dc.country;
                                }else{ 
                                    template += "Unknown";
                                } 
                                template += "</td>";
                                template += "<td>";
                                if(dc.pue) { 
                                    template += dc.pue;
                                }else{ 
                                    template += "Unknown";
                                } 
                                template += "</td>";
                    
                                if(dc.certificates.length == 0) { 
                                    template += "<td>Unknown</td>";
                                } else { 
                                    template += "<td><table>";
                                    $.each(dc.certificates, function (indexcert, cert) {
                                        template += "<tr><td>" + cert.cert_valid_from + "</td><td>" + cert.cert_valid_to + "</td><td><a href='" + cert.cert_url +"' target=\"_blank\">Certificate</a></td></tr>";
                                    }); 
                                    template += "</table></td>"
                                } 
                                template += "</tr>";
                            });
                            template += "</tbody></table>";
                        }

                        $('#providerinfo-' + providerId).html(template);
                        $('#providerinfo-' + providerId).removeClass('hide');
                    });                    
            });

            var requestedHash = ((window.location.hash.substring(1).split("#",1))+"?").split("?",1);
            $('.providerlink-' + requestedHash[0]).click();
        });
    }
}

function attachDailyStats()
{
    // Add numbers to header
  $.getJSON('https://api.thegreenwebfoundation.org/stats.php?callback=?', function (data) {
        $('.n_users').html(data.search.users);
        $('.n_results').html(data.results.checks);
        $('.n_countries').html(data.tld.count);
        $('.n_perc').html(data.tld.percentage);
        $('#layerNumbers').show();

        $('.n_remaining_perc').html(80-data.tld.percentage);

        $('.gc_download').html(data.total.users);
        $('.gc_sites').html(data.total.checks);
        $('.gc_search').html(data.search.checks);

        if($('#daily-stats')){
            $.each(data.daily, function( date, type ) {
                //On Thursday November 4th, 14,568 sites and 456,382 search-results were checked
                if(type.api && type.apisearch){
                    $('#daily-stats').append('<li>On ' + moment(date).format('LL') +', ' + type.api.count + ' sites and ' + type.apisearch.count + ' search-results were checked');    
                }
            });
        }

        // attach Chart
        attachChartPlot(data.weekly);
    });
}

function attachChartPlot(line1)
{
    $('#layerNumbersText').click(function(){
      var plot1 = $.jqplot('chart1', [line1], {
            title: 'Percentage greenly hosted',
            grid: {
                background: 'rgba(57,57,57,0.0)',
                drawBorder: false,
                shadow: false,
                gridLineColor: '#666666',
                gridLineWidth: 2
            },
            seriesColors: ["rgba(112, 186, 43, 0.7)"],
            seriesDefaults: {
              fill: true,
              rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
              }
            },
            axes: {
                xaxis: {
                    renderer:$.jqplot.DateAxisRenderer
                },
                yaxis: {min:0, max:100}
            },
            series:[{lineWidth:4, markerOptions: {style:'square'}}]  
        });
      $('#chart1').toggle('slow', function() {
        $(this).removeClass('hide');
        plot1.replot();
      });
    });
}

function attachStats() {
    activityFeed();

    attachDirectory();

    attachDailyStats();
}

function siteChecker() {
    $('#greencheck').submit(function() {
        $output = $('#output');

        var logopage = false;
        if ($('#tgwf-logo-page').length) {
            logopage = true;
            $output = $('#tgwf-logo-page');
        }

        $output.html('');
        var url = $('#url').val();
        domain = url.replace('http://','');
        domain = domain.replace('https://','');
	    split = domain.split('/');
 	    domain = split[0];

        if(!logopage){
            $.getJSON('https://api.thegreenwebfoundation.org/greencheck/'+ domain, {} , function(data) {
                var response = data;
                if(response.error){
                    $('#output').html('<p class="alert alert-error">' + response.error +'</p>');
                    return;
                }

                var img = $("<img />").attr('class', 'col-xs-6').attr('style', 'margin-top:20px; width:300px; height:135px;').attr('src', 'https://api.thegreenwebfoundation.org/greencheckimage/'+ domain)
                        .load(function() {
                        if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                    
                        } else {
                            if(response.hostedby) {
                                var a = $('<a />').attr('href', "/directory/#" + response.hostedbyid);
                                a.append(img);
                                $output.append(a);
                            } else {
                                $output.append(img);
                            }
                            $output.append(
                                $('<div />').attr('class', 'col-xs-6')
                                            .append($('<p />').append($('<a />').attr('href', 'https://api.thegreenwebfoundation.org/greencheckimage/'+ domain + '?download=1').text('Download badge here')))
                                            .append($('<p />').attr('style', 'margin-bottom:0px;').text('Copy the following code to include an image on your Facebook / Twitter'))
                                            .append($('<textarea />').attr('style', 'width:300px; margin-bottom:5px;').text("https://api.thegreenwebfoundation.org/greencheckimage/" + domain))
                            );
                            
                            $output.append(
                                $('<div />').attr('class', 'col-xs-6')
                                            .append($('<p />').attr('style', 'margin-bottom:0px;').text('Copy the following code to include an image on your website'))
                                            .append($('<textarea />').attr('style', 'width:300px; margin-bottom:5px;').text("<img src='https://api.thegreenwebfoundation.org/greencheckimage/" + domain + "'>"))
                            );

                        }
                });

                if(!logopage){
                    $('#output-title').show();    
                }
            });   
        } else {
            $.getJSON('https://api.thegreenwebfoundation.org/greencheck/'+ domain, {} , function(data) {
                var response = data;
                if(response.error){
                    $('#output').html('<p class="alert alert-error">' + response.error +'</p>');
                    return;
                }

                var img = $("<img />").attr('class', 'col-xs-6').attr('style', 'margin-top:20px; width:300px; height:135px;').attr('src', 'https://api.thegreenwebfoundation.org/greencheckimage/'+ domain)
                        .load(function() {
                        if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                    
                        } else {
                            $output = $('#tgwf-logo-page-big-result');
                            $output.html('');
                            if(response.hostedby) {
                                var a = $('<a />').attr('href', "/directory/#" + response.hostedbyid).attr('class', 'col-xs-6');
                                a.append(img);
                                $output.append(a);
                            } else {
                                $output.append(img);
                            }
                            $output.append(
                                $('<div />').attr('class', 'col-xs-6')
                                            .append($('<p />').append($('<a />').attr('href', 'https://api.thegreenwebfoundation.org/greencheckimage/'+ domain + '?download=1').text('Download badge here')))
                                            .append($('<p />').attr('style', 'margin-bottom:0px;').text('Copy the following code to include an image on your Facebook / Twitter'))
                                            .append($('<textarea />').attr('style', 'width:300px; margin-bottom:5px;').text("https://api.thegreenwebfoundation.org/greencheckimage/" + domain))
                            );
                            
                            $output.append(
                                $('<div />').attr('class', 'col-xs-6')
                                            .append($('<p />').attr('style', 'margin-bottom:0px;').text('Copy the following code to include an image on your website'))
                                            .append($('<textarea />').attr('style', 'width:300px; margin-bottom:5px;').text("<img src='https://api.thegreenwebfoundation.org/greencheckimage/" + domain + "'>"))
                            );

                            $smallresult = $('#tgwf-logo-page-small-result');
                            $smallresult.html('');
                            $('#tgwf-logo-page-small-addendum').hide();    
                            $mediumresult = $('#tgwf-logo-page-medium-result');
                            $mediumresult.html('');                                                        

                            if(response.green){
                                var imgsmall = $("<img />").attr('class', '').attr('style', 'margin-top:20px;').attr('src', "https://www.thegreenwebfoundation.org/wp-content/uploads/2015/02/20.png")
                                var smalltext = '';
                                if(response.hostedby) {
                                    var a = $('<a />').attr('href', "/directory/#" + response.hostedbyid);
                                    a.append(imgsmall);
                                    smalltext = ' is green hosted by ' + response.hostedby;
                                    a.append(smalltext);
                                    $smallresult.append($('<div />').attr('class', 'col-xs-6').append(a));
                                } else {
                                    $smallresult.append(imgsmall);
                                }
                                
                                $smallresult.append(
                                    $('<div />').attr('class', 'col-xs-6')
                                                .append($('<p />').attr('style', 'margin-bottom:0px;').text('Copy the following code to include this image on your website'))
                                                .append($('<textarea />').attr('style', 'width:300px; margin-bottom:5px;').text("<img src='https://www.thegreenwebfoundation.org/wp-content/uploads/2015/02/20.png'>" + smalltext + ""))
                                );  
                                $('#tgwf-logo-page-small-addendum').show();    
                                
                                var imgsmall = $("<img />").attr('class', '').attr('style', 'margin-top:20px;').attr('src', "https://www.thegreenwebfoundation.org/wp-content/uploads/2015/02/small-generic-badge.png")
                                var smalltext = '';
                                if(response.hostedby) {
                                    var a = $('<a />').attr('href', "/directory/#" + response.hostedbyid);
                                    a.append(imgsmall);
                                    $mediumresult.append($('<div />').attr('class', 'col-xs-6').append(a));
                                } else {
                                    $mediumresult.append(imgsmall);
                                }
                                
                                $mediumresult.append(
                                    $('<div />').attr('class', 'col-xs-6')
                                                .append($('<p />').attr('style', 'margin-bottom:0px;').text('Copy the following code to include this image on your website'))
                                                .append($('<textarea />').attr('style', 'width:300px; margin-bottom:5px;').text("<img src='https://www.thegreenwebfoundation.org/wp-content/uploads/2015/02/small-generic-badge.png'>"))
                                );

                            }
                            

                            $supporter = $('#tgwf-logo-page-supporter');
                            $supporter.html('');                                                        
                            var imgsmall = $("<img />").attr('class', '').attr('style', 'margin-top:20px;').attr('src', "https://www.thegreenwebfoundation.org/wp-content/uploads/2015/02/601.png")
                            var smalltext = '';
                            if(response.hostedby) {
                                var a = $('<a />').attr('href', "/directory/#" + response.hostedbyid);
                                a.append(imgsmall);
                                $supporter.append($('<div />').attr('class', 'col-xs-6').append(a));
                            } else {
                                $supporter.append(imgsmall);
                            }
                            
                            $supporter.append(
                                $('<div />').attr('class', 'col-xs-6')
                                            .append($('<p />').attr('style', 'margin-bottom:0px;').text('Copy the following code to include this image on your website'))
                                            .append($('<textarea />').attr('style', 'width:300px; margin-bottom:5px;').text("<img src='https://www.thegreenwebfoundation.org/wp-content/uploads/2015/02/601.png'>"))
                            );


                        }
                });
            });  
        }
        
        
        return false;
    });
}

function checkQuery()
{
    var search = getParameterByName('check');
    if (search) {
        domain = search.replace('http://','');
        domain = domain.replace('https://','');
	split = domain.split('/');
 	domain = split[0];
        $('#url').val(domain);
        $('#greencheck').submit();
    }
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
