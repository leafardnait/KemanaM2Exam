define([
    'jquery',
    'uiComponent',
    'ko',
    'mage/url',
], function (
    $,
    Component,
    ko,
    _url,
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Kemana_Superhero/checkout/dropdownuniverses',
            dropDownUniverses: ko.observableArray([]),
            IsSuperhero: ko.observable()
        },
        initObservable: function () {
            this._super().observe([
                'dropDownUniverses',
            ]);
            this.IsSuperhero(this.getIsSuperhero());
            if(this.getIsSuperhero()){
                this.getDropDownUniverses();
            }
            return this;
        },
        
         getDropDownUniverses: function () {
            
            $.ajax({
                method    : 'GET',
                url       : _url.build('superhero/superhero/universes'),
                type      : 'json',
                showLoader: true,
            }).done(function (data) {
                if(!$.trim(data.universesDropdown)){
                    this.dropDownUniverses([]);
                }else{
                    var _universesArray = ([]);
                    _.each(data.universesDropdown, function(val, key) {
                        _universesArray.push(val.value);
                    });

                    this.dropDownUniverses(_universesArray);
                }
            }.bind(this));
        },

        getIsSuperhero: function() {
            return window.checkoutConfig.is_superhero;
        },
    });

});