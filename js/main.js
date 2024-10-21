(function ($) {
    "use strict";
    $('.language').hover(function () {
        var $this = $(this);
        $this.addClass('show');
        $this.find('> a').attr('aria-expanded', true);
        $this.find('.dropdown-menu').addClass('show');
    }, function () {
        var $this = $(this);
        $this.removeClass('show');
        $this.find('> a').attr('aria-expanded', false);
        $this.find('.dropdown-menu').removeClass('show');
    });
    $('nav .dropdown').hover(function () {
        var $this = $(this);
        $this.addClass('show');
        $this.find('> a').attr('aria-expanded', true);
        $this.find('.dropdown-menu').addClass('show');
    }, function () {
        var $this = $(this);
        $this.removeClass('show');
        $this.find('> a').attr('aria-expanded', false);
        $this.find('.dropdown-menu').removeClass('show');
    });

})(jQuery);

/* Function to clickable map work properly */
$(function () {
    var czechMapOverlap = $('#czechMap-overlap');

    // map hover
    $('.czechMap-area').hover(function () {

        czechMapOverlap.attr('src', $(this).attr('data-img'));
        //czechMapOverlap.hide(0).stop(false, true);
        czechMapOverlap.show();

    }, function () {

        czechMapOverlap.attr('src', './img/mapa/none.png');
        czechMapOverlap.show(0);
    });

    $('.czechMap-area, .czechMap-link').click(function (e) {
        e.preventDefault();
        czechMapOverlap.attr('src', $(this).attr('data-img'));

        var area = $(this).attr('data-title');
        $('.map-contacts-title').empty().text(area);
        var officeKey = $(this).attr('data-target');
        //$('.map-contacts-hr').show();

        $('.map-contacts-office').hide();
        $('.' + officeKey).show();
    });
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

const isForm = document.querySelector('.service-inquiry')

if (isForm) {
    newInsuranceOption()
    descructionType()
}


function newInsuranceOption() {
    const comboSelect = document.getElementById('combo-select-insurance')
    const customInput = document.querySelector('.custom-input-wrapper')
    const customOption = document.querySelector('.custom-input')

    comboSelect.addEventListener('change', function () {
        if (comboSelect.value === 'custom') {
            customInput.classList.remove('hidden-input')
            customInput.focus()
            //comboSelect.classList.add('hidden-input')
        } else {
            customInput.classList.add('hidden-input')
            //deleteBtn.classList.remove('hidden-input')
        }
    })
}

function descructionType() {
    const radioInput1 = document.getElementById("flexRadio1")
    const radioInput2 = document.getElementById("flexRadio2")
    const textInput = document.getElementById('dest-description')

    function updateDestDesc() {
        if (radioInput2.checked) {
            textInput.removeAttribute('disabled')
        } else {
            textInput.setAttribute('disabled', 'disabled')
        }
    }
    radioInput1.addEventListener('change', updateDestDesc)
    radioInput2.addEventListener('change', updateDestDesc)

    updateDestDesc()
}

function addRetargetingCode() {
    const head = document.querySelector('head')
    const script = document.createElement('script')
    script.src = 'https://c.seznam.cz/js/rc.js'
    script.setAttribute('type', 'text/javascript')
    head.appendChild(script)
    const script2 = document.createElement('script')
    script2.setAttribute('type', 'text/javascript')
    script2.innerHTML = `
  window.sznIVA.IS.updateIdentities({
    eid: null
  });

  var retargetingConf = {
    rtgId: 37259,
    consent: null
  };
  window.rc.retargetingHit(retargetingConf);
    `
    head.appendChild(script2)
}

addRetargetingCode()

function addCookiesBanner() {
    const head = document.querySelector('head')
    const script = document.createElement('script')
    script.src = 'https://consent.cookiebot.com/uc.js'
    script.setAttribute('type', 'text/javascript')
    script.setAttribute('data-cbid', '17b36c11-f63b-48e0-9931-ef5233f7cb81')
    script.setAttribute('data-blockingmode', 'auto')
    head.appendChild(script)
}

addCookiesBanner()