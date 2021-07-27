
(function($) {
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

						// $smallresult.append(imgsmall).append(check.url + ' is grey ');
					}

					$list.append($smallresult.append('<span class="pull-right"> | Checked ' + moment(check.date).fromNow() + '</span'));
				});            
				$('#activity_feed_checks').html('');
				$('#activity_feed_checks').append($list);
			});
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
})( jQuery );
