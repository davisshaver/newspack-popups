/**
 * External dependencies
 */
import 'whatwg-fetch';

/**
 * Specify a function to execute when the DOM is fully loaded.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/packages/dom-ready/
 *
 * @param {Function} callback A function to execute after the DOM is ready.
 * @return {void}
 */
function domReady( callback ) {
	if ( typeof document === 'undefined' ) {
		return;
	}
	if (
		document.readyState === 'complete' || // DOMContentLoaded + Images/Styles/etc loaded, so we call directly.
		document.readyState === 'interactive' // DOMContentLoaded fires at this point, so we call directly.
	) {
		return void callback();
	}
	// DOMContentLoaded has not fired yet, delay callback until then.
	document.addEventListener( 'DOMContentLoaded', callback );
}

/**
 * Internal dependencies
 */
import './style.scss';
import './patterns.scss';
import { getClientIDValue, waitUntil } from './utils';
import { manageAnalyticsLinkers, manageAnalyticsEvents } from './analytics';
import { manageForms } from './form';
import { manageAnimations } from './animation';
import { managePositionObservers } from './position-observer';
import { manageBinds } from './bind';
import { manageAccess } from './access';
import { manageAnalytics } from './analytics/ga4';

if ( typeof window !== 'undefined' ) {
	domReady( () => {
		// Handle AMP Analytics linkers right away, before amp-access sets a cookie value.
		// @TODO: Deprecate after GA3 is deprecated.
		manageAnalyticsLinkers();

		// But don't manage GA3 analytics events until the client ID is available.
		// @TODO: Deprecate after GA3 is deprecated.
		waitUntil( getClientIDValue, manageAnalyticsEvents );

		manageForms();
		manageAnimations();
		managePositionObservers();
		manageBinds();
		manageAccess();

		// GA4 analytics.
		manageAnalytics();
	} );
}
