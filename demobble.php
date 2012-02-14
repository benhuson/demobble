<?php

/*

Plugin Name: demobbled
Description: Functions to store/remove a cookie if a user doesn't want their device to be detected as mobile. Intended to be used in conjunction with a plugin like <a href="http://www.toggle.uk.com/journal/mobble" target="_blank">mobble</a> which I highly recommend if you need to do any device checking in PHP.
Author: Ben Huson
Version: 1.0

Copyright (c) 2012 Ben Huson

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

THIS SOFTWARE AND DOCUMENTATION IS PROVIDED "AS IS," AND COPYRIGHT
HOLDERS MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED,
INCLUDING BUT NOT LIMITED TO, WARRANTIES OF MERCHANTABILITY OR
FITNESS FOR ANY PARTICULAR PURPOSE OR THAT THE USE OF THE SOFTWARE
OR DOCUMENTATION WILL NOT INFRINGE ANY THIRD PARTY PATENTS,
COPYRIGHTS, TRADEMARKS OR OTHER RIGHTS.COPYRIGHT HOLDERS WILL NOT
BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL OR CONSEQUENTIAL
DAMAGES ARISING OUT OF ANY USE OF THE SOFTWARE OR DOCUMENTATION.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://gnu.org/licenses/>.

*/

new Demobbled;

/**
 * Demobble Class
 */
class Demobbled {
	
	public static $demobbled = false;
	
	/**
	 * Constructor
	 */
	function Demobbled() {
		add_action( 'init', array( 'Demobbled', 'maybe_demobble' ), 1 );
	}
	
	/**
	 * Maybe Demobble
	 * Set/remove cookie based on query parameter
	 */
	function maybe_demobble() {
		if ( isset( $_COOKIE['demobbled'] ) )
			Demobbled::$demobbled = true;
		
		// Handle Demobbling
		if ( isset( $_GET['demobbled'] ) ) {
			if ( $_GET['demobbled'] == 'true' ) {
				Demobbled::demobble();
			} elseif ( $_GET['demobbled'] == 'false' ) {
				Demobbled::un_demobble();
			}
		}
	}
	
	/**
	 * Is Demobbled
	 * Cookie set so don't treat as mobile
	 */
	function is_demobbled() {
		return Demobbled::$demobbled;
	}

	/**
	 * Demobble
	 * Set cookie so we can detect mobile override
	 */
	function demobble() {
		setcookie( 'demobbled', 1, time() + 3600, '/', Demobbled::get_cookie_domain() );
		Demobbled::$demobbled = true;
	}

	/**
	 * Un-Demobble
	 * Clear the cookie to treat as mobile once again
	 */
	function un_demobble() {
		setcookie( 'demobbled', 0, time() - 3600, '/', Demobbled::get_cookie_domain() );
		Demobbled::$demobbled = false;
	}

	/**
	 * Get Cookie Domain
	 */
	function get_cookie_domain() {
		return strpos( get_bloginfo( 'url' ), 'http://www.' ) === false ? str_replace( 'http://', '', get_bloginfo( 'url' ) ) : str_replace( 'http://www.', '', get_bloginfo( 'url' ) );
	}
	
}

?>