define([
	'jquery',
	'mage/storage',
	'Eloom_Core/js/model/url-builder'
], function ($,
             storage,
             urlBuilder) {
	'use strict';

	$.widget('mage.EloomWidgetGrid', {
		options: {
			selectors: {
				container: 'div.block-products'
			},
		},

		_init: function () {
			this.call();
		},

		call: function () {
			let self = this;
			let $widget = self.element;
			let matches = $widget[0].querySelectorAll("div.grid .items.pages-items li.item > a");

			matches.forEach(
				function(entry, index, listObj) {
					$(entry).click(function (event) {
						event.preventDefault();

						try {
								const widget = $widget.parents(self.options.selectors.container)[0];
								const params = widget.getAttribute("data-params");

								$.ajax({
									url: entry.href,
									type: "POST",
									data: JSON.parse(params ? params : ''),
									showLoader: true
								}).done(function (response) {
									$(widget).html(response.output).trigger('contentUpdated');
								}).fail(
								);
						} catch (e) {
							console.error(e);
						}
					})
				}
			);
		}
	});

	return $.mage.EloomWidgetGrid;
});