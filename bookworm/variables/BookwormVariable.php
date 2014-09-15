<?php

/*

	Bookworm for Goodreads
	
	Author: Ian Isted (@ianisted)
	Site: http://www.ianisted.co.uk
	Version: 1.0

	Notes:
	
	Future versions of this plugin are to include caching, and more detailed error checking.
	
*/

namespace Craft;

class BookwormVariable
{
	
	public function fetch($options = NULL)
	{
		
		// Fetch plugin settings
		$settings = craft()->plugins->getPlugin('Bookworm')->getSettings();
    $userID = $settings['goodreadsID'];
    $apiKey = $settings['goodreadsAPIKey'];
    $showErrors = $settings['showErrors'];
    
    $shelf = (isset($options['shelf']) ? $options['shelf'] : 'read');
    $limit = (isset($options['limit']) ? $options['limit'] : '10');
    $sortBy = (isset($options['sortBy']) ? $options['sortBy'] : 'date_read');
    
    if ($userID === "" || $apiKey === "") {
	    
	    // Basic error check to see if API Key and User ID have values.
    	$error = "You must provide an API key and User ID. Please finishing setting up Bookworm using the plugin settings in Craft.";
    
    } else {
    
    	// Construct the feed URL and try to fetch the data.
			$feed_url = "http://www.goodreads.com/review/list_rss/$userID?key=$apiKey&method=reviews.list&per_page=$limit&shelf=$shelf&sort=$sortBy";
			$feed = @simplexml_load_file($feed_url);
			
			// Check if the simplexl_load_file gave us some data or if the function threw back an error.
			if ($feed) {
				$feed = $feed->channel->item;
			
				$books = array();
				
				// Loop through the XML file, and try to construct an array of books and book data.
				foreach($feed as $book) {
					
					// Check if book data exists, if it does add it, otherwise return an empty variable.
					$title = ($book->title ? $book->title : false);
					$author = ($book->author_name ? $book->author_name : false);
					$image = ($book->book_large_image_url ? $book->book_large_image_url : false);
					$description = ($book->book_description ? $book->book_description : false);
					$url = ($book->link ? $book->link : false);
					$rating = ($book->user_rating ? $book->user_rating : false);
					
					$books[] = array('title'=>$title,'author'=>$author,'image'=>$image,'description'=>$description,'url'=>$url,'rating'=>$rating);
					
				}
				
				if (count($books) > 0) {
					// Everything seems to have worked, send the books to the template.
					return $books;
				} else {
					$error = "No books could be found. Are your settings correct?<br />Feed url: <a href='$feed_url' target='_blank' style='color:#000000 !important;'>$feed_url</a>";
				}
			} else {
				// In the event of an simplexl_load_file error attempt to notify the user.
				$error = "There was an error trying to fetch your books. Goodreads might be down, or your settings may be incorrect.";
			}
		}
		
		
		// If errors are switched on in the plugin settings then display the error, otherwise continue to fail.
		if ($showErrors) {
			echo('<p style="background-color:yellow !important;padding:1em !important;color:#000 !important;font-size:16px !important;line-height:auto !important;font-weight:bold !important;border:1px solid #000 !important;">' . $error . '</p>');
		}
		
		// Things did not go so well, so return nothing.
		return false;
	}
}