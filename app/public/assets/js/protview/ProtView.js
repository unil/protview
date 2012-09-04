/**
 * Provides the base ProtView class
 *
 * Requires at least (in the following order) : 
 * jQuery 1.7.2 
 * underscore 1.3.3
 * backbonejs 0.9.2 
 * jQuery SVG 1.4.5 
 * jQuery SVG Dom (same version as jQuery SVG)
 * 
 * @author Stefan Meier
 * @version 20120903
 *
**/

(function($, exports) {
	window.ProtView = {
	};
	
	/**
	 * Contains application wide used Classes
	 * 
	 * Contains classes such as Context, Mediator and Sandbox
	 * Is also responisble for routing and global view interactions
	 * 
	 * @author Stefan Meier
	 * @version 20120903
	 * 
	 * @module Application
	 * @main Application
	 */
	ProtView.Application = {};
	/**
	 * Contains protein drawing classes
	 * 
	 * Draws protein, and offers drawing related functionalities such
	 * as export, resizing, etc.
	 * 
	 * @author Stefan Meier
	 * @version 20120903
	 * 
	 * @module DrawBoard
	 * @main DrawBoard
	 */
	ProtView.DrawBoard = {};
	/**
	 * Contains base classes which are inherited in other modules
	 * 
	 * Helpers, MVC base classes, utility classes
	 * 
	 * @author Stefan Meier
	 * @version 20120903
	 * 
	 * @module Core
	 * @main Core
	 */
	ProtView.Core = {};
	/**
	 * Contains protein structural related classes
	 * 
	 * Peptide form, Protein Form, handles all structural interactions
	 * 
	 * @author Stefan Meier
	 * @version 20120903
	 * 
	 * @module Structure
	 * @main Structure
	 */
	ProtView.Structure = {};
})(this.JQuery, this);