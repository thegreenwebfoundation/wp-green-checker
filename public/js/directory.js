/**
 * Expects a page in the site to exist called called /directory.
 * This should contain <div id="tgwf_directory"></div>, which attachDirectory inserts the directory into.
 */

(function($) {
	function attachDirectory() {

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

				$('#vmap').vectorMap({
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

							providerinfo = "<p class='providerinfo hide' id=providerinfo-" + provider.id + ">Provider information here</p>";

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
							template += "<tr><th>Active in</th><td>" + data.countrydomain + "</td></tr>"



							template += "</tr><tr><th>Datacenters in use</th><td>";
							if (data.datacenters.length == 0) { 
								template += "Unknown ";
							} else { 
								template += data.datacenters.length;

							} 
							template += "</td></tr></table></div>";
						
							if (data.datacenters.length > 0) { 
								template += "<table class='table'><thead><tr><th>Name</th><th>City</th><th>Country</th><th>PUE</th></tr></thead><tbody>";
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

	attachDirectory();
})( jQuery );