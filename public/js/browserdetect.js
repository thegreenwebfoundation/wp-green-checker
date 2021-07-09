/**
 * Browserdetect function for correct download links
 * Copyright 2011-2011 The Green Web Foundation - Arend-Jan Tetteroo
 */
var BrowserDetect = {
    init: function () {
      this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
      if (this.browser == 'Firefox') {
        this.link    = 'https://addons.mozilla.org/en-US/firefox/addon/the-green-web/';
      } else if (this.browser == 'Chrome') {
        this.link    = 'https://chrome.google.com/webstore/detail/ekiibapogjgmlhlhpoalbppfhhgkcogc';
      } else if(this.browser == 'Explorer') {
        this.link    = 'https://api.thegreenwebfoundation.org/thegreenweb/thegreenwebIE.zip';
      } else if(this.browser == 'Safari') {
        this.link    = 'https://api.thegreenwebfoundation.org/thegreenweb/thegreenweb.safariextz';
      } else if(this.browser == 'Opera') {
        this.link    = 'https://addons.opera.com/nl/extensions/details/the-green-web/?display=en';
      } else {
        this.link    = 'https://www.thegreenwebfoundation.org/add-ons/';
      }
      this.version = this.searchVersion(navigator.userAgent)
            || this.searchVersion(navigator.appVersion)
            || "an unknown version";
        this.OS = this.searchString(this.dataOS) || "an unknown OS";
    },
    searchString: function (data) {
        for (var i=0;i<data.length;i++) {
            var dataString = data[i].string;
            var dataProp = data[i].prop;
            this.versionSearchString = data[i].versionSearch || data[i].identity;
            if (dataString) {
                if (dataString.indexOf(data[i].subString) != -1)
                    return data[i].identity;
            }
            else if (dataProp)
                return data[i].identity;
        }
    },
    searchVersion: function (dataString) {
        var index = dataString.indexOf(this.versionSearchString);
        if (index == -1) return;
        return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
    },
    dataBrowser: [
        {
            string: navigator.userAgent,
            subString: "OPR",
            identity: "Opera",
            versionSearch: "OPR"
        },
        {
            string: navigator.userAgent,
            subString: "Chrome",
            identity: "Chrome"
        },
        {   string: navigator.userAgent,
            subString: "OmniWeb",
            versionSearch: "OmniWeb/",
            identity: "OmniWeb"
        },
        {
            string: navigator.vendor,
            subString: "Apple",
            identity: "Safari",
            versionSearch: "Version"
        },
        {
            prop: window.opera,
            identity: "Opera"
        },
        {
            string: navigator.vendor,
            subString: "iCab",
            identity: "iCab"
        },
        {
            string: navigator.vendor,
            subString: "KDE",
            identity: "Konqueror"
        },
        {
            string: navigator.userAgent,
            subString: "Firefox",
            identity: "Firefox"
        },
        {
            string: navigator.vendor,
            subString: "Camino",
            identity: "Camino"
        },
        {       // for newer Netscapes (6+)
            string: navigator.userAgent,
            subString: "Netscape",
            identity: "Netscape"
        },
        {
            string: navigator.userAgent,
            subString: "MSIE",
            identity: "Explorer",
            versionSearch: "MSIE"
        },
        {
            string: navigator.userAgent,
            subString: "Gecko",
            identity: "Mozilla",
            versionSearch: "rv"
        },
        {       // for older Netscapes (4-)
            string: navigator.userAgent,
            subString: "Mozilla",
            identity: "Netscape",
            versionSearch: "Mozilla"
        }
    ],
    dataOS : [
        {
            string: navigator.platform,
            subString: "Win",
            identity: "Windows"
        },
        {
            string: navigator.platform,
            subString: "Mac",
            identity: "Mac"
        },
        {
               string: navigator.userAgent,
               subString: "iPhone",
               identity: "iPhone/iPod"
        },
        {
            string: navigator.platform,
            subString: "Linux",
            identity: "Linux"
        }
    ]
};
BrowserDetect.init();

function doBrowserDetect () {
    bd = '<a href="' + BrowserDetect.link + '"><strong>Install The Green Web Add-on for <span class="accent"> ' + BrowserDetect.browser + ' ' + BrowserDetect.version + '</span></a> and help us build The Green Web!</strong>';
    $('#browserdetect').html(bd);

    bd = '<a href="' + BrowserDetect.link + '">' + BrowserDetect.browser + '</a>';
    $('.browserdetect').html(bd);

    bd = '<a href="' + BrowserDetect.link + '">Install The Green Web<br/> Add-on for <span class="accent"> ' + BrowserDetect.browser + ' ' + BrowserDetect.version + '</span><br/> and help us build<br/> The Green Web!</a>';
    $('#browserdetect_front').html(bd);
    $('#browserdetect_front_a').attr({'href' : BrowserDetect.link,'target': '_blank' });
    if(BrowserDetect.browser == 'Chrome'){
        $('#browserdetect_front_a').click(function(){
            chrome.webstore.install();
        });
        if (chrome.app.isInstalled) {
            $('#browserdetect_front').html(' You have installed the Green Web Add-on');
        }
    }
}

function doBrowserDetectLink () {
    $('.tgwf_green').attr('href', BrowserDetect.link);
}
doBrowserDetectLink();
