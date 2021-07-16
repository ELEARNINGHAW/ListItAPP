/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.resize_maxWidth = 480;
	config.width = 500;

	config.toolbar_MyToolbar =
    [
        ['Source'],
		['Undo','Redo','RemoveFormat'],
        ['Format'],
        ['Bold','Italic','Strike'],
        ['NumberedList','BulletedList'] 
		
    ];
	
    config.toolbar = 'MyToolbar';
	
	
};

